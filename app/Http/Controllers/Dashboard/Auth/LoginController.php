<?php

// app/Http/Controllers/Auth/LoginController.phpをもとにして作成

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
    // ログイン後にリダイレクトするURLを指定。
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // 以下の２つのコードではログイン時に使用する認証を指定。
    public function __construct()
    {
        $this->middleware('guest:admins')->except('logout');
    }
    
    protected function guard()
    {
        return Auth::guard('admins');
    }
    
    // 以下の２つのコードではログイン画面で使用するビューやログアウト後のリダイレクト先を指定。
    public function showLoginForm()
    {
        return view('dashboard.auth.login');
    }

    public function loggedOut(Request $request)
    {
        return redirect('dashboard.login');
    }
}