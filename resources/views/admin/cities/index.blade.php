@extends('layouts.admin')

@section('title', 'Cities')
@section('page-title', 'Cities')

@section('content')
<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">
    <div>
        <h1>Cities</h1>
        <p>Cities linked to states</p>
    </div>
    <a href="{{ route('admin.cities.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add City</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="admin-table-wrap">
            <div class="table-responsive">
                <table class="table admin-datatable" id="citiesTable">
                    <thead>
                        <tr>
                            <th style="width:72px">ID</th>
                            <th>Name</th>
                            <th>State</th>
                            <th style="width:110px" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cities as $city)
                            <tr>
                                <td>{{ $city->id }}</td>
                                <td><strong>{{ $city->name }}</strong></td>
                                <td>{{ $city->state?->name ?: '—' }}</td>
                                <td class="text-end">
                                    <div class="admin-actions">
                                        <a href="{{ route('admin.cities.edit', $city) }}" class="admin-action admin-action--edit" title="Edit" aria-label="Edit">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <form action="{{ route('admin.cities.destroy', $city) }}" method="POST" onsubmit="return confirm('Delete?');">
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
        {{ $cities->links() }}
    </div>
</div>
@endsection
