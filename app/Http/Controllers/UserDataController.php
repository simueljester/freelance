<?php

namespace App\Http\Controllers;

use App\User;
use App\Group;
use App\SystemLog;
use App\UserActivity;
use App\GroupAssignment;
use Illuminate\Http\Request;
use App\Http\Repositories\ExamAssignmentRepository;
use App\Http\Repositories\DiscussionAssignmentRepository;

class UserDataController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(GroupAssignment $group_assignment){
        $group_assignment = $group_assignment->load('group','user');
        $exam_assignments = app(ExamAssignmentRepository::class)->query()->with('exam')->whereGroupAssignmentId($group_assignment->id)->get();
        $discussion_assignments = app(DiscussionAssignmentRepository::class)->query()->with('discussion')->whereGroupAssignmentId($group_assignment->id)->get();
      
        return view('groups.show-user-data',compact('group_assignment','exam_assignments','discussion_assignments'));
    }

    public function getActivities(Request $request){
        
        $logs = UserActivity::whereUserId($request->user_id)->whereGroupId($request->group_id)->orderBy('created_at','DESC')->limit(100)->get();
        
        return response()->json([
            'logs' => $logs
        ]);
    }

}
