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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('task_code', 20);
            $table->string('task_name', 255);
            $table->text('task_description')->nullable();
            $table->decimal('work_time', 4, 2)->nullable();
            $table->foreignId('company_profile_id')->constrained('company_profiles')->onDelete('cascade');
            $table->foreignId('activity_type_id')->constrained('activity_types')->onDelete('cascade');
            $table->foreignId('task_status_id')->constrained('task_statuses')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
