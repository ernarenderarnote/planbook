<?php

namespace App\Http\Controllers\Student;

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

		return view('student.dashboard.index', $this->data);

	}
    
}
