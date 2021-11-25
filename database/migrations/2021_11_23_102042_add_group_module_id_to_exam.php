<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGroupModuleIdToExam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('group_module_id')->after('creator');
            $table->unsignedBigInteger('user_instance_id');
            
            $table->foreign('group_module_id')->references('id')->on('group_modules')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_instance_id')->references('id')->on('user_instances')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exam', function (Blueprint $table) {
            //
            $table->dropColumn(['group_module_id']);
            $table->dropColumn(['user_instance_id']);
        });
    }
}
