<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\loginRequest;

class AdminLoginController extends Controller
{
    protected function guard(){
        return Auth::guard('admin');
    }
    
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin/home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm() {
        return view('admin.loginForm');
    }

    public function postLogin(loginRequest $request) {
        if(Auth::guard('admin')->attempt(['username'=>$request->username,
                                            'password'=>$request->password],$request->_token)) {
            return redirect()->intended('admin/home');
        } else {
            return redirect()->back()->withInput()->with('error','Tài khoản hoặc mật khẩu không đúng');
        }
    }

    public function logout(Request $request) {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect("admin/getLogin");
    }
}