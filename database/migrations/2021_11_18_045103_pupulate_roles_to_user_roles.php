<?php

use App\UserRoles;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PupulateRolesToUserRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_roles', function (Blueprint $table) {
            //

            $user_roles = ['Administrator','Teacher','User'];

            foreach($user_roles as $role){
                $roles = new UserRoles;
                $roles->role = $role;
                $roles->save();
            }
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_roles', function (Blueprint $table) {
            //
        });
    }
}
