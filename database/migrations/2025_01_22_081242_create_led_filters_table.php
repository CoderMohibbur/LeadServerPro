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
        Schema::create('led_filters', function (Blueprint $table) {
            $table->id();
            $table->string('linkedin_link', 512)->nullable()->unique();
            $table->string('company_name')->nullable()->unique();
            $table->string('contact_name')->nullable()->unique();
            $table->string('name_prefix')->nullable()->unique();
            $table->string('full_name')->nullable()->unique();
            $table->string('first_name')->nullable()->unique();
            $table->string('last_name')->nullable()->unique();
            $table->string('email', 320)->nullable()->unique();
            $table->string('title_position')->nullable()->unique();
            $table->string('person_location')->nullable()->unique();
            $table->text('full_address')->nullable()->unique();
            $table->string('company_phone')->nullable()->unique();
            $table->string('company_head_count')->nullable()->unique();
            $table->string('country')->nullable()->unique();
            $table->string('city')->nullable()->unique();
            $table->string('state')->nullable()->unique();
            $table->string('tag')->nullable()->unique();
            $table->string('source_link')->nullable()->unique();
            $table->string('middle_name')->nullable()->unique();
            $table->string('sur_name')->nullable()->unique();
            $table->string('gender')->nullable()->unique();
            $table->string('personal_phone')->nullable()->unique();
            $table->string('employee_range')->nullable()->unique();
            $table->string('company_website', 512)->nullable()->unique();
            $table->string('company_linkedin_link', 512)->nullable()->unique();
            $table->string('company_hq_address')->nullable()->unique();
            $table->string('industry')->nullable()->unique();
            $table->string('revenue')->nullable()->unique();
            $table->string('street')->nullable()->unique();
            $table->string('zip_code')->nullable()->unique();
            $table->string('rating')->nullable()->default('unrated')->unique();
            $table->string('sheet_name')->nullable()->unique();
            $table->string('job_link', 512)->nullable()->unique();
            $table->string('job_role')->nullable()->unique();
            $table->string('checked_by')->nullable()->unique();
            $table->text('review')->nullable()->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('led_filters');
    }
};
