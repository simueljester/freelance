<?php

namespace App\Http\Controllers;

use Auth;
use App\Exam;
use App\Group;
use App\Folder;
use Illuminate\Http\Request;
use App\Http\Repositories\QuestionAssignmentRepository;

class GroupModuleController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }


 
}
