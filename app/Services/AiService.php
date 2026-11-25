<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AiService
{
    protected array $faq = [
        'services' => 'Ironspan Commercial Coatings specializes in warehouse interiors, plant exteriors, high-rise facade recoats, epoxy floor prep coatings, and industrial steel structure painting across the Gulf Coast.',
        'estimate' => 'Most commercial estimates are returned within 48 business hours after a site walk. Send facility type, square footage, substrate, and desired finish schedule for a faster quote.',
        'lead' => 'Typical lead time is 2–6 weeks depending on crew availability, containment needs, and weather windows for exterior work.',
        'safety' => 'We follow OSHA fall protection, confined-space, and VOC compliance protocols. Crews are insured, bonded, and trained for occupied facility work.',
        'hours' => 'Office hours are Monday–Friday 7:00 AM–5:00 PM CT. Night and weekend production shifts are available for operating warehouses and plants.',
        'warranty' => 'Standard labor warranty is 2 years on commercial recoats; manufacturer film warranties apply based on the coating system specified.',
        'contact' => 'Call (713) 555-0148 or email hello@ironspan.coatings. WhatsApp: +1 713-555-0148. Houston HQ serves TX, LA, and OK industrial corridors.',
        'payment' => 'We accept ACH, check, and card. Progress billing is standard on multi-phase industrial jobs; net-30 available for approved accounts.',
    ];

    public function chat(string $message, string $mode = 'public'): string
    {
        $message = trim($message);
        if ($message === '') {
            return 'Ask about commercial painting services, scheduling, estimates, or safety compliance.';
        }

        if ($key = config('services.openai.key')) {
            $reply = $this->callOpenAi($message, $mode, $key);
            if ($reply) {
                return $reply;
            }
        }

        if ($key = config('services.gemini.key')) {
            $reply = $this->callGemini($message, $mode, $key);
            if ($reply) {
                return $reply;
            }
        }

        return $this->demoReply($message, $mode);
    }

    public function generate(string $prompt, string $type = 'blog'): string
    {
        $enriched = match ($type) {
            'description' => "Write a concise commercial painting service description: {$prompt}",
            'automation' => "Suggest ERP automation ideas for a commercial painting contractor: {$prompt}",
            'troubleshoot' => "Troubleshoot this Ironspan ERP/operations issue: {$prompt}",
            default => "Write a knowledge-base style blog draft about commercial/industrial painting: {$prompt}",
        };

        return $this->chat($enriched, 'admin');
    }

    protected function systemPrompt(string $mode): string
    {
        $base = 'You are the AI assistant for Ironspan Commercial Coatings, a US commercial and industrial painting contractor based in Houston, TX. Be concise, professional, and practical.';

        return $mode === 'admin'
            ? $base.' Help staff with content, job ops, inventory, invoicing, and troubleshooting.'
            : $base.' Answer public FAQ about services, estimates, scheduling, safety, and contact.';
    }

    protected function callOpenAi(string $message, string $mode, string $key): ?string
    {
        try {
            $response = Http::withToken($key)
                ->timeout(20)
                ->post('https://api.openai.com/v1/chat/completions', [
                    'model' => config('services.openai.model', 'gpt-4o-mini'),
                    'messages' => [
                        ['role' => 'system', 'content' => $this->systemPrompt($mode)],
                        ['role' => 'user', 'content' => $message],
                    ],
                    'temperature' => 0.5,
                ]);

            if ($response->successful()) {
                return trim((string) data_get($response->json(), 'choices.0.message.content'));
            }
        } catch (\Throwable) {
            return null;
        }

        return null;
    }

    protected function callGemini(string $message, string $mode, string $key): ?string
    {
        try {
            $model = config('services.gemini.model', 'gemini-1.5-flash');
            $response = Http::timeout(20)
                ->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$key}", [
                    'contents' => [[
                        'parts' => [['text' => $this->systemPrompt($mode)."\n\nUser: {$message}"]],
                    ]],
                ]);

            if ($response->successful()) {
                return trim((string) data_get($response->json(), 'candidates.0.content.parts.0.text'));
            }
        } catch (\Throwable) {
            return null;
        }

        return null;
    }

    protected function demoReply(string $message, string $mode): string
    {
        $lower = Str::lower($message);

        foreach ([
            'warrant' => 'warranty',
            'pay' => 'payment',
            'price|cost|quote|estimate|bid' => 'estimate',
            'schedule|lead|timeline|when' => 'lead',
            'safe|osha|voc|compliance' => 'safety',
            'hour|open|night|weekend' => 'hours',
            'contact|phone|email|whatsapp|call' => 'contact',
            'service|paint|coat|warehouse|plant|epoxy|exterior' => 'services',
        ] as $pattern => $key) {
            if (preg_match('/'.$pattern.'/i', $lower)) {
                $prefix = $mode === 'admin' ? '[Demo AI · FAQ] ' : '';

                return $prefix.$this->faq[$key];
            }
        }

        if ($mode === 'admin') {
            return "[Demo AI] Draft response for: \"{$message}\"\n\n"
                ."Ironspan crews typically stage containment, blast or power-wash substrates, apply primer compatible with the specified system, then finish with high-build industrial coatings. "
                .'Recommend documenting substrate moisture, DFT readings, and cure windows in the job packet. Add OPENAI_API_KEY or GEMINI_API_KEY for live model output.';
        }

        return 'Thanks for reaching out to Ironspan Commercial Coatings. We handle warehouse, plant, and high-rise commercial recoats. '
            .'Ask about estimates, lead times, safety, or call (713) 555-0148 — or browse our Knowledge Base for guides.';
    }
}
