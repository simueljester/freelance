<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropFolderIdToGroupModules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('group_modules', function (Blueprint $table) {
            //
            $table->dropForeign(['folder_id']);
            $table->dropColumn('folder_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('group_modules', function (Blueprint $table) {
            //
        });
    }
}
