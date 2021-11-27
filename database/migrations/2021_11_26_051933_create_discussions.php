<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscussions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussions', function (Blueprint $table) {
  
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->float('total_score')->nullable()->default(0);
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('group_module_id');
            $table->unsignedBigInteger('creator');
            $table->unsignedBigInteger('user_instance_id');
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('creator')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('discussions');
    }
}
