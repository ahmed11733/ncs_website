<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('demo_requests', function (Blueprint $table) {
            // Make purpose_of_demo nullable
            $table->string('purpose_of_demo', 500)->nullable()->change();

            // New date/time columns
            $table->date('date')->nullable()->after('product_name');
            $table->time('time')->nullable()->after('date');

            // Customer support fields
            $table->text('issue_description')->nullable()->after('time');
            $table->text('availability_hours')->nullable()->after('issue_description');
            $table->string('type')->nullable()->after('message');
            $table->string('attachment')->nullable()->after('type');
        });
    }

    public function down(): void
    {
        Schema::table('demo_requests', function (Blueprint $table) {
            // Revert purpose_of_demo to not nullable
            $table->string('purpose_of_demo', 500)->nullable(false)->change();

            // Drop newly added columns
            $table->dropColumn([
                'date',
                'time',
                'issue_description',
                'availability_hours',
                'type',
                'attachment',
            ]);
        });
    }
};
