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
        Schema::create('sheet_lists', function (Blueprint $table) {
            $table->id();
            $table->string('file'); // ফাইলের নাম
            $table->date('sheet_working_date'); // শিট কাজের তারিখ
            $table->string('sheet_name'); // শিটের নাম
            $table->unsignedBigInteger('client_id'); // ক্লায়েন্ট আইডি
            $table->timestamps(); // created_at এবং updated_at টাইমস্ট্যাম্প

            // ফরেন কী রেফারেন্স
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sheet_lists');
    }
};
