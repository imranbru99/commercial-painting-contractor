<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\KnowledgeArticle;
use App\Models\Payment;
use App\Models\Post;
use App\Models\Product;
use App\Models\Project;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::query()->updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Ironspan Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '(713) 555-0100',
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'manager@ironspan.demo'],
            [
                'name' => 'Maya Ortiz',
                'password' => Hash::make('password'),
                'role' => 'manager',
                'phone' => '(713) 555-0101',
            ]
        );

        $staff = User::query()->updateOrCreate(
            ['email' => 'foreman@ironspan.demo'],
            [
                'name' => 'Derek Hale',
                'password' => Hash::make('password'),
                'role' => 'staff',
                'phone' => '(713) 555-0102',
            ]
        );

        Setting::setValue('company_name', 'Ironspan Commercial Coatings');
        Setting::setValue('phone', '(713) 555-0148');
        Setting::setValue('email', 'hello@ironspan.coatings');
        Setting::setValue('whatsapp', '+17135550148');
        Setting::setValue('address', '4200 Navigation Blvd, Houston, TX 77003');
        Setting::setValue('tax_rate', '8.25');

        $customers = collect([
            ['Gulfport Logistics Hub', 'Priya Nair', 'priya@gulfportlogistics.demo', 'Distribution', 'Houston', 'TX'],
            ['Bayou Process Chemicals', 'Marcus Webb', 'marcus@bayouprocess.demo', 'Chemical Plant', 'Pasadena', 'TX'],
            ['Skyline Tower REIT', 'Elena Cho', 'elena@skylinetower.demo', 'Commercial Real Estate', 'Dallas', 'TX'],
            ['Red River Steel Fab', 'Jon Briggs', 'jon@redriversteel.demo', 'Fabrication', 'Shreveport', 'LA'],
            ['Coastal Cold Storage', 'Ana Ruiz', 'ana@coastalcold.demo', 'Cold Storage', 'Galveston', 'TX'],
        ])->map(function (array $row) {
            return Customer::query()->updateOrCreate(
                ['email' => $row[2]],
                [
                    'company_name' => $row[0],
                    'contact_name' => $row[1],
                    'phone' => '(713) 555-'.random_int(1000, 9999),
                    'industry' => $row[3],
                    'city' => $row[4],
                    'state' => $row[5],
                    'address' => random_int(100, 9000).' Industrial Pkwy',
                    'zip' => (string) random_int(77001, 77999),
                ]
            );
        });

        $products = [
            ['ISC-PRIME-ZINC', 'Zinc-Rich Epoxy Primer', 'primer', 48.00, 79.00, 220],
            ['ISC-FINISH-POLY', 'Industrial Polyurethane Finish', 'finish', 52.00, 88.00, 180],
            ['ISC-ELAST-EXT', 'Elastomeric Exterior Membrane', 'elastomeric', 36.00, 64.00, 140],
            ['ISC-EPOXY-BASE', 'High-Build Epoxy Basecoat', 'epoxy', 41.00, 72.00, 160],
            ['ISC-ACRYLIC-WB', 'Low-VOC Waterborne Acrylic', 'finish', 28.00, 49.00, 300],
            ['ISC-BLAST-MEDIA', 'Steel Grit Blast Media', 'consumable', 18.00, 32.00, 90],
        ];

        foreach ($products as [$sku, $name, $cat, $cost, $price, $qty]) {
            Product::query()->updateOrCreate(
                ['sku' => $sku],
                [
                    'name' => $name,
                    'category' => $cat,
                    'description' => $name.' for commercial/industrial coating programs.',
                    'unit_cost' => $cost,
                    'unit_price' => $price,
                    'stock_qty' => $qty,
                    'unit' => str_contains($sku, 'MEDIA') ? 'bag' : 'gal',
                    'is_active' => true,
                ]
            );
        }

        $projects = [];
        $defs = [
            ['JOB-2401', 0, 'Warehouse wall recoat — Building C', 'in_progress', 186000],
            ['JOB-2402', 1, 'Process plant exterior elastomeric', 'scheduled', 312000],
            ['JOB-2403', 2, 'High-rise facade Phase 2 swing stage', 'estimate', 540000],
            ['JOB-2404', 3, 'Structural steel mezzanine system', 'punch', 97000],
            ['JOB-2405', 4, 'Cold storage interior low-VOC program', 'completed', 124000],
            ['JOB-2406', 0, 'Dock canopy and bollard coatings', 'in_progress', 42000],
        ];

        foreach ($defs as [$num, $idx, $title, $status, $value]) {
            $projects[] = Project::query()->updateOrCreate(
                ['job_number' => $num],
                [
                    'customer_id' => $customers[$idx]->id,
                    'assigned_to' => $idx % 2 === 0 ? $staff->id : $admin->id,
                    'title' => $title,
                    'description' => 'Commercial coating scope with containment and DFT documentation.',
                    'site_address' => $customers[$idx]->address.', '.$customers[$idx]->city.', '.$customers[$idx]->state,
                    'status' => $status,
                    'priority' => $status === 'estimate' ? 'high' : 'normal',
                    'start_date' => now()->subDays(random_int(5, 40)),
                    'due_date' => now()->addDays(random_int(10, 60)),
                    'estimated_value' => $value,
                    'actual_value' => $status === 'completed' ? $value : 0,
                ]
            );
        }

        foreach ($projects as $i => $project) {
            $invoice = Invoice::query()->updateOrCreate(
                ['invoice_number' => 'INV-24'.str_pad((string) ($i + 1), 3, '0', STR_PAD_LEFT)],
                [
                    'customer_id' => $project->customer_id,
                    'project_id' => $project->id,
                    'issue_date' => now()->subDays(20 - $i),
                    'due_date' => now()->addDays(10 + $i),
                    'status' => $i < 2 ? 'partial' : ($i === 4 ? 'paid' : 'sent'),
                    'subtotal' => $project->estimated_value * 0.4,
                    'tax' => round($project->estimated_value * 0.4 * 0.0825, 2),
                    'total' => round($project->estimated_value * 0.4 * 1.0825, 2),
                    'amount_paid' => $i < 2 || $i === 4 ? round($project->estimated_value * 0.2 * 1.0825, 2) : 0,
                    'notes' => 'Progress billing — Phase '.($i + 1),
                ]
            );

            if ($invoice->amount_paid > 0) {
                Payment::query()->updateOrCreate(
                    ['invoice_id' => $invoice->id, 'reference' => 'PMT-'.$invoice->invoice_number],
                    [
                        'amount' => $invoice->amount_paid,
                        'paid_at' => now()->subDays(random_int(3, 45)),
                        'method' => $i % 2 ? 'ach' : 'check',
                        'notes' => 'Demo payment',
                    ]
                );
            }

            Appointment::query()->updateOrCreate(
                ['title' => 'Site walk — '.$project->title],
                [
                    'customer_id' => $project->customer_id,
                    'project_id' => $project->id,
                    'assigned_to' => $staff->id,
                    'type' => 'site_walk',
                    'starts_at' => now()->addDays($i + 1)->setTime(9, 0),
                    'ends_at' => now()->addDays($i + 1)->setTime(10, 30),
                    'status' => 'scheduled',
                    'location' => $project->site_address,
                    'notes' => 'Bring moisture meter and coating system binder.',
                ]
            );
        }

        $posts = [
            [
                'Night-Shift Warehouse Recoats Without Downtime',
                'night-shift-warehouse-recoats',
                'How Ironspan stages aisle-by-aisle containment for 24/7 fulfillment centers.',
                "Operating warehouses rarely stop for paint. Ironspan sequences night shifts with temporary aisle closures, HEPA negative air, and fast-cure waterborne systems.\n\nKey steps: pre-clean high dust zones, mask racking, apply primer windows between 10 PM and 2 AM, then finish coats before morning inbound.\n\nFacility managers receive daily DFT logs and photo packets before crews demobilize.",
                'https://images.unsplash.com/photo-1553413077-190dd305871c?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'Choosing Elastomeric Systems for Gulf Coast Plants',
                'elastomeric-systems-gulf-coast-plants',
                'Salt air, UV, and thermal cycling demand flexible exterior membranes.',
                "Metal panel plants along the Houston Ship Channel need coatings that move with the substrate. Elastomeric acrylics bridge hairline panel seams while resisting UV chalking.\n\nIronspan specifies wash prep, rust-inhibitive primers on cut edges, and two finish coats with documented mil thickness.\n\nSchedule exterior work around humidity windows under 85% for reliable cure.",
                'https://images.unsplash.com/photo-1581092160562-40aa08e78837?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'DFT Documentation That Passes Owner Audits',
                'dft-documentation-owner-audits',
                'What progressive owners expect in commercial coating closeout packages.',
                "Closeout is more than a final invoice. Owners ask for batch numbers, WFT/DFT readings, humidity logs, and punch photos.\n\nIronspan's ERP job packet stores readings by elevation and bay so auditors can verify system compliance months later.\n\nPair manufacturer data sheets with crew time stamps for a complete chain of custody.",
                'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1200&q=80',
            ],
        ];

        foreach ($posts as [$title, $slug, $excerpt, $body, $cover]) {
            Post::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => $title,
                    'excerpt' => $excerpt,
                    'body' => $body,
                    'cover_image' => $cover,
                    'is_published' => true,
                    'published_at' => now()->subDays(random_int(2, 30)),
                ]
            );
        }

        $kb = [
            ['issues', 'Peeling Paint on Metal Panels', 'peeling-paint-metal-panels', 'Common causes and field fixes for exterior panel failures.', "1. Confirm adhesion failure vs cohesive failure.\n2. Check for oil contamination or missed rust conversion.\n3. Remove failed film to sound substrate.\n4. Apply compatible zinc or epoxy primer.\n5. Recoat with specified elastomeric or polyurethane system."],
            ['issues', 'Slow Cure in High Humidity', 'slow-cure-high-humidity', 'What to do when Gulf Coast humidity stalls cure windows.', "Monitor RH and substrate temperature. Extend recoat windows per TDS. Switch to humidity-tolerant primers when RH exceeds manufacturer limits. Never force finish coats over uncured primer."],
            ['guides', 'Warehouse Night-Shift Playbook', 'warehouse-night-shift-playbook', 'Step-by-step staging for occupied distribution centers.', "1. Pre-walk with ops manager.\n2. Stage materials in sealed cages.\n3. Close two aisles per shift.\n4. Apply primer then finish same night when TDS allows.\n5. Open aisles after tack-free and venting."],
            ['guides', 'Swing-Stage Facade Checklist', 'swing-stage-facade-checklist', 'Engineered access checks before high-rise spray days.', "Verify engineer letters, tie-backs, wind limits, containment skirts, overspray buffers, and DFT sampling plan per elevation."],
            ['admin', 'Admin Manual — Filament ERP', 'admin-manual-filament-erp', 'How managers use Ironspan admin daily.', "Login at /admin with your role.\n- CRM: customers & contact inbox\n- Operations: jobs, scheduling\n- Inventory: coating SKUs\n- Finance: invoices & payments\n- AI Studio: drafts and troubleshooting\n- Settings: company profile"],
            ['admin', 'Role Permissions Overview', 'role-permissions-overview', 'Admin, Manager, and Staff access patterns.', "Admin: full access including users and settings.\nManager: jobs, invoices, inventory, AI tools.\nStaff: assigned jobs, appointments, and field notes."],
            ['troubleshooting', 'Invoice Balance Not Updating', 'invoice-balance-not-updating', 'Fix payments that do not reflect on invoices.', "Ensure payment amount posts to the correct invoice_id. Update amount_paid to equal sum of payments. Set status to partial or paid accordingly."],
            ['troubleshooting', 'AI Demo Mode Responses', 'ai-demo-mode-responses', 'Why the chatbot returns FAQ answers.', "Without OPENAI_API_KEY or GEMINI_API_KEY, AiService serves curated commercial painting FAQ responses. Add a key in .env to enable live models."],
        ];

        foreach ($kb as $i => [$cat, $title, $slug, $summary, $body]) {
            KnowledgeArticle::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => $title,
                    'category' => $cat,
                    'summary' => $summary,
                    'body' => $body,
                    'sort_order' => $i + 1,
                    'is_published' => true,
                ]
            );
        }
    }
}
