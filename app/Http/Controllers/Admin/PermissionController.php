<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
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
        $permissions = Permission::orderBy('name')->get();

        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|regex:/^[a-z0-9\-]+$/',
        ]);

        $base = $validated['name'];
        foreach (['list', 'create', 'edit', 'delete'] as $suffix) {
            Permission::firstOrCreate(
                ['name' => "{$base}-{$suffix}", 'guard_name' => 'web']
            );
        }

        LogActivity::addToLog('Permission group added successfully.');

        return redirect()->route('admin.permissions.index')->with('success', 'Permission group created successfully.');
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,'.$permission->id,
        ]);

        $permission->update([
            'name' => $validated['name'],
            'guard_name' => 'web',
        ]);

        LogActivity::addToLog('Permission updated successfully.');

        return redirect()->route('admin.permissions.index')->with('success', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        LogActivity::addToLog('Permission deleted successfully.');

        return redirect()->route('admin.permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
