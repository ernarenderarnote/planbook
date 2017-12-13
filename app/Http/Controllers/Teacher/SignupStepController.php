<?php

namespace App\Http\Controllers\teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\User;
use App\SchoolYear;
use App\UserLessonSectionLayout;
use App\UserClass;
use Facades\App\Helpers\Common;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Paginator;
use Session;
use Input;
use Validator;
use Hash;
use DB;
use Redirect;
use View;
use Mail;
use Exception;

class SignupStepController extends Controller
{

     /**
     * Declare $data array to pass data to view 
     */
    protected $data = [];

    public function step(Request $request)
    {

        $user = Auth::user();

    	if($request->isMethod('POST'))
    	{

            //echo"<pre>";print_r($request->all());die;

            $rules = array(
                'first_name'   => 'required',
                'last_name'   => 'required',
                
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {

                return redirect()->back()->withInput()->withErrors($validator->errors());
                
            } else {

                $signup_step_completed = 1;

                $user->first_name = $request->get('first_name');
                $user->last_name = $request->get('last_name');
                $user->display_name = $request->get('display_name');
                $user->school_district = $request->get('school_district');
                $user->school_name = $request->get('school_name');
                $user->promotional_code = $request->get('promotional_code');
                $user->signup_step_completed = $signup_step_completed;
               

                if($user->save()){

                  
                    return redirect()->route("teacher.step2");

                }else{

                    
                    return redirect()->back();

                }

            } 



    		
    	}
    	else
    	{
    		return view('teacher.signUpStep.step');	
    	}
    	
    }

    public function step2(Request $request)
    {   

        
        $userSchoolYear = auth()->user()->schoolYear()->first();

        if(!$userSchoolYear){

            $userSchoolYear = new SchoolYear;

        }

        $this->data['userSchoolYear'] = $userSchoolYear;


    	if($request->isMethod('POST'))
    	{


            //echo"<pre>";print_r($request->all());die;

            $rules = array(
                'year_name'   => 'required',
                'class_schedule'   => 'required',
                
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {

                return redirect()->back()->withInput()->withErrors($validator->errors());
                
            } else {

                
                $userSchoolYear->user_id = Auth::user()->id;
                $userSchoolYear->year_name = $request->get('year_name');
                $userSchoolYear->first_day = $request->get('first_day');
                $userSchoolYear->last_day = $request->get('last_day');
                $userSchoolYear->class_schedule_type = $request->get('class_schedule');
                $userSchoolYear->cycle_days = $request->get('cycle_days');


                $classesSchedule = "";
                // get user classes schedule setting

                if($request->get('class_schedule') == "one_week"){

                    $classesSchedule = "one_week";

                }elseif($request->get('class_schedule') == "two_week"){

                    $classesSchedule = "two_week";

                }elseif($request->get('class_schedule') == "cycle"){

                    $classesSchedule = "cycle";

                }else{

                    $classesSchedule = "one_week";
                }

                $defaultClassesSchedules = Common::ClassesScheduled($classesSchedule);


                if($request->get('class_schedule') == "cycle"){

                    $defaultClassesSchedules =  array_slice($defaultClassesSchedules, 0,$request->get('cycle_days'));
                }
               // echo"<pre>";print_r($defaultClassesSchedules);die;

                $defaultClassesSchedules = json_encode($defaultClassesSchedules);
               
                $userSchoolYear->class_schedule = $defaultClassesSchedules;
                if($userSchoolYear->save()){


                    $signup_step_completed = 2;

                    $user = Auth::user();
                    $user->signup_step_completed = $signup_step_completed;
                    $user->current_selected_year = $userSchoolYear->id;
                    $user->save();

                  
                   return  redirect()->route("teacher.step3");

                }else{

                    
                    return redirect()->back();

                }

            } 

    		
    	}
    	else
    	{
            return view('teacher.signUpStep.step2', $this->data);
    	}
    }

    public function step3(Request $request)
    {


    	if($request->isMethod('POST'))
    	{
    		return  redirect()->route("teacher.step2");
    	}
    	else
    	{
    		return view('teacher.signUpStep.step3');	
    	}
    }


    public function step4(Request $request, $LessonSectionLayout)
    {

        $user_selected_school_year = SchoolYear::where('id',Auth::user()->current_selected_year)->where('user_id',Auth::user()->id)->first();
        $this->data['user_selected_school_year'] = $user_selected_school_year;

        //print_r($LessonSectionLayout);die;
        
        /* Add User lesson section layout*/
        $userLessonSectionLayout = auth()->user()->userLessonSectionLayout()->first();
        if(!$userLessonSectionLayout){
            $userLessonSectionLayout = new UserLessonSectionLayout;
        }

        $lessonLayout =  Common::LessonLayout($LessonSectionLayout);

        $userLessonSectionLayout->user_id = Auth::user()->id;
        $userLessonSectionLayout->layout_name = $lessonLayout['layout_name'];
        $userLessonSectionLayout->lesson_sections = $lessonLayout['lesson_sections'] ;
        $userLessonSectionLayout->save();

        $signup_step_completed = 3;

        $user = Auth::user();
        $user->signup_step_completed = $signup_step_completed;
        $user->save();
         /* Add User Class Information*/

         $userClasses = auth()->user()->userClass()->get();

        if(!$userClasses){

            $userClasses = new UserClass;
        }
        $this->data['userClasses'] = $userClasses;
       
        if($request->isMethod('POST'))
        {
            $deletedUserClasses = UserClass::where('user_id', Auth::id())->delete();

            $rules = array(
                'classes.*.class_name'   => 'required',
                
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {

                return redirect()->back()->withInput()->withErrors($validator->errors());
                
            } else {


                $classes = $request->get('classes');
                //echo"<pre>";print_r($classes);die;

                if(!empty($classes)){
                    foreach ($classes as $class) {
                        $userClass = new UserClass;
                        $userClass->user_id = Auth::id();
                        $userClass->year_id = Auth::user()->current_selected_year;
                        $userClass->class_name = $class['class_name'];
                        $userClass->class_color = $class['class_color'];
                        $userClass->start_date = $user_selected_school_year->first_day;
                        $userClass->end_date = $user_selected_school_year->last_day;

                        $class_schedule = json_encode($class['class_schedule']);
                        $userClass->class_schedule = $class_schedule;
                        $userClass->save();
                    }
                }

                $signup_step_completed = 4;

                $user = Auth::user();
                $user->signup_step_completed = $signup_step_completed;
                $user->save();

            }

               

            return  redirect()->route("teacher.step5");
          

        }
        else
        {
           return view('teacher.signUpStep.step4',$this->data);   
        }

    	
    }

    public function step5(Request $request)
    {

        $signup_step_completed = 5;

        $user = Auth::user();
        $user->signup_step_completed = $signup_step_completed;
        $user->save();

    	/*if($request->isMethod('POST'))
    	{*/
    		return  redirect()->route("teacher.dashboard.index");
    	/*}
    	else
    	{
    		return view('teacher.signUpStep.step5');	
    	}*/
    }


}
