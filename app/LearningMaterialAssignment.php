<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LearningMaterialAssignment extends Model
{
    //
    protected $table = 'learning_material_assignments';

    protected $fillable = [
        'learning_material_id', 'user_id','group_id','group_assignment_id','user_instance_id','score','status'
    ];

    public function learning_material()
    {
        return $this->belongsTo('App\LearningMaterial', 'learning_material_id', 'id');
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

    public function user_instance()
    {
        return $this->belongsTo('App\UserInstance', 'user_instance_id', 'id');
    }
}
