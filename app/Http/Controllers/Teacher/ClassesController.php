<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Facades\App\Helpers\Common;

use App\UserClass;
use App\SchoolYear;


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
use App\Unit;
use App\ClassLesson;
use App\User;
use App\SharingOption;
use App\AddTeachers;
use App\UserLessonSectionLayout;
class ClassesController extends Controller
{
    /**
    * $data array pass data to view 
    */
    protected $data = [];

	public function __construct(){

		
		
	}

   /**
	 * Classes List
	 */
	public function index()
	{
		$user_selected_school_year = SchoolYear::where('id',Auth::user()->current_selected_year)->where('user_id',Auth::user()->id)->first();
		$this->data['user_selected_school_year'] = $user_selected_school_year;
		$this->data['user_classes'] = UserClass::whereUserId(Auth::id())->get();
		
		return view('teacher.classes.index', $this->data);

		//return redirect()->to('/');
	}

	/**
	 * Get add Class view
	 */
	public function getAddClass()
	{
	
		// get user classes schedule setting

		$user_selected_school_year = SchoolYear::where('id',Auth::user()->current_selected_year)->where('user_id',Auth::user()->id)->first();

		$this->data['user_selected_school_year'] = $user_selected_school_year;

		$this->data['DefaultClassesSchedules'] = Common::ClassesScheduled("one_week");

		//echo"<pre>";print_r($this->data['DefaultClassesSchedules']);die;


		return view('teacher.classes.add', $this->data);

	}

	/**
	 * Post add Class view
	 */

	public function postAddClass(Request $request)
	{

		$response = array();

        $UserClass = new UserClass();


        if($request->isMethod('post')) {

            //echo"<pre>";print_r($request->all());die;


            $validation['class_name'] = 'required';

            $validator = Validator::make($request->all(), $validation);

            if($validator->fails()) {

                $response['error'] = $validator->errors()->all();
            }else{

            	$format = 'd/m/Y';

                $UserClass->user_id = Auth::id();
                $UserClass->year_id = Auth::user()->current_selected_year;
                $UserClass->class_name = $request['class_name'];
                $UserClass->start_date = \Carbon\Carbon::createFromFormat($format, $request['start_date']);
                $UserClass->end_date = \Carbon\Carbon::createFromFormat($format,$request['end_date']);
                $UserClass->class_color = $request['class_color'];
                $UserClass->collaborate = $request['collaborate'];

                $class_schedule = json_encode($request['class_schedule']);
                $UserClass->class_schedule = $class_schedule;

                if($UserClass->save()){

                    $response['success'] = 'TRUE';

                }

            }

        }

        return response()->json($response);

	}


	/**
	 * Get edit Class view
	 */
	public function getEditClass($class_id)
	{
	
		// get user class

		$this->data['userClass'] = UserClass::where('id', $class_id)->first();
		

		//echo"<pre>";print_r($this->data['userClass']);die;

		return view('teacher.classes.edit', $this->data);

	}

	/**
	 * Post Edit Class
	 */

	public function postEditClass(Request $request, $class_id)
	{

		$response = array();

        $UserClass = UserClass::where('id', $class_id)->first();


        if($request->isMethod('post')) {

            //echo"<pre>";print_r($request->all());die;


            $validation['class_name'] = 'required';


            $rules = array(
                'class_name'   => 'required',
                'start_date'   => 'required',
                'end_date'     => 'required',
                
            );

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {

                $response['error'] = $validator->errors()->all();

            }else{

            	$format = 'd/m/Y';
               
                $UserClass->class_name = $request['class_name'];
                $UserClass->start_date = \Carbon\Carbon::createFromFormat($format, $request['start_date']);
                $UserClass->end_date = \Carbon\Carbon::createFromFormat($format,$request['end_date']);
                $UserClass->class_color = $request['class_color'];
                $UserClass->collaborate = $request['collaborate'];

                $class_schedule = json_encode($request['class_schedule']);
                $UserClass->class_schedule = $class_schedule;

                if($UserClass->save()){

                    $response['success'] = 'TRUE';

                }

            }

        }

        return response()->json($response);

	}
	/*popup for edit class*/
    public function getClass(Request $request)
	{
	
		// get user class
		$date 		 = $request->sendDate;
		$getDate 	 = explode(' ', $date);
		$classData 	 = UserClass::where('id', $request->classID)->first();
		$user_plan   = UserLessonSectionLayout::where('user_id',Auth::user()->id)->first(); 
		$getTime = ClassLesson::where('class_id',$request->classID)->where('lesson_date',$getDate[1])->first();							
		$this->data['times'] = $getTime;
		$this->data['user_plan']=$user_plan;
		$this->data['userClass'] = $classData->class_name;
		
		$lessonData = ClassLesson::where('class_id',$request->classID)->where('lesson_date',$getDate[1])->first();
		
		$this->data['lessonDetails'] = $lessonData;
		
		$this->data['unit'] = Unit::where('class_id',$request->classID)->where('user_id',Auth::id())->get()->pluck('unit_title','id');
		
		return  $this->data;

	}

	public function getImportClass(Request $request){
		$user_selected_school_year = SchoolYear::where('id',Auth::user()->current_selected_year)->where('user_id',Auth::user()->id)->get();
		$this->data['user_selected_school_year'] = $user_selected_school_year;
		$this->data['user_classes'] = UserClass::whereUserId(Auth::id())->get();
		$this->data['teachers']     = AddTeachers::where('user_id',Auth::user()->id)->with('usermeta')->get();  
		return view('teacher.classes.import', $this->data);	
	
	}

	public function userData(Request $request,$id){
		$response = array();
		$response['user_classes'] = UserClass::where('user_id',	$id)->get();
		return response()->json($response);	
	}


	public function importCalendar(Request $request){
		$schoolYear = $request->year; 
		$teacher    = $request->teacher;
		if($teacher!='My Classes'){
			$user_id  = user::where('email',$teacher)->first(); 
			$teacher_id = $user_id->id;
			$user_selected_year = SchoolYear::where('user_id',$teacher_id)->where('year_name',$schoolYear)->first();
		}
		else{
			$user_selected_year = SchoolYear::where('user_id',Auth::user()->id)->where('year_name',$schoolYear)->first();
		}
		
		$year_name  = explode('-',$schoolYear);
		if($request->start_date && $request->end_date){
			$start      =  date("Y-m-d", strtotime($request->start_date));
			$end        =  date("Y-m-d", strtotime($request->end_date));
			$this->data['date_filter'] = $start.'+'.$end;
			
		}
		else{
			 $start 		= $user_selected_year->first_day;
			 $end           = $user_selected_year->last_day;

		}
		$type  		= $request->type;
		
		$this->data['current_selected_year'] = $request->year; 
		if($type=='Lessons'){
			$class_id = $request->class_id;
			if($teacher!=='My Classes'){
				$user_id  = user::where('email',$teacher)->first(); 
				$teacher_id = $user_id->id;
				$this->data['classes'] = UserClass::where('user_id',$teacher_id)->where('id',$class_id)->where('start_date', '>=', $start)->Where('end_date', '<=' , $end)->orWhere(function($q) use($start, $end, $class_id,$teacher_id){
		       		$q->where('user_id',$teacher_id)->where('id',$class_id)->where('end_date', '>=' ,$start )->where('start_date' ,'<=', $end);
					})->get();
				$this->data['code']=1;   
				$this->data['user_lessons']=$lessons = ClassLesson::where('user_id',$teacher_id)->where('class_id',$class_id)->where('lesson_date', '>=', $start)->Where('lesson_date', '<=' , $end)->orWhere(function($q) use($start, $end, $class_id,$teacher_id){
		       		$q->where('user_id',$teacher_id)->where('class_id',$class_id)->whereBetween("lesson_date", [$start, $end]);
					})->get();
			}
			else{
				$this->data['classes'] = UserClass::where('user_id',Auth::user()->id)->where('id',$class_id)->where('start_date', '>=', $start)->Where('end_date', '<=' , $end)->orWhere(function($q) use($start, $end, $class_id){
		       		$q->where('user_id',Auth::user()->id)->where('id',$class_id)->where('end_date', '>=' ,$start )->where('start_date' ,'<=', $end);
					})->get();
				$this->data['code']=1;   
				$this->data['user_lessons']=$lessons = ClassLesson::where('user_id',Auth::user()->id)->where('class_id',$class_id)->where('lesson_date', '>=', $start)->Where('lesson_date', '<=' , $end)->orWhere(function($q) use($start, $end, $class_id){
		       		$q->where('user_id',Auth::user()->id)->where('class_id',$class_id)->where('lesson_date', '>=' ,$start )->where('lesson_date' ,'<=', $end);
					})->get();
			}
			    return view('teacher.classes.lessonCalendar', $this->data);


		}
		else{
			$this->data['code']=2;
			$class_id = $request->class_id;
			if($teacher!=='My Classes'){
				$user_id    = user::where('email',$teacher)->first(); 
				$teacher_id = $user_id->id;
				$getUnits   = Unit::where('class_id',$class_id)->where('user_id',$teacher_id)->with(['lessons' =>function($query)use($class_id){
				$query->where('class_id',$class_id);}])->get();
			}
			
			else{
				$getUnits  = Unit::where('class_id',$request->class_id)->where('user_id',Auth::id())->with(['lessons' =>function($query)use($class_id){
				$query->where('class_id',$class_id);}])->get();
			}
			

			$this->data['unitsGet']  = $getUnits;

			return view('teacher.classes.lessonCalendar', $this->data);
		}
		
	}

	public function copyCalendar(Request $request, $class_id, $year){
		$schoolYear = $year; 
		$year_name  = explode('-',$schoolYear);
		$user_selected_year = SchoolYear::where('user_id',Auth::user()->id)->where('year_name',$schoolYear)->first();
		$start 		= $user_selected_year->first_day;
		$end        = $user_selected_year->last_day;
		$this->data['classes'] = UserClass::where('user_id',Auth::user()->id)->where('id',$class_id)->where('start_date', '>=', $start)->Where('end_date', '<=' , $end)->orWhere(function($q) use($start, $end, $class_id){
       		$q->where('user_id',Auth::user()->id)->where('id',$class_id)->where('end_date', '>=' ,$start )->where('start_date' ,'<=', $end);
			})->get();
		$this->data['code']=3;   
		$this->data['user_lessons']=$lessons = ClassLesson::where('user_id',Auth::user()->id)->where('class_id',$class_id)->where('lesson_date', '>=', $start)->Where('lesson_date', '<=' , $end)->orWhere(function($q) use($start, $end, $class_id){
       		$q->where('user_id',Auth::user()->id)->where('class_id',$class_id)->where('lesson_date', '>=' ,$start )->where('lesson_date' ,'<=', $end);
			})->get();
		    return view('teacher.classes.lessonCalendar', $this->data);

	}	

	public function copyClass(Request $request ){
		$date       = $request->date;
		$dateq[]    = $date;
		$class_id   = explode('+',$request->to_class); 
		$blank_date = explode(',',$class_id[1]);
		$dateCount  = array_merge($dateq,$blank_date);
		$response   = array();
		$user_id    = '';
		if(isset($request->teacher_id) && $request->teacher_id!=''){
			$user_id = $request->teacher_id;
		}
        else{
        	$user_id = Auth::user()->id;
        }
        $classLessons = new ClassLesson();

        if($request->isMethod('post') && $request->type == 'Lessons') {
        	
        	$haslesson = ClassLesson::where('user_id',Auth::user()->id)->where('lesson_date',$date)->where('class_id',$class_id[0])->first();
        	if($haslesson==''){
        		$lessons   = ClassLesson::where('user_id',$user_id)->where('id',$request->lesson_id)->first();
	 			$classLessons->class_id = $class_id[0];
				$classLessons->user_id = Auth::user()->id;
				$classLessons->lesson_date = $date;
				$classLessons->lesson_start_time = $lessons->lesson_start_time;
			    $classLessons->lesson_end_time = $lessons->lesson_end_time;
				$classLessons->unit = $lessons->unit;
				$classLessons->lesson_title = $lessons->lesson_title;
				$classLessons->lesson_text = $lessons->lesson_text;
				$classLessons->homework = $lessons->homework;
				$classLessons->notes = $lessons->notes;
				$classLessons->standards = $lessons->standards;
				$classLessons->lock_lesson_to_date = $lessons->lock_lesson_to_date; 
				$classLessons->attachments = $lessons->attachments; 
				if($classLessons->save()){
                    $schoolYear ='2017-2018'; 
					$year_name  = explode('-',$schoolYear);
					$start 		= $year_name[0];
					$end        = $year_name[1];
					$this->data['classes'] = UserClass::where('user_id',Auth::user()->id)->where('id',$class_id[0])->where('start_date', '>=', $start)->Where('end_date', '<=' , $end)->orWhere(function($q) use($start, $end, $class_id){
			       		$q->where('user_id',Auth::user()->id)->where('id',$class_id[0])->where('end_date', '>=' ,$start )->where('start_date' ,'<=', $end);
						})->get();
					$this->data['code']=3;   
					$this->data['user_lessons']=$lessons = ClassLesson::where('user_id',Auth::user()->id)->where('class_id',$class_id[0])->where('lesson_date', '>=', $start)->Where('lesson_date', '<=' , $end)->orWhere(function($q) use($start, $end, $class_id){
			       		$q->where('user_id',Auth::user()->id)->where('class_id',$class_id[0])->where('lesson_date', '>=' ,$start )->where('lesson_date' ,'<=', $end);
						})->get();
					    return view('teacher.classes.lessonCalendar', $this->data);

                }
        	}
        	else{
        		$presentLessons = ClassLesson::where('user_id',Auth::user()->id)->where('class_id',$class_id[0])->where('lesson_date' ,'>=', $date)->orderBy('lesson_date')->get()->pluck('lesson_date')->toArray();
        		$lessonsArray   = ClassLesson::where('user_id',Auth::user()->id)->where('class_id',$class_id[0])->where('lesson_date' ,'>=', $date)->orderBy('lesson_date')->get()->toArray();
			   //print_r($lessonsArray);
        		$lid               = array();
			    $lesson_start_time = array();
			    $lesson_end_time   = array();
			    $unit 			   = array();
			    $lesson_title 	   = array();
			    $lesson_text 	   = array();
			    $homework          = array();
			    $notes             = array();
			    $standards         = array();
			    $attachments 	   = array();
			    $lock_lesson_to_date = array();
        		foreach($lessonsArray as $updateLessons=>$value){
        			$lid[]               = $value['id'];
        			$lesson_start_time[] = $value['lesson_start_time'];
				    $lesson_end_time[]   = $value['lesson_end_time'];
				    $unit[]		   		 = $value['unit'];
				    $lesson_title[] 	 = $value['lesson_title'];
				    $lesson_text[] 	     = $value['lesson_text'];
				    $homework[]          = $value['homework'];
				    $notes[]             = $value['notes'];
				    $standards[]         = $value['standards'];
				    $attachments[] 	     = $value['attachments'];
				    $lock_lesson_to_date[] = $value['lock_lesson_to_date'];
        		}

        		$j = 0;
        		foreach($dateCount as $d){
        			$classCopied = new ClassLesson();
        			if(!in_array($d,$presentLessons)){
        				break;
        			}
	        		else{	
		        		ClassLesson::where('user_id',Auth::user()->id)->where('id',$lid[$j])->update(['lesson_date' => $dateCount[$j+1]]);
		        		$lessons   = ClassLesson::where('user_id',$user_id)->where('id',$request->lesson_id)->first();
		 				$classLessons->class_id = $class_id[0];
						$classLessons->user_id = Auth::user()->id;
						$classLessons->lesson_date = $date;
						$classLessons->lesson_start_time = $lessons->lesson_start_time;
				   		$classLessons->lesson_end_time = $lessons->lesson_end_time;
						$classLessons->unit = $lessons->unit;
						$classLessons->lesson_title = $lessons->lesson_title;
						$classLessons->lesson_text = $lessons->lesson_text;
						$classLessons->homework = $lessons->homework;
						$classLessons->notes = $lessons->notes;
						$classLessons->standards = $lessons->standards;
						$classLessons->lock_lesson_to_date = $lessons->lock_lesson_to_date; 
						$classLessons->attachments = $lessons->attachments; 
						if($classLessons->save()){
							$response['success'] = 'TRUE';
							$response['unit_copied']='TRUE';
		    			}
		    		}
        			$j++;
        		}
        	}	
        	return response()->json($response);	
        }

        if($request->type=='Units'){
        	$format     = 'd/m/Y';
        	$date       = $request->date;
        	$dateq[]    = $date;
			$class_id   = explode('+',$request->to_class); 
			$blank_date = explode(',',$class_id[1]);
			$dateCount  = array_merge($dateq,$blank_date);
			$haslesson 	= ClassLesson::where('user_id',Auth::user()->id)->where('unit',$request->lesson_id)->where('lesson_date',$date)->get()->count();
        	$lessons 	= ClassLesson::where('user_id',Auth::user()->id)->where('unit',$request->lesson_id)->get()->pluck('id');
        	$presentLessons = ClassLesson::where('user_id',Auth::user()->id)->where('class_id',$class_id[0])->where('lesson_date' ,'>=', $date)->get();
        	if($haslesson>=1){
        		$response['success']     = 'TRUE';
	      		$response['unit_copied'] = 'TRUE';
	            return response()->json($response);
        	}
        	else{
        		$j = 1;
	      		for($i=0;$i<count($dateCount);$i++){
	      			$classLessons = new ClassLesson();
	      			if($j==count($dateCount)){
	      				break;
	      			}
	      			$getLesson   = ClassLesson::where('user_id',Auth::user()->id)->where('id',$lessons[$i])->first();
	      			$classLessons->class_id = $class_id[0];
					$classLessons->user_id = Auth::user()->id;
					$classLessons->lesson_date = $dateCount[$i];
					$classLessons->lesson_start_time = $getLesson->lesson_start_time;
				    $classLessons->lesson_end_time = $getLesson->lesson_end_time;
					$classLessons->unit = $getLesson->unit;
					$classLessons->lesson_title = $getLesson->lesson_title;
					$classLessons->lesson_text = $getLesson->lesson_text;
					$classLessons->homework = $getLesson->homework;
					$classLessons->notes = $getLesson->notes;
					$classLessons->standards = $getLesson->standards;
					$classLessons->lock_lesson_to_date = $getLesson->lock_lesson_to_date; 
					$classLessons->attachments = $getLesson->attachments; 
					if($classLessons->save()){
					  $success = 'TRUE';	
					}	
					$j++;
	      		}
	      		$response['success']     = $success;
	      		$response['unit_copied'] = 'TRUE';
	            return response()->json($response);
        	}
        				
        }

	}

	public function copyAfterBefore(Request $request){
		$response       	= array();
		$visibleDay   		= array();
		$lastDate 	    	= array();
		$first_date         = array();  
		$date   			= explode('-',$request->year);
		$start  			= $date[0];
		$end    			= $date[1]; 
		$copyTo 			= $request->copyTo;
		$copyFrom       	= $request->class_id;
		$working_dates  	= array();
		$id 				= array();
		$class_id			= array();
		$user_id			= array();
		$lesson_date 		= array();
		$lesson_start_time	= array();
		$lesson_end_time	= array();
		$unit 				= array();
		$lesson_title 		= array();
		$lesson_text 		= array();
		$homework 			= array();
		$notes 				= array();
		$standards 			= array();
		$attachments 		= array();
		$lock_lesson_to_date= array();

		if($request->insert=='A' && $request->type=='Lessons'){
			$lastLesson 	= ClassLesson::where('user_id',Auth::user()->id)->where('class_id',$request->copyTo)->where('lesson_date', '>=', $start)->Where('lesson_date', '<=' , $end)->orWhere(function($q) use($start, $end, $copyTo){
	       		$q->where('user_id',Auth::user()->id)->where('class_id',$copyTo)->where('lesson_date', '>=' ,$start )->where('lesson_date' ,'<=', $end);
				})->orderBy('lesson_date', 'desc')->first();
			$user_classes = UserClass::where('user_id',Auth::user()->id)->where('id',$request->copyTo)->where('start_date', '>=', $start)->Where('end_date', '<=' , $end)->orWhere(function($q) use($start, $end, $copyTo){
				       		$q->where('user_id',Auth::user()->id)->where('id',$copyTo)->where('end_date', '>=' ,$start )->where('start_date' ,'<=', $end);
							})->get();
			$fromLesson = ClassLesson::where('user_id',Auth::user()->id)->where('class_id',$copyFrom)->where('lesson_date', '>=', $start)->Where('lesson_date', '<=' , $end)->orWhere(function($q) use($start, $end, $copyFrom){
	       		$q->where('user_id',Auth::user()->id)->where('class_id',$copyFrom)->where('lesson_date', '>=' ,$start )->where('lesson_date' ,'<=', $end);
				})->orderBy('lesson_date', 'asc')->get();
			foreach($user_classes as $user_data){
				$visibleDay   = collect(json_decode($user_data->class_schedule))->where("is_class", "1")->pluck("text")->all();
				$lastDate  = $user_data->end_date;
				$first_date= $user_data->start_date;
			}
			if($lastLesson!=''){
				$datediff = strtotime($lastDate) - strtotime($lastLesson->lesson_date);
			}
			else{
				$datediff = strtotime($lastDate) - strtotime($first_date);
			}
	    	$datediff = floor($datediff/(60*60*24));
			for($i = 0; $i < $datediff + 1; $i++){
			 	if($lastLesson!=''){		
	          		$all_dates = date("l Y-m-d", strtotime($lastLesson->lesson_date . ' + ' . $i . 'day'));
	      		}
	      		else{
	      			$all_dates = date("l Y-m-d", strtotime($first_date. ' + ' . $i . 'day'));
	      		}
	          $dates = explode(' ',$all_dates);
	      	  if(in_array($dates[0],$visibleDay)){
	          
	   			$working_dates[] = $dates[1];

	           }     
		
			}

	        foreach($fromLesson as $lessonsDetails){
	        	$id[] 					= $lessonsDetails->id;
	        	$class_id[]				= $lessonsDetails->class_id;
				$user_id[]				= $lessonsDetails->user_id;
				$lesson_date[] 			= $lessonsDetails->lesson_date;
				$lesson_start_time[]	= $lessonsDetails->lesson_start_time;
				$lesson_end_time[]		= $lessonsDetails->lesson_end_time;
				$unit[] 				= $lessonsDetails->unit;
				$lesson_title[] 		= $lessonsDetails->lesson_title;
				$lesson_text[] 	    	= $lessonsDetails->lesson_text;
				$homework[] 			= $lessonsDetails->homework;
				$notes[] 				= $lessonsDetails->notes;
				$standards[] 			= $lessonsDetails->standards;
				$attachments[] 			= $lessonsDetails->attachments;
				$lock_lesson_to_date[]	= $lessonsDetails->lock_lesson_to_date;
	        }
	       
	        for($j=0;$j<count($fromLesson);$j++){

	        	$classLessons = new ClassLesson();
	        	$classLessons->class_id = $copyTo;
				$classLessons->user_id 	= Auth::user()->id;
				$classLessons->user_id 	= Auth::user()->id;
				if(end($working_dates) == $lastLesson->lesson_date){
					$response['Success'] =='TRUE';
					return response()->json($response);
					die();
				}
				if($lastLesson!=''){
					$classLessons->lesson_date = $working_dates[$j+1];
				}
				else{
					$classLessons->lesson_date = $working_dates[$j];
				}
				$classLessons->lesson_start_time = $lesson_start_time[$j];
			    $classLessons->lesson_end_time = $lesson_end_time[$j];
				$classLessons->unit = $unit[$j];
				$classLessons->lesson_title = $lesson_title[$j];
				$classLessons->lesson_text = $lesson_text[$j];
				$classLessons->homework = $homework[$j];
				$classLessons->notes = $notes[$j];
				$classLessons->standards = $standards[$j];
				$classLessons->lock_lesson_to_date = $lock_lesson_to_date[$j]; 
				$classLessons->attachments = $attachments[$j]; 
				if($classLessons->save()){
				  $success = 'TRUE';	
				}	
	        }
	        if(isset($success)){
	        	$response['success'] = $success;
	        }
		    else{
		    	$response['error'] = 'Some of the lessons goes outside the class Schedule';
		    }
		    return response()->json($response);
		} 

		if($request->insert=='I' && $request->type=='Lessons'){
			$lesson_start = $request->beforeDate;
			$lastLesson 	= ClassLesson::where('user_id',Auth::user()->id)->where('class_id',$request->copyTo)->where('lesson_date', '>=', $lesson_start)->Where('lesson_date', '<=' , $end)->orWhere(function($q) use($lesson_start, $end, $copyTo){
	       		$q->where('user_id',Auth::user()->id)->where('class_id',$copyTo)->where('lesson_date', '>=' ,$lesson_start )->where('lesson_date' ,'<=', $end);
				})->orderBy('lesson_date', 'asc')->get();
			
			$user_classes = UserClass::where('user_id',Auth::user()->id)->where('id',$request->copyTo)->where('start_date', '>=', $start)->Where('end_date', '<=' , $end)->orWhere(function($q) use($start, $end, $copyTo){
				       		$q->where('user_id',Auth::user()->id)->where('id',$copyTo)->where('end_date', '>=' ,$start )->where('start_date' ,'<=', $end);
							})->get();
			$fromLesson = ClassLesson::where('user_id',Auth::user()->id)->where('class_id',$copyFrom)->where('lesson_date', '>=', $start)->Where('lesson_date', '<=' , $end)->orWhere(function($q) use($start, $end, $copyFrom){
	       		$q->where('user_id',Auth::user()->id)->where('class_id',$copyFrom)->where('lesson_date', '>=' ,$start )->where('lesson_date' ,'<=', $end);
				})->orderBy('lesson_date', 'asc')->get();
			foreach($user_classes as $user_data){
				$visibleDay   = collect(json_decode($user_data->class_schedule))->where("is_class", "1")->pluck("text")->all();
				$lastDate  = $user_data->end_date;
			}
			$datediff = strtotime($lastDate) - strtotime($lesson_start);
	    	$datediff = floor($datediff/(60*60*24));
			for($i = 0; $i < $datediff + 1; $i++){
	          $all_dates = date("l Y-m-d", strtotime($lesson_start . ' + ' . $i . 'day'));
	          $dates = explode(' ',$all_dates);
	      	  if(in_array($dates[0],$visibleDay)){
	          
	   			 $working_dates[] = $dates[1];

	           }     
		
			}
			 
			$all        = count($working_dates);
			$adding     = count($fromLesson);
			$existing   = count($lastLesson);
		    $nodesCheck = $all-($adding + $existing); 
		    $dateformat = date("Y-m-d", strtotime($lesson_start));

		    if(!in_array($dateformat,$working_dates)){
		    	$response['error'] = array('Date must be in class dates range');
		    	$delete = array_slice($working_dates, - $nodesCheck);
		    }
		    else{
		    	foreach($fromLesson as $lessonsDetails){
		        	//$id[] 					= $lessonsDetails->id;
		        	$class_id[]				= $lessonsDetails->class_id;
					$user_id[]				= $lessonsDetails->user_id;
					$lesson_date[] 			= $lessonsDetails->lesson_date;
					$lesson_start_time[]	= $lessonsDetails->lesson_start_time;
					$lesson_end_time[]		= $lessonsDetails->lesson_end_time;
					$unit[] 				= $lessonsDetails->unit;
					$lesson_title[] 		= $lessonsDetails->lesson_title;
					$lesson_text[] 	    	= $lessonsDetails->lesson_text;
					$homework[] 			= $lessonsDetails->homework;
					$notes[] 				= $lessonsDetails->notes;
					$standards[] 			= $lessonsDetails->standards;
					$attachments[] 			= $lessonsDetails->attachments;
					$lock_lesson_to_date[]	= $lessonsDetails->lock_lesson_to_date;
	       		 }
	       		 foreach($lastLesson as $lessonsDetails){
		        	$id[] 					= $lessonsDetails->id;
		        	$class_id[]				= $lessonsDetails->class_id;
					$user_id[]				= $lessonsDetails->user_id;
					$lesson_date[] 			= $lessonsDetails->lesson_date;
					$lesson_start_time[]	= $lessonsDetails->lesson_start_time;
					$lesson_end_time[]		= $lessonsDetails->lesson_end_time;
					$unit[] 				= $lessonsDetails->unit;
					$lesson_title[] 		= $lessonsDetails->lesson_title;
					$lesson_text[] 	    	= $lessonsDetails->lesson_text;
					$homework[] 			= $lessonsDetails->homework;
					$notes[] 				= $lessonsDetails->notes;
					$standards[] 			= $lessonsDetails->standards;
					$attachments[] 			= $lessonsDetails->attachments;
					$lock_lesson_to_date[]	= $lessonsDetails->lock_lesson_to_date;
	       		}
	       		for($i=0;$i<=$adding;$i++){
	       			if($working_dates[$i] >= end($working_dates) ){
						break;
					}
	       			$checkList = ClassLesson::where('user_id',Auth::user()->id)->where('class_id',$copyTo)->where('lesson_date',$working_dates[$i])->first();

	       			if($checkList!=''){
	       				ClassLesson::find($checkList->id)->delete();
	       				$classLessons = new ClassLesson();
				        $classLessons->class_id = $copyTo;
						$classLessons->user_id 	= Auth::user()->id;
						$classLessons->lesson_date = $working_dates[$i];
						$classLessons->lesson_start_time = $lesson_start_time[$i];
						$classLessons->lesson_end_time = $lesson_end_time[$i];
						$classLessons->unit = $unit[$i];
						$classLessons->lesson_title = $lesson_title[$i];
						$classLessons->lesson_text = $lesson_text[$i];
						$classLessons->homework = $homework[$i];
						$classLessons->notes = $notes[$i];
						$classLessons->standards = $standards[$i];
						$classLessons->lock_lesson_to_date = $lock_lesson_to_date[$i]; 
						$classLessons->attachments = $attachments[$i]; 
						if($classLessons->save()){
							$success = 'TRUE';	
						}

	       			}
	       			else{
       					$classLessons = new ClassLesson();
			        	$classLessons->class_id = $copyTo;
						$classLessons->user_id 	= Auth::user()->id;
						$classLessons->lesson_date = $working_dates[$i];
						$classLessons->lesson_start_time = $lesson_start_time[$i];
					    $classLessons->lesson_end_time = $lesson_end_time[$i];
						$classLessons->unit = $unit[$i];
						$classLessons->lesson_title = $lesson_title[$i];
						$classLessons->lesson_text = $lesson_text[$i];
						$classLessons->homework = $homework[$i];
						$classLessons->notes = $notes[$i];
						$classLessons->standards = $standards[$i];
						$classLessons->lock_lesson_to_date = $lock_lesson_to_date[$i]; 
						$classLessons->attachments = $attachments[$i]; 
						if($classLessons->save()){
						  $success = 'TRUE';	
						}
	       			}
	       		}
		    	$response['success'] = 'TRUE';
		    }
		    return response()->json($response);
		} 
		if($request->insert=='A' && $request->type=='Units'){
			$copyUnits = Unit::where('user_id',Auth::user()->id)->where('class_id',$copyFrom)->get();
			foreach($copyUnits as $unitsData){
				$saveunits = new Unit();	
				$saveunits->user_id    		 = Auth::user()->id;
                $saveunits->class_id   		 = $copyTo;
                $saveunits->starts_on  		 = $unitsData->starts_on;
                $saveunits->ends_on    		 = $unitsData->ends_on;
                $saveunits->unit_id    		 = $unitsData->unit_id;
                $saveunits->unit_title 		 = $unitsData->unit_title;
                $saveunits->unit_description = $unitsData->unit_description;
				if($saveunits->save()){
				  $success = 'TRUE';	
				}
			}
			
			$lastLesson = ClassLesson::where('user_id',Auth::user()->id)->where('class_id',$request->copyTo)->where('lesson_date', '>=', $start)->Where('lesson_date', '<=' , $end)->orWhere(function($q) use($start, $end, $copyTo){
	       		$q->where('user_id',Auth::user()->id)->where('class_id',$copyTo)->where('lesson_date', '>=' ,$start )->where('lesson_date' ,'<=', $end);
				})->orderBy('lesson_date', 'desc')->first();
			$user_classes = UserClass::where('user_id',Auth::user()->id)->where('id',$request->copyTo)->where('start_date', '>=', $start)->Where('end_date', '<=' , $end)->orWhere(function($q) use($start, $end, $copyTo){
				       		$q->where('user_id',Auth::user()->id)->where('id',$copyTo)->where('end_date', '>=' ,$start )->where('start_date' ,'<=', $end);
							})->get();
			$fromLesson = ClassLesson::where('user_id',Auth::user()->id)->where('class_id',$copyFrom)->where('lesson_date', '>=', $start)->Where('lesson_date', '<=' , $end)->orWhere(function($q) use($start, $end, $copyFrom){
	       		$q->where('user_id',Auth::user()->id)->where('class_id',$copyFrom)->where('lesson_date', '>=' ,$start )->where('lesson_date' ,'<=', $end);
				})->orderBy('lesson_date', 'asc')->get();
			foreach($user_classes as $user_data){
				$visibleDay   = collect(json_decode($user_data->class_schedule))->where("is_class", "1")->pluck("text")->all();
				$lastDate  = $user_data->end_date;
				$first_date= $user_data->start_date;
			}
			if($lastLesson!=''){
				$datediff = strtotime($lastDate) - strtotime($lastLesson->lesson_date);
			}
			else{
				$datediff = strtotime($lastDate) - strtotime($first_date);
			}
	    	$datediff = floor($datediff/(60*60*24));
			for($i = 0; $i < $datediff + 1; $i++){
			 	if($lastLesson!=''){		
	          		$all_dates = date("l Y-m-d", strtotime($lastLesson->lesson_date . ' + ' . $i . 'day'));
	      		}
	      		else{
	      			$all_dates = date("l Y-m-d", strtotime($first_date. ' + ' . $i . 'day'));
	      		}
	          $dates = explode(' ',$all_dates);
	      	  if(in_array($dates[0],$visibleDay)){
	          
	   			$working_dates[] = $dates[1]; 


	           }     
		
			}

	        foreach($fromLesson as $lessonsDetails){
	        	$id[] 					= $lessonsDetails->id;
	        	$class_id[]				= $lessonsDetails->class_id;
				$user_id[]				= $lessonsDetails->user_id;
				$lesson_date[] 			= $lessonsDetails->lesson_date;
				$lesson_start_time[]	= $lessonsDetails->lesson_start_time;
				$lesson_end_time[]		= $lessonsDetails->lesson_end_time;
				$unit[] 				= $lessonsDetails->unit;
				$lesson_title[] 		= $lessonsDetails->lesson_title;
				$lesson_text[] 	    	= $lessonsDetails->lesson_text;
				$homework[] 			= $lessonsDetails->homework;
				$notes[] 				= $lessonsDetails->notes;
				$standards[] 			= $lessonsDetails->standards;
				$attachments[] 			= $lessonsDetails->attachments;
				$lock_lesson_to_date[]	= $lessonsDetails->lock_lesson_to_date;
	        }
	       
	        for($j=0;$j<=count($fromLesson);$j++){
	        	$classLessons = new ClassLesson();
	        	$classLessons->class_id = $copyTo;
				$classLessons->user_id 	= Auth::user()->id;
				if(end($working_dates) == $lastLesson->lesson_date){
					$response['Success'] =='TRUE';
					return response()->json($response);
					die();
				}
				if($lastLesson!=''){
					$classLessons->lesson_date = $working_dates[$j+1];
				}
				else{
					$classLessons->lesson_date = $working_dates[$j];
				}
				$classLessons->lesson_start_time = $lesson_start_time[$j];
			    $classLessons->lesson_end_time = $lesson_end_time[$j];
				$classLessons->unit = $unit[$j];
				$classLessons->lesson_title = $lesson_title[$j];
				$classLessons->lesson_text = $lesson_text[$j];
				$classLessons->homework = $homework[$j];
				$classLessons->notes = $notes[$j];
				$classLessons->standards = $standards[$j];
				$classLessons->lock_lesson_to_date = $lock_lesson_to_date[$j]; 
				$classLessons->attachments = $attachments[$j]; 
				if($classLessons->save()){
				  $success = 'TRUE';	
				}	
	        }
	        if(isset($success)){
	        	$response['success'] = $success;
	        }
		    else{
		    	$response['error'] = 'Some of the lessons goes outside the class Schedule';
		    }
		    return response()->json($response);
		}  
		if($request->insert=='I' && $request->type=='Units'){
			$copyUnits = Unit::where('user_id',Auth::user()->id)->where('class_id',$copyFrom)->get();
			foreach($copyUnits as $unitsData){
				$saveunits = new Unit();	
				$saveunits->user_id    		 = Auth::user()->id;
                $saveunits->class_id   		 = $copyTo;
                $saveunits->starts_on  		 = $unitsData->starts_on;
                $saveunits->ends_on    		 = $unitsData->ends_on;
                $saveunits->unit_id    		 = $unitsData->unit_id;
                $saveunits->unit_title 		 = $unitsData->unit_title;
                $saveunits->unit_description = $unitsData->unit_description;
				if($saveunits->save()){
				  $success = 'TRUE';	
				}
			}
			$lesson_start = $request->beforeDate;
			$lastLesson 	= ClassLesson::where('user_id',Auth::user()->id)->where('class_id',$request->copyTo)->where('lesson_date', '>=', $lesson_start)->Where('lesson_date', '<=' , $end)->orWhere(function($q) use($lesson_start, $end, $copyTo){
	       		$q->where('user_id',Auth::user()->id)->where('class_id',$copyTo)->where('lesson_date', '>=' ,$lesson_start )->where('lesson_date' ,'<=', $end);
				})->orderBy('lesson_date', 'asc')->get();
			
			$user_classes = UserClass::where('user_id',Auth::user()->id)->where('id',$request->copyTo)->where('start_date', '>=', $start)->Where('end_date', '<=' , $end)->orWhere(function($q) use($start, $end, $copyTo){
				       		$q->where('user_id',Auth::user()->id)->where('id',$copyTo)->where('end_date', '>=' ,$start )->where('start_date' ,'<=', $end);
							})->get();
			$fromLesson = ClassLesson::where('user_id',Auth::user()->id)->where('class_id',$copyFrom)->where('lesson_date', '>=', $start)->Where('lesson_date', '<=' , $end)->orWhere(function($q) use($start, $end, $copyFrom){
	       		$q->where('user_id',Auth::user()->id)->where('class_id',$copyFrom)->where('lesson_date', '>=' ,$start )->where('lesson_date' ,'<=', $end);
				})->orderBy('lesson_date', 'asc')->get();
			foreach($user_classes as $user_data){
				$visibleDay   = collect(json_decode($user_data->class_schedule))->where("is_class", "1")->pluck("text")->all();
				$lastDate  = $user_data->end_date;
			}
			$datediff = strtotime($lastDate) - strtotime($lesson_start);
	    	$datediff = floor($datediff/(60*60*24));
			for($i = 0; $i < $datediff + 1; $i++){
	          $all_dates = date("l Y-m-d", strtotime($lesson_start . ' + ' . $i . 'day'));
	          $dates = explode(' ',$all_dates);
	      	  if(in_array($dates[0],$visibleDay)){
	          
	   			 $working_dates[] = $dates[1];

	           }     
		
			}
			$all        = count($working_dates);
			$adding     = count($fromLesson);
			$existing   = count($lastLesson);
		    $nodesCheck = $all-($adding + $existing); 
		    
		    $dateformat = date("Y-m-d", strtotime($lesson_start));

		    if(!in_array($dateformat,$working_dates)){
		    	$response['error'] = array('Date must be in class dates range');
		    	$delete = array_slice($working_dates, - $nodesCheck);
		    }
		    else{
		    	foreach($fromLesson as $lessonsDetails){
		        	$class_id[]				= $lessonsDetails->class_id;
					$user_id[]				= $lessonsDetails->user_id;
					$lesson_date[] 			= $lessonsDetails->lesson_date;
					$lesson_start_time[]	= $lessonsDetails->lesson_start_time;
					$lesson_end_time[]		= $lessonsDetails->lesson_end_time;
					$unit[] 				= $lessonsDetails->unit;
					$lesson_title[] 		= $lessonsDetails->lesson_title;
					$lesson_text[] 	    	= $lessonsDetails->lesson_text;
					$homework[] 			= $lessonsDetails->homework;
					$notes[] 				= $lessonsDetails->notes;
					$standards[] 			= $lessonsDetails->standards;
					$attachments[] 			= $lessonsDetails->attachments;
					$lock_lesson_to_date[]	= $lessonsDetails->lock_lesson_to_date;
	       		 }
	       		 foreach($lastLesson as $lessonsDetails){
		        	$id[] 					= $lessonsDetails->id;
		        	$class_id[]				= $lessonsDetails->class_id;
					$user_id[]				= $lessonsDetails->user_id;
					$lesson_date[] 			= $lessonsDetails->lesson_date;
					$lesson_start_time[]	= $lessonsDetails->lesson_start_time;
					$lesson_end_time[]		= $lessonsDetails->lesson_end_time;
					$unit[] 				= $lessonsDetails->unit;
					$lesson_title[] 		= $lessonsDetails->lesson_title;
					$lesson_text[] 	    	= $lessonsDetails->lesson_text;
					$homework[] 			= $lessonsDetails->homework;
					$notes[] 				= $lessonsDetails->notes;
					$standards[] 			= $lessonsDetails->standards;
					$attachments[] 			= $lessonsDetails->attachments;
					$lock_lesson_to_date[]	= $lessonsDetails->lock_lesson_to_date;
	       		}
	       		for($i=0;$i<=$adding;$i++){
	       			if($working_dates[$i] >= end($working_dates) ){
						break;
					}
	       			$checkList = ClassLesson::where('user_id',Auth::user()->id)->where('class_id',$copyTo)->where('lesson_date',$working_dates[$i])->first();
	       			if($checkList!=''){
	       				ClassLesson::find($checkList->id)->delete();
	       				$classLessons = new ClassLesson();
				        $classLessons->class_id = $copyTo;
						$classLessons->user_id 	= Auth::user()->id;
						$classLessons->lesson_date = $working_dates[$i];
						$classLessons->lesson_start_time = $lesson_start_time[$i];
						$classLessons->lesson_end_time = $lesson_end_time[$i];
						$classLessons->unit = $unit[$i];
						$classLessons->lesson_title = $lesson_title[$i];
						$classLessons->lesson_text = $lesson_text[$i];
						$classLessons->homework = $homework[$i];
						$classLessons->notes = $notes[$i];
						$classLessons->standards = $standards[$i];
						$classLessons->lock_lesson_to_date = $lock_lesson_to_date[$i]; 
						$classLessons->attachments = $attachments[$i]; 
						if($classLessons->save()){
							$success = 'TRUE';	
						}

	       			}
	       			else{
       					$classLessons = new ClassLesson();
			        	$classLessons->class_id = $copyTo;
						$classLessons->user_id 	= Auth::user()->id;
						$classLessons->lesson_date = $working_dates[$i];
						$classLessons->lesson_start_time = $lesson_start_time[$i];
					    $classLessons->lesson_end_time = $lesson_end_time[$i];
						$classLessons->unit = $unit[$i];
						$classLessons->lesson_title = $lesson_title[$i];
						$classLessons->lesson_text = $lesson_text[$i];
						$classLessons->homework = $homework[$i];
						$classLessons->notes = $notes[$i];
						$classLessons->standards = $standards[$i];
						$classLessons->lock_lesson_to_date = $lock_lesson_to_date[$i]; 
						$classLessons->attachments = $attachments[$i]; 
						if($classLessons->save()){
						  $success = 'TRUE';	
						}
	       			}
	       		}
		    	$response['success'] = 'TRUE';
		    }
		    return response()->json($response);
		}
	}

	public function addteacher(Request $request){

		return view('teacher.classes.addTeacher');
	}

	public function postAddteacher(Request $request){
		$response  = array();
		
        $UserClass = new UserClass();

        if($request->isMethod('post')) {

            $validation['email']        = 'required';
            $validation['teacher_key'] = 'required';
            $validator = Validator::make($request->all(), $validation);

            if($validator->fails()) {

                $response['error'] = $validator->errors()->all();
            }else{
            	$email    = User::where('email',$request->email)->first();
            	if($email!=''){
            		$shareKey = SharingOption::where('user_id',$email->id)->first();
            		if($request->teacher_key == $shareKey->teacher_key){
            			$addteachers = new AddTeachers();
            			$addteachers->user_id    = Auth::user()->id;
            			$addteachers->teacher_id = $email->id;
            			$addteachers->sharekey  = $request->teacher_key;
            			if($addteachers->save()){
            				$response['success'] = 'TRUE';
            			} 
            		}
            		else{
            			$response['error'] = array('Teacher Email or Teacher Key is incorrect');
            		}
            	}
	            else{
	            	$response['error'] = array('Teacher Email or Teacher Key is incorrect');
	            }	
            }	
        }  
        return response()->json($response);
    }      
}
