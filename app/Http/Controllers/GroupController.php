<?php

namespace App\Http\Controllers;

use App\Exam;
use App\User;
use App\Grade;
use App\Group;
use App\Folder;
use App\Subject;
use App\UserInstance;
use Illuminate\Http\Request;
use App\GroupInstructorAssignments;
use Illuminate\Support\Facades\Auth;
use App\Http\Repositories\GroupRepository;
use App\Http\Repositories\FolderRepository;
use App\Http\Repositories\SectionRepository;
use App\Http\Repositories\SubjectRepository;
use App\Http\Repositories\GroupModuleRepository;
use App\Http\Repositories\AcademicYearRepository;
use App\Http\Repositories\ExamAssignmentRepository;
use App\Http\Repositories\LinkAssignmentRepository;
use App\Http\Repositories\GroupAssignmentRepository;
use App\Http\Repositories\DiscussionAssignmentRepository;
use App\Http\Repositories\GroupInstructorAssignmentRepository;
use App\Http\Repositories\LearningMaterialAssignmentRepository;

class GroupController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $active_ac_id = app(AcademicYearRepository::class)->getActiveAcademicYear()->id;
        if(Auth::user()->user_instance->role_id == 1){
            $groups = app(GroupRepository::class)->query()->with('user_creator','subject','activeAcademicYear','section','instructorAssignments.instuctor')
            ->whereAcademicYearId($active_ac_id)
            ->get();
            $other_groups = null;
        }
        if(Auth::user()->user_instance->role_id == 2){
            $groups = app(GroupRepository::class)->query()->with('user_creator','subject','activeAcademicYear','section','instructorAssignments.instuctor')
            ->whereCreatorId(Auth::user()->id)
            ->whereCreatorInstanceId(Auth::user()->user_instance->id)
            ->whereAcademicYearId($active_ac_id)
            ->get();

            $other_groups =  app(GroupInstructorAssignments::class)->query()->with('group')
            ->whereInstructorId(Auth::user()->id)
            ->whereInstructorInstanceId(Auth::user()->user_instance->id)
            ->whereAcademicYearId($active_ac_id)
            ->get();
            
        }

      
           
        return view('groups.index',compact('groups','other_groups'));

    }

    public function create(){
        
        $active_ac_id = app(AcademicYearRepository::class)->getActiveAcademicYear()->id;
        $subjects = app(SubjectRepository::class)->query()->whereAcademicYearId($active_ac_id)->get();
        $teachers = UserInstance::with('user')->whereActive(1)->whereRoleId(2)->get();
        $sections = app(SectionRepository::class)->query()->whereAcademicYearId($active_ac_id)->get();
        
        return view('groups.create',compact('subjects','teachers','sections'));

    }

    public function save(Request $request){
        // return $request->teacher;
   
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'subject'   => 'required',
            'teacher'   => 'required',
            'section'   => 'required',
        ]);

        $data = [
            'name'                      =>  $request->name,
            'description'               =>  $request->description,
            'creator_id'                =>  json_decode($request->teacher)->user_id,
            'subject_id'                =>  $request->subject,
            'creator_instance_id'       =>  json_decode($request->teacher)->id,
            'academic_year_id'          =>  app(AcademicYearRepository::class)->getActiveAcademicYear()->id,
            'section_id'                =>  $request->section,
        ];

        app(GroupRepository::class)->save($data);
    
        return redirect()->route('groups.index')->with('success', 'Group successfully saved');
    }

    public function edit(Group $group){
        $group->load('user_creator','instructorAssignments.instuctor');
       
        $instructors = UserInstance::with('user')->whereActive(1)->whereRoleId(2)->get();
        return view('groups.edit',compact('group','instructors'));

    }

    public function addInstructor(Request $request){
     
        $user = User::with('user_instance')->find($request->instructor_id);
        $group = Group::find($request->group_id);

        $instructor_assigned = GroupInstructorAssignments::whereInstructor_id($user->id)->whereGroupId($group->id)->whereAcademicYearId($group->academic_year_id)->first() ?? null;
        
        if($instructor_assigned == null){

            $data = [
                'instructor_id'             =>  $user->id,
                'instructor_instance_id'    =>  $user->user_instance->id,
                'group_id'                  =>  $group->id,
                'subject_id'                =>  $group->subject_id,
                'academic_year_id'          =>  app(AcademicYearRepository::class)->getActiveAcademicYear()->id,
            ];
    
            app(GroupInstructorAssignmentRepository::class)->save($data);
            return redirect()->back()->with('success', 'Instructor successfully assigned');
        }else{
            return redirect()->back()->with('error', 'Instructor already assigned in this class');
        }
     
    }

    public function removeInstructor(GroupInstructorAssignments $group_instructor_assignment){
        $group_instructor_assignment->delete();
        return redirect()->back()->with('success', 'Instructor successfully removed');
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

    public function list(){
        $groups = Group::with('user_creator','subject','activeAcademicYear')->orderBy('name','ASC')->paginate(20);
        return view('groups.list',compact('groups'));
    }

    public function showFolder(Folder $folder){
    
        $this_folder = $folder->load('group','recursiveChildFolders','parent');
        $get_depth = collect($this->getTopParentArray($this_folder,$arr = []));
        $get_depth =  $get_depth->sortBy('id');
        $group = $this_folder->group;

        $assigned_users = app(GroupAssignmentRepository::class)->query()->with('group','user.user_instance')->whereGroupId($this_folder->group_id)->get();
        $created_exam = Exam::whereGroupId($this_folder->group_id)->get();

        $group_modules = app(GroupModuleRepository::class)->query()->with('exam.userCreator','discussion.userCreator','learning_material.userCreator','link.userCreator')->whereGroupId($group->id)->whereFolderId($this_folder->id)->get();
        // dd($group_modules);
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
        $group->load('members.user');
       
        $my_grade = Grade::whereUserId(Auth::user()->id)->whereUserInstanceId(Auth::user()->user_instance->id)->whereGroupId($group->id)->get();
        $my_exam_assignments = app(ExamAssignmentRepository::class)->query()
        ->with('exam')
        ->whereHas('exam.groupModule', function($q){
            $q->where('visibility', 1);
        })
        ->whereUserId(Auth::user()->id)
        ->whereUserInstanceId(Auth::user()->user_instance->id)
        ->whereGroupId($group->id)
        ->get();
        return view('groups.user.exam.list',compact('group','my_exam_assignments','my_grade'));
      
    }

    public function listDiscussion(Group $group){
        $group->load('members.user');
        $my_grade = Grade::whereUserId(Auth::user()->id)->whereUserInstanceId(Auth::user()->user_instance->id)->whereGroupId($group->id)->get();
        $my_discussion_assignments = app(DiscussionAssignmentRepository::class)->query()
        ->with('discussion')
        ->whereHas('discussion.groupModule', function($q){
            $q->where('visibility', 1);
        })
        ->whereUserId(Auth::user()->id)
        ->whereUserInstanceId(Auth::user()->user_instance->id)
        ->whereGroupId($group->id)
        ->get();
        return view('groups.user.discussion.list',compact('group','my_discussion_assignments','my_grade'));
    }

    public function listLearningMaterial(Group $group){
        $group->load('members.user');
        $my_grade = Grade::whereUserId(Auth::user()->id)->whereUserInstanceId(Auth::user()->user_instance->id)->whereGroupId($group->id)->get();
        $my_learning_material_assignments = app(LearningMaterialAssignmentRepository::class)->query()
        ->with('learning_material')
        ->whereHas('learning_material.groupModule', function($q){
            $q->where('visibility', 1);
        })
        ->whereUserId(Auth::user()->id)
        ->whereUserInstanceId(Auth::user()->user_instance->id)
        ->whereGroupId($group->id)
        ->get();
        return view('groups.user.learning-material.list',compact('group','my_learning_material_assignments','my_grade'));
    }

    public function listLink(Group $group){
        $group->load('members.user');
        $my_grade = Grade::whereUserId(Auth::user()->id)->whereUserInstanceId(Auth::user()->user_instance->id)->whereGroupId($group->id)->get();
        $my_link_assignments = app(LinkAssignmentRepository::class)->query()
        ->with('link')
        ->whereHas('link.groupModule', function($q){
            $q->where('visibility', 1);
        })
        ->whereUserId(Auth::user()->id)
        ->whereUserInstanceId(Auth::user()->user_instance->id)
        ->whereGroupId($group->id)
        ->get();
        return view('groups.user.link.list',compact('group','my_link_assignments','my_grade'));
    }


    public function userExamAssignments(Group $group, User $user){
        
        $user_exam_assignments = app(ExamAssignmentRepository::class)->query()->with('exam')->whereGroupId($group->id)->whereUserInstanceId(Auth::user()->user_instance->id)->whereUserId($user->id)->get();
        return view('groups.user.exam.assignments',compact('user_exam_assignments','group','user'));
   
    }



    
    


}
