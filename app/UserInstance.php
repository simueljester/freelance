<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class UserInstance extends Model
{
    //
    protected $table = 'user_instances';
    
    protected $fillable = [
        'id', 'user_id','role_id','active'
    ];

    public function role()
    {
        return $this->belongsTo('App\UserRoles', 'role_id');
    }

    

}
