<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    //
    protected $table = 'logins';

    protected $fillable = [
        'user_id', 'user_instance_id','date','time','ip_address','user_agent','last_activity_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function user_instance()
    {
        return $this->belongsTo('App\UserInstance', 'user_instance_id', 'id');
    }
}
