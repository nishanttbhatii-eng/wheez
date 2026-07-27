@extends('layouts.admin')

@section('title', 'Pages')
@section('page-title', 'Pages Management')

@section('content')
<div class="page-header">
    <h1>Pages</h1>
    <p>Manage your static pages</p>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-file-alt me-2"></i>All Pages</span>
        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add New Page
        </a>
    </div>
    <div class="card-body">
        @if($pages->count() > 0)
            <div class="table-responsive">
                <table id="pagesTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Order</th>
                            <th>Created Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pages as $page)
                            <tr>
                                <td></td>
                                <td>
                                    @if($page->featured_image)
                                        <img src="{{ asset('storage/' . $page->featured_image) }}" alt="{{ $page->title }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                    @else
                                        <div style="width: 50px; height: 50px; background: #e2e8f0; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td><strong>{{ $page->title }}</strong></td>
                                <td><code>{{ $page->slug }}</code></td>
                                <td>
                                    @if($page->status == 'published')
                                        <span class="badge badge-success">{{ ucfirst($page->status) }}</span>
                                    @elseif($page->status == 'draft')
                                        <span class="badge badge-warning">{{ ucfirst($page->status) }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ ucfirst($page->status) }}</span>
                                    @endif
                                </td>
                                <td><span class="badge badge-info">{{ $page->order }}</span></td>
                                <td>{{ $page->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        @if($page->status === 'published')
                                            <a href="{{ $page->slug === 'home' ? route('home') : route('page.show', $page->slug) }}" class="btn btn-sm btn-outline-secondary" target="_blank" title="View page">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        @endif
                                        <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this page?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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

@push('scripts')
<script>
$(document).ready(function() {
    @if($pages->count() > 0)
    var pagesTable = $('#pagesTable').DataTable({
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        order: [[6, 'desc']], // Sort by Created Date descending
        language: {
            search: "Search:",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ pages",
            infoEmpty: "Showing 0 to 0 of 0 pages",
            infoFiltered: "(filtered from _MAX_ total pages)",
            paginate: {
                first: "First",
                last: "Last",
                next: "Next",
                previous: "Previous"
            }
        }
    });
    @endif
});
</script>
@endpush

<style>
    .badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }
    .badge-success {
        background: #d1fae5;
        color: #065f46;
    }
    .badge-warning {
        background: #fef3c7;
        color: #b45309;
    }
    .badge-danger {
        background: #fee2e2;
        color: #991b1b;
    }
    .badge-info {
        background: #dbeafe;
        color: #0c4a6e;
    }
</style>
@endsection
