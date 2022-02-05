<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LearningMaterial extends Model
{
    //
    protected $table = 'learning_materials';

    protected $fillable = [
        'name', 'description','file','group_id','group_module_id','creator','user_instance_id','accessible_at','expired_at'
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
