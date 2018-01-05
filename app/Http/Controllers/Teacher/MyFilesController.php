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

class MyFilesController extends Controller
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
     * S
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->data['myFiles'] = MyFile::where('user_id',Auth::user()->id)->get();

		return view('teacher.myfiles.index',$this->data);
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


    public function fileDelete($file_id)
    {
        
        $MyFile =  MyFile::findOrFail($file_id);

      

        $MyFile->delete();

        Session::flash('success', 'File Deleted successfully!');

       return redirect('teacher/my_files');
    }

    // download file_id file
    public function fileDownload(Request $request){
		$file_id = $request->fileID;
        $MyFile = MyFile::find($file_id); 
        $pathToFile= public_path().'/uploads/myfiles/'.$MyFile->file_name;
		//return response()->download($pathToFile);   
		return $pathToFile;
    }
	public function authUploads(Request $request){
		$this->data['myFiles'] = MyFile::where('user_id',Auth::user()->id)->get();
		return view('teacher.dashboard.lesson.month.ajaxResponse',$this->data);
    }







}
