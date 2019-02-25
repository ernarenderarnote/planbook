<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Facades\App\Helpers\Common;

use App\UserClass;
use App\SchoolYear;
use App\Unit;
use App\MyFile;


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
use App\Template;
class TemplateController extends Controller
{
    
    private $data = array();

    


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['classes'] = UserClass::where('year_id',Auth::user()->current_selected_year)->where('user_id',Auth::user()->id)->with('schoolYear')->get();
        $this->data['templates'] = Template::where('user_id',Auth::user()->id)->get();

		return view('teacher.template.index',$this->data);
    }
	public function getAddTemplate()
    {
    
        // get user class
        
        $this->data['userClasses'] = UserClass::where('year_id',Auth::user()->current_selected_year)->where('user_id',Auth::user()->id)->with('schoolYear')->get();
        return view('teacher.template.add', $this->data);

    }

    public function postAddTemplate(Request $request)
    {

        $response = array();

        $Template = new Template();


        if($request->isMethod('post')) {

            $validation['class'] = 'required';
            $validation['day']   = 'required';
            $validation['type']  = 'required';
            

            $validator = Validator::make($request->all(), $validation);

            if($validator->fails()) {

                $response['error'] = $validator->errors()->all();

            }else{

                $format = 'd/m/Y';

                $Template->user_id = Auth::id();
                $Template->class_id = $request['class'];
                $Template->starts_on = \Carbon\Carbon::createFromFormat($format, $request['starts_on']);
                $Template->ends_on = \Carbon\Carbon::createFromFormat($format,$request['ends_on']);
                $Template->type = $request['type'];
                $Template->day = $request['day'];
                $Template->use_start = $request['use_start'];
                $Template->use_end = $request['use_end'];
                $Template->description = $request['description'];
                
                if($Template->save()){

                    $response['success'] = 'TRUE';

                }

            }

        }

        return response()->json($response);

    }

    public function getEditTemplate($id)
    {

        $this->data['userClasses'] = UserClass::where('year_id',Auth::user()->current_selected_year)->where('user_id',Auth::user()->id)->with('schoolYear')->get();

        // get Assessment

        $this->data['template'] = Template::where('id', $id)->with('userClass')->first();

        //echo"<pre>";print_r($this->data['assessment']);die;

        return view('teacher.template.edit', $this->data);

    }

    /**
     * Post Edit assignment
     */

    public function postEditTemplate(Request $request, $id)
    {

        $response = array();

        $Template = Template::where('id', $id)->first();


        if($request->isMethod('post')) {


            $rules = array(
                'class'  => 'required',
                
            );

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {

                $response['error'] = $validator->errors()->all();

            }else{

                $format = 'd/m/Y';

                $Template->user_id = Auth::id();
                $Template->class_id = $request['class'];
                $Template->starts_on = \Carbon\Carbon::createFromFormat($format, $request['starts_on']);
                $Template->ends_on = \Carbon\Carbon::createFromFormat($format,$request['ends_on']);
                $Template->type = $request['type'];
                $Template->day = $request['day'];
                $Template->use_start = $request['use_start'];
                $Template->use_end = $request['use_end'];
                $Template->description = $request['description'];

                if($Template->save()){

                    $response['success'] = 'TRUE';

                }

            }

        }

        return response()->json($response);

    }
}
