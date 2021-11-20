<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Repositories\GroupRepository;
use App\Http\Repositories\GroupAssignmentRepository;

class GroupController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        
        $groups = app(GroupRepository::class)->query()->with('user_creator')->whereCreatorId(Auth::user()->id)->get();
      
        return view('groups.index',compact('groups'));

    }

    public function create(){

        return view('groups.create');

    }

    public function save(Request $request){

        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $data = [
            'name'          => $request->name,
            'description'   => $request->description,
            'creator_id'    =>  Auth::user()->id
        ];

        app(GroupRepository::class)->save($data);
    
        return redirect()->route('groups.index')->with('success', 'Group successfully saved');
    }

    public function edit(Group $group){
    
        return view('groups.edit',compact('group'));

    }

    public function update(Request $request){

        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $data = [
            'name'      => $request->name,
            'description'     => $request->description
        ];

        app(GroupRepository::class)->update($request->group_id,$data);
        return redirect()->route('groups.index')->with('success', 'Group successfully updated');

    }

    public function show(Group $group){

        $assigned_users = app(GroupAssignmentRepository::class)->query()->with('group','user.user_instance')->whereGroupId($group->id)->get();
        $created_exam = Exam::whereGroupId($group->id)->get();
       
        return view('groups.show',compact('group','assigned_users','created_exam'));
    }
    

    

}
