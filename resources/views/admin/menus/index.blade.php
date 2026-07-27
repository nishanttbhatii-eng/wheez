@extends('layouts.admin')

@section('title', 'Menus')
@section('page-title', 'Menu Management')

@section('content')
<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">
    <div>
        <h1>Navigation Menu</h1>
        <p>Manage header menus matching <a href="https://whizseed.com/" target="_blank" rel="noopener">whizseed.com</a></p>
    </div>
    <div class="d-flex gap-2 flex-wrap">
        <form action="{{ route('admin.menus.seed') }}" method="POST" onsubmit="return confirm('Reset all menu items to whizseed.com defaults? This removes custom changes.');">
            @csrf
            <button type="submit" class="btn btn-outline-secondary">
                <i class="fas fa-sync me-2"></i>Reset to Default
            </button>
        </form>
        <a href="{{ route('admin.menus.create', ['location' => $location]) }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add Menu Item
        </a>
    </div>
</div>

<ul class="nav nav-tabs mb-4">
    <li class="nav-item">
        <a class="nav-link {{ $location === 'primary' ? 'active' : '' }}" href="{{ route('admin.menus.index', ['location' => 'primary']) }}">Primary Mega Menu</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $location === 'secondary' ? 'active' : '' }}" href="{{ route('admin.menus.index', ['location' => 'secondary']) }}">Secondary Links</a>
    </li>
</ul>

<div class="card">
    <div class="card-header">
        <i class="fas fa-bars me-2"></i>{{ $location === 'primary' ? 'Start-Up, License, Tax…' : 'About Us, Contact Us, Blogs' }}
    </div>
    <div class="card-body">
        @if($roots->isEmpty())
            <div class="text-center py-5 text-muted">
                <p>No menu items yet.</p>
                <form action="{{ route('admin.menus.seed') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-primary">Import whizseed.com Menu</button>
                </form>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Type</th>
                            <th>URL</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roots as $root)
                            @include('admin.menus._row', ['item' => $root, 'depth' => 0])
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
