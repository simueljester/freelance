<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $table = 'questions';

    protected $fillable = [
        'instruction', 
        'question_type',
        'option_1',
        'option_2',
        'option_3',
        'option_4',
        'option_5',
        'option_6',
        'answer',
        'max_points',
        'case_sensitive',
        'attachment',
        'creator',
        'subject_id',
        'level',
        'academic_year_id'
    ];

    public function user_creator()
    {
        return $this->belongsTo('App\User', 'creator', 'id');
    }

    public function subject()
    {
        return $this->belongsTo('App\Subject', 'subject_id', 'id');
    }
}
