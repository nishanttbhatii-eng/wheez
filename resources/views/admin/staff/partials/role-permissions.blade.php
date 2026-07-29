@php
    $roles = config('staff.roles');
    $permissions = config('staff.permissions');
    $selectedRole = old('role', $selectedRole ?? 'emp');
    $selectedPermissions = old('permissions', $selectedPermissions ?? ($roles[$selectedRole]['permissions'] ?? []));
    $roleDefaults = collect($roles)->mapWithKeys(fn ($role, $key) => [$key => $role['permissions']]);
    $cmsPermissions = $cmsPermissions ?? collect();
    $cmsRolePermissionMap = $cmsRolePermissionMap ?? config('staff.cms_permissions_by_role', []);
    $selectedCmsPermissions = $selectedCmsPermissions ?? old('cms_permissions', []);
@endphp

<div class="row mb-4">
    <div class="col-md-12">
        <h5 class="text-primary mb-3">Role &amp; HR permissions</h5>
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Role <span class="text-danger">*</span></label>
        <select name="role" id="staffRoleSelect" class="form-select @error('role') is-invalid @enderror" required>
            <option value="">Select Role</option>
            @foreach($roles as $value => $role)
                <option value="{{ $value }}" {{ $selectedRole == $value ? 'selected' : '' }}>{{ $role['label'] }}</option>
            @endforeach
        </select>
        @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-8 mb-3">
        <label class="form-label d-block">HR module permissions</label>
        <div class="row" id="permissionsContainer">
            @foreach($permissions as $key => $label)
                <div class="col-md-6 col-lg-4">
                    <div class="form-check mb-2">
                        <input type="checkbox"
                               name="permissions[]"
                               value="{{ $key }}"
                               id="permission_{{ $key }}"
                               class="form-check-input permission-checkbox"
                               {{ in_array($key, $selectedPermissions, true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="permission_{{ $key }}">{{ $label }}</label>
                    </div>
                </div>
            @endforeach
        </div>
        @error('permissions')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        @error('permissions.*')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <h5 class="text-primary mb-3">Admin / CMS permissions</h5>
        <p class="text-muted small mb-2">Role select karne par default CMS permissions auto tick ho jayenge. Manual bhi change kar sakte ho.</p>
    </div>
    <div class="col-md-12">
        @forelse($cmsPermissions as $group => $items)
            <div class="mb-2"><strong>{{ $group }}</strong></div>
            <div class="row mb-3">
                @foreach($items as $permission)
                    <div class="col-md-4 col-lg-3">
                        <div class="form-check mb-2">
                            <input type="checkbox"
                                   name="cms_permissions[]"
                                   value="{{ $permission->name }}"
                                   id="cms_perm_{{ $permission->id }}"
                                   class="form-check-input cms-permission-checkbox"
                                   {{ in_array($permission->name, $selectedCmsPermissions, true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="cms_perm_{{ $permission->id }}">{{ $permission->name }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
        @empty
            <p class="text-muted">No CMS permissions in database. Run <code>php artisan db:seed --class=CmsPermissionSeeder</code>.</p>
        @endforelse
        @error('cms_permissions')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        @error('cms_permissions.*')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
    </div>
</div>

<script>
const roleDefaultPermissions = @json($roleDefaults);
const cmsRolePermissionMap = @json($cmsRolePermissionMap);

function applyHrRolePermissions(role) {
    const defaults = roleDefaultPermissions[role] || [];
    document.querySelectorAll('.permission-checkbox').forEach(function (checkbox) {
        checkbox.checked = defaults.includes(checkbox.value);
    });
}

function applyCmsRolePermissions(role) {
    const defaults = cmsRolePermissionMap[role] || [];
    document.querySelectorAll('.cms-permission-checkbox').forEach(function (checkbox) {
        checkbox.checked = defaults.includes(checkbox.value);
    });
}

function applyStaffRolePermissions(role) {
    applyHrRolePermissions(role);
    applyCmsRolePermissions(role);
}

document.getElementById('staffRoleSelect')?.addEventListener('change', function () {
    applyStaffRolePermissions(this.value);
});

document.addEventListener('DOMContentLoaded', function () {
    const roleSelect = document.getElementById('staffRoleSelect');
    const hasOldHr = @json((bool) old('permissions'));
    const hasOldCms = @json((bool) old('cms_permissions'));
    if (roleSelect?.value && !hasOldHr && !hasOldCms) {
        applyStaffRolePermissions(roleSelect.value);
    }
});
</script>
