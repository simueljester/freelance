<?php

namespace App\Http\Controllers;

use Auth;
use App\Link;
use App\Group;
use App\GroupModule;
use Illuminate\Http\Request;
use App\Http\Repositories\BaseRepository;
use App\Http\Repositories\LinkRepository;
use App\Http\Repositories\GroupModuleRepository;
use App\Http\Repositories\LinkAssignmentRepository;
use Carbon\Carbon;


class LinkController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function create(Group $group,$folder){
        return view('groups.create-modules.link',compact('group','folder'));
    }

    public function save(Request $request){
   
        $request->validate([
            'name' => 'required',
            'group' => 'required',
            'link' => 'required',
            'accessible_date' => 'required',
            'accessible_time' => 'required',
            'expiration_date' => 'required',
            'expiration_time' => 'required'
        ]);

        //create group module
        $group_module_data = [
            'module_type'           => 'link',
            'module_specific_id'    => null,
            'group_id'              => $request->group,
            'user_id'               => Auth::user()->id,
            'user_instance_id'      => Auth::user()->user_instance->id,
            'folder_id'             => $request->folder_id,
            'visibility'            => $request->visibility ? 1 : 0
        ];

        $saved_group_module = app(GroupModuleRepository::class)->save($group_module_data);

        $accessible_at = Carbon::parse($request->accessible_date.''.$request->accessible_time)->format('Y-m-d H:i:s');
        $expired_at = Carbon::parse($request->expiration_date.''.$request->expiration_time)->format('Y-m-d H:i:s');
        //create exam based in created group module
        $data = [
            'name'              => $request->name,
            'description'       => $request->description,
            'link'              => $request->link,
            'group_id'          => $request->group,
            'group_module_id'   => $saved_group_module->id,
            'creator'           => Auth::user()->id,
            'user_instance_id'  => Auth::user()->user_instance->id,
            'accessible_at'     => $accessible_at,
            'expired_at'        => $expired_at
        ];

        //assign link to users
        $link_data = app(LinkRepository::class)->save($data);
        app(LinkAssignmentRepository::class)->assignLinkToUsers($link_data,$request->group);

        //update group module specific id
        $saved_group_module->module_specific_id = $link_data->id;
        $saved_group_module->save();

        //specify folder return
        if($request->folder_id == 0){
            return redirect()->route('groups.show',$link_data->group)->with('success', 'Link successfully created');
        }else{
            return redirect()->route('groups.show-folder',$request->folder_id)->with('success', 'Link successfully created');
        }
        
    }

    public function show(Link $link){
     
        $link = $link->load('group');
  
        $link_assignments = app(LinkAssignmentRepository::class)->query()->with('link','user','group')->whereLinkId($link->id)->whereGroupId($link->group_id)->get();
 
        return view('groups.show-modules.link',compact('link','link_assignments'));

    }

    public function edit(Link $link){

        return view('groups.edit-modules.link',compact('link'));

    }

    public function update(Request $request){
 
        $request->validate([
            'name' => 'required',
            'group' => 'required',
            'link' => 'required',
            'accessible_date' => 'required',
            'accessible_time' => 'required',
            'expiration_date' => 'required',
            'expiration_time' => 'required'
        ]);
        $accessible_at = Carbon::parse($request->accessible_date.''.$request->accessible_time)->format('Y-m-d H:i:s');
        $expired_at = Carbon::parse($request->expiration_date.''.$request->expiration_time)->format('Y-m-d H:i:s');
        $data = [
            'name'              => $request->name,
            'description'       => $request->description,
            'link'              => $request->link,
            'group_id'          => $request->group,
            'creator'           => Auth::user()->id,
            'user_instance_id'  => Auth::user()->user_instance->id,
            'accessible_at'     => $accessible_at,
            'expired_at'        => $expired_at
        ];

        $link_data = app(LinkRepository::class)->update($request->link_id,$data);

        $group_module_data = [
            'visibility'  => $request->visibility ? 1 : 0
        ];
        $saved_group_module = app(GroupModuleRepository::class)->update($link_data->group_module_id,$group_module_data);

        app(LinkAssignmentRepository::class)->assignLinkToUsers($link_data,$request->group);

        return redirect()->route('groups.link.show',$link_data)->with('success', 'Link successfully updated');

    }

    public function delete(Link $link){

        app(BaseRepository::class)->saveLog($link,'delete');
        $group_id = $link->group_id;
        $group_modules_delete = GroupModule::whereModuleType('link')->whereModuleSpecificId($link->id)->first();
        $group_modules_delete->delete();

        return redirect()->route('groups.show',$group_id)->with('success', 'Link successfully deleted');
    }


}
