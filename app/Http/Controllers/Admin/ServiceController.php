<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Seo;
use App\Models\Service;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = auth()->user();
            if (! $user?->isAdmin() && ! $user?->can('service-list')) {
                abort(403, 'You are not authorized to access this area.');
            }

            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $query = Service::with(['category', 'subcategory'])->latest('id');

        if ($search = trim((string) $request->get('q'))) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->integer('category_id'));
        }

        if ($request->filled('status') && $request->get('status') !== '') {
            $query->where('status', $request->integer('status'));
        }

        $services = $query->paginate(25)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('admin.services.index', compact('services', 'categories'));
    }

    public function create()
    {
        return view('admin.services.create', $this->formLookups());
    }

    public function store(Request $request)
    {
        $validated = $this->validateService($request);
        $locations = $this->selectedLocations($request);

        if ($locations === []) {
            $payload = $this->normalizePayload($validated);
            $payload['slug'] = $this->uniqueSlug($payload['slug']);
            $service = Service::create($payload);
            $this->attachSeo($service);
            LogActivity::addToLog('Service added successfully.');

            return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
        }

        $count = 0;
        foreach ($locations as $location) {
            $payload = $this->normalizePayload($validated);
            $payload['name'] = trim($validated['name'].' '.$location);
            $baseSlug = $validated['slug'] ?: $validated['name'];
            $payload['slug'] = $this->uniqueSlug(Str::slug($baseSlug).'-'.Str::slug($location));
            $service = Service::create($payload);
            $this->attachSeo($service);
            $count++;
        }

        LogActivity::addToLog("Services added successfully ({$count} city/state pages).");

        return redirect()->route('admin.services.index')->with(
            'success',
            "{$count} location-specific service page(s) created."
        );
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', array_merge(
            ['service' => $service],
            $this->formLookups()
        ));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $this->validateService($request, $service->id);
        $payload = $this->normalizePayload($validated);
        $payload['slug'] = $this->uniqueSlug(
            Str::slug($validated['slug'] ?: $validated['name']),
            $service->id
        );

        $service->update($payload);

        $locations = $this->selectedLocations($request);
        $extra = 0;
        foreach ($locations as $location) {
            $duplicate = $this->normalizePayload($validated);
            $duplicate['name'] = trim($validated['name'].' in '.$location);
            $duplicate['slug'] = $this->uniqueSlug(Str::slug($duplicate['name']));
            $newService = Service::create($duplicate);
            $this->attachSeo($newService);
            $extra++;
        }

        LogActivity::addToLog('Service updated successfully.');

        $message = 'Service updated successfully.';
        if ($extra > 0) {
            $message .= " {$extra} additional city/state page(s) created.";
        }

        return redirect()->route('admin.services.index')->with('success', $message);
    }

    public function destroy(Service $service)
    {
        $service->delete();
        LogActivity::addToLog('Service deleted successfully.');

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }

    public function changeStatus(Service $service)
    {
        $service->update(['status' => $service->status ? 0 : 1]);
        LogActivity::addToLog('Service status changed successfully.');

        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    public function subcategories(Request $request)
    {
        $parentId = $request->integer('category_id');
        $items = Category::query()
            ->where('parent_id', $parentId)
            ->where('status', 1)
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($items);
    }

    private function formLookups(): array
    {
        return [
            'categories' => Category::roots()->active()->orderBy('name')->get(),
            'states' => State::orderBy('name')->get(),
            'cities' => City::orderBy('name')->get(),
        ];
    }

    /** @return list<string> */
    private function selectedLocations(Request $request): array
    {
        $raw = $request->input('city', []);

        if (! is_array($raw)) {
            return [];
        }

        return array_values(array_unique(array_filter(array_map(
            fn ($name) => trim((string) $name),
            $raw
        ))));
    }

    private function normalizePayload(array $validated): array
    {
        $validated['slug'] = Str::slug($validated['slug'] ?: $validated['name']);
        $validated['user_id'] = auth()->id();
        $validated['category_id'] = $validated['category_id'] ?? 0;
        $validated['subcategory_id'] = $validated['subcategory_id'] ?? 0;
        $validated['price'] = $validated['price'] ?? 0;
        $validated['mrp_price'] = $validated['mrp_price'] ?? 0;

        return $validated;
    }

    private function uniqueSlug(string $base, ?int $exceptId = null): string
    {
        $slug = Str::slug($base) ?: 'service';
        $original = $slug;
        $counter = 1;

        while (Service::query()
            ->when($exceptId, fn ($q) => $q->where('id', '!=', $exceptId))
            ->where('slug', $slug)
            ->exists()) {
            $slug = $original.'-'.$counter;
            $counter++;
        }

        return $slug;
    }

    private function attachSeo(Service $service): void
    {
        Seo::firstOrCreate(
            [
                'page_id' => $service->id,
                'page_type' => Seo::TYPE_SERVICE,
            ],
            [
                'meta_title' => $service->meta_title,
                'meta_keyword' => $service->meta_keywords,
                'meta_description' => $service->meta_description,
            ]
        );
    }

    private function validateService(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'category_id' => 'nullable|integer|exists:categories,id',
            'subcategory_id' => 'nullable|integer|exists:categories,id',
            'price' => 'nullable|numeric|min:0',
            'mrp_price' => 'nullable|numeric|min:0',
            'service_type' => 'required|in:0,1',
            'status' => 'required|in:0,1',
            'small_description' => 'nullable|string',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'free_consultation_desc' => 'nullable|string|max:255',
            'talk_to_expert_description' => 'nullable|string',
            'caller_name' => 'nullable|string|max:255',
            'caller_description' => 'nullable|string|max:500',
            'testmonial_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'too_long_description' => 'nullable|string',
            'advisory_services' => 'nullable|string',
            'get_started' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'city' => 'nullable|array',
            'city.*' => 'nullable|string|max:255',
        ]);
    }
}
