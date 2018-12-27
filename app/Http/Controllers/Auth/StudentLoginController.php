<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\loginRequest;

class StudentLoginController extends Controller
{
    use AuthenticatesUsers;
    protected function guard(){
        return Auth::guard('student');
    }

    protected function username() {
        return 'username';
    }
    
    
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'student/home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:student')->except('logout');
    }

    public function showLoginForm() {
        return view('student.loginForm');
    }

    public function postLogin(loginRequest $request) {
        if(Auth::guard('student')->attempt(['username'=>$request->username,
                                            'password'=>$request->password],$request->_token)) {
            return redirect()->intended('student/home');
        } else {
            return redirect()->back()->withInput()->with('error','Tài khoản hoặc mật khẩu không đúng');
        }
    }

    public function logout(Request $request) {
        Auth::guard('student')->logout();
        $request->session()->invalidate();
        return redirect("/");
    }
}
