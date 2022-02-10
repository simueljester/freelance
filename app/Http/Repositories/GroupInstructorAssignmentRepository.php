<?php
namespace App\Http\Repositories;


use App\User;
use App\GroupInstructorAssignments;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class GroupInstructorAssignmentRepository extends BaseRepository 
{
    function __construct(GroupInstructorAssignments $model)
    {
        $this->model = $model;
    }

}