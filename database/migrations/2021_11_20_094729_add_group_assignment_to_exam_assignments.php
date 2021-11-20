<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGroupAssignmentToExamAssignments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_assignments', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('group_assignment_id')->after('group_id');
            $table->foreign('group_assignment_id')->references('id')->on('group_assignments')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exam_assignments', function (Blueprint $table) {
            //
            $table->dropColumn(['group_assignment_id']);
        });
    }
}
