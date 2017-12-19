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
use App\SharingOption;
class SharingoptionController extends Controller
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
		$this->data['sharingoption'] = SharingOption::where('user_id',Auth::user()->id)->first(); 
		return view('teacher.sharingoption.index', $this->data);

	}
	
	public function postOptions(Request $request){
		$response = array();

        $sharing = new SharingOption();


        if($request->isMethod('post')) {

            $validation['studentkey'] = 'required';

            $validator = Validator::make($request->all(), $validation);

            if($validator->fails()) {

                $response['error'] = $validator->errors()->all();
            }else{

                $sharing->user_id = Auth::id();
                $sharing->teacher_key = $request['teacherkey'];
                $sharing->student_key = $request['studentkey'];
                $sharing->information = json_encode($request['information']);
                $sharing->future_weeks = $request['future_weeks'];
                $sharing->default_view = $request['default_view'];


                if($sharing->save()){

                    $response['success'] = 'TRUE';

                }

            }

        }

        return response()->json($response);
	}

	public function postEditOptions(Request $request,$id){

		$response = array();

        $sharing = SharingOption::where('id', $id)->first();


        if($request->isMethod('post')) {


            $validation['studentkey'] = 'required';


            $rules = array(
                'studentkey'   => 'required',
            );

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {

                $response['error'] = $validator->errors()->all();

            }else{
               
                $sharing->user_id      = Auth::id();
                $sharing->teacher_key  = $request['teacherkey'];
                $sharing->student_key  = $request['studentkey'];
                $sharing->information  = json_encode($request['information']);
                $sharing->future_weeks = $request['future_weeks'];
                $sharing->default_view = $request['default_view'];

                if($sharing->save()){

                    $response['success'] = 'TRUE';

                }

            }

        }

        return response()->json($response);
	}
}
