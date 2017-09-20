<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\SchoolYear;


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

class SchoolYearController extends Controller
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

		//echo"Hi  there!";die;


		return view('teacher.schoolYear.index', $this->data);

		//return redirect()->to('/');
	}

	/**
	 * Get add new School year view
	 */
	public function getAddSchoolYear()
	{

		//echo"Hi  there!";die;


		return view('teacher.schoolYear.add', $this->data);

		//return redirect()->to('/');
	}

	/**
	 * 
	 */

	public function postAddSchoolYear(Request $request)
	{
        $school_year = new SchoolYear();

    	if($request->isMethod('POST')){

            $rules = array(
                'school_year'   => 'required',
                
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {

                return redirect()->back()->withErrors($validator->errors());
                
            } else {

                $school_year->year_name = $request->get('school_year');
                $school_year->user_id = Auth::user()->id;

                $school_year->first_day = $request->get('first_day');
                $school_year->last_day = $request->get('last_day');
               

                if($school_year->save()){

                    Session::flash('success', 'Your Year has been Added successfully!');
                    return redirect()->back();

                }else{

                    Session::flash('error', 'Oops! Please try again');
                    return redirect()->back();

                }

            }                
    
        }


	}






}
