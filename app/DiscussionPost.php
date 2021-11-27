<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscussionPost extends Model
{
    //
    protected $table = 'discussion_posts';

    protected $fillable = [
        'description','attachment','discussion_id', 'user_id','user_instance_id'
    ];

    public function discussion()
    {
        return $this->belongsTo('App\Discussion', 'discussion_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function user_instance()
    {
        return $this->belongsTo('App\UserInstance', 'user_instance_id', 'id');
    }
}
