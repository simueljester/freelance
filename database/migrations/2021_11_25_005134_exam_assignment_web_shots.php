<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExamAssignmentWebShots extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('exam_assignment_web_shots', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->text('filename');
            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('exam_assignment_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('user_instance_id');
    
            $table->foreign('exam_id')->references('id')->on('exam')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('exam_assignment_id')->references('id')->on('exam_assignments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_instance_id')->references('id')->on('user_instances')->onDelete('cascade')->onUpdate('cascade');
    
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('exam_assignment_web_shots');
    }
}
