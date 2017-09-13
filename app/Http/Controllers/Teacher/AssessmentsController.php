<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Facades\App\Helpers\Common;

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
class AssessmentsController extends Controller
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
        $user_id = Auth::user()->id;
		$assessments = Assessment::where('user_id',Auth::user()->id)->get();
		$authClasses = UserClass::where('year_id',Auth::user()->current_selected_year)->where('user_id',Auth::user()->id)->with('schoolYear')->get();
		$this->data['assessments'] = $assessments;
		$this->data['classes'] = $authClasses;
        $this->data['units'] = DB::table('units')
             ->where('units.user_id',Auth::user()->id)
             ->leftJoin('user_classes', 'units.class_id', '=', 'user_classes.id')
             ->get();
		    return view('teacher.assessments.index', $this->data);

		//return redirect()->to('/');
	}

	/**
	 * Get add assessment view
	 */
	public function getAddAssessment()
	{
	
		// get user class
        
        $this->data['userClasses'] = UserClass::where('year_id',Auth::user()->current_selected_year)->where('user_id',Auth::user()->id)->with('schoolYear')->get();
        $this->data['units'] = Unit::where('user_id',Auth::user()->id)->get();
		$this->data['type']  = ScoreWeighting::where('class_id','0')->get();
		//echo"<pre>";print_r( $this->data['userClasses']);die;


		return view('teacher.assessments.add', $this->data);

	}

	/**
	 * Post add Assessment view
	 */

	public function postAddAssessment(Request $request)
	{

		$response = array();

        $Assessment = new Assessment();


        if($request->isMethod('post')) {

            //echo"<pre>";print_r($request->all());die;


            $validation['class'] = 'required';
            $validation['unit']  = 'required';
            $validation['title'] = 'required';
            $validation['total_points'] = 'numeric|max:100';
            

            $validator = Validator::make($request->all(), $validation);

            if($validator->fails()) {

                $response['error'] = $validator->errors()->all();

            }else{

                //echo"<pre>";print_r($request->all());die;

            	$format = 'd/m/Y';

                $Assessment->user_id = Auth::id();
                $Assessment->class_id = $request['class'];
                $Assessment->starts_on = \Carbon\Carbon::createFromFormat($format, $request['starts_on']);
                $Assessment->ends_on = \Carbon\Carbon::createFromFormat($format,$request['ends_on']);
                $Assessment->unit_id = $request['unit'];
                $Assessment->title = $request['title'];
                $Assessment->description = $request['description'];
                $Assessment->total_points = $request['total_points'];


                if($Assessment->save()){

                    $response['success'] = 'TRUE';

                }

            }

        }

        return response()->json($response);

	}


	/**
	 * Get Assessment edit view
	 */
	public function getEditAssessment($assessment_id)
	{

       
        // get user units
        $this->data['units'] = Unit::where('user_id',Auth::user()->id)->get();
        
        // get user class

        $this->data['userClasses'] = UserClass::where('year_id',Auth::user()->current_selected_year)->where('user_id',Auth::user()->id)->with('schoolYear')->get();

		// get Assessment

		$this->data['assessment'] = Assessment::where('id', $assessment_id)->with('userClass')->with('unit')->first();

		//echo"<pre>";print_r($this->data['assessment']);die;

		return view('teacher.assessments.edit', $this->data);

	}

	/**
	 * Post Edit assignment
	 */

	public function postEditAssessment(Request $request, $assessment_id)
	{

		$response = array();

        $Assessment = Assessment::where('id', $assessment_id)->first();


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
               
                $Assessment->user_id = Auth::id();
                $Assessment->class_id = $request['class'];
                $Assessment->starts_on = \Carbon\Carbon::createFromFormat($format, $request['starts_on']);
                $Assessment->ends_on = \Carbon\Carbon::createFromFormat($format,$request['ends_on']);
                $Assessment->unit_id = $request['unit'];
                $Assessment->title = $request['title'];
                $Assessment->description = $request['description'];
                $Assessment->total_points = $request['total_points'];


                if($Assessment->save()){

                    $response['success'] = 'TRUE';

                }

            }

        }

        return response()->json($response);

	}


    public function getScoreAssessment(Request $request, $assessment_id){
		$response = array(); 
		if($assessment_id != 0){
        $this->data['userClasses'] = UserClass::where('year_id',Auth::user()->current_selected_year)
									->where('user_id',Auth::user()->id)
									->where('id',$assessment_id)
									->with('schoolYear')
									->get();
		$this->data['units'] 	= Unit::where('user_id',Auth::user()->id)
								->where('class_id',$assessment_id)
								->get(); 
		$this->data['checkScore'] = ScoreWeighting::where('user_id',Auth::user()->id)
									->where('class_id',$assessment_id)
								    ->first(); 
		return view('teacher.assessments.score',$this->data);							
		}
		else{
			$this->data['userClasses'] = '0';
			$this->data['checkScore'] = ScoreWeighting::where('user_id',Auth::user()->id)
									->where('class_id',$assessment_id)
								    ->first(); 
			return view('teacher.assessments.score',$this->data);
		}
		
    }
	
	public function addScoreAssessment(Request $request){
		$ScoreWeighting = new ScoreWeighting();
		$response   = array();
		$ScoreWeighting->user_id = Auth::id();
		$ScoreWeighting->class_id = $request['class_id'];
		$hasScore  = ScoreWeighting::where('user_id',Auth::user()->id)
									->where('class_id',$request['class_id'])
									->get();		
		$ScoreWeighting->assessment = json_encode($request['assessment']);
		$ScoreWeighting->assignment = json_encode($request['assignment']);
		$ScoreWeighting->standard = json_encode($request['standard']);
		if(count($hasScore) >= '1'){
			ScoreWeighting::where('class_id',$request->class_id)
				->where('user_id',Auth::user()->id)
				->update(['assessment' => json_encode($request['assessment']),
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
	public function getScoreAssessmentAll(){
		return view('teacher.assessments.score');
	}
	
	public function authUploads(Request $request){
		$this->data['myFiles'] = MyFile::where('user_id',Auth::user()->id)->get();
		return view('teacher.assessments.response', $this->data);
    }
	
	public function seletedAssessment(Request $request){
		$this->data['units'] 	= Unit::where('user_id',Auth::user()->id)
								->where('class_id',$request->class_id)
								->get(); 
		$this->data['type']  = ScoreWeighting::where('class_id',$request->class_id)->get();	
		return $this->data;
		//return view('teacher.assessments.seletedresponse', $this->data);	
	}
	
}
