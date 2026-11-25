<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\KnowledgeArticle;
use App\Models\Post;
use App\Services\AiService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function home(): View
    {
        $posts = Post::query()->where('is_published', true)->latest('published_at')->take(3)->get();

        return view('pages.home', compact('posts'));
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function services(): View
    {
        return view('pages.services');
    }

    public function serviceShow(string $slug): View
    {
        $services = $this->serviceCatalog();
        abort_unless(isset($services[$slug]), 404);

        return view('services.show', [
            'slug' => $slug,
            'service' => $services[$slug],
            'services' => $services,
        ]);
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function contactStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:160',
            'phone' => 'nullable|string|max:40',
            'company' => 'nullable|string|max:160',
            'subject' => 'nullable|string|max:180',
            'message' => 'required|string|max:5000',
        ]);

        ContactMessage::create($data);

        return back()->with('success', 'Thanks — Ironspan will follow up within one business day.');
    }

    public function blog(): View
    {
        $posts = Post::query()->where('is_published', true)->latest('published_at')->paginate(9);

        return view('blog.index', compact('posts'));
    }

    public function blogShow(string $slug): View
    {
        $post = Post::query()->where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('blog.show', compact('post'));
    }

    public function knowledge(): View
    {
        $articles = KnowledgeArticle::query()
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->get()
            ->groupBy('category');

        return view('kb.index', compact('articles'));
    }

    public function knowledgeShow(string $slug): View
    {
        $article = KnowledgeArticle::query()->where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('kb.show', compact('article'));
    }

    public function chat(Request $request, AiService $ai)
    {
        $data = $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        return response()->json([
            'reply' => $ai->chat($data['message'], 'public'),
        ]);
    }

    protected function serviceCatalog(): array
    {
        return [
            'warehouse-interiors' => [
                'title' => 'Warehouse Interior Coatings',
                'summary' => 'High-build wall and ceiling systems for distribution centers and fulfillment floors.',
                'body' => 'We stage night-shift crews, segregate active pick aisles, and apply durable latex or epoxy wall systems that resist forklift abrasion and dust.',
                'image' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=1600&q=80',
            ],
            'plant-exteriors' => [
                'title' => 'Plant & Facility Exteriors',
                'summary' => 'Weather-rated elastomeric and industrial acrylic systems for manufacturing plants.',
                'body' => 'From metal panel prep to elastomeric finish coats, Ironspan protects Gulf Coast exteriors against salt air, UV, and thermal cycling.',
                'image' => 'https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?auto=format&fit=crop&w=1600&q=80',
            ],
            'high-rise-facades' => [
                'title' => 'High-Rise Facade Recoats',
                'summary' => 'Swing-stage and rope-access recoats for commercial towers and mixed-use exteriors.',
                'body' => 'Our facade teams manage engineered swing stages, containment, and DFT documentation for Class-A office and hospitality towers.',
                'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1600&q=80',
            ],
            'structural-steel' => [
                'title' => 'Structural Steel & Pipe Coatings',
                'summary' => 'Blast, prime, and finish systems for steel mezzanines, piping, and process structures.',
                'body' => 'Industrial steel painting with zinc-rich primers and polyurethane topcoats — scheduled around turnarounds and outages.',
                'image' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=1600&q=80',
            ],
            'epoxy-floor-prep' => [
                'title' => 'Epoxy Floor Prep Coatings',
                'summary' => 'Surface prep and primer systems that set up industrial floors for durable epoxy finishes.',
                'body' => 'Shot-blast and diamond-grind prep, moisture testing, and primer coats engineered for warehouses, food plants, and light manufacturing.',
                'image' => 'https://images.unsplash.com/photo-1565793298595-6a879b1d9492?auto=format&fit=crop&w=1600&q=80',
            ],
            'occupied-facility' => [
                'title' => 'Occupied Facility Programs',
                'summary' => 'Low-VOC, phased recoats that keep offices and plants running during production.',
                'body' => 'Phased containment, HEPA negative air, and after-hours spray windows minimize disruption for tenants and operations managers.',
                'image' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1600&q=80',
            ],
        ];
    }
}
