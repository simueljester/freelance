<?php

namespace App\Http\Controllers;

use App\User;
use DateTime;
use App\Group;
use App\Login;
use DatePeriod;
use App\Subject;
use App\Question;
use DateInterval;
use Carbon\Carbon;
use App\GroupModule;
use App\ExamAssignment;
use App\LinkAssignment;
use App\GroupAssignment;
use Illuminate\Http\Request;
use App\DiscussionAssignment;
use App\LearningMaterialAssignment;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        //dashboard admin
        if(Auth::user()->user_instance->role_id == 1){

            $group_count = Group::count();
            $user_count = User::count();
            $subject_count = Subject::count();
            $question_count = Question::count();

            if($request->date){
                $date = $request->date;
            }else{
                $date = Carbon::now()->format('Y-m-d');
            }
       
            $begin = Carbon::parse($date)->startOfWeek();
            $end = Carbon::parse($date)->endOfWeek();
            $interval = DateInterval::createFromDateString('1 day');
            $period = new DatePeriod($begin, $interval, $end);
            $logins = Login::whereBetween('date', [$begin, $end])->get()->toArray();
         
            foreach ($period as $dt) {
                $date = $dt->format("Y-m-d");
                $date_format = $dt->format('M-d-Y');
                $count = array_filter($logins, function ($item) use($date) {
                    return $item["date"] == $date;
                });
                
                $login_count[] = [
                    'count' => count($count),
                    'date'  => $date_format,
                ];
            } 
          
            return view('home',compact('group_count','user_count','subject_count','question_count','login_count','date'));
        }

        //dashboard teacher
        if(Auth::user()->user_instance->role_id == 2){
            $group_count = Group::whereCreatorId(Auth::user()->id)->whereCreatorInstanceId(Auth::user()->user_instance->id)->count();
            $module_count = GroupModule::whereUserId(Auth::user()->id)->whereUserInstanceId(Auth::user()->user_instance->id)->count();
            $question_count = Question::whereCreator(Auth::user()->id)->count();
            $recently_created_questions = Question::with('subject')->whereCreator(Auth::user()->id)->orderBy('created_at','DESC')->get();
            return view('home-teacher',compact('group_count','question_count','module_count','recently_created_questions'));
        }


        //dashboard teacher
        if(Auth::user()->user_instance->role_id == 3){
            $my_group_assignments = GroupAssignment::with('group')->whereUserId(Auth::user()->id)->whereUserInstanceId(Auth::user()->user_instance->id)->get();

            $all_modules = collect();
       
            $exam_assignments = ExamAssignment::with('exam.group')->whereUserId(Auth::user()->id)->whereUserInstanceId(Auth::user()->user_instance->id)->get();
            $discussion_assignments = DiscussionAssignment::with('discussion.group')->whereUserId(Auth::user()->id)->whereUserInstanceId(Auth::user()->user_instance->id)->get();
            $learning_assignments = LearningMaterialAssignment::with('learning_material.group')->whereUserId(Auth::user()->id)->whereUserInstanceId(Auth::user()->user_instance->id)->get();
            $link_assignments = LinkAssignment::with('link.group')->whereUserId(Auth::user()->id)->whereUserInstanceId(Auth::user()->user_instance->id)->get();
            
            $all_modules =  $all_modules->merge($exam_assignments);
            $all_modules =  $all_modules->merge($discussion_assignments);
            $all_modules =  $all_modules->merge($learning_assignments);
            $all_modules =  $all_modules->merge($link_assignments);

            // dd($all_modules);
            return view('home-student',compact('my_group_assignments','all_modules'));
        }
     
    }
}
