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
use App\MyStrategies;
class MystrategiesController extends Controller
{
    /**
    * $data array pass data to view 
    */
    protected $data = [];

	public function __construct(){

		
		
	}
	public function index()
	{
        $user_id = Auth::user()->id;
		$mystrategies = MyStrategies::where('user_id',Auth::user()->id)->get();
		$this->data['mystrategies'] = $mystrategies;
		return view('teacher.mystrategies.index', $this->data);
	}

	/**
	 * Get add assessment view
	 */
	public function getAddstrategies()
	{
	

		return view('teacher.mystrategies.add', $this->data);

	}

	/**
	 * Post add Assessment view
	 */

	public function postAddstrategies(Request $request)
	{

		$response = array();

        $stratergy = new MyStrategies();


        if($request->isMethod('post')) {

            //echo"<pre>";print_r($request->all());die;

            $validation['stratergy_id'] = 'required';
            $validation['title']        = 'required'; 

            $validator = Validator::make($request->all(), $validation);

            if($validator->fails()) {

                $response['error'] = $validator->errors()->all();

            }else{

                $stratergy->user_id = Auth::id();

                $stratergy->strategies_id = $request['stratergy_id'];
                $stratergy->title = $request['title'];
                $stratergy->description = $request['description'];

                if($stratergy->save()){

                    $response['success'] = 'TRUE';

                }

            }

        }

        return response()->json($response);

	}


	/**
	 * Get Assessment edit view
	 */
	public function getEditstrategies($id)
	{

		$this->data['data'] = MyStrategies::where('id', $id)->where('user_id',Auth::user()->id)->first();
			return view('teacher.mystrategies.edit', $this->data);

	}

	/**
	 * Post Edit assignment
	 */

	public function postEditstrategies(Request $request, $id)
	{

		$response = array();

        $mydata = MyStrategies::where('id', $id)->first();


        if($request->isMethod('post')) {

            //echo"<pre>";print_r($request->all());die;



            $rules = array(
                'stratergy_id'  => 'required',
                'title'         => 'required', 
     
            );

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {

                $response['error'] = $validator->errors()->all();

            }else{
               
                $mydata->user_id = Auth::id();
                $mydata->strategies_id = $request['stratergy_id'];
                $mydata->title = $request['title'];
                $mydata->description = $request['description'];
                if($mydata->save()){

                    $response['success'] = 'TRUE';

                }

            }

        }

        return response()->json($response);

	}
}
