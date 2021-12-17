<?php

namespace App\Http\Controllers;

use Session;
use App\User;
use App\Department;
use App\AcademicYear;
use App\Mail\MyTestMail;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;


use Illuminate\Support\Facades\Crypt;
use App\Http\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;
use App\Http\Repositories\SectionRepository;
use App\Http\Repositories\DepartmentRepository;
use App\Http\Repositories\AcademicYearRepository;
use App\Http\Repositories\UserInstanceRepository;

class UserController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(Request $request){

        $keyword = $request->keyword;
        $role = $request->role;
        // $users = app(UserRepository::class)->getUserWithInstance();
        $users =  $users = User::with('user_instance.role','user_instance.section','user_instance.department')->orderBy('last_name','ASC')
        ->when($keyword, function ($query) use ($keyword) {
            $query->where('first_name', 'like', '%' . $keyword . '%')
            ->orWhere('last_name', 'like', '%' . $keyword . '%')
            ->orWhere('student_id', 'like', '%' . $keyword . '%')
            ->orWhere('email', 'like', '%' . $keyword . '%');
        })
        ->when($role, function ($query) use ($role) {
            $query->whereHas('user_instance', function($q) use ($role){
                $q->where('role_id', $role);
            });
        })
        ->get();

      
        return view('user-management.index',compact('users','keyword','role'));
    }

    public function create(){
       
        $active_ac_id = app(AcademicYearRepository::class)->getActiveAcademicYear()->id;
        $departments = app(DepartmentRepository::class)->query()->with('activeAcademicYear')->whereAcademicYearId($active_ac_id)->get();
        return view('user-management.create',compact('departments'));
    }
    
    public function saveUser(Request $request){
        
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'birthday' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required|min:10',
            'department' => 'required',
            'section' => 'required_if:role,3',
            'student_id' => 'required_if:role,3'
        ]);

        $user_data = [
            'first_name'        => $request->first_name,
            'last_name'         => $request->last_name,
            'name'              => $request->first_name .' '.$request->last_name,
            'email'             => $request->email,
            'password'          =>  Hash::make($request->password),
            'address'           => $request->address,
            'birthday'          => $request->birthday,
            'student_id'        => $request->student_id
        ];
        $saved_user_data = app(UserRepository::class)->save($user_data);
        
        $user_instance_data = [
            'user_id'           => $saved_user_data->id,
            'role_id'           => $request->role,
            'active'            =>  1,
            'academic_year_id'  => AcademicYear::whereActive(1)->first()->id,
            'department_id'        => $request->department,
            'section_id'        => $request->role == 3 ? $request->section : 0,

        ];
        $saved_user_instances_data = app(UserInstanceRepository::class)->save($user_instance_data);

        if($saved_user_data && $saved_user_instances_data){
            $this->sendEmail($saved_user_data,$request->password);
        }

        return redirect()->route('user-management.index')->with('success', 'User successfully saved');
    
    }

    public function edit(User $user){

        $active_ac_id = app(AcademicYearRepository::class)->getActiveAcademicYear()->id;
        $departments = app(DepartmentRepository::class)->query()->with('activeAcademicYear')->whereAcademicYearId($active_ac_id)->get();
        return view('user-management.edit',compact('user','departments'));

    }

    public function update(Request $request){

        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'birthday'      => 'required',
            'address'       => 'required',
            'department' => 'required',
            'section' => 'required_if:role,3'
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
            $request->validate([
                'password' => 'required|min:10'
            ]);
            $user_data['password'] = Hash::make($request->password);
        }

        $saved_user_data = app(UserRepository::class)->update($request->user_id,$user_data);

        if($request->department || $request->section){
            $user_instance_data = [
                'department_id' => $request->department,
                'section_id' => $request->section
            ];

            $saved_user_data = app(UserInstanceRepository::class)->update($saved_user_data->user_instance->id,$user_instance_data);
        }

        return redirect()->route('user-management.index')->with('success', 'User successfully updated');

    }

    public function delete(Request $request){
  
        app(UserRepository::class)->delete($request->id_to_delete);
        return redirect()->route('user-management.index')->with('success', 'User successfully deleted');

    }

    public function batchUpload(Request $request){
     

        $request->validate([
            'file'=> 'required|mimes:xlsx,xls'
        ]);

        //convert excel file into array
        $rows = Excel::toArray(new UsersImport, $request->file('file'));
        $uploaded_users = $rows[0];
        $existing_emails = [];
        $existing_student_id = [];

        foreach($uploaded_users as $user){
            $existing_emails[] = User::whereEmail($user['email'])->first()->email ?? null;
            $existing_student_id[] = User::whereStudentId($user['student_id'])->first()->student_id ?? null;
        }
    

        $existing_emails = array_filter($existing_emails);
     
        $existing_student_id = array_filter($existing_student_id);
       
        //validate each field 
        Validator::make($uploaded_users, [
            '*.first_name'   => 'required',
            '*.last_name'    => 'required',
            '*.email'        => 'required',
            '*.role'         => 'required|in:student,teacher'
        ])->validate();

        return view('user-management.check-uploads',compact('uploaded_users','existing_emails','existing_student_id'));
        
    }

    public function saveBatchUpload(Request $request){
        
        $uploaded_users = json_decode($request->uploaded_users);
     
        $data = app(UserRepository::class)->saveBatch($uploaded_users);
           
        return redirect()->route('user-management.index')->with('success', 'Users successfully uploaded');

    }


    public function sendEmail($saved_user_data,$password){

        $details = [
            'title' => 'Mail from Letran Calamba LMS',
            'body' => 'Welcome '. $saved_user_data->name.' to <strong> Letran Calamba Learning Management System </strong> ! <br> 
            You may now start your learning experience and login to your account <br> 
            <ul>
                <li> Email Address: '.$saved_user_data->email.' </li>
                <li> Password: '. $password. ' </li>
            </ul>
            <br>
            <a href="http://letrancalamba-lms.tech/"> Login Here </a>
            '
        ];
       
        \Mail::to($saved_user_data->email)->send(new \App\Mail\MyTestMail($details));
       
    }

    public function fetchSection(Department $department){
        $sections = app(SectionRepository::class)->query()->whereDepartmentId($department->id)->get();
        return response()->json([
            'sections' => $sections
        ]);

    }

  

}
