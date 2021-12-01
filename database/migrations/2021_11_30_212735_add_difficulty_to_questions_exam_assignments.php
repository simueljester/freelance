<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDifficultyToQuestionsExamAssignments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('question_exam_assignments', function (Blueprint $table) {
            //
            $table->integer('level')->nullable()->default(2);
            $table->index('level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('question_exam_assignments', function (Blueprint $table) {
            //
            $table->dropColumn('level');
        });
    }
}
