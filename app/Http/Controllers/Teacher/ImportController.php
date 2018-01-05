<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Facades\App\Helpers\Common;

use App\UserClass;
use App\SchoolYear;
use App\Assessment;
use App\Assignment;
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
use App\Students;
class ImportController extends Controller
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
		$this->data['teachers']  = AddTeachers::where('user_id',Auth::user()->id)->with('usermeta')->get();  
		$this->data['classes']   = UserClass::where('user_id',Auth::user()->id)->get();
		$this->data['years']      = SchoolYear::where('user_id',Auth::user()->id)->get();
		return view('teacher.import.index', $this->data);
	
	}

	public function userYear(Request $request,$id){
		$response = array();
		$response	['year'] = SchoolYear::where('user_id',$id)->get();
		return response()->json($response);	
	}

	public function userClass(Request $request)
	{
		$response = array();
		$id 	  = $request->user_id;
		$year_id  = $request->year_id;
		$response['user_classes'] = UserClass::where('user_id',	$id)->get();
		return response()->json($response);	
	}

	public function getdata(Request $request){
		print_r($request->all());
	}

	public function classData(Request $request){
		$this->data['classes'] = UserClass::where('year_id',$request->year_id)->where('user_id',$request->user_id)->get();
		return view('teacher.import.class', $this->data);
	}

	public function getAssessment(Request $request){
		$year = SchoolYear::where('user_id',$request->teacher_id)->where('id',$request->year_id)->first();
		$years = explode('-',$year->year_name);
		$start_date = $years[0];
		$end_date   = $years[1];
		$this->data['assessments'] = Assessment::where('user_id',$request->teacher_id)->where('class_id',$request->class_id)->where('starts_on', '>=' ,$start_date )->where('ends_on', '<=' ,$end_date )->get();
		return view('teacher.import.assessment',$this->data);
	}

	public function getAssignment(Request $request){
		$year = SchoolYear::where('user_id',$request->teacher_id)->where('id',$request->year_id)->first();
		$years = explode('-',$year->year_name);
		$start_date = $years[0];
		$end_date   = $years[1];
		$this->data['assignments'] = Assignment::where('user_id',$request->teacher_id)->where('class_id',$request->class_id)->where('starts_on', '>=' ,$start_date )->where('ends_on', '<=' ,$end_date )->get();
		return view('teacher.import.assignment',$this->data);
	}

	public function getLessons(Request $request){
		$year = SchoolYear::where('user_id',$request->teacher_id)->where('id',$request->year_id)->first();
		$working_dates = array();
		$visibleDay  = array();
		$years = explode('-',$year->year_name);
		$start = $years[0];
		$end   = $years[1];
		$user_id 	= $request->teacher_id;
		$class_id 	= $request->class_id;
		$user_classes = UserClass::where('user_id',$user_id)->where('id',$class_id)->where('start_date', '>=', $start)->Where('end_date', '<=' , $end)->orWhere(function($q) use($user_id,$start, $end, $class_id){
			$q->where('user_id',$user_id)->where('id',$class_id)->where('end_date', '>=' ,$start )->where('start_date' ,'<=', $end);
			})->first();
			$visibleDay   = collect(json_decode($user_classes->class_schedule))->where("is_class", "1")->pluck("text")->all();
			$start_date   = collect($user_classes->start_date)->first();
			$end_date     = collect($user_classes->end_date)->first();
			$datediff = strtotime($end_date) - strtotime($start_date);
	    	$datediff = floor($datediff/(60*60*24));
			for($i = 0; $i < $datediff + 1; $i++){
	          $all_dates = date("l Y-m-d", strtotime($start_date . ' + ' . $i . 'day'));
	          $dates = explode(' ',$all_dates);
	      	  if(in_array($dates[0],$visibleDay)){
	          
	   			 $working_dates[] = date("l Y-m-d", strtotime($dates[1]));
	   			 $dates_format[]  = date("Y-m-d", strtotime($dates[1]));
	           }     
		
			}
			
			foreach($dates_format as $date_format){
				$lessons[] = ClassLesson::where('user_id',$user_id)->where('class_id',$class_id)->Where('lesson_date', $date_format)->get();
				
			}
			$this->data['user_lessons'] = array_combine($working_dates,$lessons);
			return view('teacher.import.lessons',$this->data);
	}

	public function getStudents(Request $request,$year_id){
		$this->data['students'] = Students::where('teacher_id',Auth::user()->id)->get();
		return view('teacher.import.students',$this->data);
	}

	public function getUnits(Request $request){
		$year = SchoolYear::where('user_id',$request->teacher_id)->where('id',$request->year_id)->first();
		$years = explode('-',$year->year_name);
		$start_date = $years[0];
		$end_date   = $years[1];
		$class_id   = $request->class_id;
		$teacher_id = $request->teacher_id;
		$this->data['unitsGet']   = Unit::where('class_id',$class_id)->where('user_id',$teacher_id)->where('ends_on', '>=' ,$start_date )->where('starts_on' ,'<=', $end_date)->with(['lessons' =>function($query)use($class_id){
				$query->where('class_id',$class_id);}])->get();	
		return view('teacher.import.units',$this->data);

	}

	public function copyCalendar(Request $request, $class_id, $year){
		$year = SchoolYear::where('user_id',Auth::user()->id)->where('id',$year)->first();
		$working_dates = array();
		$visibleDay  = array();
		$years 		= explode('-',$year->year_name);
		$start 		= $years[0];
		$end   		= $years[1];
		$user_id 	= Auth::user()->id;
		//$class_id 	= $class_id;
		$user_classes = UserClass::where('user_id',$user_id)->where('id',$class_id)->where('start_date', '>=', $start)->Where('end_date', '<=' , $end)->orWhere(function($q) use($user_id,$start, $end, $class_id){
			$q->where('user_id',$user_id)->where('id',$class_id)->where('end_date', '>=' ,$start )->where('start_date' ,'<=', $end);
			})->first();
			$visibleDay   = collect(json_decode($user_classes->class_schedule))->where("is_class", "1")->pluck("text")->all();
			$start_date   = collect($user_classes->start_date)->first();
			$end_date     = collect($user_classes->end_date)->first();
			$datediff = strtotime($end_date) - strtotime($start_date);
	    	$datediff = floor($datediff/(60*60*24));
			for($i = 0; $i < $datediff + 1; $i++){
	          $all_dates = date("l Y-m-d", strtotime($start_date . ' + ' . $i . 'day'));
	          $dates = explode(' ',$all_dates);
	      	  if(in_array($dates[0],$visibleDay)){
	          
	   			 $working_dates[] = date("l Y-m-d", strtotime($dates[1]));
	   			 $dates_format[]  = date("Y-m-d", strtotime($dates[1]));
	           }     
		
			}
			
			foreach($dates_format as $date_format){
				$lessons[] = ClassLesson::where('user_id',$user_id)->where('class_id',$class_id)->Where('lesson_date', $date_format)->get();
				
			}
			$this->data['user_lessons'] = array_combine($working_dates,$lessons);
			return view('teacher.import.copyto',$this->data);
	}	
	
	public function copylessons(Request $request ){
		$response   = array();

		$class_id   = $request->to_class;

		$date       = $request->date;

		$dateArr[]  = $date;
		if($request->blanks_date==''){
			$blank_date = array();
		}
		else{
			$blank_date = $request->blanks_date;
		}
		
		$user_id    = $request->teacher_id;

		$dateCount  = array_merge($dateArr,$blank_date);
		
		if($request->isMethod('post') && $request->type == 'Lessons') {

			$haslesson = ClassLesson::where('user_id',Auth::user()->id)->where('lesson_date',$date)->where('class_id',$class_id)->first();
			$classLessons = new ClassLesson();
        	if($haslesson==''){

        		$lessons  = ClassLesson::where('user_id',$user_id)->where('id',$request->lesson_id)->first();
        		$classLessons->class_id = $class_id;
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
					return response()->json($response);
				}	
			}

			else{
        		$presentLessons = ClassLesson::where('user_id',Auth::user()->id)->where('class_id',$class_id)->where('lesson_date' ,'>=', $date)->orderBy('lesson_date')->get()->pluck('lesson_date')->toArray();
        		
        		$lessonsArray   = ClassLesson::where('user_id',Auth::user()->id)->where('class_id',$class_id)->where('lesson_date' ,'>=', $date)->orderBy('lesson_date')->get()->toArray();

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
	        			if($dateCount[$j]==last($dateCount)){
	        				ClassLesson::where('user_id',Auth::user()->id)->where('id',$lid[$j])->delete();

	        				$lessons  = ClassLesson::where('user_id',$user_id)->where('id',$request->lesson_id)->first();
			        		$classLessons->class_id = $class_id;
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
							}	
	        			}
	        			else{
	        				ClassLesson::where('user_id',Auth::user()->id)->where('id',$lid[$j])->update(['lesson_date' => $dateCount[$j+1]]);
	        			
			        		$lessons   = ClassLesson::where('user_id',$user_id)->where('id',$request->lesson_id)->first();
			 				$classLessons->class_id = $class_id;
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
		    		}
        			$j++;
        		}
        		
        		return response()->json($response);
        	}
			
		}	
	}	

	public function copyUnits(Request $request){
		
    	$format     = 'd/m/Y';
    	
		$response   = array();

		$class_id   = $request->to_class;

		$from_class  = $request->from_class;

		$date       = $request->date;

		$dateArr[]  = $date;

		if($request->blanks_date==''){

			$blank_date = array();
		}
		else{

			$blank_date = $request->blanks_date;
		}
		
		$user_id    = $request->teacher_id;

		$dateCount  = array_merge($dateArr,$blank_date);

		$unitClasses =  ClassLesson::where('user_id',$user_id)->where('unit',$request->unit_id)->where('class_id',$from_class)->get()->toArray();
		
		$userLessons = ClassLesson::where('user_id',Auth::user()->id)->where('class_id',$class_id)->where('lesson_date','>=',$date)->get()->toArray();
		$class_ids = array();
		
		$user_lessons_ids = array();
		
		$popIds    = array();				

		$deleteArr = array();

		$single    = array();

		foreach($unitClasses as $unitClass){
			$class_ids[] = $unitClass['id'];
			$single[]    = $unitClass['id'];       
		}
		foreach($userLessons as $userLesson){

			$user_lessons_ids[]  = $userLesson['id'];
		}
		
		for($i=0;$i < count($class_ids); $i++){

			if($i == count($dateCount)){
				break;
			}
			
			$popClasses = ClassLesson::where('user_id',Auth::user()->id)->where('class_id',$class_id)->where('lesson_date',$dateCount[$i])->first();
			if($popClasses!=''){
				array_push($class_ids,$popClasses->id);
				$deleteArr[] = array_pop($user_lessons_ids);
			}
			$classLessons = new ClassLesson();
    		$lessons      = ClassLesson::where('id',$class_ids[$i])->first();
			$classLessons->class_id = $class_id;
			$classLessons->user_id = Auth::user()->id;
			$classLessons->lesson_date = $dateCount[$i];
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
        foreach($deleteArr as $delete){
        	ClassLesson::where('id',$delete)->delete();
        }
        return response()->json($response);		
	}

	public function copyAfterBefore(Request $request){	
		$response   = array();

		$year       = $request->year;
		
		$class_id   = $request->class_id;

		$insert     = $request->insert;

		$startDate  = date("Y-m-d", strtotime($request->beforeDate));

		$from_class = $request->from_class;

		$user_id    = $request->teacher_id;

		$dates = $this->workingDates($year,$class_id);
		
		$working_date = array();

		$class_ids	  = array();	

		$single       = array();

		$user_lessons_ids = array();

		$deleteArr = array();

		$fromLessons  = ClassLesson::where('user_id',$user_id)->where('class_id',$from_class)->orderBy('lesson_date','asc')->get()->toArray();
		
		foreach($fromLessons as $fromLesson){
			$class_ids[] = $fromLesson['id'];
			$single[]    = $fromLesson['id'];       
		}

		if($insert=='A'){

			$last_lesson = ClassLesson::where('user_id',Auth::user()->id)->where('class_id',$class_id)->orderBy('lesson_date', 'desc')->pluck('lesson_date')->first();
			
			if($last_lesson!=last($dates)){

				$chunk  = array_search($last_lesson,$dates);
				if($chunk==0){
					$working_date = $dates;
				}
				else{
					$arr  = array_chunk($dates,$chunk+1);
				
					$working_date = $arr[1];
				}
				
				for($i=0; $i < count($dates);$i++){
				
					if($i==count($working_date)){
						break;
					}
					$classLessons = new ClassLesson();
		    		$lessons      = ClassLesson::where('id',$class_ids[$i])->first();
					$classLessons->class_id = $class_id;
					$classLessons->user_id = Auth::user()->id;
					$classLessons->lesson_date = $working_date[$i];
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
					$classLessons->save();
						
				}
				$response['success'] = 'TRUE';
				$response['unit_copied']='TRUE';
			}	
			else{
				
				$response['error'] = 'No empty dates in this class';
				//$response['unit_copied']='TRUE';

			}
			
		}

		if($insert=='I'){
			
			if(!in_array($startDate,$dates)){
				$response['error'] = 'Date must be exists between working_dates';
				return response()->json($response);
			}

			$userLessons = ClassLesson::where('user_id',Auth::user()->id)->where('class_id',$class_id)->where('lesson_date','>=',$startDate)->get()->toArray();

			foreach($userLessons as $userLesson){

				$user_lessons_ids[]  = $userLesson['id'];
			}

			$chunk  = array_search($startDate,$dates);
			if($chunk==0){
				$working_date = $dates;
			}
			else{
				$arr    = array_chunk($dates,$chunk);
			
				$working_date = $arr[1];
			}
			
			//print_r($user_lessons_ids);

			for($i=0;$i < count($class_ids); $i++){

				if($i == count($dates)){
					break;
				}
				
				$popClasses = ClassLesson::where('user_id',Auth::user()->id)->where('class_id',$class_id)->where('lesson_date',$dates[$i])->first();
				if($popClasses!=''){
					array_push($class_ids,$popClasses->id);
					$deleteArr[] = array_pop($user_lessons_ids);
				}
				$classLessons = new ClassLesson();
	    		$lessons      = ClassLesson::where('id',$class_ids[$i])->first();
				$classLessons->class_id = $class_id;
				$classLessons->user_id = Auth::user()->id;
				$classLessons->lesson_date = $dates[$i];
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
			foreach($deleteArr as $delete){
        		ClassLesson::where('id',$delete)->delete();
        	}
		}
		
		return response()->json($response);	
		
	}

	/*copy units after before*/

	public function copyafterunits(Request $request){	

		$response   = array();

		$year       = $request->year;
		
		$class_id   = $request->class_id;

		$insert     = $request->insert;

		$startDate  = date("Y-m-d", strtotime($request->beforeDate));

		$from_class = $request->from_class;

		$user_id    = $request->teacher_id;

		$dates = $this->workingDates($year,$class_id);
		
		$working_date = array();

		$class_ids	  = array();	

		$single       = array();

		$user_lessons_ids = array();

		$unit_id   = $request->unit_id;

		$deleteArr = array();

		$fromLessons  = ClassLesson::where('user_id',$user_id)->where('class_id',$from_class)->where('unit',$unit_id)->orderBy('lesson_date','asc')->get()->toArray();
		foreach($fromLessons as $fromLesson){
			$class_ids[] = $fromLesson['id'];
			$single[]    = $fromLesson['id'];       
		}

		if($insert=='A'){

			$last_lesson = ClassLesson::where('user_id',Auth::user()->id)->where('class_id',$class_id)->orderBy('lesson_date', 'desc')->pluck('lesson_date')->first();
			
			if($last_lesson!=last($dates)){

				$chunk  = array_search($last_lesson,$dates);
				if($chunk==0){
					$working_date = $dates;
				}
				else{
					$arr  = array_chunk($dates,$chunk+1);
				
					$working_date = $arr[1];
				}
				
				for($i=0; $i < count($dates);$i++){
				
					if($i==count($working_date)){
						break;
					}
					$classLessons = new ClassLesson();
		    		$lessons      = ClassLesson::where('id',$class_ids[$i])->first();
					$classLessons->class_id = $class_id;
					$classLessons->user_id = Auth::user()->id;
					$classLessons->lesson_date = $working_date[$i];
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
					$classLessons->save();
						
				}
				$response['success'] = 'TRUE';
				$response['unit_copied']='TRUE';
			}	
			else{
				
				$response['error'] = 'No empty dates in this class';
				//$response['unit_copied']='TRUE';

			}
			
		}

		if($insert=='I'){
			
			if(!in_array($startDate,$dates)){
				$response['error'] = 'Date must be exists between working_dates';
				return response()->json($response);
			}

			$userLessons = ClassLesson::where('user_id',Auth::user()->id)->where('class_id',$class_id)->where('lesson_date','>=',$startDate)->get()->toArray();

			foreach($userLessons as $userLesson){

				$user_lessons_ids[]  = $userLesson['id'];
			}

			$chunk  = array_search($startDate,$dates);
			if($chunk==0){
				$working_date = $dates;
			}
			else{
				$arr    = array_chunk($dates,$chunk);
			
				$working_date = $arr[1];
			}
			
			//print_r($user_lessons_ids);

			for($i=0;$i < count($class_ids); $i++){

				if($i == count($dates)){
					break;
				}
				
				$popClasses = ClassLesson::where('user_id',Auth::user()->id)->where('class_id',$class_id)->where('lesson_date',$dates[$i])->first();
				if($popClasses!=''){
					array_push($class_ids,$popClasses->id);
					$deleteArr[] = array_pop($user_lessons_ids);
				}
				$classLessons = new ClassLesson();
	    		$lessons      = ClassLesson::where('id',$class_ids[$i])->first();
				$classLessons->class_id = $class_id;
				$classLessons->user_id = Auth::user()->id;
				$classLessons->lesson_date = $dates[$i];
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
			foreach($deleteArr as $delete){
        		ClassLesson::where('id',$delete)->delete();
        	}
		}
		
		return response()->json($response);	
		
	}


	public function workingDates($year,$class_id){
		
		$year = SchoolYear::where('user_id',Auth::user()->id)->where('year_name',$year)->first();
		
		$working_dates = array();
		
		$visibleDay  	= array();
		
		$years 			= explode('-',$year->year_name);
		
		$start 			= $years[0];
		
		$end   			= $years[1];
		
		$user_id 		= Auth::user()->id;
		
		$user_classes 	= UserClass::where('user_id',$user_id)->where('id',$class_id)->where('start_date', '>=', $start)->Where('end_date', '<=' , $end)->orWhere(function($q) use($user_id,$start, $end, $class_id){
			$q->where('user_id',$user_id)->where('id',$class_id)->where('end_date', '>=' ,$start )->where('start_date' ,'<=', $end);
			})->first();

			$visibleDay   = collect(json_decode($user_classes->class_schedule))->where("is_class", "1")->pluck("text")->all();

			$start_date   = collect($user_classes->start_date)->first();
			$end_date     = collect($user_classes->end_date)->first();
			$datediff = strtotime($end_date) - strtotime($start_date);
	    	$datediff = floor($datediff/(60*60*24));

			for($i = 0; $i < $datediff + 1; $i++){
	          $all_dates = date("l Y-m-d", strtotime($start_date . ' + ' . $i . 'day'));
	          $dates = explode(' ',$all_dates);
	      	  if(in_array($dates[0],$visibleDay)){

	   			 $working_dates[] = date("l Y-m-d", strtotime($dates[1]));
	   			 $dates_format[]  = date("Y-m-d", strtotime($dates[1]));
	           	  	
	           }     
		
			}
		return($dates_format);
	}

	/*Function to display Classes Copy Table*/
	public function getClassTable(Request $request){
		
		$year = SchoolYear::where('user_id',Auth::user()->id)->first();

		$years 			= explode('-',$year->year_name);
		
		$start 			= $years[0];
		
		$end   			= $years[1];
		
		$user_id 		= Auth::user()->id;

		$this->data['classes'] = UserClass::where('user_id',$user_id)->where('start_date', '>=', $start)->Where('end_date', '<=' , $end)->orWhere(function($q) use($user_id,$start, $end){
			$q->where('user_id',$user_id)->where('end_date', '>=' ,$start )->where('start_date' ,'<=', $end);
			})->get();
		return view('teacher.import.classcopytable',$this->data);	
	}

	public function postClassCopy(Request $request){
		$response    = array();
		$all_classes = $request->class_id;
		foreach($all_classes as $class){
			$classes = UserClass::where('id',$class)->first();
			$UserClass = new UserClass();
			$UserClass->user_id        = Auth::user()->id;
			$UserClass->year_id        = Auth::user()->current_selected_year;
			$UserClass->class_name     = $classes->class_name;
            $UserClass->start_date     = $classes->start_date;
            $UserClass->end_date 	   = $classes->end_date;
            $UserClass->class_color    = $classes->class_color;
            $UserClass->collaborate    = $classes->collaborate;
            $class_schedule			   = $classes->class_schedule;
            $UserClass->class_schedule = $class_schedule;

            if($UserClass->save()){

                $response['success'] = 'TRUE';

            }			
		}
		return response()->json($response);
	}

	/*Function to display Assessment Copy Table*/
	public function getAssessmentTable(Request $request,$class_id){
		
		$year = SchoolYear::where('user_id',Auth::user()->id)->first();
		$years = explode('-',$year->year_name);
		$start_date = $years[0];
		$end_date   = $years[1];
		$this->data['assessments'] = Assessment::where('user_id',Auth::user()->id)->where('class_id',$class_id)->where('starts_on', '>=' ,$start_date )->where('ends_on', '<=' ,$end_date )->get();
		return view('teacher.import.assessmentcopy',$this->data);	
	}

	public function postAssessmentCopy(Request $request,$class_id){
		$response   = array();
		$ids 		= $request->assessment_id;
		foreach($ids as $id){
			$assessment = Assessment::where('id',$id)->first();
			$Assessment = new Assessment();
			$Assessment->user_id      = Auth::id();
	        $Assessment->class_id     = $class_id;
	        $Assessment->starts_on    = $assessment->starts_on;
	        $Assessment->ends_on      = $assessment->ends_on;
	        $Assessment->unit_id      = $assessment->unit_id;
	        $Assessment->title        = $assessment->title;
	        $Assessment->description  = $assessment->description;
	        $Assessment->total_points = $assessment->total_points;


	        if($Assessment->save()){

	            $response['success'] = 'TRUE';

	        }
  		} 
  		
  		return response()->json($response);   
	}
	/*Function to display Assignment Copy Table*/
	public function getAssignmentTable(Request $request,$class_id){
		$year = SchoolYear::where('user_id',Auth::user()->id)->first();
		$years = explode('-',$year->year_name);
		$start_date = $years[0];
		$end_date   = $years[1];
		$this->data['assignments'] = Assignment::where('user_id',Auth::user()->id)->where('class_id',$class_id)->where('starts_on', '>=' ,$start_date )->where('ends_on', '<=' ,$end_date )->get();
		return view('teacher.import.assignmentcopy',$this->data);
	}

	public function postAssignmentCopy(Request $request,$class_id){
		$response   = array();
		$ids 		= $request->assignment_id;
		foreach($ids as $id){
			$assignment = Assignment::where('id',$id)->first();
			$Assignment = new Assignment();
			$Assignment->user_id 	  = Auth::id();
            $Assignment->class_id 	  = $class_id;
            $Assignment->starts_on 	  = $assignment->starts_on;
            $Assignment->ends_on 	  = $assignment->ends_on;
            $Assignment->unit_id 	  = $assignment->unit_id;
            $Assignment->title 		  = $assignment->title;
            $Assignment->description  = $assignment->description;
            $Assignment->total_points = $assignment->total_points;


            if($Assignment->save()){

                $response['success'] = 'TRUE';

            }
  		} 
  		return response()->json($response);   
	}

	/*Function to display Student Copy Table*/
	public function studentCopyTable(Request $request,$id){
		$this->data['students'] = Students::where('teacher_id',Auth::user()->id)->get();
		return view('teacher.import.studentscopy',$this->data);
	}

	public function postStudentCopy(Request $request){
		$response   = array();
		$ids 		= $request->student_id;
		foreach($ids as $id){
			$student = Students::where('id',$id)->first();
			$students = new Students();	
			$students->studentID   = $student->studentID;
            $students->teacher_id  = Auth::id();
            $students->name        = $student->name;
            $students->middle_name = $student->middle_name;
            $students->last_name   = $student->last_name;
            $students->grade_level = $student->grade_level;
            $students->email       = $student->email;
            $students->parent_email= $student->parent_email;
            $students->phone_number= $student->phone_number;
            $students->birthdate   = $student->birthdate;
            $students->password    = $student->password;
            if($students->save()){

                $response['success'] = 'TRUE';

            }
  		} 
  		return response()->json($response);   
	}

	public function addTeacher(Request $request){

		return view('teacher.import.addTeacher');
	}

	public function postAddteacher(Request $request){
		$response  = array();
		
        $UserClass = new UserClass();

        if($request->isMethod('post')) {

            $validation['email']        = 'required';
            $validation['teacher_key'] 	= 'required';
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