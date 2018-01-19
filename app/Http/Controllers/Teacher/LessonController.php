<?php

namespace App\Http\Controllers\teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ClassLesson;
use App\UserClass;
use DB;
use Session;
use Input;
use Auth;
use App\SchoolYear;
class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	protected $data = []; 
    
	public function index()
    {
        //
    }
	/* Edit or Add lessons*/
    public function create(Request $request)
    {	
	  $imgFiles='';
      
      $classLessons = new ClassLesson();

      $values = $request->all();
	  
	  $date = $request->lesson_date;
	  
	  $singleDate = explode(' ',$date);
	  
	  $sendDate = $singleDate[1];
	  
	  $classLessons->lesson_date = $sendDate;
	  
	  $classLessons->class_id = $request->classId;
	  
	  $classLessons->user_id = Auth::user()->id;

	  $classLessons->lesson_start_time = $request->starttime;

      $classLessons->lesson_end_time = $request->endtime;

	  $classLessons->unit = $request->units;

	  $classLessons->lesson_title = $request->title;

	  $classLessons->lesson_text = $request->lessonTxt;

	  $classLessons->homework = $request->homework;

	  $classLessons->objective = $request->objectiveTxt;

	  $classLessons->differentiation = $request->differentiation;

	  $classLessons->instructional  = $request->instructional;

	  $classLessons->material      = $request->material;

	  $classLessons->direct = $request->directTxt;

	  $classLessons->guided = $request->guidedTxt;

	  $classLessons->independent = $request->independentTxt;

 	  $classLessons->notes = $request->notes;

	  $classLessons->lock_lesson_to_date = $request->lockLesson; 

	  $attach = $request->attach;

		if(!empty($attach) || count($attach) >= '1' ){
			$imgFiles =  implode( ",", $attach );
			$classLessons->attachments = $imgFiles;
		}
		$lessons = ClassLesson::where('class_id',$request->classId)->where('user_id',Auth::user()->id)->where('lesson_date',$sendDate)->first();
			if ($lessons === null ) {
				$classLessons->save();
				$this->data['response'] = $values;
				return $this->data;
				//return view('teacher.dashboard.lesson.month.ajaxResponse',$this->data);
			}
			elseif($imgFiles){
				ClassLesson::where('class_id',$request->classId)
				->where('lesson_date',$sendDate)
				->where('user_id',Auth::user()->id)
				->update(['lesson_start_time' => $request->starttime,
				  'lesson_end_time' => $request->endtime,
				  'unit' => $request->units,
				  'lesson_title' => $request->title,
				  'lesson_text' => $request->lessonTxt,
				  'homework' => $request->homework,
				  'notes' => $request->notes,
				  'objective' => $request->objectiveTxt,
				  'differentiation' => $request->differentiation,
				  'instructional'  => $request->instructional,
				  'material'    => $request->material,
				  'direct' => $request->directTxt,
				  'guided' => $request->guidedTxt,
				  'independent' => $request->independentTxt,
				  'lock_lesson_to_date' => $request->lockLesson,
				  'attachments' => $imgFiles
				  ]);
				   $this->data['response'] = $values;
				   return $this->data;
				   //return view('teacher.dashboard.lesson.month.ajaxResponse',$this->data);  
			}
			else{
				ClassLesson::where('class_id',$request->classId)
				->where('lesson_date',$sendDate)
				->where('user_id',Auth::user()->id)
				->update(['lesson_start_time' => $request->starttime,
				  'lesson_end_time' => $request->endtime,
				  'unit' => $request->units,
				  'lesson_title' => $request->title,
				  'lesson_text' => $request->lessonTxt,
				  'homework' => $request->homework,
				  'notes' => $request->notes,
				  'objective' => $request->objectiveTxt,
				  'differentiation' => $request->differentiation,
				  'instructional'  => $request->instructional,
				  'material'    => $request->material,
				  'direct' => $request->directTxt,
				  'guided' => $request->guidedTxt,
				  'independent' => $request->independentTxt,
				  'lock_lesson_to_date' => $request->lockLesson,
				  'attachments' => '',
				  ]);
				   $this->data['response'] = $values;
				   return $this->data;
			}
	  
    }
	/* Add Attachment*/
    public function attachment(Request $request)
    {
			$classLessons = new ClassLesson();
			if($request->hasFile('attach')){	
        	$image = $request->file('attach');
        	$fileExtension = $image->getClientOriginalExtension();	
        	$classLessons->attachments = $imgName =time().'.'.$fileExtension;	
			$imgName =time().'.'.$fileExtension;	
        	$request->file('attach')->move(base_path() . '/public/uploads/', $imgName);
			//$classLessons->save();
		 } 
    }
	/* Move Lessons*/
    public function movelessons(Request $request)
    {   
		ClassLesson::where('class_id',$request->classID)
			->where('lesson_date',$request->classDate)
			->where('user_id',Auth::user()->id)
			->update(['lesson_date' => $request->addedTo]);
			$this->data['response'] = "Lesson Moved Successfully"; 
			return $this->data;
    }

    /* Copy Lessons*/
    public function copylessons(Request $request)
    {
			$LessonsData = ClassLesson::where('class_id',$request->classID)
			->where('lesson_date',$request->classDate)
			->where('user_id',Auth::user()->id)->first();
			if(!empty($LessonsData))
			{
				$classLessons = new ClassLesson();
				$date = $request->lesson_date;
				$classLessons->lesson_date = $request->addedTo;
				$classLessons->class_id = $request->classID;
				$classLessons->user_id = Auth::user()->id;
				$classLessons->lesson_start_time = $LessonsData->lesson_start_time;
				$classLessons->lesson_end_time = $LessonsData->lesson_end_time;
				$classLessons->unit = $LessonsData->unit;
				$classLessons->lesson_title = $LessonsData->lesson_title;
				$classLessons->lesson_text = $LessonsData->lesson_text;
				$classLessons->homework = $LessonsData->homework;
				$classLessons->notes = $LessonsData->notes;
				$classLessons->lock_lesson_to_date = $LessonsData->lock_lesson_to_date; 
				$classLessons->save();
				$this->data['copiedLessons'] = "Lessons Copied Successfully";
				return $this->data;
			}
			else{
				$this->data['copiedLessons'] = "No lesson is added for this date";
				return $this->data;
			}	
			
			
			
    }
	/* bump Lessons */
	public function bumplessons(Request $request)
    {   
    	
		$class_id = $request->class_id;
		$start =  $request->bump_date;
		$end = date('Y-m-d', strtotime($start.'+' .$request->bump_days.' day'));
		$workingDays = $this->getWorkingDays($class_id,$start,$end);
		$current_day = date('l', strtotime($request->bump_date));
		$date = $request->bump_date;
		
		$next_lessons = ClassLesson::where('class_id',$request->class_id)
			->where('lesson_date','>',$request->bump_date)
			->where('user_id',Auth::user()->id)
			->orderBy('lesson_date', 'ASC')
			->pluck('lesson_date')
			->all();
				foreach($next_lessons as $next){
				 $next_day = date('l', strtotime($next));	
				if(in_array($next_day,$workingDays)){ 
					 $loopLength = (($request->bump_days)/(count($workingDays)));
					$position_next = array_search($next_day , $workingDays);
		
					if(($position_next + $request->bump_days) < count($workingDays)  )	{
						 $day = $workingDays[$position_next + $request->bump_days];	
						$dateGet = date('Y-m-d', strtotime($next.'next '. $day));
						   ClassLesson::where('class_id',$request->class_id)
							->where('lesson_date',$next)
							->where('user_id',Auth::user()->id)
							->update(['lesson_date' => $dateGet]);
							$this->data['response'] = "Lesson bumped Successfully";  
							//return $this->data;
					}
					else{
						$new_position = ($position_next + $request->bump_days) % (count($workingDays));
						  $day = $workingDays[$new_position];
						  $new_date = $next;
						for($i=0;$i<$loopLength;$i++)
						{
							 $dateGet = date('Y-m-d', strtotime($new_date.'next '.$day));
							  $new_date = $dateGet;
						}
						//echo $dateGet;
						   ClassLesson::where('class_id',$request->class_id)
							->where('lesson_date',$next)
							->where('user_id',Auth::user()->id)
							->update(['lesson_date' => $dateGet]);
							$this->data['response'] = "Lesson bumped Successfully";  
							//return $this->data;
					}
				}
			} 
			if(in_array($current_day,$workingDays))
			{   
				$loopLength = (($request->bump_days)/(count($workingDays)));
				$position = array_search($current_day , $workingDays);
	
				if(($position + $request->bump_days) < count($workingDays)  )	{
					 $day = $workingDays[$position + $request->bump_days];	
					 $dateGet = date('Y-m-d', strtotime($date.'next '. $day));
					 ClassLesson::where('class_id',$request->class_id)
						->where('lesson_date',$date)
						->where('user_id',Auth::user()->id)
						->update(['lesson_date' => $dateGet]);
						$this->data['response'] = "Lesson bumped Successfully";  
						//return $this->data; 
				}
				else{
					$new_position = ($position + $request->bump_days) % (count($workingDays));
					  $day = $workingDays[$new_position];
					$new_date = $request->bump_date;
					for($i=0;$i<$loopLength;$i++)
					{
						 $dateGet = date('Y-m-d', strtotime($date.'next '.$day));
						 $new_date = $dateGet;
					}
					   ClassLesson::where('class_id',$request->class_id)
						->where('lesson_date',$date)
						->where('user_id',Auth::user()->id)
						->update(['lesson_date' => $dateGet]);
						$this->data['response'] = "Lesson bumped Successfully";  
						
				}
			}
    } 
	/* back Lessons */
	public function backlessons(Request $request)
    {   
		$class_id = $request->class_id;
		$start =  $request->back_date;
		$end = date('Y-m-d', strtotime($start.'+' .$request->back_days.' day'));
		$workingDays = $this->getWorkingDays($class_id,$start,$end);
		$date = $start;
		$bump = $request->back_days;
		$current_day = date('l', strtotime($date));
		$itemIndex = array_search($current_day , $workingDays);

		$loopLen = floor(($bump + ($itemIndex)) / count($workingDays));

		$day = (($itemIndex - $bump) % (count($workingDays)));

		if($day < 0)
		{
			$day = count($workingDays) + $day;
		}

		for($i = 0; $i < $loopLen; $i++)
		{
		 $date = date('Y-m-d', strtotime($date.'previous '. $workingDays[$day]));
		}

		if($loopLen == 0)
		{
		 $date = date('Y-m-d', strtotime($date.'previous '. $workingDays[$day]));
		}

		//echo $date;
		$hasClass = $this->classExists($class_id,$date);
		if(count($hasClass) == 0 ){
			ClassLesson::where('class_id',$request->class_id)
			->where('lesson_date',$request->back_date)
			->where('user_id',Auth::user()->id)
			->update(['lesson_date' => $date]);
			$this->data['response'] = "Lesson Backed Successfully"; 
			return $this->data;
		} 
		else{
			$lessonData = ClassLesson::where('class_id',$request->class_id)->where('user_id',Auth::id())->where('lesson_date',$request->back_date)->get();
			$lesson_date ;
			$lesson_start_time ;
			$lesson_end_time ;
			$unit ;
			$lesson_title ;
			$lesson_text ;
			$homework ;
			$notes ;
			$standards ;
			$attachments  ;
			$lock_lesson_to_date ;
			foreach($lessonData as $lesson)
			{
				$lesson_date         = $lesson['lesson_date'];
				$lesson_start_time   = $lesson['lesson_start_time'];
				$lesson_end_time     = $lesson['lesson_end_time'];
				$unit                = $lesson['unit'];
				$lesson_title        = $lesson['lesson_title'];
				$lesson_text         = $lesson['lesson_text'];
				$homework            = $lesson['homework'];
				$notes               = $lesson['notes'];
				$standards           = $lesson['standards'];
				$attachments         = $lesson['attachments'];
				$lock_lesson_to_date = $lesson['lock_lesson_to_date'];
			}
			ClassLesson::where('class_id',$request->class_id)
			->where('lesson_date',$date)
			->where('user_id',Auth::user()->id)
			->update(['lesson_start_time' => $lesson_start_time,
				  'lesson_end_time' => $lesson_end_time,
				  'unit' => $unit,
				  'lesson_title' => $lesson_title,
				  'lesson_text' => $lesson_text,
				  'homework' => $homework,
				  'notes' => $notes,
				  'lock_lesson_to_date' => $lock_lesson_to_date,
				  'attachments' => $attachments,
				  'standards'  => $standards
				  ]);
			$this->data['response'] = "Lesson Backed Successfully"; 
			ClassLesson::where('lesson_date',$request->back_date)
			->where('class_id',$request->class_id)
			->where('user_id',Auth::user()->id)
			->delete();
			return $this->data; 
		} 
	}
	/*Extend lesson*/
	public function extendlessons(Request $request){
		$class_id = $request->class_id;
		$start =  $request->extend_date;
		$end = date('Y-m-d', strtotime($start.'+' .$request->extend_days.' day'));
		$workingDays = $this->getWorkingDays($class_id,$start,$end);
		$current_day = date('l', strtotime($request->extend_date));
		$date = $request->extend_date;
		$next_lessons = ClassLesson::where('class_id',$request->class_id)
			->where('lesson_date','>',$start)
			->where('user_id',Auth::user()->id)
			->orderBy('lesson_date', 'ASC')
			->pluck('lesson_date')
			->all();
		if(!empty($next_lessons)){	
			foreach($next_lessons as $next){
				$next_day = date('l', strtotime($next));	
				if(in_array($next_day,$workingDays)){ 
					 $loopLength = (($request->extend_days)/(count($workingDays)));
					$position_next = array_search($next_day , $workingDays);
		
					if(($position_next + $request->extend_days) < count($workingDays)  )	{
						 $day = $workingDays[$position_next + $request->extend_days];	
						$dateGet = date('Y-m-d', strtotime($next.'next '. $day));
						   ClassLesson::where('class_id',$request->class_id)
							->where('lesson_date',$next)
							->where('user_id',Auth::user()->id)
							->update(['lesson_date' => $dateGet]);
							$this->data['response'] = "Lesson bumped Successfully";  
							//return $this->data;
					}
					else{
						$new_position = ($position_next + $request->extend_days) % (count($workingDays));
						  $day = $workingDays[$new_position];
						  $new_date = $next;
						for($i=0;$i<=$loopLength;$i++)
						{
							 $dateGet = date('Y-m-d', strtotime($new_date.'next '.$day));
							  $new_date = $dateGet;
						}
						//echo $dateGet;
						   ClassLesson::where('class_id',$request->class_id)
							->where('lesson_date',$next)
							->where('user_id',Auth::user()->id)
							->update(['lesson_date' => $dateGet]);
							$this->data['response'] = "Lesson bumped Successfully";  
							//return $this->data;
					}
				}
			} 
		} 
		$lessonData = ClassLesson::where('class_id',$request->class_id)->where('user_id',Auth::id())->where('lesson_date',$request->extend_date)->get();
		$lesson_date ;
		$lesson_start_time;
		$lesson_end_time ;
		$unit ;
		$lesson_title ;
		$lesson_text ;
		$homework ;
		$notes ;
		$standards ;
		$attachments  ;
		$lock_lesson_to_date ;
		
		foreach($lessonData as $lesson)
		{
			$lesson_date         = $lesson['lesson_date'];
			$lesson_start_time   = $lesson['lesson_start_time'];
			$lesson_end_time     = $lesson['lesson_end_time'];
			$unit                = $lesson['unit'];
			$lesson_title        = $lesson['lesson_title'];
			$lesson_text         = $lesson['lesson_text'];
			$homework            = $lesson['homework'];
			$notes               = $lesson['notes'];
			$standards           = $lesson['standards'];
			$attachments         = $lesson['attachments'];
			$lock_lesson_to_date = $lesson['lock_lesson_to_date'];
		}
		$extend = $request->extend_days;
		for($n=1;$n<=$extend;$n++){
			$date = $request->extend_date;
			$loopLength = ($n/count($workingDays));
			$current_day = date('l', strtotime($date));
			$position = array_search($current_day , $workingDays);
			if(($position + $n) < count($workingDays)  ) {
				$day = $workingDays[$position + $n]; 
				$dateGet = date('Y-m-d', strtotime($date.'next '. $day));
				$extendLesson = new ClassLesson();
				$extendLesson->lesson_date = $dateGet;
				$extendLesson->class_id = $request->class_id;
				$extendLesson->user_id = Auth::user()->id;
				$extendLesson->lesson_start_time = $lesson_start_time;
				$extendLesson->lesson_end_time = $lesson_end_time;
				$extendLesson->unit = $unit;
				$extendLesson->lesson_title = $lesson_title;
				$extendLesson->lesson_text = $lesson_text;
				$extendLesson->homework = $homework;
				$extendLesson->notes = $notes;
				$extendLesson->attachments = $attachments;
				$extendLesson->lock_lesson_to_date = $lock_lesson_to_date;			
				$extendLesson->save();
			}
			else{
			  $position = ($position + $n) % (count($workingDays));
			  $day = $workingDays[$position];
			 for($i=0;$i<$loopLength;$i++)
			 {
			   $dateGet = date('Y-m-d', strtotime($date.'next '.$day));
			   $date = $dateGet;
			 }
				$extendLesson = new ClassLesson();
				$extendLesson->lesson_date = $dateGet;
				$extendLesson->class_id = $request->class_id;
				$extendLesson->user_id = Auth::user()->id;
				$extendLesson->lesson_start_time = $lesson_start_time;
				$extendLesson->lesson_end_time = $lesson_end_time;
				$extendLesson->unit = $unit;
				$extendLesson->lesson_title = $lesson_title;
				$extendLesson->lesson_text = $lesson_text;
				$extendLesson->homework = $homework;
				$extendLesson->notes = $notes;
				$extendLesson->attachments = $attachments;
				$extendLesson->lock_lesson_to_date = $lock_lesson_to_date;			
				$extendLesson->save();
			}		
		}
	}
	
	/*Delete lessons*/
	public function deletelessons(Request $request){
		if($request->shift_lessons=='1'){
			$back = 1;
			$class_id = $request->class_id;
			$start =  $request->delete_date;
			$end = date('Y-m-d', strtotime($start.'+' .$back.' day'));
			$workingDays = $this->getWorkingDays($class_id,$start,$end);
			$next_lessons = ClassLesson::where('class_id',$request->class_id)
				->where('lesson_date','>',$start)
				->where('user_id',Auth::user()->id)
				->orderBy('lesson_date', 'ASC')
				->pluck('lesson_date')
				->all();
			ClassLesson::where('lesson_date',$request->delete_date)
						->where('class_id',$request->class_id)
						->where('user_id',Auth::user()->id)
						->delete(); 	
			if(!empty($next_lessons)){
				foreach($next_lessons as $next){
					//echo $next;				
					$d = $next;
					$current_day = date('l', strtotime($d));
					$itemIndex = array_search($current_day , $workingDays);
					$loopLen = floor(($back + ($itemIndex)) / count($workingDays));
					$day = (($itemIndex - $back) % (count($workingDays)));
					if($day < 0){
						$day = count($workingDays) + $day;
					}
					for($i = 0; $i < $loopLen; $i++){			
						$d = date('Y-m-d', strtotime($d.'previous '. $workingDays[$day]));
					}
					if($loopLen == 0){			
						$d = date('Y-m-d', strtotime($d.'previous '. $workingDays[$day]));
					}
					
					 ClassLesson::where('class_id',$request->class_id)
								->where('lesson_date',$next)
								->where('user_id',Auth::user()->id)
								->update(['lesson_date' => $d]);
								$this->data['response'] = "Lesson bumped Successfully"; 
				}
			} 
		}
		else{
			ClassLesson::where('lesson_date',$request->delete_date)
			->where('class_id',$request->class_id)
			->where('user_id',Auth::user()->id)
			->delete();
			return $this->data; 
		}
	}	
	
	public function listLessons(Request $request,$class_id){
		$year = SchoolYear::where('user_id',Auth::user()->id)->first();
		$working_dates = array();
		$visibleDay  = array();
		$years = explode('-',$year->year_name);
		$start = $year->first_day;
		$end   = $year->last_day;
		$user_id 	= Auth::user()->id;
		$class_id 	= $request->class_id;
		$class_color = '';
		$user_classes = UserClass::where('user_id',$user_id)->where('id',$class_id)->where('start_date', '>=', $start)->Where('end_date', '<=' , $end)->orWhere(function($q) use($user_id,$start, $end, $class_id){
			$q->where('user_id',$user_id)->where('id',$class_id)->where('end_date', '>=' ,$start )->where('start_date' ,'<=', $end);
			})->first();
			$visibleDay   = collect(json_decode($user_classes->class_schedule))->where("is_class", "1")->pluck("text")->all();

			$class_color   = collect($user_classes->class_color)->first();
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
				$lessons[] = ClassLesson::where('user_id',$user_id)->where('class_id',$class_id)->Where('lesson_date', $date_format)->with(["units" => function($q) use($class_id,$date_format){
					$q->where('class_id',$class_id)->where('user_id',Auth::user()->id);}])->get();
				
			}
			$this->data['user_lessons'] = array_combine($working_dates,$lessons);
			$this->data['class_id'] 	= $class_id; 
			$this->data['class_color'] 	= $class_color;
			return view('teacher.dashboard.lesson.month.listlessons',$this->data);

	}
	
	/*Check Working Days*/
	public function getWorkingDays($class_id,$start,$end){
		$data = UserClass::where('user_id',Auth::user()->id)
			->where('id',$class_id)
			->where('start_date', '>=', $start)
			->Where('end_date', '<=' , $end)
			->orWhere(function($q) use($start, $end , $class_id){
				$q->where('end_date', '>=' ,$start )
				->where('start_date' ,'<=', $end)
				->where('id',$class_id);
			})->with(["classLesson" => function($q) use($start, $end) {
				$q->whereBetween("lesson_date", [$start, $end]);
			}])->get();
		$workingDays = array();	
		foreach($data as $getData)
		{
			$workingDays = collect(json_decode($getData->class_schedule))
								->where("is_class" , "1")
								->pluck('text')
								->all();
										
		}
		return $workingDays;	
	}
	public function classExists($class_id,$date)
	{
		$hasLesson = ClassLesson::where('class_id',$class_id)->where('user_id',Auth::id())->where('lesson_date',$date)->get();		
		return $hasLesson;
	}
}
