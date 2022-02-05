<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToThreeTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('discussions', function (Blueprint $table) {
            //
            $table->timestamp('accessible_at')->nullable();
            $table->timestamp('expired_at')->nullable();
        });

        Schema::table('links', function (Blueprint $table) {
            //
            $table->timestamp('accessible_at')->nullable();
            $table->timestamp('expired_at')->nullable();
        });

        Schema::table('learning_materials', function (Blueprint $table) {
            //
            $table->timestamp('accessible_at')->nullable();
            $table->timestamp('expired_at')->nullable();
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('discussions', function (Blueprint $table) {
            //
            $table->dropColumn('accessible_at');
            $table->dropColumn('expired_at');
        });

        Schema::table('links', function (Blueprint $table) {
            //
            $table->dropColumn('accessible_at');
            $table->dropColumn('expired_at');
        });

        Schema::table('learning_materials', function (Blueprint $table) {
            //
            $table->dropColumn('accessible_at');
            $table->dropColumn('expired_at');
        });
    }
}
