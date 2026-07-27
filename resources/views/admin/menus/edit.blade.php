@extends('layouts.admin')

@section('title', 'Edit Menu Item')
@section('page-title', 'Edit Menu Item')

@section('content')
<div class="page-header">
    <h1>Edit: {{ $menu->title }}</h1>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.menus.update', $menu) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.menus._form', ['menu' => $menu])
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">Update Menu Item</button>
                <a href="{{ route('admin.menus.index', ['location' => $menu->location]) }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
