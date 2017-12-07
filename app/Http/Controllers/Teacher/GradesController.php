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
       return view('teacher.grades.index', $this->data);

	}

	public function addstudents(){
		$this->data['students'] = Students::where('teacher_id',Auth::user()->id)->get();
       	return view('teacher.addstudents.index', $this->data);
	}

	/*Return assessments and assignments*/
	public function getUserData(Request $request,$class_id){
		$this->data['assignments'] = Assignment::where('user_id',Auth::user()->id)->where('class_id',$class_id)->get();
		$this->data['assessments'] = Assessment::where('user_id',Auth::user()->id)->where('class_id',$class_id)->get();
		$this->data['students']    = ClassAssigned::where('teacher_id',Auth::user()->id)->where('class_id',$class_id)->with('student')->get();
		return view('teacher.grades.assigndata', $this->data);
	}
}
