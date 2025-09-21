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
        Schema::table('pages', function (Blueprint $table) {
            // Drop old string columns
            $table->dropColumn(['name', 'title', 'subtitle']);
        });

        Schema::table('pages', function (Blueprint $table) {
            // Add JSON columns for translations
            $table->json('name')->nullable()->after('page_category_id');
            $table->json('title')->nullable()->after('hero_image');
            $table->json('subtitle')->nullable()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['name', 'title', 'subtitle']);
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->string('name')->after('page_category_id');
            $table->string('title')->after('hero_image');
            $table->string('subtitle')->nullable()->after('title');
        });
    }
};
