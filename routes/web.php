<?php

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

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Question Bank Routes
Route::group(['prefix' => 'question-bank', 'as' => 'question-bank.'], function() {
    Route::get('/', ['as' => 'index', 'uses' => 'QuestionBankController@index']);
    Route::get('/my-questions', ['as' => 'my-questions', 'uses' => 'QuestionBankController@myQuestionBank']);

    Route::group(['prefix' => 'create', 'as' => 'create.'], function() {
        Route::get('/mcq', ['as' => 'mcq', 'uses' => 'QuestionBankController@createMcq']);
        Route::get('/tf', ['as' => 'tf', 'uses' => 'QuestionBankController@createTf']);
        Route::get('/sa', ['as' => 'sa', 'uses' => 'QuestionBankController@createSa']);
        Route::get('/essay', ['as' => 'essay', 'uses' => 'QuestionBankController@createEssay']);
    });

    Route::post('/save', ['as' => 'save', 'uses' => 'QuestionBankController@save']);
    Route::get('/show/{question}', ['as' => 'show', 'uses' => 'QuestionBankController@show']);
    Route::get('/edit/{question}', ['as' => 'edit', 'uses' => 'QuestionBankController@edit']);
    Route::post('/update', ['as' => 'update', 'uses' => 'QuestionBankController@update']);
    Route::get('/delete/{question}', ['as' => 'delete', 'uses' => 'QuestionBankController@delete']);
});


//Groups Routes
Route::group(['prefix' => 'groups', 'as' => 'groups.'], function() {
    Route::get('/', ['as' => 'index', 'uses' => 'GroupController@index']);
    Route::get('/create', ['as' => 'create', 'uses' => 'GroupController@create']);
    Route::post('/save', ['as' => 'save', 'uses' => 'GroupController@save']);
    Route::get('/edit/{group}', ['as' => 'edit', 'uses' => 'GroupController@edit']);
    Route::post('/update', ['as' => 'update', 'uses' => 'GroupController@update']);
    Route::get('/show/{group}', ['as' => 'show', 'uses' => 'GroupController@show']);

    Route::group(['prefix' => 'group-assignment', 'as' => 'group-assignment.'], function() {
        Route::get('/{group}', ['as' => 'index', 'uses' => 'GroupAssignmentController@index']);
        Route::get('/group/{group}/assignment', ['as' => 'assignment', 'uses' => 'GroupAssignmentController@assignment']);
        Route::post('/assign-users', ['as' => 'assign-users', 'uses' => 'GroupAssignmentController@assignUsers']);
        Route::post('/unassign-users', ['as' => 'unassign-users', 'uses' => 'GroupAssignmentController@unassignUsers']);
    });
});


//Examination Routes
Route::group(['prefix' => 'examination', 'as' => 'examination.'], function() {
    Route::get('/', ['as' => 'index', 'uses' => 'ExaminationController@index']);
    Route::get('/create', ['as' => 'create', 'uses' => 'ExaminationController@create']);
    Route::post('/save', ['as' => 'save', 'uses' => 'ExaminationController@save']);
    Route::get('/show/{exam}', ['as' => 'show', 'uses' => 'ExaminationController@show']);
    Route::get('/edit/{exam}', ['as' => 'edit', 'uses' => 'ExaminationController@edit']);
    Route::post('/update', ['as' => 'update', 'uses' => 'ExaminationController@update']);
    Route::get('/delete/{exam}', ['as' => 'delete', 'uses' => 'ExaminationController@delete']);

    Route::group(['prefix' => 'examination-assignment', 'as' => 'examination-assignment.'], function() {
        Route::get('/{exam}', ['as' => 'index', 'uses' => 'QuestionAssignmentController@index']);
        Route::post('/assign-questions', ['as' => 'assign-questions', 'uses' => 'QuestionAssignmentController@assignQuestions']);
        Route::post('/unassign-questions', ['as' => 'unassign-questions', 'uses' => 'QuestionAssignmentController@unassignQuestions']);
    });
});

//User Managament Routes
Route::group(['prefix' => 'user-management', 'as' => 'user-management.'], function() {
    Route::get('/', ['as' => 'index', 'uses' => 'UserController@index']);
    Route::get('/create', ['as' => 'create', 'uses' => 'UserController@create']);
    Route::post('/save-user', ['as' => 'save-user', 'uses' => 'UserController@saveUser']);
    Route::get('/edit/{user}', ['as' => 'edit', 'uses' => 'UserController@edit']);
    Route::post('/update', ['as' => 'update', 'uses' => 'UserController@update']);
    Route::post('/delete', ['as' => 'delete', 'uses' => 'UserController@delete']);
});

// Other Routes
Route::group(['prefix' => 'downloads', 'as' => 'downloads.'], function() {
    Route::get('/{question_attachment}', ['as' => 'question-attachment', 'uses' => 'DownloadController@questionAttachment']);
});


