<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    protected $fillable = [
        'name', 'description','creator_id','subject_id','creator_instance_id','academic_year_id','section_id'
    ];

    public function user_creator()
    {
        return $this->belongsTo('App\User', 'creator_id', 'id');
    }

    public function user_creator_instance()
    {
        return $this->belongsTo('App\UserInstance', 'creator_instance_id', 'id');
    }

    public function members()
    {
        return $this->HasMany('App\GroupAssignment', 'group_id', 'id');
    }

    public function subject()
    {
        return $this->belongsTo('App\Subject', 'subject_id', 'id');
    }

    public function activeAcademicYear()
    {
        return $this->belongsTo('App\AcademicYear', 'academic_year_id', 'id');
    }

    public function section()
    {
        return $this->belongsTo('App\Section', 'section_id', 'id');
    }
    
}
