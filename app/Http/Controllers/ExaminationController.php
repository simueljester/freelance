<?php

namespace App\Http\Controllers;

use Auth;
use App\Exam;
use App\Group;
use App\GroupAssignment;
use Illuminate\Http\Request;
use App\Http\Repositories\ExamRepository;
use App\Http\Repositories\ExamAssignmentRepository;
use App\Http\Repositories\QuestionAssignmentRepository;

class ExaminationController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $exams = app(ExamRepository::class)->query()->with('group')->whereCreator(Auth::user()->id)->orderBy('created_at','DESC')->get();
        return view('examination.index', compact('exams'));
    }

    public function create(){
        $groups = Group::whereCreatorId(Auth::user()->id)->get();
        
        return view('examination.create',compact('groups'));

    }

    public function save(Request $request){
     
        $request->validate([
            'name' => 'required',
            'group' => 'required',
            'duration' => 'required'
        ]);

        $data = [
            'name'          => $request->name,
            'description'   => $request->description,
            'creator'       =>  Auth::user()->id,
            'group_id'      => $request->group,
            'duration'      => $request->duration
        ];

        $exam_data = app(ExamRepository::class)->save($data);

        app(ExamAssignmentRepository::class)->assignExamToUsers($exam_data,$request->group);

        return redirect()->route('groups.show',$exam_data->group)->with('success', 'Exam successfully created');
    }

    public function show(Exam $exam){
     
        $questions_assigned = app(QuestionAssignmentRepository::class)->query()->with('question')->whereExamId($exam->id)->get();
        return view('examination.show',compact('exam','questions_assigned'));

    }

    public function edit(Exam $exam){

        return view('examination.edit',compact('exam'));

    }

    public function update(Request $request){

        $request->validate([
            'name' => 'required',
            'group' => 'required',
            'duration' => 'required'
        ]);

        $data = [
            'name'          => $request->name,
            'description'   => $request->description,
            'creator'       =>  Auth::user()->id,
            'group_id'      => $request->group,
            'duration'      => $request->duration
        ];

        $exam_data = app(ExamRepository::class)->update($request->exam_id,$data);

        app(ExamAssignmentRepository::class)->assignExamToUsers($exam_data,$request->group);

        return redirect()->route('groups.show',$exam_data->group)->with('success', 'Exam successfully updated');

    }

    public function delete(Exam $exam){
        $group_id = $exam->group_id;
        $exam->delete();
        return redirect()->route('groups.show',$group_id)->with('success', 'Exam successfully deleted');
    }
}
