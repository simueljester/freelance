<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupAssignment extends Model
{
    //
    protected $table = 'group_assignments';

    protected $fillable = [
        'group_id', 'user_id','user_instance_id'
    ];

    public function group()
    {
        return $this->belongsTo('App\Group', 'group_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

 

}
