<?php

namespace App\Http\Controllers;

use App\Models\User;

class AuthorsController extends Controller
{
    public function index()
    {
        return view('guests.authors.index', [
            'authors' => User::where('role', 'pedagang')->with('lapak')->get(),
        ]);
    }

    public function show(User $user)
    {
        return view('guests.authors.show', [
            'author' => $user,
            'posts' => $user->posts->load('category'),
        ]);
    }
}
