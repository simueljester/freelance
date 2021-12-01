<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionExamAssignment extends Model
{
    //
    protected $table = 'question_exam_assignments';

    protected $fillable = [
        'exam_id', 'question_id','level'
    ];

    public function question()
    {
        return $this->belongsTo('App\Question', 'question_id', 'id');
    }
}
