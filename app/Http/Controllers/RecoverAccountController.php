<?php

namespace App\Http\Controllers;

use App\User;
use App\AccountRecovery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RecoverAccountController extends Controller
{
    //
    public function recoverAccount(Request $request){

        $user = User::with('user_instance')->whereEmail($request->email)->first() ?? null;

        if($user){
            
            $length = 6;    
            $generated_otp = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
      
            $otp = New AccountRecovery;
            $otp->user_id = $user->id;
            $otp->user_instance_id = $user->user_instance->id;
            $otp->email = $user->email;
            $otp->otp = $generated_otp;
            $otp->status = 0;
            $otp->save();

            $details = [
                'title' => 'OTP',
                'body' => 'This is your OTP '.$generated_otp
             
            ];
           
            \Mail::to($user->email)->send(new \App\Mail\MyTestMail($details));

        }else{
            return redirect()->back()->with('error', 'User email does not exist');
        }
    }
}
