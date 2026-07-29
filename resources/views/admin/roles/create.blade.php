@extends('layouts.admin')
@section('title', 'Create Role')
@section('page-title', 'Create Role')
@section('content')
<div class="card">
    <div class="card-body">
        <p class="text-muted small">Role sirf naam ke liye hai. Permissions user add/edit par role ke hisaab se select hote hain (<code>config/cms_roles.php</code>).</p>
        <form method="POST" action="{{ route('admin.roles.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Role name *</label>
                <input name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <button class="btn btn-primary">Save</button>
            <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
