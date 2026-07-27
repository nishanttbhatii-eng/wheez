@extends('layouts.admin')

@section('title', 'Create Menu Item')
@section('page-title', 'Add Menu Item')

@section('content')
<div class="page-header">
    <h1>Add Menu Item</h1>
    <p>Create a navigation link or dropdown group</p>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.menus.store') }}" method="POST">
            @csrf
            @include('admin.menus._form')
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">Save Menu Item</button>
                <a href="{{ route('admin.menus.index', ['location' => $location]) }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
