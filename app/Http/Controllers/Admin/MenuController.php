<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Database\Seeders\MenuSeeder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MenuController extends Controller
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
        $location = $request->get('location', 'primary');

        $roots = MenuItem::query()
            ->with(['children.children'])
            ->location($location)
            ->roots()
            ->ordered()
            ->get();

        $parentOptions = MenuItem::query()
            ->location($location)
            ->whereIn('type', ['menu', 'group'])
            ->ordered()
            ->get();

        return view('admin.menus.index', compact('roots', 'location', 'parentOptions'));
    }

    public function create(Request $request)
    {
        $location = $request->get('location', 'primary');
        $parentOptions = $this->parentOptions($location);

        return view('admin.menus.create', compact('location', 'parentOptions'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateMenuItem($request);
        MenuItem::create($validated);

        return redirect()
            ->route('admin.menus.index', ['location' => $validated['location']])
            ->with('success', 'Menu item created successfully.');
    }

    public function edit(MenuItem $menu)
    {
        $location = $menu->location;
        $parentOptions = $this->parentOptions($location, $menu->id);

        return view('admin.menus.edit', compact('menu', 'location', 'parentOptions'));
    }

    public function update(Request $request, MenuItem $menu)
    {
        $validated = $this->validateMenuItem($request, $menu->id);
        $menu->update($validated);

        return redirect()
            ->route('admin.menus.index', ['location' => $validated['location']])
            ->with('success', 'Menu item updated successfully.');
    }

    public function destroy(MenuItem $menu)
    {
        $location = $menu->location;
        $menu->delete();

        return redirect()
            ->route('admin.menus.index', ['location' => $location])
            ->with('success', 'Menu item deleted successfully.');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:menu_items,id',
            'items.*.order' => 'required|integer|min:0',
        ]);

        foreach ($request->items as $item) {
            MenuItem::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['success' => true]);
    }

    public function seed()
    {
        (new MenuSeeder)->run();

        return redirect()
            ->route('admin.menus.index')
            ->with('success', 'Menu reset from whizseed.com default structure.');
    }

    private function parentOptions(string $location, ?int $excludeId = null)
    {
        return MenuItem::query()
            ->location($location)
            ->whereIn('type', ['menu', 'group'])
            ->when($excludeId, fn ($q) => $q->where('id', '!=', $excludeId))
            ->ordered()
            ->get();
    }

    private function validateMenuItem(Request $request, ?int $menuId = null): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'nullable|string|max:500',
            'parent_id' => [
                'nullable',
                'exists:menu_items,id',
                Rule::notIn([$menuId]),
            ],
            'location' => 'required|in:primary,secondary',
            'type' => 'required|in:menu,group,link',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            'open_in_new_tab' => 'nullable|boolean',
        ]) + [
            'is_active' => $request->boolean('is_active'),
            'open_in_new_tab' => $request->boolean('open_in_new_tab'),
            'order' => $request->input('order', 0),
            'parent_id' => $request->input('parent_id') ?: null,
            'url' => $request->input('url') ?: null,
        ];
    }
}
