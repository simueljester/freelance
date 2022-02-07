<?php

namespace App\Http\Controllers;

use App\Section;
use Illuminate\Http\Request;
use App\Http\Repositories\BaseRepository;
use App\Http\Repositories\SectionRepository;

use App\Http\Repositories\AcademicYearRepository;

class SectionController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        $keyword = $request->keyword;
        $active_ac_id = app(AcademicYearRepository::class)->getActiveAcademicYear()->id;
        $sections = app(SectionRepository::class)->query()
        ->with('activeAcademicYear')
        ->whereAcademicYearId($active_ac_id)
        ->when($keyword, function ($query) use ($keyword,$active_ac_id) {
            $query->where('name', 'like', '%' . $keyword . '%')
            ->orWhere('description', 'like', '%' . $keyword . '%')
            ->whereAcademicYearId($active_ac_id);
        })
        ->paginate(20);
     
        return view('school-management.sections.index',compact('sections','keyword'));
    }

    public function create(){
        // $active_ac_id = app(AcademicYearRepository::class)->getActiveAcademicYear()->id;
    
        return view('school-management.sections.create');
    }

    public function save(Request $request){
    
        $request->validate([
            'section_name' => 'required'
        ]);
  
        $data = [
            'name'              => $request->section_name,
            'description'       => $request->section_description,
            'academic_year_id'  => app(AcademicYearRepository::class)->getActiveAcademicYear()->id,
        ];

        $saved = app(SectionRepository::class)->save($data);
    
        return redirect()->back()->with('success', 'Section successfully created');

    }

    public function show(Section $section){
        $section->load('user_instances.user');
      
        return view('school-management.sections.show',compact('section'));
    }

    public function update(Request $request){
     
        $request->validate([
            'name'          => 'required',
        ]);

        $data = [
            'name'          => $request->name,
            'description'   => $request->description,
        ];

        app(SectionRepository::class)->update($request->section_id,$data);
        return redirect()->route('school-management.sections.show',$request->section_id)->with('success', 'Section successfully updated');
    }

    public function delete(Section $section){ 

        app(BaseRepository::class)->saveLog($section,'delete');
        $section->delete();
        return redirect()->route('school-management.sections.index')->with('success', 'Section successfully deleted');
    }
}