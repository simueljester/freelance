<?php
namespace App\Http\Repositories;

use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository 
{
    function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getUserWithInstance(){

        $users = User::with('user_instance.role')->get();
        return $users;
    }
}