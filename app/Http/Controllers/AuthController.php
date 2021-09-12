<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    //
    public function isAuth($credentials = [])
    {
        if (count($credentials) > 0 && Auth::attempt($credentials)) {
            return true;
        }

        return false;
    }

    public function login(){
        $credentials = request()->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ]
        );

        if ($this->isAuth($credentials)){
            return redirect('/admin');
        }
        return redirect()->back()->withInput()->with('failed', 'Periksa Kembali Username dan Password Anda');
    }

    public function logout(){
        Auth::logout();
        return \redirect('/');
    }
}
