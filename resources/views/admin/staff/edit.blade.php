@extends('layouts.admin')

@section('title', 'Edit User')
@section('page-title', 'Edit User')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Edit User Details</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.staff.update', $staff) }}" id="staffForm">
                    @csrf
                    @method('PUT')

                    <!-- Staff Details Section -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5 class="text-primary mb-3">User Details</h5>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Title</label>
                            <select name="title" class="form-select">
                                <option value="">Select</option>
                                <option value="Mr." {{ old('title', $staff->title) == 'Mr.' ? 'selected' : '' }}>Mr.</option>
                                <option value="Mrs." {{ old('title', $staff->title) == 'Mrs.' ? 'selected' : '' }}>Mrs.</option>
                                <option value="Ms." {{ old('title', $staff->title) == 'Ms.' ? 'selected' : '' }}>Ms.</option>
                                <option value="Dr." {{ old('title', $staff->title) == 'Dr.' ? 'selected' : '' }}>Dr.</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name', $staff->first_name) }}" required>
                            @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Middle Name</label>
                            <input type="text" name="middle_name" class="form-control" value="{{ old('middle_name', $staff->middle_name) }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $staff->last_name) }}" required>
                            @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Employee Code <span class="text-danger">*</span></label>
                            <input type="text" name="employee_code" class="form-control @error('employee_code') is-invalid @enderror" value="{{ old('employee_code', $staff->employee_code) }}" required>
                            @error('employee_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $staff->email) }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Gender <span class="text-danger">*</span></label>
                            <select name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender', $staff->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $staff->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender', $staff->gender) == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Contact Number</label>
                            <input type="text" name="contact_number" class="form-control @error('contact_number') is-invalid @enderror" value="{{ old('contact_number', $staff->phone) }}">
                            @error('contact_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Date Of Birth <span class="text-danger">*</span></label>
                            <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth', $staff->date_of_birth) }}" required>
                            @error('date_of_birth')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Emergency Contact Name</label>
                            <input type="text" name="emergency_contact_name" class="form-control" value="{{ old('emergency_contact_name', $staff->emergency_contact_name) }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Emergency Contact Email</label>
                            <input type="email" name="emergency_contact_email" class="form-control @error('emergency_contact_email') is-invalid @enderror" value="{{ old('emergency_contact_email', $staff->emergency_contact_email) }}">
                            @error('emergency_contact_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Emergency Contact Number</label>
                            <input type="text" name="emergency_contact_number" class="form-control" value="{{ old('emergency_contact_number', $staff->emergency_contact_number) }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Joining date <span class="text-danger">*</span></label>
                            <input type="date" name="joining_date" class="form-control @error('joining_date') is-invalid @enderror" value="{{ old('joining_date', $staff->joining_date) }}" required>
                            @error('joining_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Department</label>
                            <select name="department" class="form-select">
                                <option value="">Select Department</option>
                                <option value="IT" {{ old('department', $staff->department) == 'IT' ? 'selected' : '' }}>IT</option>
                                <option value="HR" {{ old('department', $staff->department) == 'HR' ? 'selected' : '' }}>HR</option>
                                <option value="Finance" {{ old('department', $staff->department) == 'Finance' ? 'selected' : '' }}>Finance</option>
                                <option value="Marketing" {{ old('department', $staff->department) == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                                <option value="Operations" {{ old('department', $staff->department) == 'Operations' ? 'selected' : '' }}>Operations</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Profile</label>
                            <select name="profile" class="form-select">
                                <option value="">Select Profile</option>
                                <option value="Manager" {{ old('profile', $staff->designation) == 'Manager' ? 'selected' : '' }}>Manager</option>
                                <option value="Senior Developer" {{ old('profile', $staff->designation) == 'Senior Developer' ? 'selected' : '' }}>Senior Developer</option>
                                <option value="Developer" {{ old('profile', $staff->designation) == 'Developer' ? 'selected' : '' }}>Developer</option>
                                <option value="Designer" {{ old('profile', $staff->designation) == 'Designer' ? 'selected' : '' }}>Designer</option>
                                <option value="Analyst" {{ old('profile', $staff->designation) == 'Analyst' ? 'selected' : '' }}>Analyst</option>
                            </select>
                        </div>
                    </div>

                    @include('admin.staff.partials.role-permissions', [
                        'selectedRole' => old('role', $staff->role),
                        'selectedPermissions' => old('permissions', $staff->permissions ?? []),
                    ])

                    <!-- Working Days Section -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5 class="text-primary mb-3">Working Days</h5>
                            <p class="text-muted">Enter the weekly working schedule for the Staff member below</p>
                        </div>
                        <div class="col-md-12">
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
                                            @php $workingDays = old('working_days', $staff->working_days ?? []); @endphp
                                            @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                                                <td>
                                                    <select name="working_days[{{ $day }}]" class="form-select">
                                                        <option value="full_day" {{ ($workingDays[$day] ?? 'full_day') == 'full_day' ? 'selected' : '' }}>Full Day</option>
                                                        <option value="half_day" {{ $workingDays[$day] == 'half_day' ? 'selected' : '' }}>Half Day</option>
                                                        <option value="non_working" {{ ($workingDays[$day] ?? ($day == 'saturday' || $day == 'sunday' ? 'non_working' : 'full_day')) == 'non_working' ? 'selected' : '' }}>Non-working Day</option>
                                                    </select>
                                                </td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Settings -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5 class="text-primary mb-3">Additional Settings</h5>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="status" class="form-check-input" id="status" {{ old('status', $staff->status == 'active') ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">
                                    Status: <span class="text-success">Active</span> / <span class="text-muted">Inactive</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Notes Section -->
                    <div class="row mb-4">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Notes</label>
                            <textarea name="notes" class="form-control" rows="3" placeholder="Additional notes...">{{ old('notes', $staff->notes) }}</textarea>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary me-2">Update User</button>
                            <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

