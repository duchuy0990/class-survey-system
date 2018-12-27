<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\loginRequest;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/student/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // public function login(loginRequest $request) {
    //     $auth = [
    //         'username' => $request->username,
    //         'password' => $request->password
    //     ];
    //     if(Auth::Guard('admin')->attempt($auth)) {
    //         return redirect()->route('admin.home');
    //     }
    //     else if (Auth::Guard('teacher')->attempt($auth)) {
    //         return redirect()->route('teacher.home');
    //     } 
    //     else if (Auth::Guard('web')->attempt($auth)) {
    //         return redirect()->route('student.home');
    //     } 
    //     else {
    //         return redirect()->route('login');
    //     }
    // }
}
