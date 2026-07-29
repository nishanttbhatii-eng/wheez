<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = auth()->user();
            if (! $user?->isAdmin() && ! $user?->can('user-list')) {
                abort(403, 'You are not authorized to manage users.');
            }

            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $users = User::query()
            ->with(['roles', 'permissions'])
            ->where(function ($q) {
                $q->where('role', 'admin')
                    ->orWhere('role', 'cms')
                    ->orWhereHas('roles');
            })
            ->orderByDesc('id')
            ->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create', $this->formData());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'roles' => 'required|string|exists:roles,name',
            'phone' => 'nullable|string|max:20',
            'permissions' => 'nullable|array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);

        $roleName = $validated['roles'];
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'] ?? null,
            'role' => $this->systemRoleForSpatieRole($roleName),
            'status' => 'active',
        ]);

        $user->syncRoles([$roleName]);
        $user->syncPermissions($validated['permissions'] ?? []);

        LogActivity::addToLog('Admin user created successfully.');

        return redirect()->route('admin.users.index')->with('success', 'User created with permissions assigned.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', array_merge(
            ['user' => $user],
            $this->formData($user)
        ));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|min:6|confirmed',
            'roles' => 'required|string|exists:roles,name',
            'phone' => 'nullable|string|max:20',
            'permissions' => 'nullable|array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);

        $data = Arr::except($validated, ['password', 'roles', 'password_confirmation', 'permissions']);
        if (! empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $data['role'] = $this->systemRoleForSpatieRole($validated['roles']);

        $user->update($data);
        $user->syncRoles([$validated['roles']]);
        $user->syncPermissions($validated['permissions'] ?? []);

        LogActivity::addToLog('Admin user updated successfully.');

        return redirect()->route('admin.users.index')->with('success', 'User updated with permissions.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'You cannot delete your own account.');
        }

        DB::table('model_has_roles')->where('model_id', $user->id)->where('model_type', User::class)->delete();
        DB::table('model_has_permissions')->where('model_id', $user->id)->where('model_type', User::class)->delete();
        $user->delete();
        LogActivity::addToLog('Admin user deleted successfully.');

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function changeStatus(User $user)
    {
        $user->update(['status' => $user->status === 'active' ? 'inactive' : 'active']);
        LogActivity::addToLog('User status changed successfully.');

        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    private function formData(?User $user = null): array
    {
        $roles = Role::orderBy('name')->get();
        $permissions = Permission::orderBy('name')->get()->groupBy(function ($permission) {
            $parts = explode('-', $permission->name);

            return $parts[0] ?? 'other';
        });

        $rolePermissionMap = collect(config('cms_roles.role_permissions', []));

        $selectedRole = old('roles', $user?->roles->first()?->name);
        $selectedPermissions = old(
            'permissions',
            $user ? $user->getDirectPermissions()->pluck('name')->all() : []
        );

        return compact('roles', 'permissions', 'rolePermissionMap', 'selectedRole', 'selectedPermissions');
    }

    private function systemRoleForSpatieRole(string $roleName): string
    {
        return $roleName === 'Super Admin' ? 'admin' : 'cms';
    }
}
