<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
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

    public function index()
    {
        $categories = Category::with('parent')
            ->orderByRaw('CASE WHEN parent_id IS NULL OR parent_id = 0 THEN 0 ELSE 1 END')
            ->orderBy('name')
            ->paginate(30);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $parents = Category::roots()->orderBy('name')->get();

        return view('admin.categories.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateCategory($request);
        $validated['slug'] = Str::slug($validated['slug'] ?: $validated['name']);
        $validated['parent_id'] = $validated['parent_id'] ?: 0;
        $validated['user_id'] = auth()->id();

        Category::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        $parents = Category::roots()
            ->where('id', '!=', $category->id)
            ->orderBy('name')
            ->get();

        return view('admin.categories.edit', compact('category', 'parents'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $this->validateCategory($request, $category->id);
        $validated['slug'] = Str::slug($validated['slug'] ?: $validated['name']);
        $validated['parent_id'] = $validated['parent_id'] ?: 0;

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }

    private function validateCategory(Request $request, ?int $id = null): array
    {
        $slugRule = 'nullable|string|max:255|unique:categories,slug';
        if ($id) {
            $slugRule .= ',' . $id;
        }

        return $request->validate([
            'name' => 'required|string|max:255',
            'slug' => $slugRule,
            'parent_id' => 'nullable|integer',
            'status' => 'required|in:0,1',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);
    }
}
