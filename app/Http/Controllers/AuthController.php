<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister() { return view('auth.register'); 
    }
    public function showLogin() { return view('auth.login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required', 'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/login');
    }

    // في app/Http/Controllers/AuthController.php
public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        
        if (auth()->user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        
        return redirect()->route('dashboard');
    }

    return back()->withErrors([
        'email' => 'بيانات الاعتماد غير متطابقة مع سجلاتنا.',
    ]);
}
    
    

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}
