<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Remove duplicate training types per company while keeping the first inserted record.
        DB::statement(
            'DELETE t1 FROM training_types t1
             INNER JOIN training_types t2
             WHERE t1.company_id = t2.company_id
               AND t1.name = t2.name
               AND t1.id > t2.id'
        );

        Schema::table('training_types', function (Blueprint $table) {
            $table->unique(['company_id', 'name'], 'training_types_company_name_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('training_types', function (Blueprint $table) {
            $table->dropUnique('training_types_company_name_unique');
        });
    }
};
