<?php

namespace App\Http\Controllers;

use App\Group;

use Illuminate\Http\Request;
use App\Http\Repositories\GroupAssignmentRepository;

class ClassGradesController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Group $group){

    
        $assigned_users = app(GroupAssignmentRepository::class)->query()->with('group.subject','user.user_instance')->whereGroupId($group->id)->get();
        return view('groups.class-grades.index',compact('group','assigned_users'));
    }
}
