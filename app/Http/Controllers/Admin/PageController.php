<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Helpers\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = auth()->user();
            if (! $user?->isAdmin() && ! $user?->can('page-list')) {
                abort(403, 'You are not authorized to access this area.');
            }

            return $next($request);
        });
    }

    public function index()
    {
        $pages = Page::orderBy('order')->orderByDesc('updated_at')->paginate(15);

        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validatePage($request);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('pages', 'public');
        }

        $validated['author_id'] = auth()->id();
        $validated['slug'] = Str::slug($validated['slug']);

        Page::create($validated);
        LogActivity::addToLog('Page created successfully.');

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $validated = $this->validatePage($request, $page->id);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('pages', 'public');
        }

        $validated['slug'] = Str::slug($validated['slug']);

        $page->update($validated);
        LogActivity::addToLog('Page updated successfully.');

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        LogActivity::addToLog('Page deleted successfully.');

        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }

    public function changeStatus(Page $page)
    {
        $page->update([
            'status' => $page->status === 'published' ? 'draft' : 'published',
        ]);
        LogActivity::addToLog('Page status changed successfully.');

        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    private function validatePage(Request $request, ?int $pageId = null): array
    {
        $slugRule = 'required|string|max:255|unique:pages,slug';
        if ($pageId) {
            $slugRule .= ',' . $pageId;
        }

        return $request->validate([
            'title' => 'required|string|max:255',
            'slug' => $slugRule,
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:draft,published,archived',
            'order' => 'nullable|integer|min:0',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:500',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string|max:500',
            'og_image_url' => 'nullable|string|url|max:500',
        ]);
    }
}
