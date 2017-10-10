<?php

namespace App\Http\Controllers;
use App\User;
use App\Students;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Mail;
use Exception;
use Redirect;
use Response;
use Validator;
use Session;

class StudentController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/index';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    public function getStudentLogin()
    {
        
        if (auth()->guard('students')->user()) return redirect()->route('student.dashboard');
        return view('studentLogin');
    }

    public function studentAuth(Request $request) { $this->validate($request,
    [ 'email' => 'required|email', 'password' => 'required', ]); if
    (auth()->guard('students')->attempt(['email' => $request->input('email'),
    'password' => $request->input('password')])) {

                $response['success'] = 'TRUE';
                $response['success_redirect_url'] = '/student/dashboard/index';
                return Response::json($response);
        }else{
            $response['error'] = array('your username and password are wrong.');
            return Response::json($response);
        }
    }

    public function logout()
    {

       auth('students')->logout();

        return Redirect('/');

        //return Redirect::to('/');

    }
}