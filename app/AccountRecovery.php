<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountRecovery extends Model
{
    //
    protected $table = 'account_recovery';

    protected $fillable = [
        'user_id', 'user_instance_id','email','otp','status'
    ];
}
