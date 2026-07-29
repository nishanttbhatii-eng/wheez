@extends('layouts.admin')

@section('title', 'Add Permissions')
@section('page-title', 'Add Permission Group')

@section('content')
<div class="card">
    <div class="card-body">
        <p class="text-muted">Creates four permissions: <code>name-list</code>, <code>name-create</code>, <code>name-edit</code>, <code>name-delete</code></p>
        <form method="POST" action="{{ route('admin.permissions.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Module name (lowercase, e.g. service)</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required pattern="[a-z0-9\-]+">
            </div>
            <button class="btn btn-primary">Create</button>
            <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
