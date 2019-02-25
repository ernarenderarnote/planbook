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
use Excel;
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

    public function getAddStudents(Request $request)
    {
       return view('teacher.addstudents.add', $this->data);
    }   

    public function postAddStudents(Request $request)
    {

        $response = array();

        $students = new Students();


        if($request->isMethod('post')) {

            $validation['studentID']   = 'required';
            $validation['gradeLevel']  = 'required';
            $validation['email']       = 'required|email';
            $validation['parentemail'] = 'required|email';
            $validation['password']    = 'required';
            $validation['firstName']   = 'required';
            $validation['middlename']  = 'required';
            $validation['lastname']    = 'required';
            $validation['phonenumber'] = 'required|numeric';
            $validator = Validator::make($request->all(), $validation);

            if($validator->fails()) {

                $response['error'] = $validator->errors()->all();

            }else{

                $students->studentID   = $request['studentID'];
                $students->teacher_id  = Auth::id();
                $students->name        = $request['firstName'];
                $students->middle_name = $request['middlename'];
                $students->last_name   = $request['lastname'];
                $students->grade_level = $request['gradeLevel'];
                $students->email       = $request['email'];
                $students->parent_email= $request['parentemail'];
                $students->phone_number= $request['phonenumber'];
                $students->birthdate   = $request['birthdate'];
                $students->password    = Hash::make($request['password']);
                $students->password_hash= $request['password'];
                if($students->save()){

                    $response['success'] = 'TRUE';

                }

            }

        }

        return response()->json($response);

    }
	

	public function getEditStudents($student_id)
	{
		 
		$this->data['students'] = Students::where('teacher_id',Auth::user()->id)->where('id',$student_id)->first();

        return view('teacher.addstudents.edit', $this->data);
	}

	public function postEditStudents(Request $request, $id)
    {
        $response = array();

        $students = Students::where('id', $id)->first();


        if($request->isMethod('post')) {

            //echo"<pre>";print_r($request->all());die;



            $rules = array(
                'studentID'    => 'required',
                'gradeLevel'   => 'required',
                'email'        => 'required|email',
                'parentemail'  => 'required|email',
                'password'     => 'required',
                'firstName'    => 'required',
                'middlename'   => 'required',
                'lastname'     => 'required',
                'phonenumber'  => 'required|numeric'
            );

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {

                $response['error'] = $validator->errors()->all();

            }else{
               
                $students->studentID   = $request['studentID'];
                $students->teacher_id  = Auth::id();
                $students->name        = $request['firstName'];
                $students->middle_name = $request['middlename'];
                $students->last_name   = $request['lastname'];
                $students->grade_level = $request['gradeLevel'];
                $students->email       = $request['email'];
                $students->parent_email= $request['parentemail'];
                $students->phone_number= $request['phonenumber'];
                $students->birthdate   = $request['birthdate'];
                $students->password    = Hash::make($request['password']);
                $students->password_hash = $request['password'];
                if($students->save()){

                    $response['success'] = 'TRUE';

                }

            }

        }

        return response()->json($response);

    }

    public function importExcel()
    {   
        $response = array();
        $insert   = array();    
        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    $insert[] = [
                        'studentID'      => $value->student_id_optional,
                        'teacher_id'     => Auth::user()->id, 
                        'name'           => $value->first_name_required,
                        'middle_name'    => $value->middle_name_optional,
                        'last_name'      => $value->last_name_required,
                        'grade_level'    => $value->grade_level_required,
                        'email'          => $value->email_address_required,
                        'parent_email'   => $value->parent_email_optional,
                        'phone_number'   => $value->phone_number_optional,
                        'birthdate'      => $value->birthdate_optional,
                        'password'       => Hash::make($value->access_code_required),
                    ];
                }
                if(!empty($insert) && $value->email_address_required!='' && $value->access_code_required!=''){
                    DB::table('students')->insert($insert);
                    $response['success'] = 'TRUE';
                }
            }
        }
        else{
            $response['success'] = 'FALSE';
        }
        return response()->json($response);  
    }

    public function FilterStudent(request $request){
        $response = array();

        if($request->gradelevel!=''){
            $studentsArray = Students::where('teacher_id',Auth::user()->id)->where('grade_level',$request->gradelevel)->get();
        }
        else{
            $studentsArray = Students::where('teacher_id',Auth::user()->id)->get();
        }

        $response['success']     = 'TRUE';
        $response['students']    = $studentsArray;
        return response()->json($response);
    }
	
}
