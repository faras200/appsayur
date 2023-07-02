<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index()
    {
        return view('guests.login.index', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        } else if (Auth::guard('user')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }


        return back()->with('loginError', 'Login Gagal');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        Auth::guard('user')->logout();
        return redirect('/home');
    }

    // public function authenticate(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required'
    //     ]);

    //     if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
    //         $request->session()->regenerate();

    //         return redirect()->intended('dashboard');
    //     }

    //     return back()->with('loginError', 'Login Gagal');
    // }

    // public function logout(Request $request)
    // {
    //     Auth::logout();

    //     $request->session()->invalidate();

    //     $request->session()->regenerateToken();

    //     return redirect('/home');
    // }
}



// class LoginAdminController extends Controller
// {
//     public function __construct()
//     {
//         $this->middleware('guest:admin', ['except' => 'logout']);
//     }

//     public function formLogin()
//     {
//         return view('login');
//     }

//     public function login(Request $request)
//     {
//         $credentials = $request->validate([
//             'email' => 'required|email|exists:admins',
//             'password' => 'required'
//         ]);

//         if (Auth::guard('admin')->attempt($credentials, $request->remember)) {
//             $request->session()->regenerate();
//             return redirect()->intended(config('admin.prefix'));
//         }

//         return back()->withErrors([
//             'email' => 'The provided credentials do not match our records.',
//         ]);
//     }

//     public function logout()
//     {
//         Auth::guard('admin')->logout();
//         return redirect()->route('admin.login');
//     }
// }
