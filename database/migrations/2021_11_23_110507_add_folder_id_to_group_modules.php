<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFolderIdToGroupModules extends Migration
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
            $table->integer('folder_id')->nullable()->default(0)->after('user_instance_id');
            $table->index('folder_id');
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
