<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->json('permissions')->nullable()->after('role');
        });

        DB::table('users')->where('role', 'employee')->update(['role' => 'emp']);
    }

    public function down(): void
    {
        DB::table('users')->where('role', 'emp')->update(['role' => 'employee']);

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('permissions');
        });
    }
};
