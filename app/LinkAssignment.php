<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinkAssignment extends Model
{
    //
    protected $table = 'link_assignments';

    protected $fillable = [
        'link_id', 'user_id','group_id','group_assignment_id','score','status'
    ];

    public function link()
    {
        return $this->belongsTo('App\Link', 'link_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo('App\Group', 'group_id', 'id');
    }

    public function groupAssignment()
    {
        return $this->belongsTo('App\GroupAssignment', 'group_assignment_id', 'id');
    }
}
