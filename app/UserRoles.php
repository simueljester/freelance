<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
    //
    protected $table = 'user_roles';
    protected $fillable = [
        'id', 'role'
    ];

    
}
