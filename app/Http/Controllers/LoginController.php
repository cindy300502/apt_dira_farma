<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        if(Auth::user()){
            // if($user-> level =='1'){
            //     return redirect()->intended('beranda');
            // } elseif($user->level =='2'){
            //     return redirect()->intended('kasir');
            // }
            return redirect()->intended('login');
            // return redirect()->route('category-page');
        }
        
        return view('login.view_login');
    }
    
    public function proses(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ],
        [
            'username.required' =>'Username tidak boleh kosong',
            'password.required' =>'Password tidak boleh kosong',
        ]
    );

        $kredensial = $request->only('username','password');

        if(Auth::attempt($kredensial)){
            $request->session()->regenerate();
            $user = Auth::user();
            // if($user-> level =='1'){
            //     return redirect()->intended('beranda');
            // } elseif($user->level =='2'){
            //     return redirect()->intended('kasir');
            // }

            if ($user){
                return redirect()->route('home-page');
                // return redirect()->intended('home');
        
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'username' => 'Maaf username atau password anda salah'
        ])->onlyInput('username');
    }
    
    
}
