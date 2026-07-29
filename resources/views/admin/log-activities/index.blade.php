@extends('layouts.admin')

@section('title', 'Log Activity')
@section('page-title', 'Log Activity')

@section('content')
<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">
    <div>
        <h1>Log Activity</h1>
        <p>Audit trail of admin actions</p>
    </div>
    <form method="GET" class="d-flex gap-2">
        <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Search…">
        <button class="btn btn-outline-primary">Search</button>
    </form>
</div>

<div class="card">
    <div class="card-body">
        <div class="admin-table-wrap table-responsive">
        <table class="table admin-datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Subject</th>
                    <th>Method</th>
                    <th>IP</th>
                    <th>User</th>
                    <th>When</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                    <tr>
                        <td>{{ $log->id }}</td>
                        <td>{{ $log->subject }}</td>
                        <td><code>{{ $log->method }}</code></td>
                        <td>{{ $log->ip }}</td>
                        <td>{{ $log->user?->name ?: '—' }}</td>
                        <td>{{ $log->created_at?->format('d M Y H:i') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-muted text-center">No activity logged yet.</td></tr>
                @endforelse
            </tbody>
        </table>
        </div>
        {{ $logs->links() }}
    </div>
</div>
@endsection
