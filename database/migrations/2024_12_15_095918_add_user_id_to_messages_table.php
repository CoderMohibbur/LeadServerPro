<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToMessagesTable extends Migration
{
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('ticket_id'); // Adjust the position as needed
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Optional: Foreign key constraint
        });
    }

    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Optional: Drop foreign key first
            $table->dropColumn('user_id');
        });
    }
}

