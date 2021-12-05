<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscussionAssignment extends Model
{
    //
    protected $table = 'discussion_assignments';

    protected $fillable = [
        'discussion_id', 'user_id','group_id','group_assignment_id','user_instance_id','score','status'
    ];

    public function discussion()
    {
        return $this->belongsTo('App\Discussion', 'discussion_id', 'id');
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

    public function user_instance()
    {
        return $this->belongsTo('App\UserInstance', 'user_instance_id', 'id');
    }

    // public function user_answers()
    // {
    //     return $this->HasMany('App\ExamAnswers', 'exam_assignment_id', 'id');
    // }

    // public function webShots()
    // {
    //     return $this->HasMany('App\ExamAssignmentWebShot', 'exam_assignment_id', 'id');
    // }
}
