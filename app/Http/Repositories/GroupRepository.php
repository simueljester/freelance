<?php
namespace App\Http\Repositories;


use App\Group;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class GroupRepository extends BaseRepository 
{
    function __construct(Group $model)
    {
        $this->model = $model;
    }
}