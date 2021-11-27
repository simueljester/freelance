<?php
namespace App\Http\Repositories;


use App\Group;
use App\Discussion;
use App\DiscussionAssignment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DiscussionAssignmentRepository extends BaseRepository 
{
    function __construct(DiscussionAssignment $model)
    {
        $this->model = $model;
    }

    public function assignDiscussionToUsers($discussion_data, $group_id){

        $group = Group::with('members')->find($group_id);

        foreach($group->members as $member){
            DiscussionAssignment::firstOrCreate(
                [
                    'discussion_id'         => $discussion_data->id,
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


    public function saveScores($request){
        $score_arr = $request->score;
        foreach($score_arr as $assignment_id => $score){
            DiscussionAssignment::find($assignment_id)->update(["score" => $score]);
        }
    }
}