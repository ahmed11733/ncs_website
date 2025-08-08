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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();

            // Foreign key to jobs table
            $table->unsignedBigInteger('job_id');
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');

            // Personal information
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('national_id_number');

            // Professional information
            $table->string('job_title')->nullable();
            $table->string('department')->nullable();
            $table->string('highest_degree_achieved');
            $table->string('institution_name');
            $table->integer('graduation_year');
            $table->integer('years_of_experience');

            // Employment history
            $table->string('previous_employer_name')->nullable();
            $table->string('employment_date_start_end')->nullable();

            // Application details
            $table->string('desired_salary')->nullable();
            $table->date('date_available_to_start');
            $table->text('why_join_us');
            $table->text('additional_comments')->nullable();

            // References
            $table->text('reference_contact_information')->nullable();
            $table->string('linkedin_profile')->nullable();

            // Files
            $table->string('resume_path');
            $table->string('cv_path');

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
        Schema::dropIfExists('job_applications');
    }
};
