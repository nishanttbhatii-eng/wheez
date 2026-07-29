@extends('layouts.admin')
@section('title', 'Roles')
@section('page-title', 'Roles')

@section('content')
<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">
    <div>
        <h1>Roles</h1>
        <p>Manage access roles</p>
    </div>
    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Create</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="admin-table-wrap">
            <div class="table-responsive">
                <table class="table admin-datatable" id="rolesTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th style="width:110px" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td><strong>{{ $role->name }}</strong></td>
                                <td class="text-end">
                                    <div class="admin-actions">
                                        <a href="{{ route('admin.roles.edit', $role) }}" class="admin-action admin-action--edit" title="Edit" aria-label="Edit">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" onsubmit="return confirm('Delete?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="admin-action admin-action--delete" title="Delete" aria-label="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
