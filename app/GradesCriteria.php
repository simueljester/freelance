<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GradesCriteria extends Model
{
    //
    protected $table = 'grades_criteria';

    protected $fillable = [
        'title','max_points','percentage_equivalent'
    ];
}
