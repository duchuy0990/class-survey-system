<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\StudentPrivileges;
use App\Http\Middleware\AdminPrivileges;
use App\Http\Middleware\TeacherPrivileges;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'admin' :
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('admin.home');
                }
                break;
            case 'teacher' : 
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('teacher.home');
                }
                break;
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('student.home');
                }
                break;
        }

        return $next($request);
    }
}
