<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use App\Announcement;

class CheckAnnouncement
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
        
        if(Auth::guard('students')->check())
        {
            $data = Announcement::where('user_id',auth()->guard('students')->user()->teacher_id)->first();
            if($data)
            {
                 return view('index');
            }
            else
                return $next($request);
        }
        return redirect()->route("auth.educator");
                
    }
}
