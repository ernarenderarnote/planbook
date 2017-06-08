<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Facades\App\Helpers\Common;

use App\UserClass;
use App\SchoolYear;
use App\Unit;


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

class UnitsController extends Controller
{
    /**
    * $data array pass data to view 
    */
    protected $data = [];

	public function __construct(){

		
		
	}

   /**
	 * Classes List
	 */
	public function index()
	{
		$units = Unit::where('user_id',Auth::user()->id)->with('userClass')->get();
	
		$this->data['units'] = $units;

        //echo"<pre>";print_r($units);die;

		return view('teacher.units.index', $this->data);

		//return redirect()->to('/');
	}

	/**
	 * Get add Class view
	 */
	public function getAddUnit()
	{
	
		// get user class
        
        $this->data['userClasses'] = UserClass::where('year_id',Auth::user()->current_selected_year)->where('user_id',Auth::user()->id)->with('schoolYear')->get();

		//echo"<pre>";print_r( $this->data['userClass']);die;


		return view('teacher.units.add', $this->data);

	}

	/**
	 * Post add Class view
	 */

	public function postAddUnit(Request $request)
	{

		$response = array();

        $Unit = new Unit();


        if($request->isMethod('post')) {

            //echo"<pre>";print_r($request->all());die;


            $validation['unit_class'] = 'required';
            $validation['unit_id'] = 'required';
            $validation['unit_title'] = 'required';
            

            $validator = Validator::make($request->all(), $validation);

            if($validator->fails()) {

                $response['error'] = $validator->errors()->all();

            }else{

                //echo"<pre>";print_r($request->all());die;

            	$format = 'd/m/Y';

                $Unit->user_id = Auth::id();
                $Unit->class_id = $request['unit_class'];
                $Unit->starts_on = \Carbon\Carbon::createFromFormat($format, $request['starts_on']);
                $Unit->ends_on = \Carbon\Carbon::createFromFormat($format,$request['ends_on']);
                $Unit->unit_id = $request['unit_id'];
                $Unit->unit_title = $request['unit_title'];
                $Unit->unit_description = $request['unit_description'];


                if($Unit->save()){

                    $response['success'] = 'TRUE';

                }

            }

        }

        return response()->json($response);

	}


	/**
	 * Get unit edit view
	 */
	public function getEditUnit($unit_id)
	{

        // get user class
        
        $this->data['userClasses'] = UserClass::where('year_id',Auth::user()->current_selected_year)->where('user_id',Auth::user()->id)->with('schoolYear')->get();

		// get unit

		$this->data['unit'] = Unit::where('id', $unit_id)->with('userClass')->first();

		//echo"<pre>";print_r($this->data['Unit']);die;

		return view('teacher.units.edit', $this->data);

	}

	/**
	 * Post Edit Class
	 */

	public function postEditUnit(Request $request, $unit_id)
	{

		$response = array();

        $Unit = Unit::where('id', $unit_id)->first();


        if($request->isMethod('post')) {

            //echo"<pre>";print_r($request->all());die;



            $rules = array(
                'unit_class'   => 'required',
                'unit_id'   => 'required',
                'unit_title'   => 'required',
                
            );

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {

                $response['error'] = $validator->errors()->all();

            }else{

            	$format = 'd/m/Y';
               
                //$Unit->user_id = Auth::id();
                $Unit->class_id = $request['unit_class'];
                $Unit->starts_on = \Carbon\Carbon::createFromFormat($format, $request['starts_on']);
                $Unit->ends_on = \Carbon\Carbon::createFromFormat($format,$request['ends_on']);
                $Unit->unit_id = $request['unit_id'];
                $Unit->unit_title = $request['unit_title'];
                $Unit->unit_description = $request['unit_description'];


                if($Unit->save()){

                    $response['success'] = 'TRUE';

                }

            }

        }

        return response()->json($response);

	}



}
