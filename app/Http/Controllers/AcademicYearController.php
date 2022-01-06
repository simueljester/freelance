<?php

namespace App\Http\Controllers;

use App\User;
use App\AcademicYear;
use App\UserInstance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class AcademicYearController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        
        $tab = $request->tab ?? 'current';
        if($tab == 'current'){
          $academic_years = AcademicYear::whereArchivedAt(null)->get();
        }
        if($tab == 'archive'){
          $academic_years = AcademicYear::whereNotNull('archived_at')->get();
        }
   
        $active_academic_year = AcademicYear::whereActive(1)->first();
        return view('school-management.academic-year.index',compact('academic_years','tab','active_academic_year'));
    }

    public function saveAcademicYear(Request $request){

        $request->validate([
          'name' => 'required|unique:academic_years'
        ]);
        
        $save_acad = new AcademicYear;
        $save_acad->name = $request->name;
        $save_acad->year = $request->year;
        $save_acad->semester = $request->semester;
        $save_acad->save();
        return redirect()->back()->with('success', 'Academic year successfully created');
    }

    public function changeAcadmicActive(AcademicYear $academic_year){

        AcademicYear::where('active', 1)->update(['active' => 0]);
        $academic_year->active = 1;
        $academic_year->save();
  
        $existing_users = User::all();
  
        foreach($existing_users as $user){
          if($user->id != 1){
            UserInstance::whereUserId($user->id)->update(['active' => 0]);
            UserInstance::updateOrCreate([
              'academic_year_id'  => $academic_year->id,
              'user_id'           => $user->id,
           
            ],
            [
              'role_id'           => UserInstance::whereUserId($user->id)->orderBy('created_at','desc')->first()->role_id ?? 3,
              'active' => 1
            ]);
  
          }
        }
      
  
        return redirect()->back()->with('success', 'Academic year successfully updated');
  
      }

      public function archiveAcademicYear(Request $request){
        $academic_year = AcademicYear::find($request->ac_id);
        $academic_year->archived_at = now();
        $academic_year->save();
        return redirect()->back()->with('success', 'Academic year successfully archived');
      }

      public function restoreAcademicYear(Request $request){
        $academic_year = AcademicYear::find($request->ac_id);
        $academic_year->archived_at = null;
        $academic_year->save();
        return redirect()->back()->with('success', 'Academic year successfully restored');
      }

      

}
