<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserActivity extends Model
{
    //
    protected $table = 'user_activities';
    protected $fillable = [
        'module_type', 'details','user_id','group_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function getCreatedAtAttribute($date){
        return Carbon::parse($date)->diffForHumans();
    }

 
        
}
