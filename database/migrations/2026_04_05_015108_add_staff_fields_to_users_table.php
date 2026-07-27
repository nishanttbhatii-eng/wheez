<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('title')->nullable()->after('name');
            $table->string('first_name')->nullable()->after('title');
            $table->string('middle_name')->nullable()->after('first_name');
            $table->string('last_name')->nullable()->after('middle_name');
            $table->string('employee_code')->unique()->nullable()->after('last_name');
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('employee_code');
            $table->date('date_of_birth')->nullable()->after('gender');
            $table->string('emergency_contact_name')->nullable()->after('date_of_birth');
            $table->string('emergency_contact_email')->nullable()->after('emergency_contact_name');
            $table->string('emergency_contact_number')->nullable()->after('emergency_contact_email');
            $table->date('joining_date')->nullable()->after('emergency_contact_number');
            $table->string('user_type')->nullable()->after('joining_date');
            $table->foreignId('company_id')->nullable()->constrained()->onDelete('set null')->after('user_type');
            $table->foreignId('branch_id')->nullable()->constrained()->onDelete('set null')->after('company_id');
            $table->json('working_days')->nullable()->after('branch_id'); // Store weekly schedule
            $table->text('notes')->nullable()->after('working_days');
            $table->boolean('can_approve_leave')->default(false)->after('notes');
            $table->integer('general_leave_allowance')->default(20)->after('can_approve_leave');
            $table->integer('sick_leave_allowance')->default(5)->after('general_leave_allowance');
            $table->foreignId('leave_approver_stage1')->nullable()->constrained('users')->onDelete('set null')->after('sick_leave_allowance');
            $table->foreignId('leave_approver_stage2')->nullable()->constrained('users')->onDelete('set null')->after('leave_approver_stage1');
            $table->boolean('future_leave_allowance')->default(true)->after('leave_approver_stage2');
            $table->boolean('exempt_forced_leave')->default(false)->after('future_leave_allowance');
            $table->boolean('managed_by_approver')->default(false)->after('exempt_forced_leave');
            $table->boolean('manage_training_panel')->default(false)->after('managed_by_approver');
            $table->enum('status', ['active', 'inactive'])->default('active')->after('manage_training_panel');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropForeign(['branch_id']);
            $table->dropForeign(['leave_approver_stage1']);
            $table->dropForeign(['leave_approver_stage2']);
            $table->dropColumn([
                'title', 'first_name', 'middle_name', 'last_name', 'employee_code',
                'gender', 'date_of_birth', 'emergency_contact_name', 'emergency_contact_email',
                'emergency_contact_number', 'joining_date', 'user_type', 'company_id', 'branch_id',
                'working_days', 'notes', 'can_approve_leave', 'general_leave_allowance',
                'sick_leave_allowance', 'leave_approver_stage1', 'leave_approver_stage2',
                'future_leave_allowance', 'exempt_forced_leave', 'managed_by_approver',
                'manage_training_panel', 'status'
            ]);
        });
    }
};
