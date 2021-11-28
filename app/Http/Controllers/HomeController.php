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
use Illuminate\Http\Request;
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
    public function index()
    {
        if(Auth::user()->user_instance->role_id == 1){

            $group_count = Group::count();
            $user_count = User::count();
            $subject_count = Subject::count();
            $question_count = Question::count();

            
            $begin = Carbon::parse('2021-11-28')->startOfWeek();
            $end = Carbon::parse('2021-11-28')->endOfWeek();
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

          
          
            return view('home',compact('group_count','user_count','subject_count','question_count','login_count'));
        }else{
            return 'development';
        }
     
    }
}
