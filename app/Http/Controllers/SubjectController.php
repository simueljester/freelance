<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;
use App\Http\Repositories\BaseRepository;
use App\Http\Repositories\SubjectRepository;

class SubjectController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $subjects = app(SubjectRepository::class)->query()->get();
        return view('school-management.subjects.index',compact('subjects'));
    }

    public function create(){
        return view('school-management.subjects.create');
    }

    public function save(Request $request){
      
        $request->validate([
            'name' => 'required'
        ]);
  
        $data = [
            'name'          => $request->name,
            'description'   => $request->description,
            'course_code'   => $request->course_code
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
    

}
