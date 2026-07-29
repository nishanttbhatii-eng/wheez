<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('users', 'permissions') && ! Schema::hasColumn('users', 'staff_permissions')) {
            Schema::table('users', function (Blueprint $table) {
                $table->renameColumn('permissions', 'staff_permissions');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('users', 'staff_permissions') && ! Schema::hasColumn('users', 'permissions')) {
            Schema::table('users', function (Blueprint $table) {
                $table->renameColumn('staff_permissions', 'permissions');
            });
        }
    }
};
