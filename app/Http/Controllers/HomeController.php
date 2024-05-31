<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function showLoginForms()
    {
        return view('logins');
    }

    public function logins(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($request->email === 'admin@gmail.com' && $request->password === '12345678' ) {
            return redirect()->intended('/admin');

        } 
       
         else if(Auth::attempt($credentials)) {
        

            return redirect()->intended('/dashboard');
        }
        
        return redirect()->back()->withErrors(['email' => 'Invalid email or password.'])->withInput($request->only('email'));
    }

    public function logouts(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    public function index()
    {
        $user = auth()->user(); // Fetch authenticated user
        return view('dashboard', compact('user'));
    }

   
}
