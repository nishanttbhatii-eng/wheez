@extends('layouts.admin')

@section('title', 'Services')
@section('page-title', 'Services')

@section('content')
<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">
    <div>
        <h1>Services</h1>
        <p>Manage the service catalog</p>
    </div>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add Service</a>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Search</label>
                <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Name or slug">
            </div>
            <div class="col-md-3">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-select">
                    <option value="">All</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" @selected(request('category_id') == $cat->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">All</option>
                    <option value="1" @selected(request('status') === '1')>Active</option>
                    <option value="0" @selected(request('status') === '0')>Inactive</option>
                </select>
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary">Filter</button>
                <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="admin-table-wrap">
            <div class="table-responsive">
                <table class="table admin-datatable" id="servicesTable">
                    <thead>
                        <tr>
                            <th style="width:72px">ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th style="width:140px" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                            <tr>
                                <td>{{ $service->id }}</td>
                                <td>
                                    <strong>{{ $service->name }}</strong>
                                    <div><code>{{ \Illuminate\Support\Str::limit($service->slug, 40) }}</code></div>
                                </td>
                                <td>{{ $service->category?->name ?: '—' }}</td>
                                <td>₹{{ number_format((float) $service->price, 0) }}</td>
                                <td>
                                    @if($service->status)
                                        <span class="admin-status admin-status--success">Active</span>
                                    @else
                                        <span class="admin-status admin-status--danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="admin-actions">
                                        <a href="{{ route('admin.services.edit', $service) }}" class="admin-action admin-action--edit" title="Edit" aria-label="Edit">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="{{ route('admin.services.status', $service) }}" class="admin-action admin-action--status" title="Toggle status" aria-label="Toggle status">
                                            <i class="fas fa-toggle-on"></i>
                                        </a>
                                        <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="return confirm('Delete this service?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="admin-action admin-action--delete" title="Delete" aria-label="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted py-4">No services found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        {{ $services->links() }}
    </div>
</div>
@endsection
