<?php

namespace App\Http\Middleware;

use Closure;
use App\Login;
use Session;
use Auth;

class LastActivityAt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $id =  Session::get('login_session_id');
        $login = Login::find($id) ?? null;
        if($login){
            if(Auth::check()){
                $login->last_activity_at = now();
                $login->save();  
            }
        }else{
            Auth::logout();
        }
    

        return $next($request);
    }
}
