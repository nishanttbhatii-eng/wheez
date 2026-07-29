@extends('layouts.admin')

@section('title', 'Edit Permission')
@section('page-title', 'Edit Permission')

@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.permissions.update', $permission) }}">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Permission name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $permission->name) }}" required>
            </div>
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
