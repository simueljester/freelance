<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemLog extends Model
{
    //
    protected $table = 'system_logs';
    
    protected $fillable = [
        'date', 'time' ,'model','function', 'data' ,'details','user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
