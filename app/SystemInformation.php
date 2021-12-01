<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemInformation extends Model
{
    //
    protected $table = 'system_information';
    
    protected $fillable = [
        'id', 'title','logo'
    ];
}
