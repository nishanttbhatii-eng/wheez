@extends('layouts.admin')
@section('title', 'Create User')
@section('page-title', 'Create User')
@section('content')
<div class="card"><div class="card-body">
<form method="POST" action="{{ route('admin.users.store') }}">@csrf
<div class="mb-3"><label class="form-label">Name</label><input name="name" class="form-control" required></div>
<div class="mb-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required></div>
<div class="mb-3"><label class="form-label">Phone</label><input name="phone" class="form-control"></div>
<div class="mb-3"><label class="form-label">Password</label><input type="password" name="password" class="form-control" required></div>
<div class="mb-3"><label class="form-label">Confirm</label><input type="password" name="password_confirmation" class="form-control" required></div>
@include('admin.users.partials.role-permissions')
<button class="btn btn-primary">Create</button>
<a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Cancel</a>
</form></div></div>
@endsection
