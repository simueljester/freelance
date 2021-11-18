<?php
namespace App\Http\Repositories;


use App\UserInstance;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UserInstanceRepository extends BaseRepository 
{
    function __construct(UserInstance $model)
    {
        $this->model = $model;
    }
}