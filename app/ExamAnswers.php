<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamAnswers extends Model
{
    //
    protected $table = 'exam_answers';

    protected $fillable = [
        'exam_id', 'exam_assignment_id','question_id','group_id','user_id','user_instance_id','points','user_answer'
    ];

    public function exam()
    {
        return $this->belongsTo('App\Exam', 'exam_id', 'id');
    }

    public function examAssignment()
    {
        return $this->belongsTo('App\ExamAssignment', 'exam_assignment_id', 'id');
    }

    public function question()
    {
        return $this->belongsTo('App\Question', 'question_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo('App\Group', 'group_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function user_instance()
    {
        return $this->belongsTo('App\UserInstance', 'user_instance_id', 'id');
    }
}
