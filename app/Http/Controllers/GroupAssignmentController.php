<?php

namespace App\Http\Controllers;

use App\User;
use App\Group;
use App\GroupAssignment;
use Illuminate\Http\Request;
use App\Http\Repositories\GroupAssignmentRepository;

class GroupAssignmentController extends Controller
{
    //

    public function __construct(){

        $this->middleware('auth');
    }

    public function index(Group $group){

        $assigned_users = app(GroupAssignmentRepository::class)->query()->with('group','user.user_instance')->whereGroupId($group->id)->get();
  
        return view('groups.group-assignments.index',compact('group','assigned_users'));

    }

    public function assignment(Group $group){
        
        $all_users = User::has('user_instance')->with('user_instance.section')->get();
        $assigned_users = app(GroupAssignmentRepository::class)->query()->whereGroupId($group->id)->pluck('user_id')->toArray();
 
        return view('groups.group-assignments.assign',compact('group','all_users','assigned_users'));

    }

    public function assignUsers(Request $request){
        // return $request;
        if($request->user_id != null){
            $data = app(GroupAssignmentRepository::class)->assignUsers($request);
            return redirect()->back()->with('success', 'Users successfully assigned to Group');
        }else{
            return back()->with('error','Must select user');
        }
      
        // return redirect()->route('groups.show',$request->group_id)->with('success', 'Users successfully assigned to Group');
   
    }

    public function unassignUsers(Request $request){
        if($request->user_id){

            foreach($request->user_id as $user_id){
                $assignment = GroupAssignment::whereGroupId($request->group_id)->whereUserId($user_id);
                $assignment->delete();
            }
    
            return redirect()->route('groups.show',$request->group_id)->with('success', 'Users successfully unassigned to Group');

        }else{
            return redirect()->route('groups.show',$request->group_id)->with('error', 'Must select user to unassign');
        }
        
    }
}
