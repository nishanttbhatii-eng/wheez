@extends('layouts.admin')

@section('title', 'View User')
@section('page-title', 'View User')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">User Details</h4>
                <div>
                    <a href="{{ route('admin.staff.edit', $staff) }}" class="btn btn-warning me-2">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-primary mb-3">Personal Information</h5>
                        <table class="table table-borderless">
                            <tr>
                                <th width="40%">Full Name:</th>
                                <td>{{ $staff->title ? $staff->title . ' ' : '' }}{{ $staff->first_name }} {{ $staff->middle_name ? $staff->middle_name . ' ' : '' }}{{ $staff->last_name }}</td>
                            </tr>
                            <tr>
                                <th>Employee Code:</th>
                                <td>{{ $staff->employee_code }}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{ $staff->email }}</td>
                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <td>{{ $staff->phone ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Gender:</th>
                                <td>{{ ucfirst($staff->gender) }}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth:</th>
                                <td>{{ $staff->date_of_birth ? \Carbon\Carbon::parse($staff->date_of_birth)->format('M d, Y') : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Joining Date:</th>
                                <td>{{ $staff->joining_date ? \Carbon\Carbon::parse($staff->joining_date)->format('M d, Y') : 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <h5 class="text-primary mb-3">Employment Information</h5>
                        <table class="table table-borderless">
                            <tr>
                                <th width="40%">Role:</th>
                                <td><span class="badge bg-info">{{ $staff->role_label }}</span></td>
                            </tr>
                            <tr>
                                <th>Department:</th>
                                <td>{{ $staff->department ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Profile:</th>
                                <td>{{ $staff->designation ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>
                                    <span class="badge {{ $staff->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($staff->status) }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <h5 class="text-primary mb-3">Permissions</h5>
                        <div class="d-flex flex-wrap gap-2">
                            @forelse($staff->staff_permissions ?? [] as $permission)
                                <span class="badge bg-secondary">{{ config('staff.permissions.' . $permission, ucfirst(str_replace('_', ' ', $permission))) }}</span>
                            @empty
                                <span class="text-muted">No permissions assigned.</span>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <h5 class="text-primary mb-3">Emergency Contact</h5>
                        <table class="table table-borderless">
                            <tr>
                                <th width="40%">Name:</th>
                                <td>{{ $staff->emergency_contact_name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{ $staff->emergency_contact_email ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <td>{{ $staff->emergency_contact_number ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <h5 class="text-primary mb-3">Working Days Schedule</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Monday</th>
                                        <th>Tuesday</th>
                                        <th>Wednesday</th>
                                        <th>Thursday</th>
                                        <th>Friday</th>
                                        <th>Saturday</th>
                                        <th>Sunday</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @php $workingDays = $staff->working_days ?? []; @endphp
                                        @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                                            <td>
                                                @php
                                                    $dayStatus = $workingDays[$day] ?? 'full_day';
                                                    $badgeClass = match($dayStatus) {
                                                        'full_day' => 'bg-success',
                                                        'half_day' => 'bg-warning',
                                                        'non_working' => 'bg-secondary',
                                                        default => 'bg-secondary'
                                                    };
                                                    $statusText = match($dayStatus) {
                                                        'full_day' => 'Full Day',
                                                        'half_day' => 'Half Day',
                                                        'non_working' => 'Non-working',
                                                        default => 'Unknown'
                                                    };
                                                @endphp
                                                <span class="badge {{ $badgeClass }}">{{ $statusText }}</span>
                                            </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @if($staff->notes)
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h5 class="text-primary mb-3">Notes</h5>
                        <div class="card">
                            <div class="card-body">
                                {{ $staff->notes }}
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
