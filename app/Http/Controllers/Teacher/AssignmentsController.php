<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Facades\App\Helpers\Common;

use App\UserClass;
use App\SchoolYear;
use App\Unit;
use App\Assignment;
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
class AssignmentsController extends Controller
{
    /**
    * $data array pass data to view 
    */
    protected $data = [];

	public function __construct(){

		
		
	}

   /**
	 * Assignment List
	 */
	public function index()
	{
		$assignments = Assignment::where('user_id',Auth::user()->id)->get();
		$authClasses = UserClass::where('year_id',Auth::user()->current_selected_year)->where('user_id',Auth::user()->id)->with('schoolYear')->get();
		$this->data['assignments'] = $assignments;
        $this->data['classes'] = $authClasses;
        //echo"<pre>";print_r($assignments);die;
		$this->data['units'] = DB::table('units')
             ->where('units.user_id',Auth::user()->id)
             ->leftJoin('user_classes', 'units.class_id', '=', 'user_classes.id')
             ->get();
		return view('teacher.assignments.index', $this->data);

		//return redirect()->to('/');
	}

	/**
	 * Get add Assignment view
	 */
	public function getAddAssignment()
	{
	
		// get user class
        
        $this->data['userClasses'] = UserClass::where('year_id',Auth::user()->current_selected_year)->where('user_id',Auth::user()->id)->with('schoolYear')->get();
        
        $this->data['units'] = Unit::where('user_id',Auth::user()->id)->get();

		$this->data['type']  = ScoreWeighting::where('class_id','0')->get();

		return view('teacher.assignments.add', $this->data);

	}

	/**
	 * Post add Assignment view
	 */

	public function postAddAssignment(Request $request)
	{

		$response = array();

        $Assignment = new Assignment();


        if($request->isMethod('post')) {

            //echo"<pre>";print_r($request->all());die;


            $validation['class'] = 'required';
            $validation['unit'] = 'required';
            $validation['title'] = 'required';
            $validation['total_points'] = 'numeric|max:100';
            

            $validator = Validator::make($request->all(), $validation);

            if($validator->fails()) {

                $response['error'] = $validator->errors()->all();

            }else{

                //echo"<pre>";print_r($request->all());die;

            	$format = 'd/m/Y';

                $Assignment->user_id = Auth::id();
                $Assignment->class_id = $request['class'];
                $Assignment->starts_on = \Carbon\Carbon::createFromFormat($format, $request['starts_on']);
                $Assignment->ends_on = \Carbon\Carbon::createFromFormat($format,$request['ends_on']);
                $Assignment->unit_id = $request['unit'];
                $Assignment->title = $request['title'];
                $Assignment->description = $request['description'];
                $Assignment->total_points = $request['total_points'];


                if($Assignment->save()){

                    $response['success'] = 'TRUE';

                }

            }

        }

        return response()->json($response);

	}


	/**
	 * Get Assignment edit view
	 */
	public function getEditAssignment($assignment_id)
	{

       
        // get user units
        $this->data['units'] = Unit::where('user_id',Auth::user()->id)->get();
        
        // get user class

        $this->data['userClasses'] = UserClass::where('year_id',Auth::user()->current_selected_year)->where('user_id',Auth::user()->id)->with('schoolYear')->get();

		// get Assignment

		$this->data['assignment'] = Assignment::where('id', $assignment_id)->with('userClass')->with('unit')->first();

		//echo"<pre>";print_r($this->data['assignment']);die;

		return view('teacher.assignments.edit', $this->data);

	}

	/**
	 * Post Edit assignment
	 */

	public function postEditAssignment(Request $request, $assignment_id)
	{

		$response = array();

        $Assignment = Assignment::where('id', $assignment_id)->first();


        if($request->isMethod('post')) {

            //echo"<pre>";print_r($request->all());die;



            $rules = array(
                'class'  => 'required',
                'unit'   => 'required',
                'title'  => 'required',
                'total_points'  => 'numeric|max:100',
                
            );

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {

                $response['error'] = $validator->errors()->all();

            }else{

            	$format = 'd/m/Y';
               
                $Assignment->user_id = Auth::id();
                $Assignment->class_id = $request['class'];
                $Assignment->starts_on = \Carbon\Carbon::createFromFormat($format, $request['starts_on']);
                $Assignment->ends_on = \Carbon\Carbon::createFromFormat($format,$request['ends_on']);
                $Assignment->unit_id = $request['unit'];
                $Assignment->title = $request['title'];
                $Assignment->description = $request['description'];
                $Assignment->total_points = $request['total_points'];


                if($Assignment->save()){

                    $response['success'] = 'TRUE';

                }

            }

        }

        return response()->json($response);

	}

	public function getScoreassignment(Request $request, $assignment_id){
		$response = array(); 
		if($assignment_id != 0){
        $this->data['userClasses'] = UserClass::where('year_id',Auth::user()->current_selected_year)
									->where('user_id',Auth::user()->id)
									->where('id',$assignment_id)
									->with('schoolYear')
									->get();
		$this->data['units'] 	= Unit::where('user_id',Auth::user()->id)
								->where('class_id',$assignment_id)
								->get(); 
		$this->data['checkScore'] = ScoreWeighting::where('user_id',Auth::user()->id)
									->where('class_id',$assignment_id)
								    ->first(); 
		return view('teacher.assignments.score',$this->data);							
		}
		else{
			$this->data['userClasses'] = '0';
			$this->data['checkScore'] = ScoreWeighting::where('user_id',Auth::user()->id)
									->where('class_id',$assignment_id)
								    ->first(); 
			return view('teacher.assignments.score',$this->data);
		}
		
    }
	
	public function addScoreassignment(Request $request){
		$ScoreWeighting = new ScoreWeighting();
		$response   = array();
		$ScoreWeighting->user_id = Auth::id();
		$ScoreWeighting->class_id = $request['class_id'];
		$hasScore  = ScoreWeighting::where('user_id',Auth::user()->id)
									->where('class_id',$request['class_id'])
									->get();		
		$ScoreWeighting->assignment = json_encode($request['assignment']);
		$ScoreWeighting->assignment = json_encode($request['assignment']);
		$ScoreWeighting->standard = json_encode($request['standard']);
		if(count($hasScore) >= '1'){
			ScoreWeighting::where('class_id',$request->class_id)
				->where('user_id',Auth::user()->id)
				->update(['assignment' => json_encode($request['assignment']),
					  'assignment' => json_encode($request['assignment']),
					  'standard' => json_encode($request['standard']),
					  ]);
				$response['success'] ='Updated Successfully';
		}
		elseif($ScoreWeighting->save()){
			$response['success'] = 'Score Added Successfully';
		}
		return response()->json($response);
			
	}
	public function getScoreassignmentAll(){
		return view('teacher.assignments.score');
	}


	public function authUploads(Request $request){
		$this->data['myFiles'] = MyFile::where('user_id',Auth::user()->id)->get();
		return view('teacher.assessments.response', $this->data);
    }
	
	public function seletedAssignment(Request $request){
		$this->data['units'] 	= Unit::where('user_id',Auth::user()->id)
								->where('class_id',$request->class_id)
								->get(); 
		$this->data['type']     = ScoreWeighting::where('class_id',$request->class_id)->get();	
		return response()->json($this->data);
		//return view('teacher.assessments.seletedresponse', $this->data);	
	}



}
