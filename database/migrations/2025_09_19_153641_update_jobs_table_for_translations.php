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
        Schema::table('jobs', function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('job_description')->nullable()->change();
            $table->json('skills')->nullable()->change();
            $table->json('nationality')->nullable()->change();
            $table->json('certificate')->nullable()->change();
            $table->json('specialization')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->string('title')->change();
            $table->text('job_description')->nullable()->change();
            $table->text('skills')->nullable()->change();
            $table->string('nationality')->nullable()->change();
            $table->string('certificate')->nullable()->change();
            $table->string('specialization')->nullable()->change();
        });
    }
};
