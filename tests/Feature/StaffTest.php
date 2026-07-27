<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StaffTest extends TestCase
{
    use RefreshDatabase;

    public function test_staff_create_form_loads(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'email' => 'admin@test.com',
        ]);

        $response = $this->actingAs($admin)->get('/admin/staff/create');

        $response->assertStatus(200);
        $response->assertSee('Add Staff');
        $response->assertSee('Team Lead');
        $response->assertSee('HR');
        $response->assertSee('Employee');
        $response->assertDontSee('Working Days');
        $response->assertDontSee('Emergency Contact Name');
    }

    public function test_staff_creation_with_valid_data(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'email' => 'admin@test.com',
        ]);

        $staffData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'employee_code' => 'EMP001',
            'email' => 'john.doe@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'joining_date' => '2024-01-01',
            'role' => 'team_lead',
            'permissions' => ['approve_leave', 'manage_training', 'view_reports', 'view_training', 'request_leave'],
            'department' => 'IT',
            'status' => '1',
        ];

        $response = $this->actingAs($admin)
            ->post('/admin/staff', $staffData);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/staff');

        $this->assertDatabaseHas('users', [
            'email' => 'john.doe@example.com',
            'employee_code' => 'EMP001',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'role' => 'team_lead',
            'can_approve_leave' => true,
            'manage_training_panel' => true,
            'general_leave_allowance' => 20,
            'sick_leave_allowance' => 5,
        ]);
    }

    public function test_staff_creation_validation(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/admin/staff', []);

        $response->assertRedirect();
        $response->assertSessionHasErrors([
            'first_name',
            'last_name',
            'employee_code',
            'email',
            'password',
            'joining_date',
            'role',
        ]);
    }

    public function test_employee_cannot_access_staff_management(): void
    {
        $employee = User::factory()->create([
            'role' => 'emp',
            'email' => 'emp@test.com',
        ]);

        $this->actingAs($employee)->get('/admin/staff')->assertStatus(403);
        $this->actingAs($employee)->get('/admin/staff/create')->assertStatus(403);
    }
}
