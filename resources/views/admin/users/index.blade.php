@extends('layouts.admin')
@section('title', 'Users')
@section('page-title', 'Admin Users')

@section('content')
<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">
    <div>
        <h1>CMS users</h1>
        <p>Manage admin panel users and access</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add user</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="admin-table-wrap">
            <div class="table-responsive">
                <table class="table admin-datatable" id="usersTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Permissions</th>
                            <th>Status</th>
                            <th style="width:120px" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td><strong>{{ $user->name }}</strong></td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->roles->pluck('name')->join(', ') ?: '—' }}</td>
                                <td class="small text-muted">
                                    {{ $user->getDirectPermissions()->pluck('name')->take(4)->join(', ') ?: '—' }}
                                    @if($user->getDirectPermissions()->count() > 4)
                                        <span>(+{{ $user->getDirectPermissions()->count() - 4 }} more)</span>
                                    @endif
                                </td>
                                <td>
                                    @php($isActive = in_array((string) $user->status, ['1', 'active', 'published'], true))
                                    <span class="admin-status {{ $isActive ? 'admin-status--success' : 'admin-status--danger' }}">
                                        {{ $isActive ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="admin-actions">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="admin-action admin-action--edit" title="Edit" aria-label="Edit">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="{{ route('admin.users.status', $user) }}" class="admin-action admin-action--status" title="Toggle status" aria-label="Toggle status">
                                            <i class="fas fa-toggle-on"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-muted text-center py-4">No users yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        {{ $users->links() }}
    </div>
</div>
@endsection
