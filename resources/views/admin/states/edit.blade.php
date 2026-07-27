@extends('layouts.admin')

@section('title', 'Edit State')
@section('page-title', 'Edit State')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.states.update', $state) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Name *</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $state->name) }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.states.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
