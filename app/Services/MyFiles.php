<?php

namespace App\Services;

use Auth;
use App\MyFile;
class Myfiles
{

	 private $data = array();
	
     
    /********************* PUBLIC **********************/ 

    public function __construct(){

    	//$this->middleware('auth');
    }

    public function returnUploads(){
		
		return $this->data['myFiles'] = MyFile::where('user_id',Auth::user()->id)->get();
		
	}
}