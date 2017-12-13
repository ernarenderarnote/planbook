<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class IsTeacherSetupCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check())
        {
            if(Auth::user()->signup_step_completed == 0)
            {
                return redirect()->route('teacher.step');
            }
            else if(Auth::user()->signup_step_completed == 1)
            {
                return redirect()->route('teacher.step2');
            }
            else if( Auth::user()->signup_step_completed == 2)
            {
                 return redirect()->route('teacher.step3');
            }
            else if( Auth::user()->signup_step_completed == 3)
            {
                return redirect()->route('teacher.step3');
            }
            else if( Auth::user()->signup_step_completed == 4)
            {
                 return redirect()->route('teacher.step5');
            }
            else
                return $next($request);
        }
        return redirect()->route("auth.educator");
                
    }
}
