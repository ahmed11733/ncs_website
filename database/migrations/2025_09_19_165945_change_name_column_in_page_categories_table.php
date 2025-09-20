<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop the old string column
        Schema::table('page_categories', function (Blueprint $table) {
            $table->dropColumn('name');
        });

        // Add the new JSON column
        Schema::table('page_categories', function (Blueprint $table) {
            $table->json('name')->after('id');
        });
    }

    public function down(): void
    {
        // Rollback: convert back to string
        Schema::table('page_categories', function (Blueprint $table) {
            $table->dropColumn('name');
        });

        Schema::table('page_categories', function (Blueprint $table) {
            $table->string('name')->after('id');
        });
    }
};
