<?php

namespace App\Http\Controllers;

use App\User;
use App\AccountRecovery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

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
                'title' => 'Account Recovery',
                'body' =>   'Hi <strong>' .$user->first_name.' </strong>,
                            <br> <br>
                            We received that you forgot your TakeToQ account password, to recover your account, use this generated OTP to create a new password. This is your generated OTP <strong> '.$generated_otp.' </strong> 
                            <br> <br> 
                            You will be redirected to Password Update Form
                            <br> <br> 
                            Regards
                            '    
            ];
           
            \Mail::to($user->email)->send(new \App\Mail\MyTestMail($details));

            return view('password-update');

        }else{
            return redirect()->back()->with('error', 'User account does not exist');
        }
    }

    public function updatePassword(Request $request){
      
        $otp = AccountRecovery::whereOtp($request->otp)->first() ?? null;
      

        if($otp){
            $user_account = User::find($otp->user_id);

            if($request->password == $request->confirm_password){

                $user_account->password = Hash::make($request->password);
                $user_account->save();

                $otp->status = 1; //used
                $otp->save();

                return redirect()->route('login')->with('success', 'Password successfully updated.');

            }else{

                return redirect()->route('login')->with('error', 'Password not match, OTP is now expired.');

            }
        }else{
            return redirect()->route('login')->with('error', 'OTP does not exist and now expired.');
            
            $otp->save();
        }
    }
}
