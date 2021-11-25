<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
 
    protected $table = 'folders';

    protected $fillable = [
        'name','parent_id','group_id'
    ];
    
    public function group()
    {
        return $this->belongsTo('App\Group', 'group_id');
    }

    public function parent() {
        return $this->hasOne('App\Folder','id','parent_id') ;
    }

    
    public function recursiveParentFolders() {
        return $this->parent()->with('recursiveParentFolders');
    }

    public function childs() {
        return $this->hasMany('App\Folder','parent_id','id') ;
    }

    public function recursiveChildFolders() {
        return $this->childs()->with('recursiveChildFolders');
    }

    public function getRoot(){
        $cur = $this->parent();
        while ($cur) {
            $cur = $cur->parent();
        }
        return $cur;
    }


}
