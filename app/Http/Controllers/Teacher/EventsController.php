<?php
namespace App\Http\Controllers\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Facades\App\Helpers\Common;
use App\User;
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
use App\ClassLesson;
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

            $validation['title'] = 'required';
            $validation['startdate'] ='required';
            $validation['enddate']='required'; 

            $validator = Validator::make($request->all(), $validation);

            if($validator->fails()) {

                $response['error'] = $validator->errors()->all();

            }
            else{
                if($request->schoolday == 'N' || $request['shiftlesson']=='NO'){

                    $format = 'd/m/Y';
                    
                    $Events->user_id      = Auth::id();
                    
                    $Events->start_date   = \Carbon\Carbon::createFromFormat($format, $request['startdate']);
                    
                    $Events->end_date     = \Carbon\Carbon::createFromFormat($format,$request['enddate']);
                    
                    $Events->start_time   = $request['starttime'];
                    
                    $Events->end_time     = $request['endtime'];
                    
                    $Events->repeat       = $request['repeats'];
                    
                    $Events->school_day   = $request['schoolday'];
                    
                    $Events->event_title  = $request['title'];
                    
                    $Events->event_text   = $request['description'];
                    
                    $Events->attachment   = ($request['attach']);
                    
                    $Events->add_day      = json_encode($request['addday']);
                    
                    $Events->remove_day   = json_encode($request['removeday']);
                    
                    $Events->private_event = $request['privateevent'];


                    if($Events->save()){
                    
                        $response['success'] = 'TRUE';

                    } 
                }
                else{
                    $format      = 'd/m/Y';
                    $start_date  =  \Carbon\Carbon::createFromFormat($format, $request['startdate'])->toDateString();
                    $end_date    =  \Carbon\Carbon::createFromFormat($format, $request['enddate'])->toDateString();
                    $day_diff    =  \Carbon\Carbon::parse($start_date)->diffInDays(\Carbon\Carbon::parse($end_date));
                    $bump_days   =   $day_diff + 1;
                    $class_ids   =  ClassLesson::whereBetween('lesson_date',[$start_date,$end_date])->where('user_id',Auth::user()->id)->pluck('class_id')->unique()->all();
                     
                    foreach($class_ids as $class_id){
                        
                        $start =  $start_date;
                        
                        $end = date('Y-m-d', strtotime($start_date.'+' .$bump_days.' day'));
                        
                        $workingDays = $this->getWorkingDays($class_id,$start,$end);
                       
                        $current_day = date('l', strtotime($start_date));
                        
                        $date = $start_date;
                        
                        $next_lessons = ClassLesson::where('class_id',$class_id)
                            ->where('lesson_date','>',$start_date)
                            ->where('user_id',Auth::user()->id)
                            ->orderBy('lesson_date', 'ASC')
                            ->pluck('lesson_date')
                            ->all();
                        foreach($next_lessons as $next){
                            
                            $next_day = date('l', strtotime($next));   
    
                            if(in_array($next_day,$workingDays)){ 
                                $loopLength = (($bump_days)/(count($workingDays)));
                                $position_next = array_search($next_day , $workingDays);
                    
                                if(($position_next + $bump_days) < count($workingDays)  )  {
                                     $day = $workingDays[$position_next + $bump_days]; 
                                      
                                    $dateGet = date('Y-m-d', strtotime($next.'next '. $day));
                                    
                                       ClassLesson::where('class_id',$class_id)
                                        ->where('lesson_date',$next)
                                        ->where('user_id',Auth::user()->id)
                                        ->update(['lesson_date' => $dateGet]);
                                        $response['Success'] = "Lesson moved Successfully";  
                            
                                }
                                else{
                                    $new_position = ($position_next + $bump_days) % (count($workingDays));
                                      $day = $workingDays[$new_position];
                                      $new_date = $next;
                                    for($i=0;$i<$loopLength;$i++)
                                    {
                                         $dateGet = date('Y-m-d', strtotime($new_date.'next '.$day));
                                          $new_date = $dateGet;
                                    }
        
                                       ClassLesson::where('class_id',$class_id)
                                        ->where('lesson_date',$next)
                                        ->where('user_id',Auth::user()->id)
                                        ->update(['lesson_date' => $dateGet]);
                                        $response['Success'] = "Lesson moved Successfully";  
                                        
                                }
                            }
                        } 
                        if(in_array($current_day,$workingDays))
                        {   
                            
                            $loopLength = (($bump_days)/(count($workingDays)));
                            $position = array_search($current_day , $workingDays);
                
                            if(($position + $bump_days) < count($workingDays) ){
                                 $day = $workingDays[$position + $bump_days];  
                                 $dateGet = date('Y-m-d', strtotime($date.'next '. $day));
                                 ClassLesson::where('class_id',$class_id)
                                    ->where('lesson_date',$date)
                                    ->where('user_id',Auth::user()->id)
                                    ->update(['lesson_date' => $dateGet]);
                                    $response['Success'] = "Lesson moved Successfully";  
                                      
                            }
                            else{
                                $new_position = ($position + $bump_days) % (count($workingDays));
                                  $day = $workingDays[$new_position];
                                $new_date = $start_date;
                                for($i=0;$i<$loopLength;$i++){
                                     $dateGet = date('Y-m-d', strtotime($date.'next '.$day));
                                     $new_date = $dateGet;
                                }
                               ClassLesson::where('class_id',$class_id)
                                ->where('lesson_date',$date)
                                ->where('user_id',Auth::user()->id)
                                ->update(['lesson_date' => $dateGet]);
                                $response['Success'] = "Lesson moved Successfully";  
                                  
                            }
                        }
                    }    
                }
                $format = 'd/m/Y';
                    
                $Events->user_id      = Auth::id();
                
                $Events->start_date   = \Carbon\Carbon::createFromFormat($format, $request['startdate']);
                
                $Events->end_date     = \Carbon\Carbon::createFromFormat($format,$request['enddate']);
                
                $Events->start_time   = $request['starttime'];
                
                $Events->end_time     = $request['endtime'];
                
                $Events->repeat       = $request['repeats'];
                
                $Events->school_day   = $request['schoolday'];
                
                $Events->event_title  = $request['title'];
                
                $Events->event_text   = $request['description'];
                
                $Events->attachment   = ($request['attach']);
                
                $Events->add_day      = json_encode($request['addday']);
                
                $Events->remove_day   = json_encode($request['removeday']);
                
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
                if($request->schoolday == 'N' || $request['shiftlesson']=='NO'){

                    $format = 'd/m/Y';

                    $Events->user_id        = Auth::id();
                    
                    $Events->start_date     = \Carbon\Carbon::createFromFormat($format, $request['startdate']);
                    
                    $Events->end_date       = \Carbon\Carbon::createFromFormat($format,$request['enddate']);
                    
                    $Events->start_time     = $request['starttime'];
                    
                    $Events->end_time       = $request['endtime'];
                    
                    $Events->repeat         = $request['repeats'];
                    
                    $Events->school_day     = $request['schoolday'];
                    
                    $Events->event_title    = $request['title'];
                    
                    $Events->event_text     = $request['description'];
                    
                    $Events->attachment     = json_encode($request['attach']);
                    
                    $Events->add_day        = json_encode($request['addday']);
                    
                    $Events->remove_day     = json_encode($request['removeday']);
                    
                    $Events->private_event  = $request['privateevent'];

                    if($Events->save()){

                        $response['success'] = 'TRUE';

                    }
                }  
                else{
                    $format      = 'd/m/Y';
                    $start_date  =  \Carbon\Carbon::createFromFormat($format, $request['startdate'])->toDateString();
                    $end_date    =  \Carbon\Carbon::createFromFormat($format, $request['enddate'])->toDateString();
                    $day_diff    =  \Carbon\Carbon::parse($start_date)->diffInDays(\Carbon\Carbon::parse($end_date));
                    $bump_days   =   $day_diff + 1;
                    $class_ids   =  ClassLesson::whereBetween('lesson_date',[$start_date,$end_date])->where('user_id',Auth::user()->id)->pluck('class_id')->unique()->all();
                     
                    foreach($class_ids as $class_id){
                        
                        $start =  $start_date;
                        
                        $end = date('Y-m-d', strtotime($start_date.'+' .$bump_days.' day'));
                        
                        $workingDays = $this->getWorkingDays($class_id,$start,$end);
                       
                        $current_day = date('l', strtotime($start_date));
                        
                        $date = $start_date;
                        
                        $next_lessons = ClassLesson::where('class_id',$class_id)
                            ->where('lesson_date','>',$start_date)
                            ->where('user_id',Auth::user()->id)
                            ->orderBy('lesson_date', 'ASC')
                            ->pluck('lesson_date')
                            ->all();
                        foreach($next_lessons as $next){
                            
                            $next_day = date('l', strtotime($next));   
    
                            if(in_array($next_day,$workingDays)){ 
                                $loopLength = (($bump_days)/(count($workingDays)));
                                $position_next = array_search($next_day , $workingDays);
                    
                                if(($position_next + $bump_days) < count($workingDays)  )  {
                                     $day = $workingDays[$position_next + $bump_days]; 
                                      
                                    $dateGet = date('Y-m-d', strtotime($next.'next '. $day));
                                    
                                       ClassLesson::where('class_id',$class_id)
                                        ->where('lesson_date',$next)
                                        ->where('user_id',Auth::user()->id)
                                        ->update(['lesson_date' => $dateGet]);
                                        $response['Success'] = "Lesson moved Successfully";  
                            
                                }
                                else{
                                    $new_position = ($position_next + $bump_days) % (count($workingDays));
                                      $day = $workingDays[$new_position];
                                      $new_date = $next;
                                    for($i=0;$i<$loopLength;$i++)
                                    {
                                         $dateGet = date('Y-m-d', strtotime($new_date.'next '.$day));
                                          $new_date = $dateGet;
                                    }
        
                                       ClassLesson::where('class_id',$class_id)
                                        ->where('lesson_date',$next)
                                        ->where('user_id',Auth::user()->id)
                                        ->update(['lesson_date' => $dateGet]);
                                        $response['Success'] = "Lesson moved Successfully";  
                                        
                                }
                            }
                        } 
                        if(in_array($current_day,$workingDays))
                        {   
                            
                            $loopLength = (($bump_days)/(count($workingDays)));
                            $position = array_search($current_day , $workingDays);
                
                            if(($position + $bump_days) < count($workingDays) ){
                                 $day = $workingDays[$position + $bump_days];  
                                 $dateGet = date('Y-m-d', strtotime($date.'next '. $day));
                                 ClassLesson::where('class_id',$class_id)
                                    ->where('lesson_date',$date)
                                    ->where('user_id',Auth::user()->id)
                                    ->update(['lesson_date' => $dateGet]);
                                    $response['Success'] = "Lesson moved Successfully";  
                                      
                            }
                            else{
                                $new_position = ($position + $bump_days) % (count($workingDays));
                                  $day = $workingDays[$new_position];
                                $new_date = $start_date;
                                for($i=0;$i<$loopLength;$i++){
                                     $dateGet = date('Y-m-d', strtotime($date.'next '.$day));
                                     $new_date = $dateGet;
                                }
                               ClassLesson::where('class_id',$class_id)
                                ->where('lesson_date',$date)
                                ->where('user_id',Auth::user()->id)
                                ->update(['lesson_date' => $dateGet]);
                                $response['Success'] = "Lesson moved Successfully";  
                                  
                            }
                        }
                    }    
                     $format = 'd/m/Y';

                        $Events->user_id        = Auth::id();
                        
                        $Events->start_date     = \Carbon\Carbon::createFromFormat($format, $request['startdate']);
                        
                        $Events->end_date       = \Carbon\Carbon::createFromFormat($format,$request['enddate']);
                        
                        $Events->start_time     = $request['starttime'];
                        
                        $Events->end_time       = $request['endtime'];
                        
                        $Events->repeat         = $request['repeats'];
                        
                        $Events->school_day     = $request['schoolday'];
                        
                        $Events->event_title    = $request['title'];
                        
                        $Events->event_text     = $request['description'];
                        
                        $Events->attachment     = json_encode($request['attach']);
                        
                        $Events->add_day        = json_encode($request['addday']);
                        
                        $Events->remove_day     = json_encode($request['removeday']);
                        
                        $Events->private_event  = $request['privateevent'];

                        if($Events->save()){

                            $response['success'] = 'TRUE';

                        }   
                        
                }  
            }

        }

        return response()->json($response);

    }

    /*Check Working Days*/
    public function getWorkingDays($class_id,$start,$end){
        $data = UserClass::where('user_id',Auth::user()->id)
            ->where('id',$class_id)
            ->where('start_date', '>=', $start)
            ->Where('end_date', '<=' , $end)
            ->orWhere(function($q) use($start, $end , $class_id){
                $q->where('end_date', '>=' ,$start )
                ->where('start_date' ,'<=', $end)
                ->where('id',$class_id);
            })->with(["classLesson" => function($q) use($start, $end) {
                $q->whereBetween("lesson_date", [$start, $end]);
            }])->get();
        $workingDays = array(); 
        foreach($data as $getData)
        {
            $workingDays = collect(json_decode($getData->class_schedule))
                                ->where("is_class" , "1")
                                ->pluck('text')
                                ->all();
                                        
        }
        return $workingDays;    
    }

    public function authUploads(Request $request){
        $this->data['myFiles'] = MyFile::where('user_id',Auth::user()->id)->get();
        return view('teacher.events.response', $this->data);
    }


    public function myFileUpload(Request $request)
    {      
        $original_path = $request->file('file')->getRealPath();
        
        $file = $request->file('file'); 
        
        $fileExtension = $file->getClientOriginalExtension();
        
        $filename = $file->getClientOriginalName();
        
        $file = time().'-'.str_random(6).'-'. $filename;
        
        $request->file('file')->move(base_path() . '/public/uploads/myfiles', $file);

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
        return Excel::create('events', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($events);
    }
    public function importExcel()
    {   $insert = array();    
        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                   
                    $insert[] = ['user_id' => Auth::user()->id, 'start_date' => $value->start_date,'end_date'=>$value->end_date,'start_time'=>$value->start_time,'end_time'=>$value->end_time,'repeat'=>$value->repeat,'school_day'=>$value->school_day,'event_title'=>$value->event_title,'event_text'=>$value->event_text];
                }
                if(!empty($insert)){
                    DB::table('events')->insert($insert);
                    return redirect()->back()->with('success', 'Events Imported Successfully!');
                }
            }
        }
        return back();
    }

    public function getImport(Request $request)
    {   
        $insert = array();
        
        $response = array();
        
        $user = User::where('email',$request->email)->where('promotional_code',$request->shareKey)->pluck('id')->all();
        
        $user_selected_school_year = SchoolYear::where('id',Auth::user()->current_selected_year)->where('user_id',Auth::user()->id)->pluck('year_name')->all();
        
        if(empty($user)){
            $response['error']=array('Teacher Email or Teacher Key is Invalid');
            return response()->json($response);
        }
        else{
           $Events = Events::where('user_id', $user)->get(); 
           if(!empty($Events) && $Events->count()){
                foreach ($Events as $key => $value) {
                   
                    $insert[] = ['user_id' => Auth::user()->id, 'start_date' => $value->start_date,'end_date'=>$value->end_date,'start_time'=>$value->start_time,'end_time'=>$value->end_time,'repeat'=>$value->repeat,'school_day'=>$value->school_day,'event_title'=>$value->event_title,'event_text'=>$value->event_text];
                }
                if(!empty($insert)){
                    DB::table('events')->insert($insert);
                    $response['success'] = 'TRUE'; 
                        return response()->json($response);
                }
                else{
                        $response['error'] = array('No Events are present for this teacher '); 
                        return response()->json($response);
                }

            }
        }
        die();
    }

    
}
