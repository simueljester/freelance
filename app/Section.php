<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    protected $table = 'sections';
    
    protected $fillable = [
        'id', 'name','description','academic_year_id','department_id'
    ];

    public function activeAcademicYear()
    {
        return $this->belongsTo('App\AcademicYear', 'academic_year_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo('App\Department', 'department_id', 'id');
    }

    public function user_instances()
    {
        return $this->HasMany('App\UserInstance', 'section_id', 'id');
    }
}
