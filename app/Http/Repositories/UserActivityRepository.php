<?php
namespace App\Http\Repositories;


use App\UserActivity;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UserActivityRepository extends BaseRepository 
{
    function __construct(UserActivity $model)
    {
        $this->model = $model;
    }
}