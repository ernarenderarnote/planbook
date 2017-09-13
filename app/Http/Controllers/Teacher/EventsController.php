<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Facades\App\Helpers\Common;

use App\UserClass;
use App\SchoolYear;
use App\Unit;
use App\Assessment;


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

class EventsController extends Controller
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
		/*$assessments = Assessment::where('user_id',Auth::user()->id)->get();
		$authClasses = UserClass::where('year_id',Auth::user()->current_selected_year)->where('user_id',Auth::user()->id)->with('schoolYear')->get();
		$this->data['assessments'] = $assessments;
		$this->data['classes'] = $authClasses;
        //echo"<pre>";print_r($authClasses);die;*/

		return view('teacher.events.index', $this->data);

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
            $validation['unit'] = 'required';
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








}
