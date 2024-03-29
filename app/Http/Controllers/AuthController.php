<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    //

    public function index()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $message=[
            'username.required'=>'Username harus diisi',
            'password'=>'Password harud diisi'
        ];


        $credentials=$request->validate([
            'username'=>'required',
            'password'=>'required'
        ],$message);

        if(Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->with('LoginError','Login gagal!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');    }
}
