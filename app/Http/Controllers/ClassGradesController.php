<?php

namespace App\Http\Controllers;

use App\Grade;

use App\Group;
use Illuminate\Http\Request;
use App\Exports\GroupGradesExport;
use App\Http\Repositories\GradeRepository;
use App\Http\Repositories\GroupAssignmentRepository;
use Excel;

class ClassGradesController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Group $group){

    
        $assigned_users = app(GroupAssignmentRepository::class)->query()->with('group.subject','user.user_instance','prelim_grades','midterm_grades','finals_grades')->whereGroupId($group->id)->get();
       
        return view('groups.class-grades.index',compact('group','assigned_users'));
    }

    public function save(Request $request){
    
        $data = app(GradeRepository::class)->saveGrade($request);
      
        return redirect()->back()->with('success', 'Grade successfully saved');
    }

    public function show(Grade $grade){
        $grade->load('user','user_instance','group.subject','groupAssignment','user_creator');
       
       return view('groups.class-grades.show',compact('grade'));
    }

    public function downloadGrades(Group $group){
        // $assigned_users = app(GroupAssignmentRepository::class)->query()->with('group.subject','group.user_creator_instance.academicYear','user.user_instance','prelim_grades','midterm_grades','finals_grades')->whereGroupId($group->id)->get();
        $data = Grade::with('user','user_instance.academicYear','group.subject','user_creator')->whereGroupId($group->id)->get();
 
        return Excel::download(new GroupGradesExport($data), 'ClassGrades.xlsx');

    }
}
