<?php

namespace App\Http\Controllers\Teacher;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\ContactUsMesssge;
use App\Mail\ContactUs;
use App\UserLessonSectionLayout;
use Session;
use App\User;
use App\UserClass;
use App\SchoolYear;
use App\Unit;
use DB;
use App\ViewItems;
class DashboardController extends Controller
{

	/********************* PROPERTY ********************/  
    private $dayLabels = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun");
     
    private $currentYear=0;
     
    private $currentMonth=0;
     
    private $currentDay=0;
     
    private $currentDate=null;
     
    private $daysInMonth=0;
     
    private $naviHref= null;
     
    /********************* PUBLIC **********************/  

	/**
     * $data array pass data to view 
     */
    protected $data = [];

	public function __construct(){

		
		
	}
   

   /**
	 * Dashboard index
	 */
	public function index()
	{
        $this->data['user_plan'] = UserLessonSectionLayout::where('user_id',Auth::user()->id)->first(); 
		return view('teacher.dashboard.index', $this->data);


	}
    public function weekView()
	{

		return view('teacher.dashboard.weekCalendar', $this->data);

	}
    public function dayView()
	{

		return view('teacher.dashboard.dayCalendar', $this->data);

	}
    public function listView(Request $request)
    {
        $this->data['classes'] = UserClass::where('year_id',Auth::user()->current_selected_year)->where('user_id',Auth::user()->id)->with('schoolYear')->get();
        $this->data['units'] = DB::table('units')
             ->where('units.user_id',Auth::user()->id)
             ->leftJoin('user_classes', 'units.class_id', '=', 'user_classes.id')
             ->get();
        return view('teacher.dashboard.listCalendar', $this->data);

    }
    /**
    * print out the calendar
    */
    public function showCalendar() {


        $year  = null;
         
        $month =  null;
         
        if(null==$year&&isset($_GET['year'])){
 
            $year = $_GET['year'];
         
        }else if(null==$year){
 
            $year = date("Y",time());  
         
        }          
         
        if(null==$month&&isset($_GET['month'])){
 
            $month = $_GET['month'];
         
        }else if(null==$month){
 
            $month = date("m",time());
         
        }                  
         
        $this->currentYear=$year;
         
        $this->currentMonth=$month;
         
        $this->daysInMonth=$this->_daysInMonth($month,$year);  
         
        $content='<div id="calendar">'.
                        '<div class="box-content">'.
                                '<ul class="label">'.$this->_createLabels().'</ul>';   
                                $content.='<div class="clear"></div>';     
                                $content.='<ul class="dates">';    
                                 
                                $weeksInMonth = $this->_weeksInMonth($month,$year);
                                // Create weeks in a month
                                for( $i=0; $i<$weeksInMonth; $i++ ){
                                     
                                    //Create days in a week
                                    for($j=1;$j<=7;$j++){
                                        $content.=$this->_showDay($i*7+$j);
                                    }
                                }
                                 
                                $content.='</ul>';
                                 
                                $content.='<div class="clear"></div>';     
             
                        $content.='</div>';
                 
        $content.='</div>'.

			$this->_createNavi();


        $this->data['content'] = $content;

        return view('teacher.dashboard.showCalendar', $this->data);

    }
     
    /********************* PRIVATE **********************/ 
    /**
    * create the li element for ul
    */
    private function _showDay($cellNumber){
         
        if($this->currentDay==0){
             
            $firstDayOfTheWeek = date('N',strtotime($this->currentYear.'-'.$this->currentMonth.'-01'));
                     
            if(intval($cellNumber) == intval($firstDayOfTheWeek)){
                 
                $this->currentDay=1;
                 
            }
        }
         
        if( ($this->currentDay!=0)&&($this->currentDay<=$this->daysInMonth) ){
             
            $this->currentDate = date('Y-m-d',strtotime($this->currentYear.'-'.$this->currentMonth.'-'.($this->currentDay)));
             
            $cellContent = $this->currentDay;
             
            $this->currentDay++;   
             
        }else{
             
            $this->currentDate =null;
 
            $cellContent=null;
        }
             
         
        return '<li id="li-'.$this->currentDate.'" class="'.($cellNumber%7==1?' start ':($cellNumber%7==0?' end ':' ')).
                ($cellContent==null?'mask':'').'">'.$cellContent.'</li>';
    }
     
    /**
    * create navigation
    */
    private function _createNavi(){
         
        $nextMonth = $this->currentMonth==12?1:intval($this->currentMonth)+1;
         
        $nextYear = $this->currentMonth==12?intval($this->currentYear)+1:$this->currentYear;
         
        $preMonth = $this->currentMonth==1?12:intval($this->currentMonth)-1;
         
        $preYear = $this->currentMonth==1?intval($this->currentYear)-1:$this->currentYear;
         
        return
            '<script>'.
                '$("#pPrev").attr("href","?month='.sprintf('%02d',$preMonth).'&year='.$preYear.'");'.
                 '$("#pNext").attr("href","?month='.sprintf("%02d", $nextMonth).'&year='.$nextYear.'");'.
            '</script>';
    }
         
    /**
    * create calendar week labels
    */
    private function _createLabels(){  
                 
        $content='';
         
        foreach($this->dayLabels as $index=>$label){
             
            $content.='<li class="'.($label==6?'end title':'start title').' title">'.$label.'</li>';
 
        }
         
        return $content;
    }
     
     
     
    /**
    * calculate number of weeks in a particular month
    */
    private function _weeksInMonth($month=null,$year=null){
         
        if( null==($year) ) {
            $year =  date("Y",time()); 
        }
         
        if(null==($month)) {
            $month = date("m",time());
        }
         
        // find number of days in this month
        $daysInMonths = $this->_daysInMonth($month,$year);
         
        $numOfweeks =  ceil($daysInMonths/7);
         
        $monthEndingDay= date('N',strtotime($year.'-'.$month.'-'.$daysInMonths));
         
        $monthStartDay = date('N',strtotime($year.'-'.$month.'-01'));
         
        if($monthEndingDay<$monthStartDay){
             
            $numOfweeks++;
         
        }
         
        return $numOfweeks;
    }
 
    /**
    * calculate number of days in a particular month
    */
    private function _daysInMonth($month=null,$year=null){
         
        if(null==($year))
            $year =  date("Y",time()); 
 
        if(null==($month))
            $month = date("m",time());
             
        return date('t',strtotime($year.'-'.$month.'-01'));
    }

    /** Edit User Account Details**/

    public function updateEmail(Request $request){
                $userId = Auth::user()->id;
                $update_email = User::where('id', $userId)->update(['email'=>$request->get('email')]);
                if($update_email){
                    $response['status'] = 'ok';
                }else{
                    $response['status'] = 'error';
                }
                return response()->json($response);
        }

   public function updatePassword(Request $request) {
            $this->validate($request, [
                'old_password'     => 'required',
                'new_password'     => 'required',
                'confirm_password' => 'required|same:new_password',
            ]);
            $data = $request->all();
            $user = User::find(auth()->user()->id);
            if(!Hash::check($data['old_password'], $user->password)){
                 return back()
                            ->with('error','The specified password does not match the database password');
                $response['status'] = 'error';
            }else{
              $update_pswd = User::where('id', auth()->user()->id)->update(['password'=>Hash::make($data['new_password'])]);
              if($update_pswd){
                    $response['status'] = 'ok';
                }
            } 
        return response()->json($response);
        }  
        public function updateAccountDetails(Request $request) {
            $userdata = $request->all();
            $userId = Auth::user()->id;
            $myDetails = User::where('id', $userId)->update(['first_name' => $userdata['first_name'], 'last_name'=>$userdata['last_name'], 'display_name'=>$userdata['display_name'], 'school_district'=>$userdata['school_district'], 'school_name'=>$userdata['school_name']  ]);
            if($myDetails){
                $response['status'] = 'ok';
                return response()->json($response);
            }else{
                $response['status'] = 'error';
                return response()->json($response);
            }
        }  
    /*  Custom functions to get calendar data */
    /* Send Email On contact us messge*/
    
         public function contactUs(Request $request) {
            $msgdata = $request->all();
            if($msgdata['img_val']){
            $screenshot_64 = explode(",", $msgdata['img_val']);
            $screenshot_file = time();
            $savefile = @file_put_contents(base_path() ."/public/contactus_image/screen".$screenshot_file.".png", base64_decode($screenshot_64[1]));
            $screemshotname = "screen".$screenshot_file.".png";
             } else{
                 $screemshotname = '';
             }
          
            $my_data_array = array();
            $my_data_array['contact_message'] = $msgdata['contact_message'];
            $userId = Auth::user()->id;
            
         $validator = Validator::make($request->all(), [
                'file_name'    => 'mimes:jpeg,jpg,png'
            ]);
            if ($validator->fails()){
                $response['status'] = 'error';
                $response['msg'] = $validator->errors(); 
                return response()->json($response);
            }else{
                if($request->file('file_name')){
                $image = $request->file('file_name'); 
                $fileExtension = $image->getClientOriginalExtension();
                $imgName =time().'.'.$fileExtension;
                $my_data_array['att_image_name'] = $imgName;
                $my_data_array['screenshot_n'] = $screemshotname;
                $image_att = ContactUsMesssge::insert(['user_id' => $userId, 'message' => $msgdata['contact_message'] ,'image' => $imgName ,'screenshot' => $screemshotname ]);
                if($image_att){
                $request->file('file_name')->move(base_path().'/public/contactus_image/', $imgName);
                Mail::to('jonnykumar@techsparksit.com')->send(new ContactUs($my_data_array));
                    $response['status'] = 'ok';
                    return response()->json($response);
                }else{
                    $response['status'] = 'code_error';
                    return response()->json($response);
                }
             }else{
                $without_image_att = ContactUsMesssge::insert(['user_id' => $userId, 'message' => $msgdata['contact_message'],'screenshot' => $screemshotname]);
                $my_data_array['att_image_name'] = '';
                $my_data_array['screenshot_n'] = $screemshotname;
                if($without_image_att){
                Mail::to('jonnykumar@techsparksit.com')->send(new ContactUs($my_data_array));
                    $response['status'] = 'ok';
                    return response()->json($response);
                }else{
                    $response['status'] = 'code_error';
                    return response()->json($response);
                }
              }
            }
        } 
    /*  Custom functions to get calendar data */

    private function _get_class_lesson($month=null,$year=null){
       
    }

    public function viewItems(Request $request){
        $response = array();

        $viewItems = ViewItems::where('user_id',Auth::user()->id)->first();
        if($viewItems!=''){
            $viewItems->user_id     = Auth::id();
            $viewItems->view_items  = json_encode($request->view_items);
            $viewItems->view_class  = json_encode($request->user_class);
        }
        else{
            $viewItems = new ViewItems();
            $viewItems->user_id     = Auth::id();
            $viewItems->view_items  = json_encode($request->view_items);
            $viewItems->view_class  = json_encode($request->user_class);
        }
        
        if($viewItems->save()){

            $response['success'] = 'TRUE';

        }
        return response()->json($response);
    }

}
