<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Models\Page;
use App\Models\Service;
use App\Models\State;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $page = Page::published()->where('slug', 'home')->first();

        return view('front.home', [
            'page' => $page,
            'activeNav' => 'home',
            'heroDescription' => $page?->content ?: "At Whizseed, we're dedicated to fueling your entrepreneurial fire. Our services and expert guidance empower startups and entrepreneurs across India to build, grow, and prosper.",
        ]);
    }
     public function homeNew(): View
    {
        return view('front.home-new', [
            'activeNav' => 'home',
        ]);
    }
    public function services(): View
    {
        $page = Page::published()->where('slug', 'services')->first();
        $serviceSlugs = Service::query()
            ->active()
            ->where('service_type', 1)
            ->pluck('slug', 'name');

        return view('front.services', [
            'page' => $page,
            'filters' => config('services_catalog.filters'),
            'recommended' => config('services_catalog.recommended'),
            'categories' => config('services_catalog.categories'),
            'serviceSlugs' => $serviceSlugs,
        ]);
    }

    public function serviceShow(string $slug): View
    {
        $service = Service::query()
            ->active()
            ->where('slug', $slug)
            ->where('service_type', 1)
            ->firstOrFail();

        return view('front.home-new', $this->servicePageData($service));
    }

    public function serviceEnquire(Request $request, string $slug): RedirectResponse
    {
        $service = Service::query()
            ->active()
            ->where('slug', $slug)
            ->where('service_type', 1)
            ->firstOrFail();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180'],
            'mobile' => ['required', 'digits:10'],
            'state' => ['required', 'string', 'max:80'],
        ]);

        $stateId = null;
        if (Schema::hasTable('states')) {
            $stateId = State::where('name', $validated['state'])->value('id');
        }

        Enquiry::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'mobile' => $validated['mobile'],
            'state_id' => $stateId,
            'service_slug' => $service->slug,
            'subject' => $service->name,
            'description' => 'Consultation request from service page.',
            'status' => Enquiry::STATUS_NEW,
        ]);

        return redirect()
            ->route('services.show', $service->slug)
            ->with('service_enquiry_success', 'Thanks! Our expert will contact you shortly.');
    }

    public function about(): View
    {
        $page = Page::published()->where('slug', 'about-us')->first();

        return view('front.about', [
            'page' => $page,
            'activeNav' => 'about-us',
        ]);
    }

    public function contact(): View
    {
        $page = Page::published()->where('slug', 'contact-us')->first();

        $states = Schema::hasTable('states') && State::query()->exists()
            ? State::orderBy('name')->pluck('name')->all()
            : config('indian_states');

        return view('front.contact', [
            'page' => $page,
            'activeNav' => 'contact-us',
            'states' => $states,
        ]);
    }

    public function contactSubmit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180'],
            'mobile' => ['required', 'digits:10'],
            'state' => ['required', 'string', 'max:80'],
            'message' => ['nullable', 'string', 'max:2000'],
        ]);

        $stateId = null;
        if (Schema::hasTable('states')) {
            $stateId = State::where('name', $validated['state'])->value('id');
        }

        Enquiry::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'mobile' => $validated['mobile'],
            'state_id' => $stateId,
            'subject' => 'Contact Us',
            'description' => $validated['message'] ?? null,
            'status' => Enquiry::STATUS_NEW,
        ]);

        $redirectRoute = $request->input('redirect_to') === 'home.new' ? 'home.new' : 'contact';

        return redirect()
            ->route($redirectRoute)
            ->with('contact_success', 'Thanks! Your request has been received. Our team will get back to you shortly.');
    }

    public function privacy(): View
    {
        return $this->legal('privacy-policy');
    }

    public function terms(): View
    {
        return $this->legal('terms-of-services');
    }

    private function legal(string $key): View
    {
        $legal = config("legal_pages.{$key}");
        abort_unless(is_array($legal), 404);

        $page = Page::published()->where('slug', $legal['slug'])->first();

        return view('front.legal', [
            'page' => $page,
            'legal' => $legal,
        ]);
    }

    public function show(string $slug): View
    {
        $page = Page::published()->where('slug', $slug)->firstOrFail();

        return view('front.page', compact('page'));
    }

    private function servicePageData(Service $service): array
    {
        $states = Schema::hasTable('states') && State::query()->exists()
            ? State::orderBy('name')->pluck('name')->all()
            : config('indian_states');

        $processSteps = collect($service->processSteps())->map(function (array $step) {
            $icon = $step['icon'] ?? '';
            if ($icon && ! str_contains($icon, '<')) {
                if (str_starts_with($icon, 'http://') || str_starts_with($icon, 'https://')) {
                    $icon = str_replace('https://www.whizseed.com/frontend/', asset('frontend/'), $icon);
                    $src = $icon;
                } elseif (str_starts_with($icon, '/') && ! str_starts_with($icon, '//')) {
                    $src = url($icon);
                } else {
                    $src = asset(ltrim($icon, '/'));
                }
                $icon = '<img src="'.e($src).'" alt="" width="40" height="40">';
            }

            return [
                'icon' => $icon,
                'text' => $step['text'] ?? '',
            ];
        })->all();

        $otherServices = Service::query()
            ->active()
            ->where('service_type', 1)
            ->where('id', '!=', $service->id)
            ->when($service->category_id, fn ($q) => $q->where('category_id', $service->category_id))
            ->orderBy('name')
            ->limit(12)
            ->get(['id', 'name', 'slug']);

        if ($otherServices->count() < 6) {
            $otherServices = Service::query()
                ->active()
                ->where('service_type', 1)
                ->where('id', '!=', $service->id)
                ->orderBy('name')
                ->limit(12)
                ->get(['id', 'name', 'slug']);
        }

        $overviewHtml = rewrite_html_root_paths(
            $service->long_description
            ?: $service->too_long_description
            ?: $service->short_description
            ?: '<p>'.e($service->heroDescription()).'</p>'
        );

        $extraHtml = rewrite_html_root_paths(
            $service->too_long_description && $service->long_description
                ? $service->too_long_description
                : ($service->get_started ?: $service->advisory_services)
        );

        return [
            'service' => $service,
            'page' => (object) [
                'document_title' => ($service->meta_title ?: $service->name).' | Whizseed',
                'meta_description_text' => strip_tags($service->meta_description ?: $service->heroDescription()),
                'og_image' => asset('Image/logo.png'),
            ],
            'activeNav' => 'services',
            'states' => $states,
            'processSteps' => $processSteps,
            'heroFeatures' => config('service_page.hero_features', []),
            'tabs' => config('service_page.tabs', []),
            'overviewHtml' => $overviewHtml,
            'extraHtml' => $extraHtml,
            'categories' => [],
            'checklist' => [],
            'downloadSteps' => [],
            'faqs' => [
                [
                    'q' => 'What is '.$service->name.'?',
                    'a' => $service->heroDescription(),
                ],
                [
                    'q' => 'How can Whizseed help with '.$service->name.'?',
                    'a' => 'Whizseed handles documentation, expert consultation, and end-to-end filing support so you can complete '.$service->name.' without hassle.',
                ],
                [
                    'q' => 'How long does '.$service->name.' take?',
                    'a' => 'Timelines vary by case and government processing. Our team prepares everything correctly to minimize delays.',
                ],
            ],
            'reviews' => [
                [
                    'image' => 'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=800&h=1000&fit=crop&auto=format',
                    'avatar' => 'https://i.pravatar.cc/80?img=12',
                    'text' => 'Whizseed made '.$service->name.' simple and fast. Clear guidance throughout.',
                    'name' => 'Rahul Mehta',
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&h=1000&fit=crop&auto=format',
                    'avatar' => 'https://i.pravatar.cc/80?img=32',
                    'text' => 'Professional support and excellent communication from start to finish.',
                    'name' => 'Priya Sharma',
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=800&h=1000&fit=crop&auto=format',
                    'avatar' => 'https://i.pravatar.cc/80?img=15',
                    'text' => 'Highly recommend Whizseed for business registrations and compliance.',
                    'name' => 'Aman Verma',
                ],
            ],
            'otherServices' => $otherServices,
            'callerName' => $service->caller_name ?: 'Khushi',
            'callerDescription' => $service->caller_description ?: $service->free_consultation_desc,
        ];
    }
}
