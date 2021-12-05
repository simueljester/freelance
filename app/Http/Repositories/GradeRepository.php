<?php
namespace App\Http\Repositories;



use App\Grade;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Auth;

class GradeRepository extends BaseRepository 
{
    function __construct(Grade $model)
    {
        $this->model = $model;
    }

    public function saveGrade($request){
    
       $term                            = $request->term;

       $long_quiz_input                 = $request->long_quiz_score; // request name score because its being computed in front end. IT IS AN INPUT originally
       $long_quiz_score                 = 100;
       $long_quiz_percentage            = 0.25;
       $long_quiz_final                 = $request->long_quiz_eg_text;

       $short_quiz_input                = $request->short_quiz_score; // request name score because its being computed in front end. IT IS AN INPUT originally
       $short_quiz_score                = 100;
       $short_quiz_percentage           = 0.15;
       $short_quiz_final                = $request->short_quiz_eg_text;

       $assessment_task_input           = $request->class_participation_score; // request name score because its being computed in front end. IT IS AN INPUT originally
       $assessment_task_score           = 100;
       $assessment_task_percentage      = 0.10;
       $assessment_task_final           = $request->class_participation_eg_txt;

       $major_examination_input         = $request->major_examination_score; // request name score because its being computed in front end. IT IS AN INPUT originally
       $major_examination_score         = 100;
       $major_examination_percentage    = 0.50;
       $major_examination_final         = $request->major_examination_eg_txt;

       $final_grade                     = $request->final_grade_txt;
       $user_id                         = $request->user_id;
       $user_instance_id                = $request->user_instance_id;
       $group_id                        = $request->group_id;
       $group_assignment_id             = $request->group_assignment_id;
       $creator                         = Auth::user()->id;

       $grade = Grade::updateOrCreate(
        [
            'term'                      => $term,
            'user_id'                   => $user_id,
            'user_instance_id'          => $user_instance_id,
            'group_id'                  => $group_id,
            'group_assignment_id'       => $group_assignment_id,
        ],
        [

            'long_quiz_input'               => $long_quiz_input,
            'long_quiz_score'               => $long_quiz_score,
            'long_quiz_percentage'          => $long_quiz_percentage,
            'long_quiz_final'               => $long_quiz_final,

            'short_quiz_input'              => $short_quiz_input,
            'short_quiz_score'              => $short_quiz_score,
            'short_quiz_percentage'         => $short_quiz_percentage,
            'short_quiz_final'              => $short_quiz_final,

            'assessment_task_input'         => $assessment_task_input,
            'assessment_task_score'         => $assessment_task_score,
            'assessment_task_percentage'    => $assessment_task_percentage,
            'assessment_task_final'         => $assessment_task_final,

            'major_examination_input'       => $major_examination_input,
            'major_examination_score'       => $major_examination_score,
            'major_examination_percentage'  => $major_examination_percentage,
            'major_examination_final'       => $major_examination_final,

            'final_grade'                   => $final_grade,
            'creator'                       => $creator
        ],
    );
       
    }
 
}