<?php

// 2024_12_14_000000_add_parent_message_id_to_messages_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentMessageIdToMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            // Add parent_message_id column to messages table
            $table->foreignId('parent_message_id')->nullable()->constrained('messages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            // Drop parent_message_id column
            $table->dropForeign(['parent_message_id']);
            $table->dropColumn('parent_message_id');
        });
    }
}
