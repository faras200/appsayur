<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    public function index(){
        return view('guests.authors.index',[
            'authors' => User::with('ormawa')->get(),
        ]);
    }

    public function show(User $user){
        return view('guests.authors.show',[
            'author' => $user,
            'posts' => $user->posts->load('category')
        ]);
    }
}
