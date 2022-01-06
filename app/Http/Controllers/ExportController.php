<?php

namespace App\Http\Controllers;

use Excel;
use App\User;
use App\Group;
use App\Login;
use App\Section;
use App\Subject;
use App\Question;
use App\SystemLog;
use App\Department;
use App\UserActivity;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Exports\GroupsExport;
use App\Exports\QuestionExport;
use App\Exports\SectionsExport;
use App\Exports\SubjectsExport;
use App\Exports\SystemLogExport;
use App\Exports\DepartmentsExport;
use App\Exports\LoginReportExport;
use App\Exports\UserActivitiesExport;

class ExportController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('admin.exports.index');
    }

    public function subjects(){

        $data = Subject::with('activeAcademicYear')->get();
        return Excel::download(new SubjectsExport($data), 'CoursesRecord.xlsx');

    }

    public function departments(){

        $data = Department::with('activeAcademicYear')->get();
        return Excel::download(new DepartmentsExport($data), 'DepartmentRecord.xlsx');

    }

    public function sections(){

        $data = Section::with('activeAcademicYear','department')->get();
        return Excel::download(new SectionsExport($data), 'SectionRecord.xlsx');

    }

    public function users(){

        $data = User::with('user_instance.role')->get();
      
        return Excel::download(new UsersExport($data), 'Users.xlsx');
    }

    public function groups(){

        $data = Group::with('user_creator','members.user','subject','user_creator_instance.academicYear')->get();
        return Excel::download(new GroupsExport($data), 'Classes.xlsx');

    }

    public function questionBank(){

        $data = Question::with('user_creator','subject')->get();
        return Excel::download(new QuestionExport($data), 'Questions.xlsx');

    }

    public function loginReport(){

        $data = Login::with('user','user_instance.role')->get();
        return Excel::download(new LoginReportExport($data), 'LoginReport.xlsx');

    }

    public function systemLogs(){

        $data = SystemLog::with('user')->get();
        return Excel::download(new SystemLogExport($data), 'SystemLogs.xlsx');

    }

    public function userActivities(){

        $data = UserActivity::with('user','group')->get();
        return Excel::download(new UserActivitiesExport($data), 'UserActivities.xlsx');

    }

    

}
