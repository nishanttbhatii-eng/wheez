@extends('layouts.admin')

@section('title', 'States')
@section('page-title', 'States')

@section('content')
<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">
    <div>
        <h1>States</h1>
        <p>Indian states used by enquiry forms</p>
    </div>
    <a href="{{ route('admin.states.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add State</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr><th>ID</th><th>Name</th><th>Cities</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    @foreach($states as $state)
                        <tr>
                            <td>{{ $state->id }}</td>
                            <td>{{ $state->name }}</td>
                            <td>{{ $state->cities_count }}</td>
                            <td>
                                <a href="{{ route('admin.states.edit', $state) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.states.destroy', $state) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this state?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $states->links() }}
    </div>
</div>
@endsection
