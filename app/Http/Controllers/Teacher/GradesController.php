<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Facades\App\Helpers\Common;
use App\Students;	
use App\UserClass;
use App\SchoolYear;
use App\Unit;
use App\Assessment;
use App\ScoreWeighting;
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
use App\MyFile;
use App\ClassAssigned;
use App\AssignmentPoints;
use App\AssessmentPoints;
use App\GradeLetters;
use App\ClassPeriods;
class GradesController extends Controller
{
    /**
    * $data array pass data to view 
    */
    protected $data = [];

	public function __construct(){

		
		
	}

   /**
	 * Assessment List
	 */
	public function index()
	{
	  $this->data['classes'] = UserClass::where('year_id',Auth::user()->current_selected_year)->where('user_id',Auth::user()->id)->with('schoolYear')->get();
	   
	   $this->data['gradeletters'] = GradeLetters::where('user_id',Auth::user()->id)->get();

	   $this->data['periods'] = ClassPeriods::where('user_id',Auth::user()->id)->get();																			return view('teacher.grades.index', $this->data);
	}

	public function addstudents(){
		$this->data['students'] = Students::where('teacher_id',Auth::user()->id)->get();
       	return view('teacher.addstudents.index', $this->data);
	}

	/*Return assessments and assignments*/
	public function getUserData(Request $request,$class_id){
		$response = array();
		$this->data['assignments'] = Assignment::where('user_id',Auth::user()->id)->where('class_id',$class_id)->with(['avgAssignmentPoints' =>function($query) use($class_id){
			$query->where('class_id',$class_id);}])->get();
		$this->data['assessments'] = Assessment::where('user_id',Auth::user()->id)->where('class_id',$class_id)->with(['avgAssessmentPoints' =>function($query) use($class_id){
			$query->where('class_id',$class_id);}])->get();
		$this->data['students']    = ClassAssigned::where('teacher_id',Auth::user()->id)->where('class_id',$class_id)->with(['assignpoints' => function($query)use($class_id){
			$query->where('class_id',$class_id); }],'student')->with(['assesspoints' => function($query)use($class_id){
			$query->where('class_id',$class_id); }])->get();
			
		return view('teacher.grades.assigndata', $this->data);
	}

	public function postUserData(request $request){
	   $response = array();
	   $assignmentID 		= $request->assignment_id;
	   $assessmentID 		= $request->assessment_id;
	   $class_id     		= $request->class_id;
	   $assignment_points   = $request->assignment_points;
	   $assessment_points   = $request->assessment_points;
	   $assess_student_id   = $request->ass_student_id;
	   $student_id          = $request->student_id;  
	    for($i=0;$i<count($assignmentID);$i++){
	   		$AssignmentPoints = AssignmentPoints::where('class_id',$class_id)
	   		->where('teacher_id',Auth::user()->id)
	   		->where('assignment_id',$assignmentID[$i])
	   		->where('student_id',$student_id[$i])->first();
	  

			if($AssignmentPoints!=''){
		   		$AssignmentPoints->teacher_id    = Auth::user()->id;
	        	$AssignmentPoints->class_id      = $class_id;
	        	$AssignmentPoints->student_id    = $student_id[$i];
	        	$AssignmentPoints->assignment_id = $assignmentID[$i];
	        	$AssignmentPoints->points 		 = $assignment_points[$i]; 
	       		if($AssignmentPoints->save()){

	            	$response['success'] = 'TRUE';
	            	//echo"update";
	        	}
			}
			else{
				$AssignmentPoints = new AssignmentPoints();
		   		$AssignmentPoints->teacher_id    = Auth::user()->id;
	        	$AssignmentPoints->class_id      = $class_id;
	        	$AssignmentPoints->student_id    = $student_id[$i];
	        	$AssignmentPoints->assignment_id = $assignmentID[$i];
	        	$AssignmentPoints->points 		 = $assignment_points[$i]; 
	       		if($AssignmentPoints->save()){

	            	$response['success'] = 'TRUE';
	            	//echo"added";
	        	}
			}
	   		
	    }
	   
	    for($i=0;$i<count($assessmentID);$i++){
	   		$AssessmentPoints = AssessmentPoints::where('class_id',$class_id)
	   		->where('teacher_id',Auth::user()->id)
	   		->where('assessment_id',$assessmentID[$i])
	   		->where('student_id',$assess_student_id[$i])->first();
			if($AssessmentPoints!=''){
		   		$AssessmentPoints->teacher_id    = Auth::user()->id;
	        	$AssessmentPoints->class_id      = $class_id;
	        	$AssessmentPoints->student_id    = $assess_student_id[$i];
	        	$AssessmentPoints->assessment_id = $assessmentID[$i];
	        	$AssessmentPoints->points 		 = $assessment_points[$i]; 
	       		if($AssessmentPoints->save()){

	            	$response['success'] = 'TRUE';
	            	
	        	}
			}
			else{
				$AssessmentPoints = new AssessmentPoints();
		   		$AssessmentPoints->teacher_id    = Auth::user()->id;
	        	$AssessmentPoints->class_id      = $class_id;
	        	$AssessmentPoints->student_id    = $assess_student_id[$i];
	        	$AssessmentPoints->assessment_id = $assessmentID[$i];
	        	$AssessmentPoints->points 		 = $assessment_points[$i]; 
	       		if($AssessmentPoints->save()){

	            	$response['success'] = 'TRUE';
	            	
	        	}
			}
	   		
	    }
	    
	   $respopnse['success'] = 'TRUE';
	   
	   
	}

	public function postGradeLetters(Request $request){
		$GradeLetters = new GradeLetters();
		$response     = array();
		$GradeLetters->user_id = Auth::id();
		$hasGrade     = GradeLetters::where('user_id',Auth::user()->id)->get();		
		$GradeLetters->grade_letters_data = json_encode($request['grade']);
		if(count($hasGrade) >= '1'){
			GradeLetters::where('user_id',Auth::user()->id)->delete();
				$GradeLetters->save();
				$response['success'] ='Updated Successfully';
		}
		elseif($GradeLetters->save()){
			$response['success'] = 'Grade Letters Added Successfully';
		}
		return response()->json($response);

	}

	public function addPeriods(Request $request){

		return view('teacher.grades.addperiod', $this->data);
	}

	public function postPeriod(Request $request){
		$response = array();
        $ClassPeriods = new ClassPeriods();
        if($request->isMethod('post')) {
            $validation['periodname']	 = 'required';
            $validation['class_id']  = 'required';           
            $validator = Validator::make($request->all(), $validation);

            if($validator->fails()) {

                $response['error'] = $validator->errors()->all();

            }else{

            	$format = 'd/m/Y';

                $ClassPeriods->user_id = Auth::id();
                $ClassPeriods->class_id = $request['class_id'];
                $ClassPeriods->starts_on = \Carbon\Carbon::createFromFormat($format, $request['start_date']);
                $ClassPeriods->ends_on = \Carbon\Carbon::createFromFormat($format,$request['end_date']);
                $ClassPeriods->title = $request['periodname'];
                if($ClassPeriods->save()){

                    $response['success'] = 'TRUE';

                }

            }

        }

        return response()->json($response);


	}

	public function geteditPeriod(Request $request,$period_id){
		$this->data['period'] = ClassPeriods::where('id',$period_id)->first();
		return view('teacher.grades.editperiod', $this->data);  
	}

}
