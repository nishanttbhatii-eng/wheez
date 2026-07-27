@extends('layouts.admin')

@section('title', 'Users')
@section('page-title', 'Users')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">User List</h4>
                <a href="{{ route('admin.staff.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add User
                </a>
            </div>
            <div class="card-body">
                <!-- Filters -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <form method="GET" action="{{ route('admin.staff.index') }}" class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Role</label>
                                <select name="role" class="form-select">
                                    <option value="">All Roles</option>
                                    @foreach($roles as $value => $role)
                                        <option value="{{ $value }}" {{ request('role') == $value ? 'selected' : '' }}>{{ $role['label'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Search by Name</label>
                                <input type="text" name="name" class="form-control" value="{{ request('name') }}" placeholder="Search by name...">
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="fas fa-search"></i> Filter
                                </button>
                                <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Clear
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Staff Table -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Employee Code</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Joining Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($staff as $employee)
                                <tr>
                                    <td>{{ $employee->employee_code }}</td>
                                    <td>
                                        {{ $employee->title ? $employee->title . ' ' : '' }}
                                        {{ $employee->first_name }}
                                        {{ $employee->middle_name ? ' ' . $employee->middle_name : '' }}
                                        {{ $employee->last_name }}
                                    </td>
                                    <td>{{ $employee->email }}</td>
                                    <td><span class="badge bg-info">{{ $employee->role_label }}</span></td>
                                    <td>{{ $employee->department ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge {{ $employee->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($employee->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $employee->joining_date ? \Carbon\Carbon::parse($employee->joining_date)->format('M d, Y') : 'N/A' }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.staff.show', $employee) }}" class="btn btn-sm btn-outline-primary" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.staff.edit', $employee) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger" title="Delete" onclick="confirmDelete({{ $employee->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">No Users Found</h5>
                                            <p class="text-muted mb-3">There are no users matching your criteria.</p>
                                            <a href="{{ route('admin.staff.create') }}" class="btn btn-primary">
                                                <i class="fas fa-plus"></i> Add First User
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($staff->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $staff->appends(request()->query())->links() }}
                    </div>
                @endif

                <!-- Results Info -->
                <div class="mt-3 text-muted">
                    Showing {{ $staff->firstItem() ?? 0 }} to {{ $staff->lastItem() ?? 0 }} of {{ $staff->total() }} users
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this user? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Delete confirmation
function confirmDelete(staffId) {
    const deleteForm = document.getElementById('deleteForm');
    deleteForm.action = `{{ url('admin/staff') }}/${staffId}`;

    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
@endsection