<?php

namespace App\Http\Controllers;

use App\Exam;
use App\User;
use App\Grade;
use App\Group;
use App\Folder;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Repositories\BaseRepository;
use App\Http\Repositories\GroupRepository;
use App\Http\Repositories\FolderRepository;
use App\Http\Repositories\GroupModuleRepository;
use App\Http\Repositories\ExamAssignmentRepository;
use App\Http\Repositories\LinkAssignmentRepository;
use App\Http\Repositories\GroupAssignmentRepository;
use App\Http\Repositories\DiscussionAssignmentRepository;
use App\Http\Repositories\LearningMaterialAssignmentRepository;

class GroupController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        
        $groups = app(GroupRepository::class)->query()->with('user_creator','subject')->whereCreatorId(Auth::user()->id)->whereCreatorInstanceId(Auth::user()->user_instance->id)->get();
       
        return view('groups.index',compact('groups'));

    }

    public function create(){
        $subjects = Subject::all();
        return view('groups.create',compact('subjects'));
    }

    public function save(Request $request){
     
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'subject'   => 'required'
        ]);

        $data = [
            'name'                      => $request->name,
            'description'               => $request->description,
            'creator_id'                =>  Auth::user()->id,
            'subject_id'                =>  $request->subject,
            'creator_instance_id'       =>  Auth::user()->user_instance->id,
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
        $folders = app(FolderRepository::class)->query()->whereGroupId($group->id)->whereParentId(0)->get();
        $this_folder = null;
        $group_modules = app(GroupModuleRepository::class)->query()->with('exam','discussion','learning_material','link')->whereGroupId($group->id)->whereFolderId(0)->get();
       
        return view('groups.folder-content',compact('group','assigned_users','this_folder','folders','group_modules'));

    }

    public function delete(Group $group){
        app(BaseRepository::class)->saveLog($group,'delete');
        $group->delete();
        return redirect()->route('groups.index')->with('success', 'Group successfully deleted');
        return $group;
    }

    public function list(){
        $groups = Group::with('user_creator','subject')->orderBy('name','ASC')->paginate(20);
        return view('groups.list',compact('groups'));
    }

    public function showFolder(Folder $folder){
    
        $this_folder = $folder->load('group','recursiveChildFolders','parent');
        $get_depth = collect($this->getTopParentArray($this_folder,$arr = []));
        $get_depth =  $get_depth->sortBy('id');
        $group = $this_folder->group;

        $assigned_users = app(GroupAssignmentRepository::class)->query()->with('group','user.user_instance')->whereGroupId($this_folder->group_id)->get();
        $created_exam = Exam::whereGroupId($this_folder->group_id)->get();

        $group_modules = app(GroupModuleRepository::class)->query()->with('exam','discussion','learning_material','link')->whereGroupId($group->id)->whereFolderId($this_folder->id)->get();
        
        return view('groups.folder-content',compact('group','this_folder','assigned_users','created_exam','get_depth','group_modules'));
    }

 

    public function getTopParentArray($this_folder,$arr){
        
        if ($this_folder->parent_id == null){
            return $arr;
        }

        $parent = Folder::find($this_folder->parent_id);
        $arr[] = (object)[
            'id' => $parent->id,
            'name' => $parent->name
        ];

        return $this->getTopParentArray($parent, $arr);
    }  


    public function userGroup(){

        $my_group_assignments =  app(GroupAssignmentRepository::class)->query()->with('group')->whereUserId(Auth::user()->id)->whereUserInstanceId(Auth::user()->user_instance->id)->get();
        return view('groups.user.index',compact('my_group_assignments'));
    
    }

    public function listExam(Group $group){

        $my_grade = Grade::whereUserId(Auth::user()->id)->whereUserInstanceId(Auth::user()->user_instance->id)->whereGroupId($group->id)->get();
        $my_exam_assignments = app(ExamAssignmentRepository::class)->query()->with('exam')->whereUserId(Auth::user()->id)->whereUserInstanceId(Auth::user()->user_instance->id)->whereGroupId($group->id)->get();
        return view('groups.user.exam.list',compact('group','my_exam_assignments','my_grade'));
      
    }

    public function listDiscussion(Group $group){

        $my_grade = Grade::whereUserId(Auth::user()->id)->whereUserInstanceId(Auth::user()->user_instance->id)->whereGroupId($group->id)->get();
        $my_discussion_assignments = app(DiscussionAssignmentRepository::class)->query()->with('discussion')->whereUserId(Auth::user()->id)->whereUserInstanceId(Auth::user()->user_instance->id)->whereGroupId($group->id)->get();
        return view('groups.user.discussion.list',compact('group','my_discussion_assignments','my_grade'));
    }

    public function listLearningMaterial(Group $group){

        $my_grade = Grade::whereUserId(Auth::user()->id)->whereUserInstanceId(Auth::user()->user_instance->id)->whereGroupId($group->id)->get();
        $my_learning_material_assignments = app(LearningMaterialAssignmentRepository::class)->query()->with('learning_material')->whereUserId(Auth::user()->id)->whereUserInstanceId(Auth::user()->user_instance->id)->whereGroupId($group->id)->get();
        return view('groups.user.learning-material.list',compact('group','my_learning_material_assignments','my_grade'));
    }

    public function listLink(Group $group){

        $my_grade = Grade::whereUserId(Auth::user()->id)->whereUserInstanceId(Auth::user()->user_instance->id)->whereGroupId($group->id)->get();
        $my_link_assignments = app(LinkAssignmentRepository::class)->query()->with('link')->whereUserId(Auth::user()->id)->whereUserInstanceId(Auth::user()->user_instance->id)->whereGroupId($group->id)->get();
        return view('groups.user.link.list',compact('group','my_link_assignments','my_grade'));
    }


    public function userExamAssignments(Group $group, User $user){
        
        $user_exam_assignments = app(ExamAssignmentRepository::class)->query()->with('exam')->whereGroupId($group->id)->whereUserInstanceId(Auth::user()->user_instance->id)->whereUserId($user->id)->get();
        return view('groups.user.exam.assignments',compact('user_exam_assignments','group','user'));
   
    }



    
    


}
