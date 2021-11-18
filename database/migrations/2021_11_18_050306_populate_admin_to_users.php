<?php

use App\User;
use App\UserInstance;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulateAdminToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $admin = UserInstance::whereRoleId(1)->first() ?? null;
        if($admin == null){
            $user = new User;
            $user->name = 'Administrator';
            $user->email = 'admin@gmail.com';
            $user->password = Hash::make('admin1234');
            $user->save();

            $user_instance = new UserInstance;
            $user_instance->user_id = $user->id;
            $user_instance->role_id = 1;
            $user_instance->active = 1;
            $user_instance->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
