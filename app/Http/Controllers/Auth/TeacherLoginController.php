<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\loginRequest;

class TeacherLoginController extends Controller
{
    use AuthenticatesUsers;
    protected function guard(){
        return Auth::guard('teacher');
    }

    protected function username() {
        return 'username';
    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'teacher/home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:teacher')->except('logout');
    }

    public function showLoginForm() {
        return view('teacher.loginForm');
    }

    public function postLogin(loginRequest $request) {
        if(Auth::guard('teacher')->attempt(['username'=>$request->username,
                                            'password'=>$request->password],$request->_token)) {
            return redirect()->intended('teacher/home');
        } else {
            return redirect()->back()->withInput()->with('error','Tài khoản hoặc mật khẩu không đúng');
        }
    }

    public function logout(Request $request) {
        Auth::guard('teacher')->logout();
        $request->session()->invalidate();
        return redirect("/");
    }
}
