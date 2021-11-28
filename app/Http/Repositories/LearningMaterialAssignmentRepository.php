<?php
namespace App\Http\Repositories;


use App\Group;
use App\LearningMaterial;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\LearningMaterialAssignment;

class LearningMaterialAssignmentRepository extends BaseRepository 
{
    function __construct(LearningMaterialAssignment $model)
    {
        $this->model = $model;
    }

    public function assignLearningMaterialToUsers($learning_material_data, $group_id){

        $group = Group::with('members')->find($group_id);

        foreach($group->members as $member){
            LearningMaterialAssignment::firstOrCreate(
                [
                    'learning_material_id'  => $learning_material_data->id,
                    'user_id'               => $member->user_id,
                    'group_id'              => $group->id,
                    'group_assignment_id'   => $member->id
                ],
                [
                    'score'         => 0,
                    'status'        => 0
                ]
            );
        }   

    }



}