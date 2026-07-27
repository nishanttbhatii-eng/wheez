<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use Illuminate\Http\Request;

class SeoController extends Controller
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
        $query = Seo::latest('id');

        if ($request->filled('page_type') && $request->get('page_type') !== '') {
            $query->where('page_type', $request->integer('page_type'));
        }

        if ($search = trim((string) $request->get('q'))) {
            $query->where(function ($q) use ($search) {
                $q->where('meta_title', 'like', "%{$search}%")
                    ->orWhere('meta_keyword', 'like', "%{$search}%")
                    ->orWhere('meta_description', 'like', "%{$search}%");
            });
        }

        $seos = $query->paginate(25)->withQueryString();

        return view('admin.seos.index', compact('seos'));
    }

    public function create()
    {
        return view('admin.seos.create', [
            'seo' => new Seo(['page_type' => Seo::TYPE_CONTENT_PAGE]),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateSeo($request);
        Seo::create($validated);

        return redirect()->route('admin.seos.index')->with('success', 'SEO record created successfully.');
    }

    public function edit(Seo $seo)
    {
        return view('admin.seos.edit', compact('seo'));
    }

    public function update(Request $request, Seo $seo)
    {
        $validated = $this->validateSeo($request);
        $seo->update($validated);

        return redirect()->route('admin.seos.index')->with('success', 'SEO record updated successfully.');
    }

    public function destroy(Seo $seo)
    {
        $seo->delete();

        return redirect()->route('admin.seos.index')->with('success', 'SEO record deleted successfully.');
    }

    private function validateSeo(Request $request): array
    {
        return $request->validate([
            'page_id' => 'required|integer|min:1',
            'page_type' => 'required|in:0,1,2',
            'meta_title' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
        ]);
    }
}
