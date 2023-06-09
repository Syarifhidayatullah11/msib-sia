<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth/login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',

        ], [

            'email.required'=> 'Email Wajib Diisi',
            'password.required'=> 'password Wajib Diisi',

        ]);


        $infologin = [

            'email' => $request->email,
            'password' => $request->password,

        ];


        if(Auth::attempt($infologin)){

            if(Auth::user()->role_id == '1'){
                return redirect('dashboard/admin');
            } elseif(Auth::user()->role_id == '2'){
                return redirect('dashboard/manajer');
            }
        }else{

        return redirect('/login')->withErrors(['Email atau password tidak sesuai.'])->withInput();
        }
    }




    public function logout(Request $request)
        {
            Auth::logout();
        
            $request->session()->invalidate();
        
            $request->session()->regenerateToken();
        
            return redirect('/login');
        }
}
