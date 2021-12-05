<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    //
    protected $table = 'academic_years';

    protected $fillable = [
        'name', 'year','semester','active'
    ];

}
