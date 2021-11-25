<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    //
    protected $table = 'exam';

    protected $fillable = [
        'name', 'description','creator','group_id','duration','group_module_id','user_instance_id'
    ];

    public function group()
    {
        return $this->belongsTo('App\Group', 'group_id', 'id');
    }

    public function questionAssignments()
    {
        return $this->HasMany('App\QuestionExamAssignment', 'exam_id', 'id');
    }

    
    public function groupModule()
    {
        return $this->belongsTo('App\GroupModule', 'group_module_id', 'id');
    }
}
