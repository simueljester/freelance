<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    //
    protected $table = 'discussions';

    protected $fillable = [
        'name', 'description','attachment','total_score','group_id','group_module_id','creator','user_instance_id'
    ];

    public function group()
    {
        return $this->belongsTo('App\Group', 'group_id', 'id');
    }


    public function groupModule()
    {
        return $this->belongsTo('App\GroupModule', 'group_module_id', 'id');
    }

    public function creator()
    {
        return $this->belongsTo('App\User', 'creator', 'id');
    }


}
