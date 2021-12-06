<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class UserInstance extends Model
{
    //
    protected $table = 'user_instances';
    
    protected $fillable = [
        'id', 'user_id','role_id','active','academic_year_id'
    ];

    public function role()
    {
        return $this->belongsTo('App\UserRoles', 'role_id');
    }


    public function academicYear()
    {
        return $this->belongsTo('App\AcademicYear', 'academic_year_id');
    }
    

}
