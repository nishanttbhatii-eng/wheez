@php
    $selectedRole = $selectedRole ?? old('roles');
    $selectedPermissions = $selectedPermissions ?? old('permissions', []);
    $rolePermissionMap = $rolePermissionMap ?? collect();
@endphp
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <label class="form-label">Role *</label>
        <select name="roles" id="cmsUserRoleSelect" class="form-select @error('roles') is-invalid @enderror" required>
            <option value="">Select role</option>
            @foreach($roles as $role)
                <option value="{{ $role->name }}" @selected($selectedRole === $role->name)>{{ $role->name }}</option>
            @endforeach
        </select>
        @error('roles')<div class="invalid-feedback">{{ $message }}</div>@enderror
        <small class="text-muted">Role change par default permissions auto select honge (config se).</small>
    </div>
    <div class="col-md-12 mb-3">
        <label class="form-label d-block">Permissions for this user</label>
        @foreach($permissions as $group => $items)
            <div class="mb-2"><strong>{{ $group }}</strong></div>
            <div class="row mb-3">
                @foreach($items as $permission)
                    <div class="col-md-4">
                        <label class="d-block">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="cms-permission-checkbox" @checked(in_array($permission->name, $selectedPermissions, true))>
                            {{ $permission->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
<script>
const cmsRolePermissionMap = @json($rolePermissionMap);
function applyCmsRolePermissions(roleName) {
    const defaults = cmsRolePermissionMap[roleName] || [];
    document.querySelectorAll('.cms-permission-checkbox').forEach(function (checkbox) {
        checkbox.checked = defaults.includes(checkbox.value);
    });
}
document.getElementById('cmsUserRoleSelect')?.addEventListener('change', function () {
    applyCmsRolePermissions(this.value);
});
document.addEventListener('DOMContentLoaded', function () {
    const select = document.getElementById('cmsUserRoleSelect');
    if (select?.value && !@json((bool) old('permissions'))) {
        applyCmsRolePermissions(select.value);
    }
});
</script>
