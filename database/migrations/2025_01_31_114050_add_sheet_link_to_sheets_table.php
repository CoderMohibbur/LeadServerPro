<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSheetLinkToSheetsTable extends Migration
{
    public function up()
    {
        Schema::table('sheets', function (Blueprint $table) {
            $table->string('sheet_link')->nullable()->after('sheet_name');
        });
    }

    public function down()
    {
        Schema::table('sheets', function (Blueprint $table) {
            $table->dropColumn('sheet_link');
        });
    }
}
