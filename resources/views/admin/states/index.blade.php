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
        <div class="admin-table-wrap">
            <div class="table-responsive">
                <table class="table admin-datatable" id="statesTable">
                    <thead>
                        <tr>
                            <th style="width:72px">ID</th>
                            <th>Name</th>
                            <th>Cities</th>
                            <th style="width:110px" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($states as $state)
                            <tr>
                                <td>{{ $state->id }}</td>
                                <td><strong>{{ $state->name }}</strong></td>
                                <td>{{ $state->cities_count }}</td>
                                <td class="text-end">
                                    <div class="admin-actions">
                                        <a href="{{ route('admin.states.edit', $state) }}" class="admin-action admin-action--edit" title="Edit" aria-label="Edit">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <form action="{{ route('admin.states.destroy', $state) }}" method="POST" onsubmit="return confirm('Delete this state?');">
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
        {{ $states->links() }}
    </div>
</div>
@endsection
