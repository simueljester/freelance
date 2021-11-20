<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    //
    protected $table = 'exam';

    protected $fillable = [
        'name', 'description','creator','group_id','duration'
    ];

    public function group()
    {
        return $this->belongsTo('App\Group', 'group_id', 'id');
    }
}
