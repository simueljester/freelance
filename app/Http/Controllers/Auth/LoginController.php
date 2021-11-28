<?php

namespace App\Http\Controllers\Auth;

use DateTime;
use App\Login;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated() {
        $dt = new DateTime();
        $server = \Request::server();
        $useragent = $server['HTTP_USER_AGENT'];
        $ip_address = \Request::ip();
        
        $save_login = new Login;
        $save_login->user_id = Auth::user()->id;
        $save_login->user_instance_id = Auth::user()->user_instance->id;
        $save_login->date = $dt->format('Y-m-d');
        $save_login->time = $dt->format('H:i:s');
        $save_login->ip_address = $ip_address;
        $save_login->user_agent = $useragent;
        $save_login->last_activity_at = now();
        $save_login->save();

        Session::put('login_session_id', $save_login->id);
    }
}
