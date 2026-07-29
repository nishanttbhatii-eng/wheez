@extends('layouts.admin')

@section('title', 'Permissions')
@section('page-title', 'Permissions')

@section('content')
<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">
    <div>
        <h1>Permissions</h1>
        <p>Permission groups for CMS modules</p>
    </div>
    <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add Permission Group</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="admin-table-wrap">
            <div class="table-responsive">
                <table class="table admin-datatable" id="permissionsTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th style="width:110px" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td><strong>{{ $permission->name }}</strong></td>
                                <td class="text-end">
                                    <div class="admin-actions">
                                        <a href="{{ route('admin.permissions.edit', $permission) }}" class="admin-action admin-action--edit" title="Edit" aria-label="Edit">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <form action="{{ route('admin.permissions.destroy', $permission) }}" method="POST" onsubmit="return confirm('Delete?');">
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
