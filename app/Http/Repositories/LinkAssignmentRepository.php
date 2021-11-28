<?php
namespace App\Http\Repositories;


use App\Group;
use App\LinkAssignment;;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class LinkAssignmentRepository extends BaseRepository 
{
    function __construct(LinkAssignment $model)
    {
        $this->model = $model;
    }

    public function assignLinkToUsers($link_data, $group_id){

        $group = Group::with('members')->find($group_id);

        foreach($group->members as $member){
            LinkAssignment::firstOrCreate(
                [
                    'link_id'               => $link_data->id,
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