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

    public function index(Request $request){
        $active_ac_id = app(AcademicYearRepository::class)->getActiveAcademicYear()->id;
        $keyword = $request->keyword;
        $departments = app(DepartmentRepository::class)->query()
        ->when($keyword, function ($query) use ($keyword,$active_ac_id) {
            $query->where('name', 'like', '%' . $keyword . '%')
            ->orWhere('description', 'like', '%' . $keyword . '%')
            ->whereAcademicYearId($active_ac_id);
        })
        ->with('activeAcademicYear')
        ->whereAcademicYearId($active_ac_id)
        ->paginate(20);
 
        return view('school-management.departments.index',compact('departments','keyword'));
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
