<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            'title' => 'Register',
            'active' => 'register'
        ]);
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:5', 'max:20', 'unique:users'],
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        $validasi['password'] = Hash::make($validasi['password']);

        User::create($validasi);

        //$request->session()->flash('success', 'Registrasi Berhasil !! Silahkan Login  ');

        return redirect('/login')->with('success', 'Registrasi Berhasil !! Silahkan Login  ');
    }
}
