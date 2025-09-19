<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Since the table is empty, we can simply:
        // 1. Drop the existing name column
        // 2. Add a new JSON name column

        Schema::table('job_departments', function (Blueprint $table) {
            $table->dropColumn('name');
        });

        Schema::table('job_departments', function (Blueprint $table) {
            $table->json('name')->after('id');
        });
    }

    public function down()
    {
        // For rollback, we'll convert back to string
        Schema::table('job_departments', function (Blueprint $table) {
            $table->dropColumn('name');
        });

        Schema::table('job_departments', function (Blueprint $table) {
            $table->string('name')->after('id');
        });
    }
};
