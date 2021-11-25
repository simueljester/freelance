<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamAssignment extends Model
{
    //
    protected $table = 'exam_assignments';

    protected $fillable = [
        'exam_id', 'user_id','group_id','group_assignment_id','duration','score','status'
    ];

    public function exam()
    {
        return $this->belongsTo('App\Exam', 'exam_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo('App\Group', 'group_id', 'id');
    }

    public function groupAssignment()
    {
        return $this->belongsTo('App\GroupAssignment', 'group_assignment_id', 'id');
    }

    public function user_answers()
    {
        return $this->HasMany('App\ExamAnswers', 'exam_assignment_id', 'id');
    }

    public function webShots()
    {
        return $this->HasMany('App\ExamAssignmentWebShot', 'exam_assignment_id', 'id');
    }
}
