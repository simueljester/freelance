<?php
namespace App\Http\Repositories;



use Auth;
use App\Question;
use App\ExamAnswers;
use App\ExamAssignment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Repositories\BaseRepository;

class ExamAnswerRepository extends BaseRepository 
{
    function __construct(ExamAnswers $model)
    {
        $this->model = $model;
    }

    public function saveAnswers($request){
        $duration_status = $request->duration_status;
        $answers = $request->answer;
        $exam_id = $request->exam_id;
        $exam_assignment_id = $request->exam_assignment_id;
        $group_id = $request->group_id;

        DB::beginTransaction();

        try {

            foreach($answers as $key => $answer){ //key = question & value = answer

                $question = Question::find($key);
                $correct_answer = $question->answer;
                $user_answer = $answer;
               
                $points = $correct_answer == $user_answer ? $question->max_points : 0;
    
                $get_points[] = ExamAnswers::firstOrCreate(
                    [
                        'exam_id'               => $exam_id,
                        'exam_assignment_id'    => $exam_assignment_id,
                        'question_id'           => $question->id,
                        'group_id'              => $group_id,
                        'user_id'               => Auth::user()->id,
                 
                    ],
                    [
                        'user_instance_id'      => Auth::user()->user_instance->id,
                        'points'                => $points,
                        'user_answer'           => $user_answer
                    ]
                )->points;

                $total_score = array_sum($get_points);
    
            }
    
            //update exam assignment
            $this->updateExamAssignment($exam_assignment_id,$total_score,$duration_status);
            app(BaseRepository::class)->customSaveLog('exam_answers','create','Answered examination',$answers);

            DB::commit();
   
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }

        return 'success';

    }

    public function updateExamAssignment($exam_assignment_id,$total_score,$duration_status){
        $exam_assignment = ExamAssignment::find($exam_assignment_id);
        $exam_assignment->duration = 0;
        $exam_assignment->score = $total_score;
        $exam_assignment->status = $duration_status;
        $exam_assignment->save();
    }
}