<?php
namespace App\Http\Repositories;


use App\User;
use App\GroupAssignment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class GroupAssignmentRepository extends BaseRepository 
{
    function __construct(GroupAssignment $model)
    {
        $this->model = $model;
    }

    public function assignUsers($request){
        $user_data = [];
        foreach($request->user_id as $user_id){
            $user_data = User::with('user_instance')->find($user_id);

            $group_assignment = GroupAssignment::updateOrCreate(
                [
                    'group_id'          => $request->group_id,
                    'user_id'           => $user_data->id,
                    'user_instance_id'  => $user_data->user_instance->id,
                ]
            );
        }
    }
}