<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupModules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_modules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('module_type')->nullable();
            $table->integer('module_specific_id')->nullable();
            $table->index('module_specific_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('user_instance_id');
            $table->unsignedBigInteger('folder_id');
            $table->integer('visibility')->nullable()->default(1);
            $table->index('visibility');
            
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_instance_id')->references('id')->on('user_instances')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('folder_id')->references('id')->on('folders')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('group_modules');
    }
}
