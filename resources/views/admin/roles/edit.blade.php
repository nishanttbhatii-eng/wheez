@extends('layouts.admin')
@section('title', 'Edit Role')
@section('page-title', 'Edit Role')
@section('content')
<div class="card">
    <div class="card-body">
        <p class="text-muted small">Permissions is role par assign nahi hote — user form par role select karke set karte hain.</p>
        <form method="POST" action="{{ route('admin.roles.update', $role) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Role name *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $role->name) }}" required>
            </div>
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
