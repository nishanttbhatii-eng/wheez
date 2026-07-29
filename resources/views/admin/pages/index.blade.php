@extends('layouts.admin')

@section('title', 'Pages')
@section('page-title', 'Pages Management')

@section('content')
<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">
    <div>
        <h1>Pages</h1>
        <p>Manage your static pages</p>
    </div>
    <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New Page
    </a>
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-file-alt me-2"></i>All Pages
    </div>
    <div class="card-body">
        @if($pages->count() > 0)
            <div class="admin-table-wrap">
                <div class="table-responsive">
                    <table id="pagesTable" class="table admin-datatable">
                        <thead>
                            <tr>
                                <th style="width:56px">#</th>
                                <th style="width:64px">Image</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th style="width:72px">Order</th>
                                <th>Created</th>
                                <th style="width:150px" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pages as $page)
                                <tr>
                                    <td></td>
                                    <td>
                                        @if($page->featured_image_url)
                                            <img src="{{ $page->featured_image_url }}" alt="{{ $page->title }}" class="admin-thumb">
                                        @else
                                            <span class="admin-thumb-placeholder"><i class="fas fa-image"></i></span>
                                        @endif
                                    </td>
                                    <td><strong>{{ $page->title }}</strong></td>
                                    <td><code>{{ $page->slug }}</code></td>
                                    <td>
                                        @if($page->status == 'published')
                                            <span class="admin-status admin-status--success">Published</span>
                                        @elseif($page->status == 'draft')
                                            <span class="admin-status admin-status--warning">Draft</span>
                                        @else
                                            <span class="admin-status admin-status--danger">{{ ucfirst($page->status) }}</span>
                                        @endif
                                    </td>
                                    <td><span class="admin-status admin-status--info">{{ $page->order }}</span></td>
                                    <td data-order="{{ $page->created_at?->timestamp }}">{{ $page->created_at?->format('M d, Y') }}</td>
                                    <td class="text-end">
                                        <div class="admin-actions">
                                            @if($page->status === 'published')
                                                <a href="{{ $page->url }}"
                                                   class="admin-action admin-action--view"
                                                   target="_blank"
                                                   title="View {{ $page->url }}"
                                                   aria-label="View page">
                                                    <i class="fas fa-external-link-alt"></i>
                                                </a>
                                            @endif
                                            <a href="{{ route('admin.pages.edit', $page->id) }}"
                                               class="admin-action admin-action--edit"
                                               title="Edit"
                                               aria-label="Edit">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <a href="{{ route('admin.pages.status', $page) }}"
                                               class="admin-action admin-action--status"
                                               title="Toggle status"
                                               aria-label="Toggle status">
                                                <i class="fas fa-toggle-on"></i>
                                            </a>
                                            <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this page?');">
                                                @csrf
                                                @method('DELETE')
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
        @else
            <div class="text-center py-5">
                <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                <p class="text-muted">No pages found.</p>
                <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Create Your First Page
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    @if($pages->count() > 0)
    $('#pagesTable').DataTable({
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
        order: [[6, 'desc']],
        columnDefs: [
            { orderable: false, searchable: false, targets: [1, 7] },
            {
                targets: 0,
                searchable: false,
                orderable: false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            }
        ],
        language: {
            search: 'Search',
            searchPlaceholder: 'Title, slug…',
            lengthMenu: 'Show _MENU_',
            info: 'Showing _START_–_END_ of _TOTAL_',
            infoEmpty: 'No pages',
            infoFiltered: '(filtered from _MAX_)',
            paginate: { previous: 'Prev', next: 'Next' },
            zeroRecords: 'No matching pages found'
        }
    });
    @endif
});
</script>
@endpush
