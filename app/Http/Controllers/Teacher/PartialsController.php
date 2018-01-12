<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;
use Input;
use Validator;
use Hash;
use DB;
use Redirect;
use View;
use Mail;
use Exception;
use App\SubstituteNotes;
use App\Announcement;

class PartialsController extends Controller
{
    protected $data = [];

    public function __construct(){
    
        
    }
    public function index(Request $request)
    {
        
    }
    public function announcement(Request $request){

        $this->data['announcement'] = Announcement::where('user_id',Auth::user()->id)->first();
        
        return view('teacher.partials.announcement',$this->data);
    }

    public function AnnouncementSave(Request $request){

        $response = array();

        $Announcement = new Announcement();

        if($request->isMethod('post')) {

            $validation['detailed_txt'] = 'required';
            
            $validator = Validator::make($request->all(), $validation);

            if($validator->fails()) {

                $response['error'] = $validator->errors()->all();

            }
            else{
                $Announcement->user_id     = Auth::user()->id;
                $Announcement->detailed_txt = $request['detailed_txt'];

                if($Announcement->save()){

                    $response['success'] = 'TRUE';

                }

            }

        }

        return response()->json($response);
    }

    public function AnnouncementEdit(Request $request){

        $response = array();

        $Announcement = Announcement::where('user_id',Auth::user()->id)->first();


        if($request->isMethod('post')) {

            $rules = array(
                'detailed_txt'  => 'required',
            );

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {

                $response['error'] = $validator->errors()->all();

            }else{               
                
                $Announcement->user_id = Auth::id();

                $Announcement->detailed_txt = $request['detailed_txt'];


                if($Announcement->save()){

                    $response['success'] = 'TRUE';

                }

            }

        }

        return response()->json($response);
    }

    public function AnnouncementDelete(Request $request,$id){

        $response = array();

        if(Announcement::where('id',$id)->delete()){
            $response['success'] = 'TRUE';
        }
        else{
            $response['error'] = 'TRUE';
        }
        return response()->json($response);
    }

    public function Substitute(Request $request){

        $this->data['substitute'] = SubstituteNotes::where('user_id',Auth::user()->id)->first();
        
        return view('teacher.partials.substitutenotes',$this->data);
    }

    public function SubstituteSave(Request $request){

        $response = array();

        $SubstituteNotes = new SubstituteNotes();

        if($request->isMethod('post')) {

            $validation['detailed_txt'] = 'required';
            
            $validator = Validator::make($request->all(), $validation);

            if($validator->fails()) {

                $response['error'] = $validator->errors()->all();

            }
            else{
                $SubstituteNotes->user_id     = Auth::user()->id;
                $SubstituteNotes->detailed_txt = $request['detailed_txt'];

                if($SubstituteNotes->save()){

                    $response['success'] = 'TRUE';

                }

            }

        }

        return response()->json($response);
    }

    public function SubstituteEdit(Request $request){

        $response = array();

        $SubstituteNotes = SubstituteNotes::where('user_id',Auth::user()->id)->first();


        if($request->isMethod('post')) {

            $rules = array(
                'detailed_txt'  => 'required',
            );

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {

                $response['error'] = $validator->errors()->all();

            }else{               
                
                $SubstituteNotes->user_id = Auth::id();

                $SubstituteNotes->detailed_txt = $request['detailed_txt'];


                if($SubstituteNotes->save()){

                    $response['success'] = 'TRUE';

                }

            }

        }

        return response()->json($response);
    }

    public function SubstituteDelete(Request $request,$id){

        $response = array();

        if(SubstituteNotes::where('id',$id)->delete()){
            $response['success'] = 'TRUE';
        }
        else{
            $response['error'] = 'TRUE';
        }
        return response()->json($response);
    }
}
