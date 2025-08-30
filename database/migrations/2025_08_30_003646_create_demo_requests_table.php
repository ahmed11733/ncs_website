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
        Schema::create('demo_requests', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('job_title');
            $table->string('email');
            $table->string('phone');
            $table->string('country_region');

            // Company Information
            $table->string('company_name');
            $table->string('industry');
            $table->string('number_of_employees');

            // Product Information
            $table->string('product_name');
            $table->text('purpose_of_demo');
            $table->text('message')->nullable();

            // Preferences
            $table->boolean('subscribe_to_updates')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demo_requests');
    }
};
