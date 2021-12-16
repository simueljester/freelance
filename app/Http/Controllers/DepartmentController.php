<?php

namespace App\Http\Controllers;


use App\Department;
use Illuminate\Http\Request;
use App\Http\Repositories\BaseRepository;
use App\Http\Repositories\DepartmentRepository;
use App\Http\Repositories\AcademicYearRepository;

class DepartmentController extends Controller
{
    //
       //
       public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $active_ac_id = app(AcademicYearRepository::class)->getActiveAcademicYear()->id;
        $departments = app(DepartmentRepository::class)->query()->with('activeAcademicYear')->whereAcademicYearId($active_ac_id)->paginate(10);
 
        return view('school-management.departments.index',compact('departments'));
    }

    public function create(){
        return view('school-management.departments.create');
    }

    public function save(Request $request){
     
        $request->validate([
            'name' => 'required'
        ]);
  
        $data = [
            'name'          => $request->name,
            'description'   => $request->description,
            'academic_year_id' => app(AcademicYearRepository::class)->getActiveAcademicYear()->id
        ];

        $saved = app(DepartmentRepository::class)->save($data);
    
        return redirect()->route('school-management.departments.index')->with('success', 'Section successfully created');

    }

    public function show(Department $department){
        $department->load('sections');
     
        return view('school-management.departments.show',compact('department'));
    }

    public function update(Request $request){
     
        $request->validate([
            'name'          => 'required',
        ]);

        $data = [
            'name'          => $request->name,
            'description'   => $request->description,
        ];

        app(DepartmentRepository::class)->update($request->department_id,$data);
        return redirect()->route('school-management.departments.show',$request->department_id)->with('success', 'Department successfully updated');
    }

    public function delete(Department $department){ 

        app(BaseRepository::class)->saveLog($department,'delete');
        $department->delete();
        return redirect()->route('school-management.departments.index')->with('success', 'Department successfully deleted');
    }
}
