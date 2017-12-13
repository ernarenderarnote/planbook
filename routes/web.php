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
Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');
Route::post('/login', array(
    'as' => 'login',
    'uses' => 'GuestController@login',
));

Route::get('/logout', array(
    'as' => 'logout',
    'uses' => 'GuestController@logout',
));
Route::get('/student/logout', array(
    'as' => 'logout',
    'uses' => 'StudentController@logout',
));

Route::post('/studentlogin', ['as'=>'studentlogin','uses'=>'StudentController@studentAuth']);
   
/*Route::group(['middleware' => ['student']], function () {
    
    Route::post('/studentlogin', ['as'=>'studentlogin','uses'=>'StudentController@studentAuth']);
   
});*/
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
			Route::post('/getClasses', ['as' => 'class', 'uses' => 'ClassesController@getClass']);
			Route::Post('/addlessons', ['as' => 'addlesson', 'uses' => 'LessonController@create']);
			Route::Post('/attachFiles', ['as' => 'attachFiles', 'uses' => 'MyFilesController@myFileUpload']);
			Route::Post('/movelessons', ['as' => 'movelessons', 'uses' => 'LessonController@movelessons']);
			Route::Post('/copylessons', ['as' => 'copylessons', 'uses' => 'LessonController@copylessons']);
			Route::Post('/bumplessons', ['as' => 'bumplessons', 'uses' => 'LessonController@bumplessons']);
			Route::Post('/backlessons', [ 'as' => 'backlessons', 'uses' => 'LessonController@backlessons']);
			Route::Post('/extendlessons', [ 'as' => 'extendlessons', 'uses' => 'LessonController@extendlessons']);
			Route::Post('/deletelessons', [ 'as' => 'deletelessons', 'uses' => "LessonController@deletelessons"]);
			Route::get('/authUploads', [ 'as' => 'authUploads', 'uses' => "MyFilesController@authUploads"]);
			
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
			Route::match(['get'], '/import', [ 'as' => 'getImportClass', 'uses' => "ClassesController@getImportClass"]);
            Route::match(['get'], '/importcalendar', [ 'as' => 'importCalendar', 'uses' => "ClassesController@importCalendar"]);
            Route::match(['get'], '/importcalendar/{class_id}/{year}', [ 'as' => 'importCalendar', 'uses' => "ClassesController@copyCalendar"]);
            Route::match(['post'], '/copyclass', [ 'as' => 'copyClass', 'uses' => "ClassesController@copyClass"]);
            Route::match(['post'], '/copyafterbefore', [ 'as' => 'copyafterbefore', 'uses' => "ClassesController@copyAfterBefore"]);

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
            Route::match(['post'], '/myFileDownload', [ 'as' => 'myFileDownload', 'uses' => "MyFilesController@fileDownload"]);        
        });

        /* teacher Assignments Routes*/

        Route::group([ 'prefix' => "assignments", 'as' => 'assignments.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "AssignmentsController@index"]);
            Route::match(['get'], '/add', [ 'as' => 'getAddAssignment', 'uses' => "AssignmentsController@getAddAssignment"]);
            Route::match(['post'], '/add', [ 'as' => 'postAddAssignment', 'uses' => "AssignmentsController@postAddAssignment"]);
            Route::match(['get'], '/edit/{assignment_id}', [ 'as' => 'getEditAssignment', "uses" => "AssignmentsController@getEditAssignment"]);
            Route::match(['post'], '/edit/{assignment_id}', [ 'as' => 'postEditAssignment', "uses" => "AssignmentsController@postEditAssignment"]);
            Route::match(['get'], '/score/{assessment_id}', [ 'as' => 'getScoreAssignment', 'uses' => "AssignmentsController@getScoreAssignment"]);
			Route::match(['post'], '/scoreAdd', [ 'as' => 'addScoreAssignment', 'uses' => "AssignmentsController@addScoreAssignment"]);
			Route::match(['get'], '/score', [ 'as' => 'getScoreAssignmentAll', 'uses' => "AssignmentsController@getScoreAssignmentAll"]);
			route::match(['get'], '/authUploads', [ 'as' => 'authUploads', 'uses' => "AssignmentsController@authUploads"]);
			route::match(['get'], '/seletedAssignment', [ 'as' => 'seletedAssignment', 'uses' => "AssignmentsController@seletedAssignment"]);
        });

        /* teacher Assessment Routes*/

        Route::group([ 'prefix' => "assessments", 'as' => 'assessments.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "AssessmentsController@index"]);
            Route::match(['get'], '/add', [ 'as' => 'getAddAssignment', 'uses' => "AssessmentsController@getAddAssessment"]);
            Route::match(['post'], '/add', [ 'as' => 'postAddAssignment', 'uses' => "AssessmentsController@postAddAssessment"]);
            Route::match(['get'], '/edit/{assessment_id}', [ 'as' => 'getEditAssignment', "uses" => "AssessmentsController@getEditAssessment"]);
            Route::match(['post'], '/edit/{assessment_id}', [ 'as' => 'postEditAssignment', "uses" => "AssessmentsController@postEditAssessment"]);
            Route::match(['get'], '/score/{assessment_id}', [ 'as' => 'getScoreAssessment', 'uses' => "AssessmentsController@getScoreAssessment"]);
			Route::match(['post'], '/scoreAdd', [ 'as' => 'getScoreAssessment', 'uses' => "AssessmentsController@addScoreAssessment"]);
			Route::match(['get'], '/score', [ 'as' => 'getScoreAssessmentAll', 'uses' => "AssessmentsController@getScoreAssessmentAll"]);
            route::match(['get'], '/authUploads', [ 'as' => 'authUploads', 'uses' => "AssessmentsController@authUploads"]);
			route::match(['get'], '/seletedAssessment', [ 'as' => 'seletedAssessment', 'uses' => "AssessmentsController@seletedAssessment"]);
			
        });
		/* teacher Standards Routes*/

        Route::group([ 'prefix' => "standards", 'as' => 'standards.' ], function()
        {
            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "StandardsController@index"]);
			Route::match(['get','post'], '/explore', [ 'as' => 'explore', 'uses' => "StandardsController@explore"]);
        });

		/* teacher Events Routes*/

        Route::group([ 'prefix' => "events", 'as' => 'events.' ], function()
        {
            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "EventsController@index"]);
            Route::match(['get'], '/add', [ 'as' => 'addEvents', 'uses' => "EventsController@getAddEvents"]);
            route::match(['get'], '/authUploads', [ 'as' => 'authUploads', 'uses' => "EventsController@authUploads"]);
            Route::Post('/attachFiles', ['as' => 'attachFiles', 'uses' => 'EventsController@myFileUpload']);
            Route::match(['post'], '/add', [ 'as' => 'postAddEvent', 'uses' => "EventsController@postAddEvents"]);
            Route::match(['get'], '/edit/{event_id}', [ 'as' => 'getEditEvent', "uses" => "EventsController@getEditEvent"]);
            Route::match(['post'], '/edit/{event_id}', [ 'as' => 'postEditEvent', "uses" => "EventsController@postEditEvent"]);
            Route::get('/importExport', [ 'as' => 'importExport', "uses" => 'EventsController@importExport']);
            Route::get('/downloadExcel/{events}', [ 'as' => 'downloadExcel', "uses" => 'EventsController@downloadExcel']);
            Route::post('/importExcel', [ 'as' => 'importExcel', "uses" => 'EventsController@importExcel']);
            Route::get('/getyear', [ 'as' => 'getyear', "uses" => 'EventsController@getImport']);
        });

        /* Teacher's Grades Routes*/

        Route::group([ 'prefix' => "grades", 'as' => 'grades.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "GradesController@index"]);
            Route::match(['get','post'], '/addstudents', [ 'as' => 'addstudents', 'uses' => "GradesController@addstudents"]);
            Route::match(['get'], '/getData/{class_id}', [ 'as' => 'getData', 'uses' => "GradesController@getUserData"]);
            Route::match(['post'], '/postData', [ 'as' => 'postData', 'uses' => "GradesController@postUserData"]);
        });
        /* Teacher's Mylist Routes*/

        Route::group([ 'prefix' => "mylist", 'as' => 'mylist.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "MylistController@index"]);
            Route::match(['get'], '/add', [ 'as' => 'getAddList', 'uses' => "MylistController@getAddList"]);
            Route::match(['post'], '/add', [ 'as' => 'postAddList', 'uses' => "MylistController@postAddmylist"]);
            Route::match(['get'], '/edit/{id}', [ 'as' => 'getEditList', 'uses' => "MylistController@getEditList"]);
            Route::match(['post'], '/edit/{id}', [ 'as' => 'postEditMylist', "uses" => "MylistController@postEditMylist"]);
        });

        /* Teacher's strategies Routes*/

        Route::group([ 'prefix' => "mystrategies", 'as' => 'mystrategies.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "MystrategiesController@index"]);
            Route::match(['get'], '/add', [ 'as' => 'getAddList', 'uses' => "MystrategiesController@getAddstrategies"]);
            Route::match(['post'], '/add', [ 'as' => 'postAddList', 'uses' => "MystrategiesController@postAddstrategies"]);
            Route::match(['get'], '/edit/{id}', [ 'as' => 'getEditMystrategies', 'uses' => "MystrategiesController@getEditstrategies"]);
            Route::match(['post'], '/edit/{id}', [ 'as' => 'postEditMystrategies', "uses" => "MystrategiesController@postEditstrategies"]);
        });

        /* Teacher's Add Student Routes*/

        Route::group([ 'prefix' => "addstudents", 'as' => 'addstudents.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "AddstudentController@index"]);
            Route::match(['get'], '/add', [ 'as' => 'getAddStudent', "uses" => "AddstudentController@getAddStudents"]);
            Route::match(['post'], '/add', [ 'as' => 'getAddStudent', "uses" => "AddstudentController@postAddStudents"]);
            Route::match(['get'], '/edit/{id}', [ 'as' => 'geteditStudent', "uses" => "AddstudentController@getEditStudents"]);
            Route::match(['post'], '/edit/{id}', [ 'as' => 'posteditStudent', "uses" => "AddstudentController@postEditStudents"]);
            Route::post('/importExcel', [ 'as' => 'importExcel', "uses" => 'AddstudentController@importExcel']);
            Route::match(['get','post'], '/filterStudents', [ 'as' => 'filterStudents', "uses" => "AddstudentController@FilterStudent"]);
        });

        /* Teacher's Assign Student Routes*/

        Route::group([ 'prefix' => "assignstudents", 'as' => 'assignstudents.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "AssignstudentController@index"]);
            Route::match(['get','post'], '/getStudents/{id}', [ 'as' => 'getStudents', "uses" => "AssignstudentController@getStudents"]);
            Route::match(['get','post'], '/assignAllStudents/{id}', [ 'as' => 'getStudents', "uses" => "AssignstudentController@AssignAllStudents"]);
            Route::match(['get','post'], '/assignSingle', [ 'as' => 'assignSingle', "uses" => "AssignstudentController@AssignSingleStudent"]);
            Route::match(['get','post'], '/removeSingle', [ 'as' => 'assignSingle', "uses" => "AssignstudentController@RemoveSingleStudent"]);
            Route::match(['get','post'], '/filterStudents/{id}', [ 'as' => 'filterStudents', "uses" => "AssignstudentController@FilterStudent"]);
            Route::match(['get','post'], '/removeAllStudents/{id}', [ 'as' => 'removeAllStudents', "uses" => "AssignstudentController@RemoveAllStudent"]);
        });

        /* Teacher's Sharing Option Routes*/
        
        Route::group([ 'prefix' => "sharingoption", 'as' => 'sharingoption.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "SharingoptionController@index"]);
           
        });

        /* Teacher's tepmplate Option Routes*/
        
        Route::group([ 'prefix' => "template", 'as' => 'template.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "TemplateController@index"]);
           
        });

        /* Teacher's display Option Routes*/
        
        Route::group([ 'prefix' => "display", 'as' => 'display.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "DisplayController@index"]);
           
        });
    });
  

});

Route::group(['namespace' => 'Student','prefix' => 'student', 'as' => 'student.','middleware'=>'student'], function()
{

    Route::group([ 'prefix' => "dashboard", 'as' => 'dashboard.' ], function(){
            Route::get('/showCalendar', ['as' => 'showCalendar', 'uses' => 'DashboardController@showCalendar']);
            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "DashboardController@index"]);
            Route::get('/weekCalendar', ['as' => 'week', 'uses' => 'DashboardController@weekView']);
            Route::get('/dayCalendar', ['as' => 'day', 'uses' => 'DashboardController@dayView']);

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


