<?php

namespace App\Http\Controllers;

use PDF;
use Auth;
use App\Group;
use App\Discussion;
use App\GroupModule;
use Illuminate\Http\Request;
use App\DiscussionAssignment;
use App\Helpers\UploadHelper;
use App\Http\Repositories\DiscussionRepository;
use App\Http\Repositories\GroupModuleRepository;
use App\Http\Repositories\DiscussionPostRepository;
use App\Http\Repositories\DiscussionAssignmentRepository;

class DiscussionController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function create(Group $group,$folder){
        return view('groups.create-modules.discussion',compact('group','folder'));
    }

    public function save(Request $request){
     
        $request->validate([
            'name' => 'required',
            'group' => 'required',
            'total_score' => 'required'
        ]);

        //create group module
        $group_module_data = [
            'module_type'           => 'discussion',
            'module_specific_id'    => null,
            'group_id'              => $request->group,
            'user_id'               => Auth::user()->id,
            'user_instance_id'      => Auth::user()->user_instance->id,
            'folder_id'             => $request->folder_id,
            'visibility'            => 1,
        ];

        $saved_group_module = app(GroupModuleRepository::class)->save($group_module_data);

        $attachment = $request->attachment ? UploadHelper::uploadDiscussionPostAttachment($request->attachment) : null;

        //create exam based in created group module
        $data = [
            'name'              => $request->name,
            'description'       => $request->description,
            'total_score'       => $request->total_score,
            'attachment'        => $attachment,
            'group_id'          => $request->group,
            'group_module_id'   => $saved_group_module->id,
            'creator'           => Auth::user()->id,
            'user_instance_id'  => Auth::user()->user_instance->id
        ];

        //assign discussion to users
        $discussion_data = app(DiscussionRepository::class)->save($data);
        app(DiscussionAssignmentRepository::class)->assignDiscussionToUsers($discussion_data,$request->group);

        //update group module specific id
        $saved_group_module->module_specific_id = $discussion_data->id;
        $saved_group_module->save();

        //specify folder return
        if($request->folder_id == 0){
            return redirect()->route('groups.show',$discussion_data->group)->with('success', 'Discussion successfully created');
        }else{
            return redirect()->route('groups.show-folder',$request->folder_id)->with('success', 'Discussion successfully created');
        }
        
    }

    public function show(Discussion $discussion){
     
        $discussion = $discussion->load('group');
  
        $discussion_assignments = app(DiscussionAssignmentRepository::class)->query()->with('discussion','user','group')->whereDiscussionId($discussion->id)->whereGroupId($discussion->group_id)->get();
 
        return view('groups.show-modules.discussion',compact('discussion','discussion_assignments'));

    }

    public function edit(Discussion $discussion){

        return view('groups.edit-modules.discussion',compact('discussion'));

    }

    public function update(Request $request){
     
        $request->validate([
            'name' => 'required',
            'group' => 'required',
            'total_score' => 'required'
        ]);

        $attachment = $request->attachment ? UploadHelper::uploadFile($request->attachment) : ($request->old_attachment ?? null);

        $data = [
            'name'              => $request->name,
            'description'       => $request->description,
            'attachment'        => $attachment,
            'total_score'       => $request->total_score,
            'group_id'          => $request->group,
            'creator'           => Auth::user()->id,
            'user_instance_id'  => Auth::user()->user_instance->id,
        ];

        $discussion_data = app(DiscussionRepository::class)->update($request->discussion_id,$data);

        app(DiscussionAssignmentRepository::class)->assignDiscussionToUsers($discussion_data,$request->group);

        return redirect()->route('groups.discussion.show',$discussion_data)->with('success', 'Discussion successfully updated');

    }

    public function delete(Discussion $discussion){

        $group_id = $discussion->group_id;
        $group_modules_delete = GroupModule::whereModuleType('discussion')->whereModuleSpecificId($discussion->id)->first();
        $group_modules_delete->delete();

        return redirect()->route('groups.show',$group_id)->with('success', 'Discussion successfully deleted');
    }

    public function start(Discussion $discussion){

        $posts = app(DiscussionPostRepository::class)->query()->with('user','user_instance.role')->whereDiscussionId($discussion->id)->orderBy('created_at','DESC')->get();
        $discussion_assignments = app(DiscussionAssignmentRepository::class)->query()->with('discussion','user','group')->whereDiscussionId($discussion->id)->whereGroupId($discussion->group_id)->get();
     
        return view('groups.user.discussion.start',compact('discussion','posts','discussion_assignments'));
    }

    public function saveScores(Request $request){
        $data = app(DiscussionAssignmentRepository::class)->saveScores($request);
        return redirect()->back()->with('success', 'Scores updated');
       
    }

    public function generatePdf(Discussion $discussion){
        $discussion_assignments = app(DiscussionAssignmentRepository::class)->query()->with('discussion','user','group')->whereDiscussionId($discussion->id)->whereGroupId($discussion->group_id)->get();
     
        $pdf = PDF::loadView('pdf.discussion-score', compact(
            'discussion_assignments',
            'discussion'
        ));

        return $pdf->stream('DiscussionScores.pdf');
    }


}
