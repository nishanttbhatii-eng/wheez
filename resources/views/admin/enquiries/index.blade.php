@extends('layouts.admin')

@section('title', 'Enquiries')
@section('page-title', 'Enquiries')

@section('content')
<div class="page-header">
    <h1>Enquiries</h1>
    <p>Contact form and lead submissions</p>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-5">
                <label class="form-label">Search</label>
                <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Name, email, mobile">
            </div>
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">All</option>
                    <option value="1" @selected(request('status') === '1')>New</option>
                    <option value="2" @selected(request('status') === '2')>In Progress</option>
                    <option value="3" @selected(request('status') === '3')>Closed</option>
                </select>
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary">Filter</button>
                <a href="{{ route('admin.enquiries.index') }}" class="btn btn-outline-secondary">Reset</a>
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
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($enquiries as $enquiry)
                        <tr>
                            <td>{{ $enquiry->id }}</td>
                            <td><strong>{{ $enquiry->name }}</strong></td>
                            <td>
                                <div>{{ $enquiry->email }}</div>
                                <div class="text-muted small">{{ $enquiry->mobile }}</div>
                            </td>
                            <td>{{ $enquiry->state?->name ?: '—' }}</td>
                            <td>
                                @if($enquiry->status == 2)
                                    <span class="badge badge-warning">In Progress</span>
                                @elseif($enquiry->status == 3)
                                    <span class="badge badge-secondary">Closed</span>
                                @else
                                    <span class="badge badge-success">New</span>
                                @endif
                            </td>
                            <td>{{ optional($enquiry->created_at)->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.enquiries.show', $enquiry) }}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                <form action="{{ route('admin.enquiries.destroy', $enquiry) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this enquiry?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted py-4">No enquiries found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $enquiries->links() }}
    </div>
</div>
@endsection
