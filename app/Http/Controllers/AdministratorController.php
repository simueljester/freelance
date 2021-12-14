<?php

namespace App\Http\Controllers;

use App\User;
use App\AcademicYear;
use App\UserInstance;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $academic_years = AcademicYear::all();
        return view('admin.index',compact('academic_years'));
    }

    // public function saveAcademicYear(Request $request){

    //     $save_acad = new AcademicYear;
    //     $save_acad->name = $request->name;
    //     $save_acad->year = $request->year;
    //     $save_acad->semester = $request->semester;
    //     $save_acad->save();
    //     return redirect()->back()->with('success', 'Academic year successfully created');
    // }

    // public function changeAcadmicActive(AcademicYear $academic_year){

    //   AcademicYear::where('active', 1)->update(['active' => 0]);
    //   $academic_year->active = 1;
    //   $academic_year->save();

    //   $existing_users = User::all();

    //   foreach($existing_users as $user){
    //     if($user->id != 1){
    //       UserInstance::whereUserId($user->id)->update(['active' => 0]);
    //       UserInstance::updateOrCreate([
    //         'academic_year_id'  => $academic_year->id,
    //         'user_id'           => $user->id,
         
    //       ],
    //       [
    //         'role_id'           => UserInstance::whereUserId($user->id)->orderBy('created_at','desc')->first()->role_id ?? 3,
    //         'active' => 1
    //       ]);

    //     }
    //   }
    

    //   return redirect()->back()->with('success', 'Academic year successfully updated');

    // }


}
