@php
    $roles = config('staff.roles');
    $permissions = config('staff.permissions');
    $selectedRole = old('role', $selectedRole ?? 'emp');
    $selectedPermissions = old('permissions', $selectedPermissions ?? ($roles[$selectedRole]['permissions'] ?? []));
    $roleDefaults = collect($roles)->mapWithKeys(fn ($role, $key) => [$key => $role['permissions']]);
@endphp

<div class="row mb-4">
    <div class="col-md-12">
        <h5 class="text-primary mb-3">Role & Permissions</h5>
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
        <label class="form-label d-block">Permissions</label>
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
        <small class="text-muted">Default permissions are applied when you select a role. You can adjust them as needed.</small>
    </div>
</div>

<script>
const roleDefaultPermissions = @json($roleDefaults);

function applyRolePermissions(role, preserveChecked = false) {
    const defaults = roleDefaultPermissions[role] || [];
    document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
        if (!preserveChecked) {
            checkbox.checked = defaults.includes(checkbox.value);
        }
    });
}

document.getElementById('staffRoleSelect').addEventListener('change', function() {
    applyRolePermissions(this.value);
});

document.addEventListener('DOMContentLoaded', function() {
    const roleSelect = document.getElementById('staffRoleSelect');
    if (roleSelect.value && !@json((bool) old('permissions'))) {
        applyRolePermissions(roleSelect.value);
    }
});
</script>
