@extends('layouts.admin')

@section('title', 'Edit City')
@section('page-title', 'Edit City')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.cities.update', $city) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Name *</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $city->name) }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">State *</label>
                <select name="state_id" class="form-select @error('state_id') is-invalid @enderror" required>
                    @foreach($states as $state)
                        <option value="{{ $state->id }}" @selected(old('state_id', $city->state_id) == $state->id)>{{ $state->name }}</option>
                    @endforeach
                </select>
                @error('state_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.cities.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
