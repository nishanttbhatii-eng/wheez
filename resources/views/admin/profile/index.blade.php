@extends('layouts.admin')

@section('title', 'Profile')
@section('page-title', 'My Profile')

@section('content')
@php($user = $user ?? Auth::user())

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-body text-center py-4">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Profile Picture" class="mb-3" style="width: 140px; height: 140px; object-fit: cover; border-radius: 50%; border: 4px solid #f2e600;">
                @else
                    <div class="mb-3 mx-auto" style="width: 140px; height: 140px; background: linear-gradient(135deg, #f2e600 0%, #c8c400 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #0a0a0a; font-size: 48px; font-weight: 700;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif

                <h4 class="mb-1">{{ $user->name }}</h4>
                <p class="text-muted mb-2">{{ $user->email }}</p>

                @if($user->isStaff())
                    <span class="badge bg-info mb-2">{{ $user->role_label }}</span>
                    @if($user->employee_code)
                        <p class="text-muted small mb-0">Employee Code: {{ $user->employee_code }}</p>
                    @endif
                @elseif($user->isAdmin())
                    <span class="badge bg-dark mb-0">Admin</span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <i class="fas fa-user me-2"></i>Account Details
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless table-sm mb-0">
                            @if($user->isStaff())
                                <tr>
                                    <th>Department</th>
                                    <td>{{ $user->department ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Joining Date</th>
                                    <td>{{ $user->joining_date ? $user->joining_date->format('M d, Y') : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $user->phone ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <span class="badge {{ $user->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($user->status ?? 'active') }}
                                        </span>
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <th>Member Since</th>
                                <td>{{ $user->created_at->format('M d, Y') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <i class="fas fa-camera me-2"></i>Update Avatar
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" accept="image/*">
                                @error('avatar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <small class="text-muted">Max 2MB. JPG, PNG, GIF, WEBP</small>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-upload me-1"></i> Upload
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('admin.settings') }}" class="btn btn-outline-primary">
                <i class="fas fa-cog me-1"></i> Settings
            </a>
        </div>
    </div>
</div>
@endsection
