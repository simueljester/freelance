<?php
namespace App\Http\Repositories;


use App\Question;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Auth;

class QuestionBankRepository extends BaseRepository 
{
    function __construct(Question $model)
    {
        $this->model = $model;
    }

    public function saveBatchQuestions($uploaded_questions){
        
        foreach($uploaded_questions as $question){

            $level = null;

            if($question->difficulty == 'easy'){
                $level = 1;
            }

            if($question->difficulty == 'medium'){
                $level = 2;
            }

            if($question->difficulty == 'hard'){
                $level = 3;
            }

            $new_question = New Question;
            $new_question->instruction      = $question->instruction;
            $new_question->question_type    = $question->question_type;
            $new_question->option_1         = $question->option_1;
            $new_question->option_2         = $question->option_2;
            $new_question->option_3         = $question->option_3 ?? null;
            $new_question->option_4         = $question->option_4 ?? null;
            $new_question->option_5         = $question->option_5 ?? null;
            $new_question->option_6         = $question->option_6 ?? null;
            $new_question->answer           = $question->correct_answer;
            $new_question->max_points       = $question->max_points;
            $new_question->attachment       = null;
            $new_question->creator          = Auth::user()->id;
            $new_question->subject_id       = 0;
            $new_question->level            = $level ?? 2;
            $new_question->save();
        }


    }
}