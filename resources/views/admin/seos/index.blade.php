@extends('layouts.admin')

@section('title', 'SEO Records')
@section('page-title', 'SEO Records')

@section('content')
<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">
    <div>
        <h1>SEO Records</h1>
        <p>Meta titles and descriptions for pages, categories, and services</p>
    </div>
    <a href="{{ route('admin.seos.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add SEO</a>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Search</label>
                <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Title / keywords">
            </div>
            <div class="col-md-3">
                <label class="form-label">Type</label>
                <select name="page_type" class="form-select">
                    <option value="">All</option>
                    <option value="0" @selected(request('page_type') === '0')>Content Page</option>
                    <option value="1" @selected(request('page_type') === '1')>Subcategory</option>
                    <option value="2" @selected(request('page_type') === '2')>Service</option>
                </select>
            </div>
            <div class="col-md-5">
                <button class="btn btn-primary">Filter</button>
                <a href="{{ route('admin.seos.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Related</th>
                        <th>Meta Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($seos as $seo)
                        <tr>
                            <td>{{ $seo->id }}</td>
                            <td><span class="badge badge-info">{{ $seo->typeLabel() }}</span></td>
                            <td>
                                <div>#{{ $seo->page_id }}</div>
                                <div class="small text-muted">{{ \Illuminate\Support\Str::limit($seo->relatedTitle(), 40) }}</div>
                            </td>
                            <td>{{ \Illuminate\Support\Str::limit((string) ($seo->meta_title ?? ''), 60) }}</td>
                            <td>
                                <a href="{{ route('admin.seos.edit', $seo) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.seos.destroy', $seo) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this SEO record?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">No SEO records. Run <code>php artisan wiz:import-sql --tables=seos</code>.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $seos->links() }}
    </div>
</div>
@endsection
