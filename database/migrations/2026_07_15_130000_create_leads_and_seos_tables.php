<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('mobile', 10);
            $table->string('email');
            $table->integer('state_id')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('seos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id')->index();
            $table->smallInteger('page_type')->default(0)->index()->comment('0=content page, 1=subcategory, 2=services');
            $table->string('meta_title')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seos');
        Schema::dropIfExists('leads');
    }
};
