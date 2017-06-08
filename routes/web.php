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

Route::post('/signUp', array(
    'as' => 'signUp',
    'uses' => 'GuestController@register'
));

Route::post('/login', array(
    'as' => 'login',
    'uses' => 'GuestController@login',
));

Route::get('/logout', array(
    'as' => 'logout',
    'uses' => 'GuestController@logout',
));

/**  Dashboard  **/ 
Route::group(['namespace' => 'Teacher','prefix' => 'teacher', 'as' => 'teacher.','middleware'=>'auth'], function()
{

    Route::match(['get','post'], 'step', ["as" => "step", "uses" => "SignupStepController@step"]);
    Route::match(['get','post'], 'step-2', ["as" => "step2", "uses" => "SignupStepController@step2"]);
    Route::match(['get','post'], 'step-3', ["as" => "step3", "uses" => "SignupStepController@step3"]);
    Route::match(['get','post'], 'step-4/{LessonSectionLayout}', ["as" => "step4", "uses" => "SignupStepController@step4"]);
    Route::match(['get','post'], 'step-5', ["as" => "step5", "uses" => "SignupStepController@step5"]);

    Route::group(['middleware'=>'IsSignupCompleted'],function(){

        /* Teacher Dashboard Routes*/

        Route::group([ 'prefix' => "dashboard", 'as' => 'dashboard.' ], function()
        {
            Route::get('/index', ['as' => 'index', 'uses' => 'DashboardController@index']);
            Route::get('/showCalendar', ['as' => 'showCalendar', 'uses' => 'DashboardController@showCalendar']);
			Route::get('/weekCalendar', ['as' => 'week', 'uses' => 'DashboardController@weekView']);
            Route::get('/dayCalendar', ['as' => 'day', 'uses' => 'DashboardController@dayView']);
			Route::Post('/editlessons', ['as' => 'editlesson', 'uses' => 'LessonController@create']);
        });


        /* School Year Routes*/

        Route::group([ 'prefix' => "school_year", 'as' => 'school_year.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "SchoolYearController@index"]);
            Route::match(['get'], '/add', [ 'as' => 'getAddSchoolYear', 'uses' => "SchoolYearController@getAddSchoolYear"]);
            Route::match(['post'], '/add', [ 'as' => 'postAddSchoolYear', 'uses' => "SchoolYearController@postAddSchoolYear"]);
            Route::match(['get','post'], '/edit/{school_year_id}', [ 'as' => 'editSchoolYear', "uses" => "SchoolYearController@editSchoolYear"]);

        });


        /* classes Routes*/

        Route::group([ 'prefix' => "classes", 'as' => 'classes.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "ClassesController@index"]);
            Route::match(['get'], '/add', [ 'as' => 'getAddClass', 'uses' => "ClassesController@getAddClass"]);
            Route::match(['post'], '/add', [ 'as' => 'postAddClass', 'uses' => "ClassesController@postAddClass"]);
            Route::match(['get'], '/edit/{class_id}', [ 'as' => 'edit', "uses" => "ClassesController@getEditClass"]);
            Route::match(['post'], '/edit/{class_id}', [ 'as' => 'edit', "uses" => "ClassesController@postEditClass"]);

        });

        /* teacher units Routes*/

        Route::group([ 'prefix' => "units", 'as' => 'units.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "UnitsController@index"]);
            Route::match(['get'], '/add', [ 'as' => 'getAddUnit', 'uses' => "UnitsController@getAddUnit"]);
            Route::match(['post'], '/add', [ 'as' => 'postAddUnit', 'uses' => "UnitsController@postAddUnit"]);
            Route::match(['get'], '/edit/{unit_id}', [ 'as' => 'getEditUnit', "uses" => "UnitsController@getEditUnit"]);
            Route::match(['post'], '/edit/{unit_id}', [ 'as' => 'postEditUnit', "uses" => "UnitsController@postEditUnit"]);

        });


        /* teacher My Files Routes*/

        Route::group([ 'prefix' => "my_files", 'as' => 'my_files.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "MyFilesController@index"]);
            Route::match(['post'], '/myFileUpload', [ 'as' => 'myFileUpload', 'uses' => "MyFilesController@myFileUpload"]);
            

        });

        /* teacher Assignments Routes*/

        Route::group([ 'prefix' => "assignments", 'as' => 'assignments.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "AssignmentsController@index"]);
            Route::match(['get'], '/add', [ 'as' => 'getAddAssignment', 'uses' => "AssignmentsController@getAddAssignment"]);
            Route::match(['post'], '/add', [ 'as' => 'postAddAssignment', 'uses' => "AssignmentsController@postAddAssignment"]);
            Route::match(['get'], '/edit/{assignment_id}', [ 'as' => 'getEditAssignment', "uses" => "AssignmentsController@getEditAssignment"]);
            Route::match(['post'], '/edit/{assignment_id}', [ 'as' => 'postEditAssignment', "uses" => "AssignmentsController@postEditAssignment"]);
            

        });

        /* teacher Assessment Routes*/

        Route::group([ 'prefix' => "assessments", 'as' => 'assessments.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "AssessmentsController@index"]);
            Route::match(['get'], '/add', [ 'as' => 'getAddAssignment', 'uses' => "AssessmentsController@getAddAssessment"]);
            Route::match(['post'], '/add', [ 'as' => 'postAddAssignment', 'uses' => "AssessmentsController@postAddAssessment"]);
            Route::match(['get'], '/edit/{assessment_id}', [ 'as' => 'getEditAssignment', "uses" => "AssessmentsController@getEditAssessment"]);
            Route::match(['post'], '/edit/{assessment_id}', [ 'as' => 'postEditAssignment', "uses" => "AssessmentsController@postEditAssessment"]);
            

        });


    });
  

});




Route::get('/privacy', function () {
    return view('privacy');
});

Route::get('/reviews', function () {
    return view('reviews');
});

Route::get('/terms', function () {
    return view('terms');
});

Route::get('/tutorials', function () {
    return view('tutorials');
});


