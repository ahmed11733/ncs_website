<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('page_sections', function (Blueprint $table) {
            $table->dropColumn(['label', 'title', 'sub_title', 'content']);
        });

        Schema::table('page_sections', function (Blueprint $table) {
            $table->json('label')->nullable()->after('page_id');
            $table->json('title')->after('label');
            $table->json('sub_title')->nullable()->after('title');
            $table->json('content')->after('sub_title');
        });
    }

    public function down(): void
    {
        Schema::table('page_sections', function (Blueprint $table) {
            $table->dropColumn(['label', 'title', 'sub_title', 'content']);
        });

        Schema::table('page_sections', function (Blueprint $table) {
            $table->string('label')->nullable()->after('page_id');
            $table->string('title')->after('label');
            $table->string('sub_title')->nullable()->after('title');
            $table->text('content')->after('sub_title');
        });
    }
};
