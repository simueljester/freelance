<?php

namespace App\Http\Controllers;

use Auth;
use App\Group;
use App\GroupModule;
use App\LearningMaterial;
use Illuminate\Http\Request;
use App\Helpers\UploadHelper;
use App\Http\Repositories\BaseRepository;
use App\Http\Repositories\GroupModuleRepository;
use App\Http\Repositories\LearningMaterialRepository;
use App\Http\Repositories\LearningMaterialAssignmentRepository;

class LearningMaterialController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function create(Group $group,$folder){
        return view('groups.create-modules.learning-material',compact('group','folder'));
    }

    public function save(Request $request){
   
        $request->validate([
            'name' => 'required',
            'group' => 'required',
            'attachment' => 'required'
        ]);

        //create group module
        $group_module_data = [
            'module_type'           => 'learning_material',
            'module_specific_id'    => null,
            'group_id'              => $request->group,
            'user_id'               => Auth::user()->id,
            'user_instance_id'      => Auth::user()->user_instance->id,
            'folder_id'             => $request->folder_id,
            'visibility'            => $request->visibility ? 1 : 0
        ];

        $saved_group_module = app(GroupModuleRepository::class)->save($group_module_data);

        $attachment = $request->attachment ? UploadHelper::uploadLearningMaterial($request->attachment) : null;

        //create exam based in created group module
        $data = [
            'name'              => $request->name,
            'description'       => $request->description,
            'file'              => $attachment,
            'group_id'          => $request->group,
            'group_module_id'   => $saved_group_module->id,
            'creator'           => Auth::user()->id,
            'user_instance_id'  => Auth::user()->user_instance->id
        ];

        //assign learning material to users
        $learning_material_data = app(LearningMaterialRepository::class)->save($data);
        app(LearningMaterialAssignmentRepository::class)->assignLearningMaterialToUsers($learning_material_data,$request->group);

        //update group module specific id
        $saved_group_module->module_specific_id = $learning_material_data->id;
        $saved_group_module->save();

        //specify folder return
        if($request->folder_id == 0){
            return redirect()->route('groups.show',$learning_material_data->group)->with('success', 'Learning material successfully created');
        }else{
            return redirect()->route('groups.show-folder',$request->folder_id)->with('success', 'Learning material successfully created');
        }
        
    }

    public function show(LearningMaterial $learning_material){
     
        $learning_material = $learning_material->load('group');
  
        $learning_material_assignments = app(LearningMaterialAssignmentRepository::class)->query()->with('learning_material','user','group')->whereLearningMaterialId($learning_material->id)->whereGroupId($learning_material->group_id)->get();
 
        return view('groups.show-modules.learning-material',compact('learning_material','learning_material_assignments'));

    }

    public function edit(LearningMaterial $learning_material){

        return view('groups.edit-modules.learning-material',compact('learning_material'));

    }

    public function update(Request $request){
 
        $request->validate([
            'name' => 'required',
            'group' => 'required',
            'attachment' => 'required_without:old_attachment'
        ]);

        $attachment = $request->attachment ? UploadHelper::uploadLearningMaterial($request->attachment) : ($request->old_attachment ?? null);

        $data = [
            'name'              => $request->name,
            'description'       => $request->description,
            'file'              => $attachment,
            'group_id'          => $request->group,
            'creator'           => Auth::user()->id,
            'user_instance_id'  => Auth::user()->user_instance->id,
        ];

        $learning_material_data = app(LearningMaterialRepository::class)->update($request->learning_material_id,$data);

        $group_module_data = [
            'visibility'  => $request->visibility ? 1 : 0
        ];
        $saved_group_module = app(GroupModuleRepository::class)->update($learning_material_data->group_module_id,$group_module_data);

        app(LearningMaterialAssignmentRepository::class)->assignLearningMaterialToUsers($learning_material_data,$request->group);

        return redirect()->route('groups.learning-material.show',$learning_material_data)->with('success', 'Learning Material successfully updated');

    }

    public function delete(LearningMaterial $learning_material){

        app(BaseRepository::class)->saveLog($learning_material,'delete');
        $group_id = $learning_material->group_id;
        $group_modules_delete = GroupModule::whereModuleType('learning_material')->whereModuleSpecificId($learning_material->id)->first();
        $group_modules_delete->delete();

        return redirect()->route('groups.show',$group_id)->with('success', 'Learning Material successfully deleted');
    }


}
