<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupInstructorAssignments extends Model
{
    //
    protected $table = 'group_instructor_assignments';

    protected $fillable = [
        'instructor_id','instructor_instance_id','group_id','subject_id','academic_year_id' 
    ];

    public function group()
    {
        return $this->belongsTo('App\Group', 'group_id');
    }

    public function instuctor()
    {
        return $this->belongsTo('App\User', 'instructor_id');
    }

}
