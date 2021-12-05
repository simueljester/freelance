<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserInstanceIdToAllModules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('discussion_assignments', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('user_instance_id')->after('group_assignment_id');
            $table->foreign('user_instance_id')->references('id')->on('user_instances')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('exam_assignments', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('user_instance_id')->after('group_assignment_id');
            $table->foreign('user_instance_id')->references('id')->on('user_instances')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('learning_material_assignments', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('user_instance_id')->after('group_assignment_id');
            $table->foreign('user_instance_id')->references('id')->on('user_instances')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('link_assignments', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('user_instance_id')->after('group_assignment_id');
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
        Schema::table('discussion_assignments', function (Blueprint $table) {
            //
            $table->dropColumn('user_instance_id');
        });

        Schema::table('exam_assignments', function (Blueprint $table) {
            //
            $table->dropColumn('user_instance_id');
        });

        Schema::table('learning_material_assignments', function (Blueprint $table) {
            //
            $table->dropColumn('user_instance_id');
        });

        Schema::table('link_assignments', function (Blueprint $table) {
            //
            $table->dropColumn('user_instance_id');
        });
    }
}
