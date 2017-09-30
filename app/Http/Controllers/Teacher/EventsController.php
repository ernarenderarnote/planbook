<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Facades\App\Helpers\Common;

use App\UserClass;
use App\SchoolYear;
use App\Unit;
use App\Events;


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
		$this->data['events'] = Events::where('user_id',Auth::user()->id)->get();
		return view('teacher.events.index', $this->data);
	}

	/**
	 * Get add assessment view
	 */
	public function getAddEvents()
	{
	
		// get user class
        
        /*$this->data['userClasses'] = UserClass::where('year_id',Auth::user()->current_selected_year)->where('user_id',Auth::user()->id)->with('schoolYear')->get();
        $this->data['units'] = Unit::where('user_id',Auth::user()->id)->get();*/

		//echo"<pre>";print_r( $this->data['userClasses']);die;


		return view('teacher.events.add');

	}

	/**
	 * Post add Assessment view
	 */

	public function postAddEvents(Request $request)
	{

		$response = array();

        $Events = new Events();


        if($request->isMethod('post')) {

            //echo"<pre>";print_r($request->all());die;

            $validation['title'] = 'required';
            $validation['startdate'] ='required';
            $validation['enddate']='required'; 

            $validator = Validator::make($request->all(), $validation);

            if($validator->fails()) {

                $response['error'] = $validator->errors()->all();

            }else{
                //$dataarr = serialize($request->attach);
                //echo"<pre>";print_r($dataarr);die;

            	$format = 'd/m/Y';

                $Events->user_id = Auth::id();
                $Events->start_date = \Carbon\Carbon::createFromFormat($format, $request['startdate']);
                $Events->end_date = \Carbon\Carbon::createFromFormat($format,$request['enddate']);
                $Events->start_time = $request['starttime'];
                $Events->end_time = $request['endtime'];
                $Events->repeat = $request['repeats'];
                $Events->school_day = $request['schoolday'];
                $Events->event_title = $request['title'];
                $Events->event_text = $request['description'];
                $Events->attachment = serialize($request['attach']);
                $Events->add_day = serialize($request['addday']);
                $Events->remove_day = serialize($request['removeday']);
                $Events->private_event = $request['privateevent'];


                if($Events->save()){
                
                    $response['success'] = 'TRUE';

                } 

            }
            
        }

        return response()->json($response);

	}


	/**
	 * Get Event edit view
	 */
	public function getEditEvent($event_id)
	{

       
       // get user events
        
        $this->data['userEvents'] = Events::where('user_id',Auth::user()->id)->where('id',$event_id)->get();

		return view('teacher.events.edit',$this->data);

	}

	/**
	 * Post Edit assignment
	 */

	public function postEditEvent(Request $request, $event_id)
	{

		$response = array();

        $Events = Events::where('id', $event_id)->first();


        if($request->isMethod('post')) {

            //echo"<pre>";print_r($request->all());die;

            $rules = array(
                'title'  => 'required',
                'startdate'   => 'required',
                'enddate'  => 'required',
                
            );

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {

                $response['error'] = $validator->errors()->all();

            }else{

            	$format = 'd/m/Y';

                $Events->user_id = Auth::id();
                $Events->start_date = \Carbon\Carbon::createFromFormat($format, $request['startdate']);
                $Events->end_date = \Carbon\Carbon::createFromFormat($format,$request['enddate']);
                $Events->start_time = $request['starttime'];
                $Events->end_time = $request['endtime'];
                $Events->repeat = $request['repeats'];
                $Events->school_day = $request['schoolday'];
                $Events->event_title = $request['title'];
                $Events->event_text = $request['description'];
                $Events->attachment = serialize($request['attach']);
                $Events->add_day = serialize($request['addday']);
                $Events->remove_day = serialize($request['removeday']);
                $Events->private_event = $request['privateevent'];

                if($Events->save()){

                    $response['success'] = 'TRUE';

                }

            }

        }

        return response()->json($response);

	}

    public function authUploads(Request $request){
        $this->data['myFiles'] = MyFile::where('user_id',Auth::user()->id)->get();
        return view('teacher.events.response', $this->data);
    }


    public function myFileUpload(Request $request)
    {


        //echo"<pre>";print_r($request->all());
             
          
        $original_path = $request->file('file')->getRealPath();
        $file = $request->file('file'); 
        $fileExtension = $file->getClientOriginalExtension();
        $filename = $file->getClientOriginalName();
        $file = time().'-'.str_random(6).'-'. $filename;
        
        $request->file('file')->move(base_path() . '/public/uploads/myfiles', $file);
        
        //MyFile::create(['file' => $file]);


        $MyFile = new MyFile();

        $MyFile->user_id = Auth::user()->id;
        $MyFile->file_name = $file;
        $MyFile->uploadSize = $request->uploadSize;
        $MyFile->file_changeable_name = $filename;
               
                

        if($MyFile->save()){

           return response()->json(["status" => 'ok', "file" => $file ]);

        }else{
          return response()->json(["status" => 'error', "file" => $file ]);

        }


       
    }

    public function importExport()
    {
        return view('importExport');
    }
    public function downloadExcel($events)
    {
        $data = Events::get()->toArray();
        return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($events);
    }
    public function importExcel()
    {
        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    $insert[] = ['title' => $value->title, 'description' => $value->description];
                }
                if(!empty($insert)){
                    DB::table('events')->insert($insert);
                    dd('Insert Record successfully.');
                }
            }
        }
        return back();
    }



}
