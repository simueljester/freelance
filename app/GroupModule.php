<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupModule extends Model
{
    //
    protected $table = 'group_modules';

    protected $fillable = [
        'module_type', 'module_specific_id','group_id','user_id','user_instance_id','folder_id','visibility'
    ];

    public function exam()
    {
        return $this->hasOne('App\Exam', 'id','module_specific_id');
    }
    public function discussion()
    {
        return $this->hasOne('App\Discussion', 'id','module_specific_id');
    }

    public function group()
    {
        return $this->belongsTo('App\Group', 'group_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function user_instance()
    {
        return $this->belongsTo('App\UserInstance', 'user_instance_id', 'id');
    }

    public function folder() {
        return $this->belongsTo('App\Folder','folder_id') ;
    }

    

}
