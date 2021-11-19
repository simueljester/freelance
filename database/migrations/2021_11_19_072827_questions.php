<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Questions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->mediumText('instruction')->nullable();
            $table->string('question_type')->nullable();
            $table->text('option_1')->nullable();
            $table->text('option_2')->nullable();
            $table->text('option_3')->nullable();
            $table->text('option_4')->nullable();
            $table->text('option_5')->nullable();
            $table->text('option_6')->nullable();
            $table->text('answer')->nullable();
            $table->float('max_points')->nullable();
            $table->text('attachment')->nullable();
            $table->unsignedBigInteger('creator');
            $table->timestamps();

    
            $table->foreign('creator')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
         
          
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
        Schema::dropIfExists('questions');
    }
}
