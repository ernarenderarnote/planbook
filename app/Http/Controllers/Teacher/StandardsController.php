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

class StandardsController extends Controller
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

        //$this->data['myFiles'] = MyFile::where('user_id',Auth::user()->id)->get();

		return view('teacher.standardReportings.index');
    }
	public function explore()
    {

        //$this->data['myFiles'] = MyFile::where('user_id',Auth::user()->id)->get();

		return view('teacher.standardReportings.explore');
    }

}
