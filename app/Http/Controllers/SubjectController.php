<?php

namespace App\Http\Controllers;

use App\Subject;
use App\AcademicYear;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Imports\SubjectImport;
use App\Http\Repositories\BaseRepository;
use App\Http\Repositories\SubjectRepository;
use App\Http\Repositories\DepartmentRepository;
use App\Http\Repositories\AcademicYearRepository;
use Maatwebsite\Excel\Facades\Excel;

class SubjectController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        $keyword = $request->keyword;
        $department_filter = $request->department_filter;
        $active_ac_id = app(AcademicYearRepository::class)->getActiveAcademicYear()->id;
        $subjects = app(SubjectRepository::class)->query()
        ->with('activeAcademicYear','department')
        ->whereAcademicYearId($active_ac_id)
        ->when($keyword, function ($query) use ($keyword,$active_ac_id) {
            $query->where('name', 'like', '%' . $keyword . '%')
            ->orWhere('description', 'like', '%' . $keyword . '%')
            ->orWhere('course_code', 'like', '%' . $keyword . '%')
            ->whereAcademicYearId($active_ac_id);
        })
        ->when($department_filter, function ($query) use ($department_filter) {
            $query->where('department_id', $department_filter);
        })
        ->paginate(20);
        $departments = app(DepartmentRepository::class)->query()->get();
        return view('school-management.subjects.index',compact('subjects','keyword','departments','department_filter'));
    }

    public function create(){
        $departments = app(DepartmentRepository::class)->query()->get();
        return view('school-management.subjects.create',compact('departments'));
    }

    public function save(Request $request){
    
        $request->validate([
            'name' => 'required'
        ]);
  
        $data = [
            'name'          => $request->name,
            'description'   => $request->description,
            'course_code'   => Str::slug($request->course_code),
            'academic_year_id' => app(AcademicYearRepository::class)->getActiveAcademicYear()->id,
            'department_id'     => $request->department
        ];

        $saved = app(SubjectRepository::class)->save($data);
    
        return redirect()->route('school-management.subjects.index')->with('success', 'Subject successfully created');

    }

    public function show(Subject $subject){

        return view('school-management.subjects.show',compact('subject'));
    }

    public function update(Request $request){
  
        $request->validate([
            'name'          => 'required',
            'course_code'   => 'required'
        ]);

        $data = [
            'name'      => $request->name,
            'description'     => $request->description,
            'course_code'   => $request->course_code
        ];

        app(SubjectRepository::class)->update($request->subject_id,$data);
        return redirect()->route('school-management.subjects.show',$request->subject_id)->with('success', 'Subject successfully updated');
    }

    public function delete(Subject $subject){ 
        app(BaseRepository::class)->saveLog($subject,'delete');
        $subject->delete();
        return redirect()->route('school-management.subjects.index')->with('success', 'Subject successfully deleted');
    }

    public function saveBatchUpload(Request $request){
    
        $request->validate([
            'file'=> 'required|mimes:xlsx,xls'
        ]);

        $rows = Excel::toArray(new SubjectImport, $request->file('file'));
        $uploaded_subjects = $rows[0];
     
        $department = $request->department;
        $data = app(SubjectRepository::class)->saveBatch($uploaded_subjects,$department);
           
        return redirect()->back()->with('success', 'Subjects successfully uploaded');

    }
    

}
