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
use App\MyList;
class MylistController extends Controller
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
		$mylists = MyList::where('user_id',Auth::user()->id)->get();
		$this->data['mylists'] = $mylists;
		return view('teacher.mylist.index', $this->data);
	}

	/**
	 * Get add assessment view
	 */
	public function getAddList()
	{
	

		return view('teacher.mylist.add', $this->data);

	}

	/**
	 * Post add Assessment view
	 */

	public function postAddmylist(Request $request)
	{

		$response = array();

        $mylist = new MyList();


        if($request->isMethod('post')) {

            //echo"<pre>";print_r($request->all());die;

            $validation['listId'] = 'required';

            $validator = Validator::make($request->all(), $validation);

            if($validator->fails()) {

                $response['error'] = $validator->errors()->all();

            }else{

                $mylist->user_id = Auth::id();

                $mylist->list_id = $request['listId'];
                
                $mylist->description = $request['description'];

                if($mylist->save()){

                    $response['success'] = 'TRUE';

                }

            }

        }

        return response()->json($response);

	}


	/**
	 * Get Assessment edit view
	 */
	public function getEditList($id)
	{

		$this->data['mylists'] = MyList::where('id', $id)->where('user_id',Auth::user()->id)->first();
			return view('teacher.mylist.edit', $this->data);

	}

	/**
	 * Post Edit assignment
	 */

	public function postEditMylist(Request $request, $mylist_id)
	{

		$response = array();

        $mylist = MyList::where('id', $mylist_id)->first();


        if($request->isMethod('post')) {

            //echo"<pre>";print_r($request->all());die;



            $rules = array(
                'listId'  => 'required',
     
            );

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {

                $response['error'] = $validator->errors()->all();

            }else{
               
                $mylist->user_id = Auth::id();
                $mylist->list_id = $request['listId'];
                $mylist->description = $request['description'];
                if($mylist->save()){

                    $response['success'] = 'TRUE';

                }

            }

        }

        return response()->json($response);

	}


}
