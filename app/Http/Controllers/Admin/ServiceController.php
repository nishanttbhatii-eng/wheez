<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (! auth()->user()?->isAdmin()) {
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
        $categories = Category::orderBy('name')->get();

        return view('admin.services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateService($request);
        $validated['slug'] = Str::slug($validated['slug'] ?: $validated['name']);
        $validated['user_id'] = auth()->id();

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $this->validateService($request, $service->id);
        $validated['slug'] = Str::slug($validated['slug'] ?: $validated['name']);

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
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
            'long_description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);
    }
}
