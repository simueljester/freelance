<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Repositories\GroupRepository;

class GroupController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        
        $groups = app(GroupRepository::class)->query()->whereCreatorId(Auth::user()->id)->get();
      
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

    

    

}
