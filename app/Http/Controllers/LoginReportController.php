<?php

namespace App\Http\Controllers;

use App\Login;
use Illuminate\Http\Request;

class LoginReportController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {   
       
        if($request->start_date && $request->end_date){
            $request->validate([
                'start_date'    => 'date',
                'end_date'      => 'date|after_or_equal:start_date'
            ]);
        }
      
        $start_date = $request->start_date ?? null;
        $end_date = $request->end_date ?? null;

        $logins = Login::with('user','user_instance.role')
        ->when($start_date, function ($query) use($start_date, $end_date) {
            $query->where('date', '>=', $start_date)->where('date', '<=', $end_date);
        })
        ->orderBy('created_at','DESC')
        ->paginate(50);

        return view('admin.login.index',compact('logins','start_date','end_date'));
    }
}
