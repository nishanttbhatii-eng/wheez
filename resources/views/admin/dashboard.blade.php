@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="dashboard-welcome mb-4">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
        <div>
            <h1 class="h3 mb-1">Welcome back, {{ $user->name }}</h1>
            <p class="text-muted mb-0">{{ now()->format('l, d M Y') }}</p>
        </div>
        @if($isSuperAdmin)
            <span class="badge dashboard-admin-badge">Super Admin</span>
        @else
            <span class="badge bg-secondary">{{ $user->role_label }}</span>
        @endif
    </div>
</div>

@if($isSuperAdmin)
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="dashboard-stat-card stat-indigo">
            <div class="stat-label">Categories</div>
            <div class="stat-value">{{ $stats['categories'] }}</div>
            <div class="stat-foot">Service categories</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="dashboard-stat-card stat-blue">
            <div class="stat-label">Services</div>
            <div class="stat-value">{{ $stats['services'] }}</div>
            <div class="stat-foot">Catalog items</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="dashboard-stat-card stat-slate">
            <div class="stat-label">Enquiries</div>
            <div class="stat-value">{{ $stats['enquiries'] }}</div>
            <div class="stat-foot">{{ $stats['new_enquiries'] }} new</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="dashboard-stat-card stat-indigo">
            <div class="stat-label">Users</div>
            <div class="stat-value">{{ $stats['total_users'] }}</div>
            <div class="stat-foot">{{ $stats['active_users'] }} active</div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4 dashboard-charts-row">
    @if($charts['staff_roles'])
    <div class="col-lg-6">
        <div class="card dashboard-chart-card h-100">
            <div class="card-header"><h5 class="mb-0">Users by Role</h5></div>
            <div class="card-body">
                <div class="dashboard-chart-wrap dashboard-chart-wrap--doughnut" id="staffRoleChartWrap">
                    <canvas id="staffRoleChart"></canvas>
                </div>
                <div class="dashboard-chart-empty d-none" id="staffRoleChartEmpty">No user data yet.</div>
            </div>
        </div>
    </div>
    @endif
    @if($charts['user_status'])
    <div class="col-lg-6">
        <div class="card dashboard-chart-card h-100">
            <div class="card-header"><h5 class="mb-0">User Status</h5></div>
            <div class="card-body">
                <div class="dashboard-chart-wrap dashboard-chart-wrap--doughnut" id="userStatusChartWrap">
                    <canvas id="userStatusChart"></canvas>
                </div>
                <div class="dashboard-chart-empty d-none" id="userStatusChartEmpty">No user data yet.</div>
            </div>
        </div>
    </div>
    @endif
</div>

@if(count($modules))
<div class="card dashboard-modules-card">
    <div class="card-header"><h5 class="mb-0">Quick Access</h5></div>
    <div class="card-body">
        <div class="row g-3">
            @foreach($modules as $module)
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route($module['route']) }}" class="dashboard-module-link">
                        <strong>{{ $module['name'] }}</strong>
                        <span>{{ $module['desc'] }}</span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@else
<div class="card dashboard-modules-card">
    <div class="card-body">
        <p class="text-muted mb-0">Use the menu to access your account profile and settings.</p>
    </div>
</div>
@endif
@endsection

@push('scripts')
@include('admin.dashboard.charts-script')
@endpush
