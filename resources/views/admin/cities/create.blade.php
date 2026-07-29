@extends('layouts.admin')

@section('title', 'Create City')
@section('page-title', 'Create City')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.cities.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">State</label>
                <select name="state_id" class="form-select" required>
                    <option value="">Select state</option>
                    @foreach($states as $state)
                        <option value="{{ $state->id }}" @selected(old('state_id') == $state->id)>{{ $state->name }}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-primary">Create</button>
            <a href="{{ route('admin.cities.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
