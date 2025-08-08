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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained('job_departments')->onDelete('cascade');
            $table->string('title');
            $table->integer('experience_years')->nullable();
            $table->date('last_date')->nullable();
            $table->text('job_description')->nullable();
            $table->text('skills')->nullable();
            $table->string('nationality')->nullable();
            $table->string('certificate')->nullable();
            $table->integer('age')->nullable();
            $table->string('specialization')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
