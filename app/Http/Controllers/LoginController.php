<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * 处理登录认证
     *
     * @param  Request  $request
     *
     * @return Response
     * @translator laravelacademy.org
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
//            if (Auth::attempt(['email' => $email, 'password' => $password, 'active' => 1]), $remember) {
            // 认证通过...
            return redirect()->intended('dashboard');
        }
    }
}
