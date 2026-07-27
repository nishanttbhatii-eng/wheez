<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'permissions',
        'phone',
        'department',
        'designation',
        'avatar',
        'title',
        'first_name',
        'middle_name',
        'last_name',
        'employee_code',
        'gender',
        'date_of_birth',
        'emergency_contact_name',
        'emergency_contact_email',
        'emergency_contact_number',
        'joining_date',
        'user_type',
        'working_days',
        'notes',
        'can_approve_leave',
        'general_leave_allowance',
        'sick_leave_allowance',
        'leave_approver_stage1',
        'leave_approver_stage2',
        'future_leave_allowance',
        'exempt_forced_leave',
        'managed_by_approver',
        'manage_training_panel',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'permissions' => 'array',
        'working_days' => 'array',
        'date_of_birth' => 'date',
        'joining_date' => 'date',
        'can_approve_leave' => 'boolean',
        'future_leave_allowance' => 'boolean',
        'exempt_forced_leave' => 'boolean',
        'managed_by_approver' => 'boolean',
        'manage_training_panel' => 'boolean',
    ];

    public function scopeStaff($query)
    {
        return $query->whereIn('role', array_keys(config('staff.roles', [])));
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isStaff(): bool
    {
        return array_key_exists($this->role, config('staff.roles', []));
    }

    public function hasPermission(string $permission): bool
    {
        if ($this->isAdmin()) {
            return true;
        }

        return in_array($permission, $this->permissions ?? [], true);
    }

    public function getRoleLabelAttribute(): string
    {
        if ($this->isAdmin()) {
            return 'Admin';
        }

        return config("staff.roles.{$this->role}.label", ucfirst(str_replace('_', ' ', $this->role ?? '')));
    }
}
