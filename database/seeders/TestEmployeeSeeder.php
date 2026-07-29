<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestEmployeeSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'nishantbhati02@gmail.com'],
            [
                'name' => 'Nishant Bhati',
                'first_name' => 'Nishant',
                'last_name' => 'Bhati',
                'employee_code' => 'EMP002',
                'password' => Hash::make('emp123'),
                'joining_date' => now()->toDateString(),
                'role' => 'emp',
                'staff_permissions' => config('staff.roles.emp.permissions'),
                'department' => 'IT',
                'working_days' => [
                    'monday' => 'full_day',
                    'tuesday' => 'full_day',
                    'wednesday' => 'full_day',
                    'thursday' => 'full_day',
                    'friday' => 'full_day',
                    'saturday' => 'non_working',
                    'sunday' => 'non_working',
                ],
                'can_approve_leave' => false,
                'general_leave_allowance' => 20,
                'sick_leave_allowance' => 5,
                'future_leave_allowance' => true,
                'exempt_forced_leave' => false,
                'managed_by_approver' => false,
                'manage_training_panel' => false,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );
    }
}
