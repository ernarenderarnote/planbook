<?php

namespace App\Http\Controllers\Student;
use App\Students;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

	/********************* PROPERTY ********************/  
    
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
		$this->data['teachers'] = Students::where('id',auth()->guard('students')->user()->id)->with('teacher')->first();
		return view('student.dashboard.index', $this->data);

	}
    
}
