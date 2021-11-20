<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    protected $fillable = [
        'name', 'description','creator_id'
    ];

    public function user_creator()
    {
        return $this->belongsTo('App\User', 'creator_id', 'id');
    }

    public function members()
    {
        return $this->HasMany('App\GroupAssignment', 'group_id', 'id');
    }
    
}
