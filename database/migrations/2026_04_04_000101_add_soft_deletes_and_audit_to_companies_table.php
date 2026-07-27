<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->softDeletes()->after('updated_at');
            $table->foreignId('created_by')->nullable()->constrained('users')->after('deleted_at');
            $table->foreignId('updated_by')->nullable()->constrained('users')->after('created_by');
        });
    }

    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropColumn(['deleted_at', 'created_by', 'updated_by']);
        });
    }
};