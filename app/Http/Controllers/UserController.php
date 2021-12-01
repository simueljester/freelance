<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Repositories\UserRepository;
use App\Http\Repositories\UserInstanceRepository;

class UserController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){

        $users = app(UserRepository::class)->getUserWithInstance();
        return view('user-management.index',compact('users'));
    }

    public function create(){
        return view('user-management.create');
    }
    
    public function saveUser(Request $request){
        
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'birthday' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required'
        ]);

        $user_data = [
            'first_name'        => $request->first_name,
            'last_name'         => $request->last_name,
            'name'              => $request->first_name .' '.$request->last_name,
            'email'             => $request->email,
            'password'          =>  Hash::make($request->password),
            'address'           => $request->address,
            'birthday'          => $request->birthday,
        ];
        $saved_user_data = app(UserRepository::class)->save($user_data);
        
        $user_instance_data = [
            'user_id'       => $saved_user_data->id,
            'role_id'       => $request->role,
            'active'        =>  1
        ];
        $saved_user_instances_data = app(UserInstanceRepository::class)->save($user_instance_data);

        return redirect()->route('user-management.index')->with('success', 'User successfully saved');
    
    }

    public function edit(User $user){

        return view('user-management.edit',compact('user'));

    }

    public function update(Request $request){

        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'birthday'      => 'required',
            'address'       => 'required',
        ]);

        $user_data = [
            'first_name'        => $request->first_name,
            'last_name'         => $request->last_name,
            'name'              => $request->first_name .' '.$request->last_name,
            'email'             => $request->email,
            'address'           => $request->address,
            'birthday'          => $request->birthday
        ];

        if($request->password != null){
            $user_data['password'] = Hash::make($request->password);
        }

        $saved_user_data = app(UserRepository::class)->update($request->user_id,$user_data);
        return redirect()->route('user-management.index')->with('success', 'User successfully updated');

    }

    public function delete(Request $request){
  
        app(UserRepository::class)->delete($request->id_to_delete);
        return redirect()->route('user-management.index')->with('success', 'User successfully deleted');

    }

}
