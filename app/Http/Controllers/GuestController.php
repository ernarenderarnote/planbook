<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\SignUp;
use App\User;
//use App\UserProfile;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Mail;
use Exception;
use Redirect;
use Response;

use Validator;
use Session;

//use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * S===
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('welcome');
    }

    public function register(SignUp $request)
    {

       // echo"xsxs";die;


        $response = array();

        $validation = array();

        $user = new User();

        switch ($request['user_role']) {
            case 2:

                //Registed as a teacher

                //print_r($request->all());die;

                $user->email = $request['email'];
                $user->password = Hash::make($request['password']);

                $user->save();


                $user->roles()->attach($request['user_role']);

                Auth::login($user);

                $response['success'] = 'TRUE';
                $response['success_redirect_url'] = '/teacher/dashboard/index';


                break;
            case 3:

                //Registed as a Student


                $user->email = $request['email'];

                $user->save();


                $user->roles()->attach($request['user_role']);

                
                Auth::login($user);

                $response['success'] = 'TRUE';
                $response['success_redirect_url'] = '/student/dashboard';


                break;
           

            default:
        }


        return Response::json($response);

    }

   
   
    public function login(Request $request)
    {

        $response = array();

        if ($request->isMethod('post')) {

            $validation['email'] = 'required|email';
            $validation['password'] = 'required';


            $validator = Validator::make($request->all(), $validation);

            if ($validator->fails()) {
                $response['error'] = $validator->errors()->all();
                if(!$request->ajax())
                    return redirect()->back()->withErrors($response['error']);
            } else {
                //authenticate user

                if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']], $request->has('remember'))) {

                    $user = Auth::user();


                    $role = Auth::user()->roles->pluck('name');
                    $response['success'] = 'TRUE';
                        if(Auth::user()->hasRole('teacher')){
                          $response['success_redirect_url'] = '/teacher/dashboard/index';  
                        }
                        /*elseif(Auth::user()->hasRole('student')){
                            $response['success_redirect_url'] = '/student/dashboard/index'; 
                        }
                        elseif(Auth::user()->hasRole('admin')){
                            $response['success_redirect_url'] = '/admin/dashboard/index'; 
                        }

*/
                } else {

                    $response['error'] = ['These credentials do not match our records.!'];

                }


            }

            if($request->ajax()){
                return Response::json($response);
            }else{
                return redirect()->intended("/");
            }


        }

    }

    /**
     * to log user out from system
     * @return [response]
     *
     */
    public function logout(Request $request)
    {

        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return Redirect('/');

        //return Redirect::to('/');

    }
}