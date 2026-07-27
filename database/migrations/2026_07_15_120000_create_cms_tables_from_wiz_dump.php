<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('state_id');
            $table->timestamps();
            $table->softDeletes();
            $table->index('state_id');
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('slug')->nullable()->index();
            $table->smallInteger('sub_page_no')->nullable();
            $table->integer('parent_id')->nullable()->default(0)->index();
            $table->longText('description')->nullable();
            $table->longText('short_description')->nullable();
            $table->integer('user_id')->nullable();
            $table->smallInteger('status')->default(1)->index();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->longText('meta_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0);
            $table->integer('category_id')->nullable()->index();
            $table->integer('subcategory_id')->nullable()->index();
            $table->string('name')->nullable();
            $table->text('slug')->nullable();
            $table->double('price')->default(0);
            $table->double('mrp_price')->default(0);
            $table->smallInteger('service_type')->default(1);
            $table->longText('small_description')->nullable();
            $table->longText('description')->nullable();
            $table->text('free_consultation_desc')->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('talk_to_expert_description')->nullable();
            $table->string('caller_name')->nullable();
            $table->string('caller_description')->nullable();
            $table->longText('testmonial_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->longText('too_long_description')->nullable();
            $table->longText('advisory_services')->nullable();
            $table->longText('get_started')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->longText('meta_description')->nullable();
            $table->tinyInteger('status')->default(1)->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('enquiries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('mobile');
            $table->string('email');
            $table->integer('state_id')->nullable()->index();
            $table->string('service_slug', 500)->nullable();
            $table->string('subject')->nullable();
            $table->longText('description')->nullable();
            $table->tinyInteger('status')->default(1)->index();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('basic_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->index();
            $table->longText('value')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('basic_settings');
        Schema::dropIfExists('enquiries');
        Schema::dropIfExists('services');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('states');
    }
};
