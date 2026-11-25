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

    public function about(): View
    {
        return view('pages.about');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function contactStore(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180'],
            'phone' => ['nullable', 'string', 'max:40'],
            'subject' => ['nullable', 'string', 'max:180'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        ContactMessage::query()->create($data);

        return back()->with('success', 'Thanks! SteriPath will follow up as soon as possible — for emergencies call (214) 555-0188.');
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
        $articles = KnowledgeArticle::query()->where('is_published', true)->orderBy('category')->orderBy('title')->get()->groupBy('category');

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
            'message' => ['required', 'string', 'max:2000'],
            'session_id' => ['nullable', 'string', 'max:80'],
        ]);

        $result = $ai->chat($data['message'], $data['session_id'] ?? null);

        return response()->json($result);
    }

    /** @return array<string, array<string, string>> */
    protected function serviceCatalog(): array
    {
        return [
            'trauma-scene-cleanup' => [
                'title' => 'Trauma Scene Cleanup',
                'summary' => 'Discreet unattended death and trauma remediation with full PPE containment.',
                'body' => 'SteriPath isolates affected zones, removes contaminated materials, and applies EPA-registered disinfectants before odor control and reconstruction handoff. Families and property managers get discreet unmarked arrivals, documented chain-of-custody for regulated waste, and a space returned to safe occupancy standards.',
                'image' => 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=1600&q=80',
            ],
            'bloodborne-pathogen-remediation' => [
                'title' => 'Bloodborne Pathogen Remediation',
                'summary' => 'ATP-aware cleaning of blood and other potentially infectious materials.',
                'body' => 'We treat hard surfaces, soft goods, and porous materials with chemistry matched to bloodborne pathogen risk. When needed, SteriPath uses ATP sampling to verify reduction before releasing the site. Porous items that cannot be disinfected are bagged, manifested, and disposed through licensed medical waste partners.',
                'image' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=1600&q=80',
            ],
            'infectious-disease-disinfection' => [
                'title' => 'Infectious Disease Disinfection',
                'summary' => 'Hospital-grade disinfection after confirmed or suspected contagious events.',
                'body' => 'From flu outbreak suites to high-touch facility corridors, SteriPath stages electrostatic and wipe protocols with kill-claim compatible chemistry. We document dwell times, protect HVAC returns when required, and coordinate re-entry guidance for building managers.',
                'image' => 'https://images.unsplash.com/photo-1631549916768-4119b2e5f926?auto=format&fit=crop&w=1600&q=80',
            ],
            'hoarding-biohazard-cleanup' => [
                'title' => 'Hoarding Biohazard Cleanup',
                'summary' => 'Biohazard-level hoarding scenes with waste sorting, pest residue, and pathogen control.',
                'body' => 'Hoarding environments often mix animal waste, mold-adjacent moisture, and bloodborne risk. Our crews stage progressive clearing, separate regulated waste, and disinfect structural surfaces so restoration or occupancy can resume safely.',
                'image' => 'https://images.unsplash.com/photo-1563453392212-326f5e854473?auto=format&fit=crop&w=1600&q=80',
            ],
            'vehicle-biohazard-cleanup' => [
                'title' => 'Vehicle Biohazard Cleanup',
                'summary' => 'Interior remediation for cars, vans, and fleet vehicles after trauma or infectious events.',
                'body' => 'Vehicle cabins concentrate fluids into foam, carpet, and HVAC pathways. SteriPath extracts contaminated materials, treats hard plastics and soft trim, and odor-controls before returning vehicles to service or salvage.',
                'image' => 'https://images.unsplash.com/photo-1527515637462-cff97d7f3eba?auto=format&fit=crop&w=1600&q=80',
            ],
            'sharps-medical-waste' => [
                'title' => 'Sharps & Medical Waste',
                'summary' => 'Packaging, labeling, and transport coordination for regulated medical waste.',
                'body' => 'We supply puncture-resistant containers, label per DOT/OSHA expectations for our partners, and arrange pickup through licensed medical waste haulers. Ideal for clinics, home healthcare overflow, and scene residual sharps discovered during remediation.',
                'image' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=1600&q=80',
            ],
        ];
    }
}
