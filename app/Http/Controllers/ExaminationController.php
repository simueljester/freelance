<?php

namespace App\Http\Controllers;

use PDF;
use Auth;
use App\Exam;
use App\Group;
use App\ExamAnswers;
use App\GroupModule;
use App\ExamAssignment;
use App\GroupAssignment;
use Illuminate\Http\Request;
use App\Http\Repositories\BaseRepository;
use App\Http\Repositories\ExamRepository;
use App\Http\Repositories\ExamAnswerRepository;
use App\Http\Repositories\GroupModuleRepository;
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

    public function create(Group $group,$folder){
        return view('groups.create-modules.exam',compact('group','folder'));
    }

    public function save(Request $request){
     
        $request->validate([
            'name' => 'required',
            'group' => 'required',
            'duration' => 'required'
        ]);

        //create group module
        $group_module_data = [
            'module_type'           => 'exam',
            'module_specific_id'    => null,
            'group_id'              => $request->group,
            'user_id'               => Auth::user()->id,
            'user_instance_id'      => Auth::user()->user_instance->id,
            'folder_id'             => $request->folder_id,
            'visibility'            => 1,
        ];

        $saved_group_module = app(GroupModuleRepository::class)->save($group_module_data);

        //create exam based in created group module
        $data = [
            'name'              => $request->name,
            'description'       => $request->description,
            'creator'           =>  Auth::user()->id,
            'group_module_id'   => $saved_group_module->id,
            'group_id'          => $request->group,
            'duration'          => $request->duration,
            'user_instance_id'  => Auth::user()->user_instance->id,
        ];

        //assign exam to users
        $exam_data = app(ExamRepository::class)->save($data);
        app(ExamAssignmentRepository::class)->assignExamToUsers($exam_data,$request->group);

        //update group module specific id
        $saved_group_module->module_specific_id = $exam_data->id;
        $saved_group_module->save();

        //specify folder return
        if($request->folder_id == 0){
            return redirect()->route('groups.show',$exam_data->group)->with('success', 'Exam successfully created');
        }else{
            return redirect()->route('groups.show-folder',$request->folder_id)->with('success', 'Exam successfully created');
        }
        
    }


    public function show(Exam $exam){
     
        $exam = $exam->load('group');
        $questions_assigned = app(QuestionAssignmentRepository::class)->query()->with('question')->whereExamId($exam->id)->get();
        $exam_assignments = app(ExamAssignmentRepository::class)->query()->with('exam','user','group')->whereExamId($exam->id)->whereGroupId($exam->group_id)->get();
 
        return view('groups.show-modules.exam',compact('exam','questions_assigned','exam_assignments'));

    }

    public function edit(Exam $exam){

        return view('groups.edit-modules.exam',compact('exam'));

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

        return redirect()->route('groups.exam.show',$exam_data)->with('success', 'Exam successfully updated');

    }

    public function delete(Exam $exam){

        app(BaseRepository::class)->saveLog($exam,'delete');
        
        $group_id = $exam->group_id;
        $group_modules_delete = GroupModule::whereModuleType('exam')->whereModuleSpecificId($exam->id)->first();
        $group_modules_delete->delete();

        return redirect()->route('groups.show',$group_id)->with('success', 'Exam successfully deleted');
    }

    public function start(ExamAssignment $exam_assignment){

        $exam_assignment = $exam_assignment->load('exam.questionAssignments.question');
        return view('groups.user.exam.start',compact('exam_assignment'));

    }

    public function saveFinishedExam(Request $request){
   
        $exam_answers = app(ExamAnswerRepository::class)->saveAnswers($request);

  

        return redirect()->route('groups.user-group.list-exam', $request->group_id)->with('success', 'Exam successfully deleted');

    }

    public function viewExamResult(ExamAssignment $exam_assignment){

       $exam_assignment->load('exam.questionAssignments.question','user_answers.question','user','group','webShots');
       return view('groups.user.exam.view',compact('exam_assignment'));
  
    }

    public function override(Request $request){

        //update the exact answer points
        ExamAnswers::whereId($request->answer_id)->update(["points" => $request->score]);

        //get new total score
        $new_total_score = ExamAnswers::whereExamAssignmentId($request->exam_assignment_id)->sum('points');
        
        //update exam assignment total score
        app(ExamAnswerRepository::class)->updateExamAssignment($request->exam_assignment_id,$new_total_score,$request->status);

        return redirect()->back()->with('success', 'Answer points successfully updated');
    }

    public function generatePdf(ExamAssignment $exam_assignment){

        $exam_assignment->load('exam.questionAssignments.question','user_answers.question','user','group','webShots');
      
        $pdf = PDF::loadView('pdf.exam-result', compact(
            'exam_assignment'
        ));

        return $pdf->stream('Examination.pdf');
        
    }
}
