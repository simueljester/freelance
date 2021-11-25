<?php
namespace App\Http\Repositories;



use App\GroupModule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class GroupModuleRepository extends BaseRepository 
{
    function __construct(GroupModule $model)
    {
        $this->model = $model;
    }

}