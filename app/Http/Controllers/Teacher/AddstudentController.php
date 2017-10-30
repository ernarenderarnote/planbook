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
class AddstudentController extends Controller
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
	   $this->data['students'] = Students::where('teacher_id',Auth::user()->id)->get();
       return view('teacher.addstudents.index', $this->data);

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

        $response['success'] = 'TRUE';
        $response['success_redirect_url'] = '/student/dashboard/index';
	}
}
