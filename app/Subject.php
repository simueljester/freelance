<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    protected $table = 'subjects';
    
    protected $fillable = [
        'id', 'name','course_code','description','academic_year_id'
    ];

    public function activeAcademicYear()
    {
        return $this->belongsTo('App\AcademicYear', 'academic_year_id', 'id');
    }
}
