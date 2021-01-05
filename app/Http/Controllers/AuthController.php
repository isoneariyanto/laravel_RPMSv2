<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(){
        if(!session('login')){
        	return view('authenticate.login');
        }
        return redirect('/dashboard');
    }

    public function loginAction(Request $request){
        // dd($request->all());
        // else{
        //     return redirect('/login')->with('message','Incorrect email or password !');
        // }
        $request->validate([
            'email' => 'required||email',
            'password' => 'required'    
        ]);
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            session(['login' => true]);
            $request->session()->regenerate();
            return redirect('/dashboard');
        }
        return back()->with('message','Incorrect email or password !');
    	// if (Auth::attempt($request->only('email','password'))){
    	// 	return redirect('/');
    	// }
    	// return redirect('/login');
    }

    public function logout(Request $request){
        $request->session()->flush();
    	Auth::logout();
    	return redirect('/login');
    }
}
