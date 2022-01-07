<?php

namespace App\Http\Controllers;

use Auth;
use App\Exam;
use App\Group;
use App\Folder;
use App\GroupModule;
use Illuminate\Http\Request;
use App\Http\Repositories\QuestionAssignmentRepository;

class GroupModuleController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function toogleVisibility(GroupModule $group_module){
       
        $group_module->visibility = $group_module->visibility == 1 ? 0 : 1;
        $group_module->save();
        return redirect()->back()->with('success', 'Module visibility updated');
    }

 
}
