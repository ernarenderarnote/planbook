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
	}

	public function AssignAllStudents(Request $request,$id){
		
		$students = Students::where('teacher_id',Auth::user()->id )->get()->pluck('id');
		
		$assigned = ClassAssigned::where('teacher_id',Auth::user()->id )->where('class_id',$id)->get()->pluck('student_id');
		
		$diff = $students->diff($assigned)->all();
		
		$response = array();

		$response['status']='TRUE';
		
		foreach($diff as $student_id){
			$classAssigned = new ClassAssigned();
	        $classAssigned->student_id = $student_id;
	        $classAssigned->teacher_id = Auth::id();
	        $classAssigned->class_id   = $id;
	        $classAssigned->save();
	        
	      
		}
		 $response['inclass'] = Students::whereIn('id', $diff)->get();
		 return response()->json($response);
	}

	public function AssignSingleStudent(Request $request){
		$response = array();
		$classAssigned = new ClassAssigned();
		$classAssigned->teacher_id = Auth::user()->id;
		$classAssigned->class_id   = $request->class_id;
		$classAssigned->student_id = $request->student_id;
		if($classAssigned->save()){
			$response['success'] = 'TRUE';
		}

		return response()->json($response);
	}

	public function RemoveSingleStudent(Request $request){
		ClassAssigned::where('class_id',$request->class_id)->where('student_id',$request->student_id)
			->where('teacher_id',Auth::user()->id)
			->delete();	
	}

	public function FilterStudent(request $request,$id){
		$response = array();

		$students = Students::where('teacher_id',Auth::user()->id)->get();

		$inclass = ClassAssigned::where('teacher_id',Auth::user()->id)->where('class_id',$id)->get();
		if($request->gradelevel!=''){
			$studentsArray = Students::where('teacher_id',Auth::user()->id)->where('grade_level',$request->gradelevel)->get()->pluck('id');
		}
		else{
			$studentsArray = Students::where('teacher_id',Auth::user()->id)->get()->pluck('id');
		}

		$inclassArray = ClassAssigned::where('teacher_id',Auth::user()->id)->where('class_id',$id)->get()->pluck('student_id');
		$diff = $studentsArray->diff($inclassArray)->all();
		
		$notInClass = Students::whereIn('id', $diff)->get();

		$dataInClass = Students::whereIn('id', $inclassArray)->get();

		$response['success']  	 = 'TRUE';
		$response['students'] 	 = $students;
		$response['inclass']  	 = $dataInClass;
		$response['notInClass']  = $notInClass;
        return response()->json($response);
	}

	public function RemoveAllStudent(Request $request,$id){

	}
}
