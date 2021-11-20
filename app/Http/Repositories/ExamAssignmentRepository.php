<?php
namespace App\Http\Repositories;


use App\Group;
use App\ExamAssignment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ExamAssignmentRepository extends BaseRepository 
{
    function __construct(ExamAssignment $model)
    {
        $this->model = $model;
    }

    public function assignExamToUsers($exam_data, $group_id){

        $group = Group::with('members')->find($group_id);

        foreach($group->members as $member){
            ExamAssignment::firstOrCreate(
                [
                    'exam_id'               => $exam_data->id,
                    'user_id'               => $member->user_id,
                    'group_id'              => $group->id,
                    'group_assignment_id'   => $member->id
                ],
                [
                    'duration'      => null,
                    'score'         => 0,
                    'status'        => 0
                ]
            );
        }

    }
}