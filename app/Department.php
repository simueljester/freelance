<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    protected $table = 'departments';
    
    protected $fillable = [
        'id', 'name','description','academic_year_id'
    ];

    public function activeAcademicYear()
    {
        return $this->belongsTo('App\AcademicYear', 'academic_year_id', 'id');
    }


    public function sections()
    {
        return $this->HasMany('App\Section', 'department_id', 'id');
    }
}
