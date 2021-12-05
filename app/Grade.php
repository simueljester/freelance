<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    //
    protected $table = 'grades';

    protected $fillable = [
        'term', 
        'long_quiz_input',
        'long_quiz_score',
        'long_quiz_percentage',
        'long_quiz_final',

        'short_quiz_input',
        'short_quiz_score',
        'short_quiz_percentage',
        'short_quiz_final',

        'assessment_task_input',
        'assessment_task_score',
        'assessment_task_percentage',
        'assessment_task_final',

        'major_examination_input',
        'major_examination_score',
        'major_examination_percentage',
        'major_examination_final',

        'final_grade',
        'user_id',
        'user_instance_id',
        'group_id',
        'group_assignment_id',
        'creator'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    
    public function user_instance()
    {
        return $this->belongsTo('App\UserInstance', 'user_instance_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo('App\Group', 'group_id', 'id');
    }

    public function groupAssignment()
    {
        return $this->belongsTo('App\GroupAssignment', 'group_assignment_id', 'id');
    }

    public function user_creator()
    {
        return $this->belongsTo('App\User', 'creator', 'id');
    }

}
