<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->json('department')->nullable()->after('manager');
            $table->json('profiles')->nullable()->after('description');
            $table->enum('status', ['active', 'inactive'])->default('active')->after('profiles');
        });
    }

    public function down()
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->dropColumn(['department', 'profiles', 'status']);
        });
    }
};