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
     
        $questions = app(QuestionBankRepository::class)->query()->orderBy('created_at','DESC')->get();
        return view('examination.question-assignment.index',compact('exam','questions','assigned_questions'));
    }

    public function assignQuestions(Request $request){
    
        $data = app(QuestionAssignmentRepository::class)->assignQuestions($request);
 
        return redirect()->route('examination.show',$request->exam_id)->with('success', 'Questions successfully assigned to Exam');
    }

    public function unassignQuestions(Request $request){
  
        if($request->question_assignment_ids){

            foreach($request->question_assignment_ids as $assignment_id){
                $assignment = QuestionExamAssignment::find($assignment_id);
                $assignment->delete();
            }
    
            app(QuestionAssignmentRepository::class)->updateExamTotalScore($request->exam_id);
            return redirect()->route('examination.show',$request->exam_id)->with('success', 'Questions successfully unassigned to Exam');

        }else{
            return redirect()->route('examination.show',$request->exam_id)->with('error', 'Must select questions to unassign');
        }

    }
}
