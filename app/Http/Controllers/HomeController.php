<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Models\Page;
use App\Models\Service;
use App\Models\State;
use App\Services\EnquiryNotifier;
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

    public function setLocale(string $locale): RedirectResponse
    {
        if (! in_array($locale, ['en', 'hi'], true)) {
            $locale = 'en';
        }

        session(['locale' => $locale]);

        $response = redirect()->back();

        // Reset Google Translate cookie first
        $response->withCookie(cookie()->forget('googtrans'));

        if ($locale === 'hi') {
            $response->withCookie(cookie(
                'googtrans',
                '/en/hi',
                60 * 24 * 365,
                '/',
                null,
                false,
                false,
                false,
                'lax'
            ));
        }

        return $response;
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
            'country' => ['nullable', 'string', 'max:10'],
            'country_code' => ['nullable', 'string', 'max:8'],
            'mobile' => ['required', 'regex:/^[0-9]{6,15}$/'],
            'state' => ['required', 'string', 'max:120'],
        ]);

        $stateId = null;
        if (Schema::hasTable('states')) {
            $stateId = State::where('name', $validated['state'])->value('id');
        }

        $dial = preg_replace('/\D+/', '', (string) ($validated['country_code'] ?? ''));
        $mobile = $validated['mobile'];
        $fullMobile = $dial !== '' ? '+'.$dial.' '.$mobile : $mobile;
        $countryIso = $validated['country'] ?? 'IN';

        $enquiry = Enquiry::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'mobile' => $fullMobile,
            'state_id' => $stateId,
            'service_slug' => $service->slug,
            'subject' => $service->name,
            'description' => 'Consultation request from service page. Country: '.$countryIso.'. State/Region: '.$validated['state'].'.',
            'status' => Enquiry::STATUS_NEW,
        ]);

        app(EnquiryNotifier::class)->notify($enquiry);

        return redirect()->route('thanks');
    }

    public function generalEnquire(Request $request): RedirectResponse
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180'],
            'country' => ['nullable', 'string', 'max:10'],
            'country_code' => ['nullable', 'string', 'max:8'],
            'mobile' => ['required', 'regex:/^[0-9]{6,15}$/'],
            'state' => ['required', 'string', 'max:120'],
            'service_slug' => ['nullable', 'string', 'max:180'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('open_consult_modal', true);
        }

        $validated = $validator->validated();

        $stateId = null;
        if (Schema::hasTable('states')) {
            $stateId = State::where('name', $validated['state'])->value('id');
        }

        $dial = preg_replace('/\D+/', '', (string) ($validated['country_code'] ?? ''));
        $mobile = $validated['mobile'];
        $fullMobile = $dial !== '' ? '+'.$dial.' '.$mobile : $mobile;
        $countryIso = $validated['country'] ?? 'IN';
        $serviceSlug = $validated['service_slug'] ?? null;

        $service = null;
        if ($serviceSlug) {
            $service = Service::query()
                ->active()
                ->where('slug', $serviceSlug)
                ->where('service_type', 1)
                ->first();
        }

        $enquiry = Enquiry::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'mobile' => $fullMobile,
            'state_id' => $stateId,
            'service_slug' => $service?->slug,
            'subject' => $service?->name ?: 'General consultation',
            'description' => 'Consultation request from Get Started popup. Country: '.$countryIso.'. State/Region: '.$validated['state'].'.',
            'status' => Enquiry::STATUS_NEW,
        ]);

        app(EnquiryNotifier::class)->notify($enquiry);

        return redirect()->route('thanks');
    }

    public function thanks(): View
    {
        return view('front.thanks', [
            'activeNav' => null,
        ]);
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

        $services = collect(config('services_catalog.categories', []))
            ->flatMap(fn ($category) => $category['services'] ?? [])
            ->unique()
            ->values()
            ->all();

        if ($services === []) {
            $services = [
                'Company Registration',
                'GST & Tax Filing',
                'Trademark & IP',
                'FSSAI License',
                'ISO Certification',
                'Annual Compliance',
                'Import Export Code',
                'NGO Registration',
            ];
        }

        return view('front.contact', [
            'page' => $page,
            'activeNav' => 'contact-us',
            'states' => $states,
            'services' => $services,
        ]);
    }

    public function contactSubmit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'service' => ['required', 'string', 'max:180'],
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

        $serviceName = $validated['service'] ?? null;
        $description = trim(implode("\n", array_filter([
            $serviceName ? 'Service: '.$serviceName : null,
            'State: '.$validated['state'],
            $validated['message'] ?? null,
        ])));

        $enquiry = Enquiry::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'mobile' => $validated['mobile'],
            'state_id' => $stateId,
            'subject' => $serviceName ? 'Contact Us — '.$serviceName : 'Contact Us',
            'description' => $description !== '' ? $description : null,
            'status' => Enquiry::STATUS_NEW,
        ]);

        app(EnquiryNotifier::class)->notify($enquiry);

        return redirect()->route('thanks');
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
