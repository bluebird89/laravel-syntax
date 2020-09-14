<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * 处理登录认证
     *
     * @return Response
     * @translator laravelacademy.org
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // 认证通过...
            return redirect()->intended('dashboard');
        }
    }
}
