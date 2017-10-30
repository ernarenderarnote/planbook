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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Paginator;
use App\ClassAssigned;
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
class AssignstudentController extends Controller
{
    /**
    * $data array pass data to view 
    */
    protected $data = [];

	public function __construct(){

		
		
	}

   /**
	 * 
	 */
	public function index()
	{
	   $this->data['classes'] = UserClass::where('user_id',Auth::user()->id)->get();
       return view('teacher.assignstudents.index', $this->data);

	}
	public function getStudents(Request $request,$id){
		$response = array();

		$students = Students::where('teacher_id',Auth::user()->id)->get();

		$inclass = ClassAssigned::where('teacher_id',Auth::user()->id)->where('class_id',$id)->get();
		
		$studentsArray = Students::where('teacher_id',Auth::user()->id)->get()->pluck('id');

		$inclassArray = ClassAssigned::where('teacher_id',Auth::user()->id)->where('class_id',$id)->get()->pluck('student_id');
		$diff = $studentsArray->diff($inclassArray)->all();

		$notInClass = Students::whereIn('id', $diff)->get();

		$dataInClass = Students::whereIn('id', $inclassArray)->get();

		$response['success']  	 = 'TRUE';
		$response['students'] 	 = $students;
		$response['inclass']  	 = $dataInClass;
		$response['notInClass']  = $notInClass;
        return response()->json($response);
;
	}

	public function AssignAllStudents(Request $request,$id){
		$students = Students::where('teacher_id',Auth::user()->id )->get()->pluck('id');
		$assigned = ClassAssigned::where('teacher_id',Auth::user()->id )->where('class_id',$id)->get()->pluck('student_id');
		$diff = $students->diff($assigned)->all();
		print_r($diff);
		$response = array();
		/*foreach($students as $student_id){
			$classAssigned = new ClassAssigned();
	        $classAssigned->student_id = $student_id;
	        $classAssigned->teacher_id = Auth::id();
	        $classAssigned->class_id   = $id;
	        $classAssigned->save();
	        
	      
		}*/
		
	}
	public function postAddStudents(Request $request){
		$response = array();
        $students = new Students();
        $students->studentID = $request['sudentID'];
        $students->teacher_id = Auth::id();
        $students->name = $request['firstName'];
        $students->middle_name = $request['middlename'];
		$students->last_name= $request['lastname'];
		$students->grade_level=$request['gradeLevel'];
		$students->email = $request['email'];
        $students->parent_email =$request['parentemail'];
		$students->phone_number=$request['phonenumber'];
		$students->birthdate=$request['birthdate'];
		$students->password = Hash::make($request['password']);
        $students->save();
        Auth::login($students);

        $response['success'] = 'TRUE';
        $response['success_redirect_url'] = '/student/dashboard/index';
	}
}
