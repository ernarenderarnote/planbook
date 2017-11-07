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

            //echo"<pre>";print_r($request->all());die;

            $validation['studentID'] = 'required';
            $validation['gradeLevel'] = 'required';
            $validation['email'] = 'required';
            $validation['parentemail'] = 'required';
            $validation['password'] = 'required';
            $validation['firstName'] = 'required';
            $validation['middlename'] = 'required';
            $validation['lastname'] = 'required';
            
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
                'email'        => 'required',
                'parentemail'  => 'required',
                'password'     => 'required',
                'firstName'    => 'required',
                'middlename'   => 'required',
                'lastname'     => 'required',
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
                if($students->save()){

                    $response['success'] = 'TRUE';

                }

            }

        }

        return response()->json($response);

    }

    public function importExcel()
    {   
        
        $insert = array();    
        if(Input::hasFile('import_file')){
            echo"hello";
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            print_r($data);
            die();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                   print_r($value);
                   die(); 
                    /*$insert[] = [
                    'user_id'    => Auth::user()->id, 
                    'start_date' => $value->start_date,
                    'end_date'   => $value->end_date,
                    'start_time' => $value->start_time,
                    'end_time'   => $value->end_time,
                    'repeat'     => $value->repeat,
                    'school_day' => $value->school_day,
                    'event_title'=> $value->event_title,
                    'event_text' => $value->event_text
                    ];*/
                }
                /*if(!empty($insert)){
                    DB::table('events')->insert($insert);
                    return redirect()->back()->with('success', 'Events Imported Successfully!');
                }*/
            }
        }
        else{
            echo "hii";
        }
       // return back();
    }

	
}
