<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('term')->nullable();
            $table->float('long_quiz_input')->nullable();
            $table->float('long_quiz_score')->nullable();
            $table->float('long_quiz_percentage')->nullable();
            $table->float('long_quiz_final')->nullable();

            $table->float('short_quiz_input')->nullable();
            $table->float('short_quiz_score')->nullable();
            $table->float('short_quiz_percentage')->nullable();
            $table->float('short_quiz_final')->nullable();

            $table->float('assessment_task_input')->nullable();
            $table->float('assessment_task_score')->nullable();
            $table->float('assessment_task_percentage')->nullable();
            $table->float('assessment_task_final')->nullable();

            $table->float('major_examination_input')->nullable();
            $table->float('major_examination_score')->nullable();
            $table->float('major_examination_percentage')->nullable();
            $table->float('major_examination_final')->nullable();

            $table->float('final_grade')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('user_instance_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('group_assignment_id');
            $table->unsignedBigInteger('creator');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_instance_id')->references('id')->on('user_instances')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('group_assignment_id')->references('id')->on('group_assignments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('creator')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('grades');
    }
}
