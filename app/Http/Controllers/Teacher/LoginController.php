<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;//追加

class LoginController extends Controller
{
    //
    use AuthenticatesUsers;

    public function redirectTo()
    {
        return route('teacher.top');
    }

    public function showLoginForm()
    {
        return view('teacher.login');
    }

    protected function validateLogin(Request $request)
    {
        $messages = [
            $this->username().'.required' =>'ログインIDを入力してください。',
            'password.required' => 'パスワードを入力してください。',    
        ];

        $this->validate($request,[
            $this->username() => 'required|string',
            'password' => 'required|string',
        ],$messages);
    }

    /**
    *ログインIDの英語名
    */
    public function username()
    {
        return 'email';
    }

    /**
    *ログアウト処理
    */
    public function logout(Request $request)
    {
        $partialLogin = auth('teacher')->guest() || auth('student')->guest();
            $this->guard()->logout();

            //どちらか片方のみでログインしている時のみ、invalidateする
            if ($partialLogin){
                $request->session()->invalidate();
            }

        return redirect()->route('teacher.login');
    }

    /**
    *使用する認証を返す
    */
    public function guard()
    {
        return auth('teacher');
    }

}
