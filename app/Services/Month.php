<?php

namespace App\Services;

use Auth;
use App\User;
use App\UserClass;
use App\SchoolYear;
use App\ClassLesson;
class Month
{
/********************* PROPERTY ********************/  
    private $dayLabels = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun");
    private $dayFullLabels = array("monday","tuesday","wednesday","thursday","friday","saturday", "sunday");

    private $currentYear=0;
     
    private $currentMonth=0;
     
    private $currentDay=0;
     
    private $currentDate=null;
     
    private $daysInMonth=0;
     
    private $naviHref= null;
     
    /********************* PUBLIC **********************/ 

    public function __construct(){

    	$year  = null;
         
        $month =  null;
        
        $week = null;		
		
		$calDay = null;
        if(null==$year && isset($_GET['year'])){
 
            $year = $_GET['year'];
         
        }else if(null==$year){
 
            $year = date("Y",time());  
         
        }          
         
        if(null==$month && isset($_GET['month'])){
 
            $month = $_GET['month'];
         
        }else if(null==$month){
 
            $month = date("m",time());
         
        }  
		if(null==$week && isset($_GET['week'])){
 
            $week = $_GET['week'];
         
        }else if(null==$week){
 
            $week  = date("Y-m-d", strtotime("monday this week"));
         
        }
		
		if(null==$calDay && isset($_GET['day'])){
 
            $calDay = $_GET['day'];
         
        }else if(null==$calDay){
 
            $calDay = date("Y-m-d");
         
        }
		
        $this->currentMonth =   $month;
        $this->currentYear  =   $year; 
		$this->currentWeek  =   $week;
		$this->currentCalDay   =   $calDay;
        $this->daysInMonth  =   $this->_daysInMonth($month,$year);            
    }  

    public function getMonth(){
    	return $this->currentMonth;
    }

    public function getYear(){
    	return $this->currentYear;
    }
    
	public function getWeek(){
		$year = $this->currentYear;
		$weeks = date('W', strtotime($this->currentWeek));
    	return date("Y-m-d", strtotime("{$year}-W{$weeks}-1"));
    }
	
	public function getDay(){
    	return $this->currentCalDay;
    }
	
    public function setDate($year, $month){

    	$this->currentYear=$year;
         
        $this->currentMonth=$month;
         
        $this->daysInMonth=$this->_daysInMonth($month,$year); 
    }

    /**
    * create the li element for ul
    */
    function _showDay($cellNumber){
       
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
             
        return ["date" => $this->currentDate, "day" => $cellContent];

    }
     
    /**
    * create navigation
    */
    function _createNavi(){
         
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
    function _createLabels(){  
                 
        $content='';
         
        foreach($this->dayLabels as $index=>$label){
             
            $content.='<li class="'.($label==6?'end title':'start title').' title" data-day="'. $this->dayFullLabels[$index].'">'.$label.'</li>';
 
        }
         
        return $content;
    }
     
     
     
    /**
    * calculate number of weeks in a particular month
    */
    function _weeksInMonth($month=null,$year=null){
         
        if( null==($year) ) {
            $year =  $this->currentYear; 
        }
         
        if(null==($month)) {
            $month = $this->currentMonth;
        }
         
        // find number of days in this month
        $daysInMonths = $this->_daysInMonth($month,$year);
         
        $numOfweeks = ($daysInMonths%7==0?0:1) + intval($daysInMonths/7);
         
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
            $year =  $this->currentYear; 
 
        if(null==($month))
            $month = $this->currentMonth;
             
        return date('t',strtotime($year.'-'.$month.'-01'));
    }

    public function getClasses(){
        $start = $this->currentYear .'-'. $this->currentMonth .'-01';
        $end   = $this->currentYear .'-'. $this->currentMonth .'-'. $this->_daysInMonth(); 

        return  UserClass::where('start_date', '>=', $start)->Where('end_date', '<=' , $end)->orWhere(function($q) use($start, $end){
       $q->where('end_date', '>=' ,$start )->where('start_date' ,'<=', $end);
})->with(["classLesson" => function($q) use($start, $end) {
                    $q->whereBetween("lesson_date", [$start, $end]);
        }])->get();
    }
    
	public function getWeekClasses(){
        $start = $this->currentWeek;
        $weekEnd   = $this->currentWeek; 
        $end =  date('Y-m-d', strtotime($weekEnd.' +7 day'));
        return  UserClass::where('start_date', '>=', $start)->Where('end_date', '<=' , $end)->orWhere(function($q) use($start, $end){
       $q->where('end_date', '>=' ,$start )->where('start_date' ,'<=', $end);
})->with(["classLesson" => function($q) use($start, $end) {
                    $q->whereBetween("lesson_date", [$start, $end]);
        }])->get();
    }
	
	public function getDayClasses(){
        $start = $this->currentCalDay;
		$end = $this->currentCalDay;
        return  UserClass::where('start_date', '>=', $start)->Where('end_date', '<=' , $end)->orWhere(function($q) use($start, $end){
       $q->where('end_date', '>=' ,$start )->where('start_date' ,'<=', $end);
})->with(["classLesson" => function($q) use($start, $end) {
                    $q->whereBetween("lesson_date", [$start, $end]);
        }])->get();
    }
	
    public function _createWeekNavi(){
        $year = $this->currentYear;
		$weeks = date('W', strtotime($this->currentWeek));
		$next = ($weeks + 1);
		$previous = ($weeks - 1);
        $nextWeek = date("Y-m-d", strtotime("{$year}-W{$next}-1"));   
        $preWeek =  date("Y-m-d", strtotime("{$year}-W{$previous}-1"));
         
        return 
            '<script>'.
                '$("#pPrev").attr("href","?week='.sprintf( $preWeek).'");'.
                '$("#pNext").attr("href","?week='.sprintf($nextWeek).'");'.
            '</script>';
    }
	
	public function _createDayNavi(){
		$date = $this->currentCalDay;
        $nextDay = date('Y-m-d', strtotime($date .' +1 day'));   
        $preDay =  date('Y-m-d', strtotime($date .' -1 day'));
         
        return 
            '<script>'.
                '$("#pPrev").attr("href","?day='.sprintf($preDay).'");'.
                '$("#pNext").attr("href","?day='.sprintf($nextDay).'");'.
            '</script>';
    }
	
	public function getLessons($classID,$date){
		$userID = Auth::id();
		$lessons = ClassLesson::where('user_id',$userID)->where('class_id',$classID)->where('lesson_date',$date)->get();
		return $lessons;
	}
	
}