<?php

namespace App\Http\Controllers;

use App\Exam;
use Illuminate\Http\Request;
use App\QuestionExamAssignment;
use App\Http\Repositories\QuestionBankRepository;
use App\Http\Repositories\QuestionAssignmentRepository;

class QuestionAssignmentController extends Controller
{
    //
    public function index(Exam $exam){
    
        $assigned_questions = app(QuestionAssignmentRepository::class)->query()->whereExamId($exam->id)->pluck('question_id')->toArray();
     
        $questions = app(QuestionBankRepository::class)->query()->with('subject')->orderBy('created_at','DESC')->where('subject_id',$exam->group->subject->id)->get();
        return view('examination.question-assignment.index',compact('exam','questions','assigned_questions'));
    }

    public function assignQuestions(Request $request){
    
        $data = app(QuestionAssignmentRepository::class)->assignQuestions($request);
 
        return redirect()->route('groups.exam.show',$request->exam_id)->with('success', 'Questions successfully assigned to Assessment');
    }

    public function unassignQuestions(Request $request){
  
        if($request->question_assignment_ids){

            foreach($request->question_assignment_ids as $assignment_id){
                $assignment = QuestionExamAssignment::find($assignment_id);
                $assignment->delete();
            }
    
            app(QuestionAssignmentRepository::class)->updateExamTotalScore($request->exam_id);
            return redirect()->route('groups.exam.show',$request->exam_id)->with('success', 'Questions successfully unassigned to Assessment');

        }else{
            return redirect()->route('groups.exam.show',$request->exam_id)->with('error', 'Must select questions to unassign');
        }

    }
}
