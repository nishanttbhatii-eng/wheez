<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StaffController extends Controller
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
        $query = User::staff()->orderBy('created_at', 'desc');

        if ($request->filled('name')) {
            $name = $request->name;
            $query->where(function ($q) use ($name) {
                $q->where('first_name', 'like', "%{$name}%")
                  ->orWhere('middle_name', 'like', "%{$name}%")
                  ->orWhere('last_name', 'like', "%{$name}%")
                  ->orWhereRaw("CONCAT(first_name, ' ', COALESCE(middle_name, ''), ' ', last_name) LIKE ?", ["%{$name}%"]);
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $staff = $query->paginate(15);
        $roles = config('staff.roles');

        return view('admin.staff.index', compact('staff', 'roles'));
    }

    public function create()
    {
        return view('admin.staff.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate($this->staffValidationRules(isCreate: true));

            $fullName = trim($validated['first_name'] . ' ' . $validated['last_name']);
            $permissions = $this->resolvePermissions($validated['role'], $validated['permissions'] ?? []);

            User::create([
                'name' => $fullName,
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'employee_code' => $validated['employee_code'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'phone' => $validated['contact_number'] ?? null,
                'joining_date' => $validated['joining_date'],
                'role' => $validated['role'],
                'permissions' => $permissions,
                'department' => $validated['department'] ?? null,
                'working_days' => [
                    'monday' => 'full_day',
                    'tuesday' => 'full_day',
                    'wednesday' => 'full_day',
                    'thursday' => 'full_day',
                    'friday' => 'full_day',
                    'saturday' => 'non_working',
                    'sunday' => 'non_working',
                ],
                'status' => $request->has('status') ? 'active' : 'inactive',
            ]);

            return redirect()->route('admin.staff.index')->with('success', 'User created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error creating user: ' . $e->getMessage());
        }
    }

    public function show(User $staff)
    {
        return view('admin.staff.show', compact('staff'));
    }

    public function edit(User $staff)
    {
        return view('admin.staff.edit', compact('staff'));
    }

    public function update(Request $request, User $staff)
    {
        $validated = $request->validate($this->staffValidationRules($staff->id, false));

        $fullName = trim($validated['first_name'] . ' ' . ($validated['middle_name'] ?? '') . ' ' . $validated['last_name']);
        $permissions = $this->resolvePermissions($validated['role'], $validated['permissions'] ?? []);

        $staff->update([
            'name' => $fullName,
            'title' => $validated['title'] ?? null,
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'] ?? null,
            'last_name' => $validated['last_name'],
            'employee_code' => $validated['employee_code'],
            'email' => $validated['email'],
            'gender' => $validated['gender'],
            'phone' => $validated['contact_number'] ?? null,
            'date_of_birth' => $validated['date_of_birth'],
            'emergency_contact_name' => $validated['emergency_contact_name'] ?? null,
            'emergency_contact_email' => $validated['emergency_contact_email'] ?? null,
            'emergency_contact_number' => $validated['emergency_contact_number'] ?? null,
            'joining_date' => $validated['joining_date'],
            'role' => $validated['role'],
            'permissions' => $permissions,
            'department' => $validated['department'] ?? null,
            'designation' => $validated['profile'] ?? null,
            'working_days' => $validated['working_days'],
            'notes' => $validated['notes'] ?? null,
            'status' => $request->has('status') ? 'active' : 'inactive',
        ]);

        return redirect()->route('admin.staff.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $staff)
    {
        $staff->delete();

        return redirect()->route('admin.staff.index')->with('success', 'User deleted successfully');
    }

    private function staffValidationRules(?int $staffId = null, bool $requirePassword = true, bool $isCreate = false): array
    {
        $staffRoleKeys = array_keys(config('staff.roles'));
        $permissionKeys = array_keys(config('staff.permissions'));

        if ($isCreate) {
            return [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'employee_code' => 'required|string|max:50|unique:users,employee_code',
                'email' => 'required|email|unique:users,email',
                'contact_number' => 'nullable|string|max:20',
                'joining_date' => 'required|date',
                'role' => ['required', Rule::in($staffRoleKeys)],
                'permissions' => 'nullable|array',
                'permissions.*' => [Rule::in($permissionKeys)],
                'department' => 'nullable|string|max:100',
                'password' => 'required|string|min:8|confirmed',
            ];
        }

        $rules = [
            'title' => 'nullable|string|max:10',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'employee_code' => 'required|string|max:50|unique:users,employee_code' . ($staffId ? ',' . $staffId : ''),
            'email' => 'required|email|unique:users,email' . ($staffId ? ',' . $staffId : ''),
            'gender' => 'required|in:male,female,other',
            'contact_number' => 'nullable|string|max:20',
            'date_of_birth' => 'required|date' . ($staffId ? '|before:today' : ''),
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_email' => 'nullable|email|max:255',
            'emergency_contact_number' => 'nullable|string|max:20',
            'joining_date' => 'required|date',
            'role' => ['required', Rule::in($staffRoleKeys)],
            'permissions' => 'nullable|array',
            'permissions.*' => [Rule::in($permissionKeys)],
            'department' => 'nullable|string|max:100',
            'profile' => 'nullable|string|max:100',
            'working_days' => ($staffId ? 'required' : 'nullable') . '|array' . ($staffId ? '|min:7|max:7' : ''),
            'working_days.*' => 'in:full_day,half_day,non_working',
            'notes' => 'nullable|string|max:1000',
        ];

        if ($requirePassword) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        return $rules;
    }

    private function resolvePermissions(string $role, array $permissions): array
    {
        $validPermissions = array_keys(config('staff.permissions'));
        $selected = array_values(array_intersect($permissions, $validPermissions));

        if ($selected === []) {
            return config("staff.roles.{$role}.permissions", []);
        }

        return $selected;
    }
}
