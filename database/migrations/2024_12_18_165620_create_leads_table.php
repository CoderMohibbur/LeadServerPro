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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('linkedin_link')->nullable();
            $table->string('company_name')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('name_prefix')->nullable();
            $table->string('full_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('title_position')->nullable();
            $table->string('person_location')->nullable();
            $table->text('full_address')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_head_count')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('tag')->nullable();
            $table->string('source_link')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('sur_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('personal_phone')->nullable();
            $table->string('employee_range')->nullable();
            $table->string('company_website')->nullable();
            $table->string('company_linkedin_link')->nullable();
            $table->string('company_hq_address')->nullable();
            $table->string('industry')->nullable();
            $table->string('revenue')->nullable();
            $table->string('street')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('rating')->nullable();
            $table->string('sheet_id')->nullable();
            $table->string('sheet_name')->nullable();
            $table->string('job_link')->nullable();
            $table->string('job_role')->nullable();
            $table->string('checked_by')->nullable();
            $table->text('review')->nullable();
            $table->unsignedBigInteger('sheets_id')->nullable(); // Added column
            $table->foreign('sheets_id')->references('id')->on('sheets')->onDelete('cascade'); // Added foreign key constraint
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
