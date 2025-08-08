<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_departments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g., Engineering, Marketing
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_departments');
    }
};
