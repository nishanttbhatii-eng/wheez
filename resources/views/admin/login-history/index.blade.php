@extends('layouts.admin')

@section('title', 'Login History')
@section('page-title', 'Login History')

@section('content')
<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">
    <div>
        <h1>Login History</h1>
        <p>Successful admin sign-ins</p>
    </div>
    <form method="GET" class="d-flex gap-2">
        <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Name or email…">
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>IP</th>
                    <th>When</th>
                </tr>
            </thead>
            <tbody>
                @forelse($records as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->ip }}</td>
                        <td>{{ $row->created_at?->format('d M Y H:i') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-muted text-center">No login records yet.</td></tr>
                @endforelse
            </tbody>
        </table>
        </div>
        {{ $records->links() }}
    </div>
</div>
@endsection
