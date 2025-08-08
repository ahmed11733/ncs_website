<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('job_title')->nullable();
            $table->string('country_code', 10);
            $table->string('phone_number');
            $table->string('email');
            $table->string('company_name')->nullable();
            $table->string('country_region')->nullable();
            $table->unsignedInteger('number_of_attendees')->default(1);
            $table->string('event_name');
            $table->string('preferred_session')->nullable();
            $table->boolean('receive_event_reminder')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};
