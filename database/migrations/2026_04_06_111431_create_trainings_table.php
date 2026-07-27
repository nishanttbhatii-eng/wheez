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
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->string('training_type');
            $table->string('custom_text')->nullable();
            $table->json('employee_ids'); // Store multiple employee IDs
            $table->string('document_path')->nullable();
            $table->text('notes');
            $table->date('due_date');
            $table->date('expiry_date')->nullable();
            $table->boolean('results_required')->default(true);
            $table->boolean('learning_outcome_required')->default(true);
            $table->boolean('learning_outcome_doc_required')->default(true);
            $table->enum('status', ['pending', 'completed', 'overdue'])->default('pending');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
