<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class UserInstance extends Model
{
    //
    protected $table = 'user_instances';
    
    protected $fillable = [
        'id', 'user_id','role_id','active','academic_year_id','section_id','department_id'
    ];

    public function role()
    {
        return $this->belongsTo('App\UserRoles', 'role_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }


    public function academicYear()
    {
        return $this->belongsTo('App\AcademicYear', 'academic_year_id');
    }

    public function department()
    {
        return $this->belongsTo('App\Department', 'department_id');
    }

    public function section()
    {
        return $this->belongsTo('App\Section', 'section_id');
    }
    

}
