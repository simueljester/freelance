<?php
namespace App\Http\Repositories;


use App\Department;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DepartmentRepository extends BaseRepository 
{
    function __construct(Department $model)
    {
        $this->model = $model;
    }
}