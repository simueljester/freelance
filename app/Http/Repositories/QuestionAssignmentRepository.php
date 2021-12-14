<?php
namespace App\Http\Repositories;


use App\Question;
use App\Exam;
use App\QuestionExamAssignment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class QuestionAssignmentRepository extends BaseRepository 
{
    function __construct(QuestionExamAssignment $model)
    {
        $this->model = $model;
    }

    public function assignQuestions($request){
   
        foreach($request->question_ids as $question){
            $question_object = Question::find($question);
            $group_assignment = QuestionExamAssignment::updateOrCreate(
                [
                    'exam_id'          => $request->exam_id,
                    'question_id'      => $question_object->id,
                    'level'            => $question_object->level
                ]
            );
        }

        $this->updateExamTotalScore($request->exam_id);
    }

    public function updateExamTotalScore($exam_id){

        $question_assignments = QuestionExamAssignment::with('question')->whereExamId($exam_id)->get();
        $individual_points = [];
        foreach($question_assignments as $qa){
            $individual_points[] = $qa->question->max_points;
        }
        $total_score = array_sum($individual_points);
        Exam::where('id',$exam_id)->update(['total_score'=>$total_score]);
    }

    public function assignSingleQuestions($exam,$question){
        $question_object = $question;
        $group_assignment = QuestionExamAssignment::updateOrCreate(
            [
                'exam_id'          => $exam->id,
                'question_id'      => $question_object->id,
                'level'            => $question_object->level
            ]
        );
    }
} 