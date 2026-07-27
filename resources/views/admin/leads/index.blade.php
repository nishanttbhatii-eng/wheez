@extends('layouts.admin')

@section('title', 'Leads')
@section('page-title', 'Leads')

@section('content')
<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">
    <div>
        <h1>Leads</h1>
        <p>Captured leads from campaigns and forms</p>
    </div>
    <a href="{{ route('admin.leads.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add Lead</a>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-6">
                <label class="form-label">Search</label>
                <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Name, email, mobile">
            </div>
            <div class="col-md-6">
                <button class="btn btn-primary">Filter</button>
                <a href="{{ route('admin.leads.index') }}" class="btn btn-outline-secondary">Reset</a>
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
                        <th>Name</th>
                        <th>Contact</th>
                        <th>State</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($leads as $lead)
                        <tr>
                            <td>{{ $lead->id }}</td>
                            <td><strong>{{ $lead->name }}</strong></td>
                            <td>
                                <div>{{ $lead->email }}</div>
                                <div class="text-muted small">{{ $lead->mobile }}</div>
                            </td>
                            <td>{{ $lead->state?->name ?: '—' }}</td>
                            <td>{{ optional($lead->created_at)->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.leads.show', $lead) }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('admin.leads.edit', $lead) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.leads.destroy', $lead) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this lead?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-4">No leads yet. Import or add one manually.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $leads->links() }}
    </div>
</div>
@endsection
