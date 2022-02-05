<?php

use Illuminate\Support\Facades\Artisan;

use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/check-send', function() {
 
    $data = array('name'=>"Virat Gandhi");
   
    Mail::send(['text'=>'mail'], $data, function($message) {
       $message->to('simueljester@gmail.com', 'Tutorials Point')->subject
          ('Laravel Basic Testing Mail');
       $message->from('jestercareer@gmail.com','Virat Gandhi');
    });
    echo "Basic Email Sent. Check your inbox.";
    

 });

 Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
   Artisan::call('config:clear');
   // return what you want
});


Route::get('/', function () {
    return redirect('login');
});
Route::get('/flush', function () {
    Session::flush();
});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//School Management
Route::group(['prefix' => 'school-management', 'as' => 'school-management.'], function() {
    Route::get('/',                 ['as' => 'index',       'uses' => 'SchoolManagementController@index']);

    Route::group(['prefix' => 'academic-year', 'as' => 'academic-year.'], function() {
        Route::get('/',                                         ['as' => 'index',                   'uses' => 'AcademicYearController@index']);
        Route::post('/save-academic-year',                      ['as' => 'save-academic-year',      'uses' => 'AcademicYearController@saveAcademicYear']);
        Route::get('/change-academic-active/{academic_year}',   ['as' => 'change-academic-active',  'uses' => 'AcademicYearController@changeAcadmicActive']);
        Route::post('/archive-academic-year',                   ['as' => 'archive-academic-year',      'uses' => 'AcademicYearController@archiveAcademicYear']);
        Route::post('/restore-academic-year',                   ['as' => 'restore-academic-year',      'uses' => 'AcademicYearController@restoreAcademicYear']);
    });

    Route::group(['prefix' => 'subjects', 'as' => 'subjects.'], function() {
        Route::get('/',                 ['as' => 'index',       'uses' => 'SubjectController@index']);
        Route::get('/create',           ['as' => 'create',      'uses' => 'SubjectController@create']);
        Route::post('/save',            ['as' => 'save',        'uses' => 'SubjectController@save']);
        Route::get('/show/{subject}',   ['as' => 'show',        'uses' => 'SubjectController@show']);
        Route::post('/update',          ['as' => 'update',      'uses' => 'SubjectController@update']);
        Route::get('/delete/{subject}', ['as' => 'delete',      'uses' => 'SubjectController@delete']);
    });

    Route::group(['prefix' => 'sections', 'as' => 'sections.'], function() {
        Route::get('/',                 ['as' => 'index',       'uses' => 'SectionController@index']);
        Route::get('/create',           ['as' => 'create',      'uses' => 'SectionController@create']);
        Route::post('/save',            ['as' => 'save',        'uses' => 'SectionController@save']);
        Route::get('/show/{section}',   ['as' => 'show',        'uses' => 'SectionController@show']);
        Route::post('/update',          ['as' => 'update',      'uses' => 'SectionController@update']);
        Route::get('/delete/{section}', ['as' => 'delete',      'uses' => 'SectionController@delete']);
    });

    Route::group(['prefix' => 'departments', 'as' => 'departments.'], function() {
        Route::get('/',                     ['as' => 'index',       'uses' => 'DepartmentController@index']);
        Route::get('/create',               ['as' => 'create',      'uses' => 'DepartmentController@create']);
        Route::post('/save',                ['as' => 'save',        'uses' => 'DepartmentController@save']);
        Route::get('/show/{department}',    ['as' => 'show',        'uses' => 'DepartmentController@show']);
        Route::post('/update',              ['as' => 'update',      'uses' => 'DepartmentController@update']);
        Route::get('/delete/{department}',  ['as' => 'delete',      'uses' => 'DepartmentController@delete']);
    });

});



//Question Bank Routes
Route::group(['prefix' => 'question-bank', 'as' => 'question-bank.'], function() {
    Route::get('/',             ['as' => 'index',           'uses' => 'QuestionBankController@index']);
    Route::get('/my-questions', ['as' => 'my-questions',    'uses' => 'QuestionBankController@myQuestionBank']);

    Route::post('/batch-upload',        ['as' => 'batch-upload',            'uses' => 'QuestionBankController@batchUpload']);
    Route::post('/batch-upload-save',   ['as' => 'save-batch-upload',       'uses' => 'QuestionBankController@saveBatchUpload']);

    Route::group(['prefix' => 'create', 'as' => 'create.'], function() {
        Route::get('/mcq/{exam}',      ['as' => 'mcq',     'uses' => 'QuestionBankController@createMcq']);
        Route::get('/tf/{exam}',       ['as' => 'tf',      'uses' => 'QuestionBankController@createTf']);
        Route::get('/sa/{exam}',       ['as' => 'sa',      'uses' => 'QuestionBankController@createSa']);
        Route::get('/essay/{exam}',    ['as' => 'essay',   'uses' => 'QuestionBankController@createEssay']);
    });

    Route::post('/save',            ['as' => 'save',    'uses' => 'QuestionBankController@save']);
    Route::get('/show/{question}',  ['as' => 'show',    'uses' => 'QuestionBankController@show']);
    Route::get('/edit/{question}',  ['as' => 'edit',    'uses' => 'QuestionBankController@edit']);
    Route::post('/update',          ['as' => 'update',  'uses' => 'QuestionBankController@update']);
    Route::get('/delete/{question}',['as' => 'delete',  'uses' => 'QuestionBankController@delete']);

});

//Groups Routes
Route::group(['prefix' => 'groups', 'as' => 'groups.'], function() {
    Route::get('/',                                         ['as' => 'index',                   'uses' => 'GroupController@index']);
    Route::get('/create',                                   ['as' => 'create',                  'uses' => 'GroupController@create']);
    Route::post('/save',                                    ['as' => 'save',                    'uses' => 'GroupController@save']);
    Route::get('/edit/{group}',                             ['as' => 'edit',                    'uses' => 'GroupController@edit']);
    Route::post('/update',                                  ['as' => 'update',                  'uses' => 'GroupController@update']);
    Route::get('/show/{group}',                             ['as' => 'show',                    'uses' => 'GroupController@show']);
    Route::get('/view-user-exam-assignment/group/{group}/user/{user}',  ['as' => 'user-exam-assignments', 'uses' => 'GroupController@userExamAssignments']);
    Route::get('/show/folder/{folder}',                     ['as' => 'show-folder',             'uses' => 'GroupController@showFolder']);
    Route::get('/list/',                                    ['as' => 'list',                    'uses' => 'GroupController@list']);
    Route::get('/show-user-data/{group_assignment}',        ['as' => 'user-data',               'uses' => 'UserDataController@index']);
    Route::get('/get-user-activities',                      ['as' => 'get-user-activities',     'uses' => 'UserDataController@getActivities']);
    Route::get('/toogle-visibility/{group_module}',         ['as' => 'toogle-visibility',       'uses' => 'GroupModuleController@toogleVisibility']);


    Route::group(['prefix' => 'group-assignment', 'as' => 'group-assignment.'], function() {
        Route::get('/{group}',                  ['as' => 'index',           'uses' => 'GroupAssignmentController@index']);
        Route::get('/group/{group}/assignment', ['as' => 'assignment',      'uses' => 'GroupAssignmentController@assignment']);
        Route::post('/assign-users',            ['as' => 'assign-users',    'uses' => 'GroupAssignmentController@assignUsers']);
        Route::post('/unassign-users',          ['as' => 'unassign-users',  'uses' => 'GroupAssignmentController@unassignUsers']);
    });

    Route::group(['prefix' => 'user-group', 'as' => 'user-group.'], function() {
        Route::get('/',                                     ['as' => 'user-group',              'uses' => 'GroupController@userGroup']);

        Route::get('/list-exam/{group}',                    ['as' => 'list-exam',               'uses' => 'GroupController@listExam']);
        Route::get('/start-exam/{exam_assignment}',         ['as' => 'start-exam',              'uses' => 'ExaminationController@start']);
        Route::post('/save-exam',                           ['as' => 'save-exam',               'uses' => 'ExaminationController@saveFinishedExam']);
        Route::get('/view-exam-result/{exam_assignment}',   ['as' => 'view-exam-result',        'uses' => 'ExaminationController@viewExamResult']);
        Route::post('/exam/save-webshot',                   ['as' => 'save-webshot',            'uses' => 'WebshotController@save']);
    
        Route::get('/list-discussion/{group}',              ['as' => 'list-discussion',         'uses' => 'GroupController@listDiscussion']);
        Route::get('/start-discussion/{discussion}',        ['as' => 'start-discussion',        'uses' => 'DiscussionController@start']);
        Route::post('/save-discussion-post',                ['as' => 'save-discussion-post',    'uses' => 'DiscussionPostController@save']);

        Route::get('/list-learning-material/{group}',       ['as' => 'list-learning-material',  'uses' => 'GroupController@listLearningMaterial']);

        Route::get('/list-link/{group}',                    ['as' => 'list-link',               'uses' => 'GroupController@listLink']);
    
    
    });

    Route::group(['prefix' => 'exam', 'as' => 'exam.'], function() {
        Route::get('/group/{group}/folder/{folder}',    ['as' => 'create',              'uses' => 'ExaminationController@create']);
        Route::post('/save',                            ['as' => 'save',                'uses' => 'ExaminationController@save']);
        Route::get('/show/exam/{exam}',                 ['as' => 'show',                'uses' => 'ExaminationController@show']);
        Route::get('/edit/exam/{exam}',                 ['as' => 'edit',                'uses' => 'ExaminationController@edit']);
        Route::post('/update',                          ['as' => 'update',              'uses' => 'ExaminationController@update']);
        Route::get('/delete/{exam}',                    ['as' => 'delete',              'uses' => 'ExaminationController@delete']);
        Route::post('/override-score',                  ['as' => 'override',            'uses' => 'ExaminationController@override']);
        Route::get('/generate-pdf/{exam_assignment}',   ['as' => 'generate-pdf',        'uses' => 'ExaminationController@generatePdf']);
        

        Route::group(['prefix' => 'examination-assignment', 'as' => 'examination-assignment.'], function() {
            Route::get('/{exam}',               ['as' => 'index',               'uses' => 'QuestionAssignmentController@index']);
            Route::post('/assign-questions',    ['as' => 'assign-questions',    'uses' => 'QuestionAssignmentController@assignQuestions']);
            Route::post('/unassign-questions',  ['as' => 'unassign-questions',  'uses' => 'QuestionAssignmentController@unassignQuestions']);
        });

    });

    Route::group(['prefix' => 'class-grades', 'as' => 'class-grades.'], function() {
        Route::get('/group/{group}/',               ['as' => 'index',              'uses' => 'ClassGradesController@index']);
        Route::post('/save',                        ['as' => 'save',               'uses' => 'ClassGradesController@save']);
        Route::get('/show/grade/{grade}',           ['as' => 'show',               'uses' => 'ClassGradesController@show']);
        Route::get('/download-grades/{group}',      ['as' => 'download',           'uses' => 'ClassGradesController@downloadGrades']);

    });

    Route::group(['prefix' => 'discussion', 'as' => 'discussion.'], function() {
        Route::get('/group/{group}/folder/{folder}',            ['as' => 'create',          'uses' => 'DiscussionController@create']);
        Route::post('/save',                                    ['as' => 'save',            'uses' => 'DiscussionController@save']);
        Route::get('/show/discussion/{discussion}',             ['as' => 'show',            'uses' => 'DiscussionController@show']);
        Route::get('/edit/discussion/{discussion}',             ['as' => 'edit',            'uses' => 'DiscussionController@edit']);
        Route::post('/update',                                  ['as' => 'update',          'uses' => 'DiscussionController@update']);
        Route::get('/delete/{discussion}',                      ['as' => 'delete',          'uses' => 'DiscussionController@delete']);
        Route::post('/save-scores',                             ['as' => 'save-scores',     'uses' => 'DiscussionController@saveScores']);
        Route::get('/generate-pdf/{discussion}',                ['as' => 'generate-pdf',    'uses' => 'DiscussionController@generatePdf']);
    });

    Route::group(['prefix' => 'learning-material', 'as' => 'learning-material.'], function() {
        Route::get('/group/{group}/folder/{folder}',                ['as' => 'create',          'uses' => 'LearningMaterialController@create']);
        Route::post('/save',                                        ['as' => 'save',            'uses' => 'LearningMaterialController@save']);
        Route::get('/show/learning-material/{learning_material}',   ['as' => 'show',            'uses' => 'LearningMaterialController@show']);
        Route::get('/edit/learning-material/{learning_material}',   ['as' => 'edit',            'uses' => 'LearningMaterialController@edit']);
        Route::post('/update',                                      ['as' => 'update',          'uses' => 'LearningMaterialController@update']);
        Route::get('/delete/{learning_material}',                   ['as' => 'delete',          'uses' => 'LearningMaterialController@delete']);
    });

    Route::group(['prefix' => 'link', 'as' => 'link.'], function() {
        Route::get('/group/{group}/folder/{folder}',                ['as' => 'create',          'uses' => 'LinkController@create']);
        Route::post('/save',                                        ['as' => 'save',            'uses' => 'LinkController@save']);
        Route::get('/show/link/{link}',                             ['as' => 'show',            'uses' => 'LinkController@show']);
        Route::get('/edit/link/{link}',                             ['as' => 'edit',            'uses' => 'LinkController@edit']);
        Route::post('/update',                                      ['as' => 'update',          'uses' => 'LinkController@update']);
        Route::get('/delete/{link}',                                ['as' => 'delete',          'uses' => 'LinkController@delete']);
    });

});


//Examination Routes
// Route::group(['prefix' => 'examination', 'as' => 'examination.'], function() {
  

//     Route::group(['prefix' => 'examination-assignment', 'as' => 'examination-assignment.'], function() {
//         Route::get('/{exam}',               ['as' => 'index',               'uses' => 'QuestionAssignmentController@index']);
//         Route::post('/assign-questions',    ['as' => 'assign-questions',    'uses' => 'QuestionAssignmentController@assignQuestions']);
//         Route::post('/unassign-questions',  ['as' => 'unassign-questions',  'uses' => 'QuestionAssignmentController@unassignQuestions']);
//     });
// });

//User Managament Routes
Route::group(['prefix' => 'user-management', 'as' => 'user-management.'], function() {
    Route::get('/',                             ['as' => 'index',                   'uses' => 'UserController@index']);
    Route::get('/create',                       ['as' => 'create',                  'uses' => 'UserController@create']);
    Route::post('/save-user',                   ['as' => 'save-user',               'uses' => 'UserController@saveUser']);
    Route::get('/edit/{user}',                  ['as' => 'edit',                    'uses' => 'UserController@edit']);
    Route::post('/update',                      ['as' => 'update',                  'uses' => 'UserController@update']);
    Route::post('/delete',                      ['as' => 'delete',                  'uses' => 'UserController@delete']);
    Route::post('/batch-upload',                ['as' => 'batch-upload',            'uses' => 'UserController@batchUpload']);
    Route::post('/batch-upload-save',           ['as' => 'save-batch-upload',       'uses' => 'UserController@saveBatchUpload']);

    Route::get('/fetch-section/{department}',   ['as' => 'fetch-section',           'uses' => 'UserController@fetchSection']);
});

//User Managament Routes
Route::group(['prefix' => 'administrator', 'as' => 'administrator.'], function() {
    Route::get('/',                                         ['as' => 'index',                   'uses' => 'AdministratorController@index']);
    // Route::post('/save-academic-year',                      ['as' => 'save-academic-year',      'uses' => 'AdministratorController@saveAcademicYear']);
    // Route::get('/change-academic-active/{academic_year}',   ['as' => 'change-academic-active',  'uses' => 'AdministratorController@changeAcadmicActive']);

    Route::group(['prefix' => 'logins', 'as' => 'logins.'], function() {
        Route::get('/',      ['as' => 'index',       'uses' => 'LoginReportController@index']);
    });

    Route::group(['prefix' => 'system-logs', 'as' => 'system-logs.'], function() {
        Route::get('/',      ['as' => 'index',       'uses' => 'SystemLogController@index']);
    });

    Route::group(['prefix' => 'exports', 'as' => 'exports.'], function() {
        Route::get('/',                 ['as' => 'index',           'uses' => 'ExportController@index']);
        Route::get('/subjects',         ['as' => 'subjects',        'uses' => 'ExportController@subjects']);
        Route::get('/departments',      ['as' => 'departments',     'uses' => 'ExportController@departments']);
        Route::get('/sections',         ['as' => 'sections',        'uses' => 'ExportController@sections']);
        Route::get('/users',            ['as' => 'users',           'uses' => 'ExportController@users']);
        Route::get('/groups',           ['as' => 'groups',          'uses' => 'ExportController@groups']);
        Route::get('/question-bank',    ['as' => 'question-bank',   'uses' => 'ExportController@questionBank']);
        Route::get('/login-report',     ['as' => 'login-report',    'uses' => 'ExportController@loginReport']);
        Route::get('/system-logs',      ['as' => 'system-logs',     'uses' => 'ExportController@systemLogs']);
        Route::get('/user-activities',  ['as' => 'user-activities', 'uses' => 'ExportController@userActivities']);
    });

});

// Other Routes
Route::group(['prefix' => 'downloads', 'as' => 'downloads.'], function() {
    Route::get('/{question_attachment}',                            ['as' => 'question-attachment',             'uses' => 'DownloadController@questionAttachment']);
    Route::get('/{discussion_attachment}',                          ['as' => 'discussion-attachment',           'uses' => 'DownloadController@discussionAttachment']);
    Route::get('/{learning_material_attachment}/group/{group}',     ['as' => 'learning-material-attachment',    'uses' => 'DownloadController@learningMaterialAttachment']);
    Route::get('/downloa-templates/{template}',                     ['as' => 'template',                        'uses' => 'DownloadController@template']);

});


Route::group(['prefix' => 'folders', 'as' => 'folders.'], function() {
    Route::post('/save', ['as' => 'save', 'uses' => 'FolderController@save']);
    Route::post('/update', ['as' => 'update', 'uses' => 'FolderController@update']);
});


Route::get('send', 'UserController@sendNotification');

Route::get('send-email-notif', 'UserController@sendEmail')->name('send-email');


//User Profile
Route::group(['prefix' => 'user-profile', 'as' => 'user-profile.'], function() {
    Route::get('/',                     ['as' => 'index',               'uses' => 'UserController@userProfile']);
    Route::post('/save-new-password',    ['as' => 'save-new-password',   'uses' => 'UserController@saveNewPasswordProfile']);
    Route::post('/save-avatar',    ['as' => 'save-avatar',   'uses' => 'UserController@saveAvatar']);
});

