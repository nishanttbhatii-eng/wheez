@extends('layouts.admin')

@section('title', 'Categories')
@section('page-title', 'Categories')

@section('content')
<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">
    <div>
        <h1>Categories</h1>
        <p>Manage service categories and subcategories</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add Category</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="admin-table-wrap">
            <div class="table-responsive">
                <table id="categoriesTable" class="table admin-datatable">
                    <thead>
                        <tr>
                            <th style="width:72px">ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Parent</th>
                            <th>Status</th>
                            <th style="width:140px" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td><strong>{{ $category->name }}</strong></td>
                                <td><code>{{ $category->slug }}</code></td>
                                <td>{{ $category->parent?->name ?: '—' }}</td>
                                <td>
                                    @if($category->status)
                                        <span class="admin-status admin-status--success">Active</span>
                                    @else
                                        <span class="admin-status admin-status--danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="admin-actions">
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="admin-action admin-action--edit" title="Edit" aria-label="Edit">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="{{ route('admin.categories.status', $category) }}" class="admin-action admin-action--status" title="Toggle status" aria-label="Toggle status">
                                            <i class="fas fa-toggle-on"></i>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category?');">
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

@push('scripts')
<script>
$(function () {
    $('#categoriesTable').DataTable({
        pageLength: 25,
        order: [[0, 'asc']],
        columnDefs: [{ orderable: false, searchable: false, targets: -1 }],
        language: {
            search: 'Search',
            searchPlaceholder: 'Name, slug…',
            lengthMenu: 'Show _MENU_',
            info: 'Showing _START_–_END_ of _TOTAL_',
            paginate: { previous: 'Prev', next: 'Next' }
        }
    });
});
</script>
@endpush
