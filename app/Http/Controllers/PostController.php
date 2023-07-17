<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view(
            'guests.posts.index',
            [
                "title" => "All Post",
                "image" => '../images/bg_home.jpg',
                "active" => "home",
                "post" => Post::with(['category', 'user'])->latest()->filter(request(['search', 'category', 'authors']))->paginate(5)->withQueryString(),
            ]
        );
    }
    public function blog()
    {
        return view(
            'blog',
            [
                "title" => "Blog",
                "active" => "blog",
                "nama" => "Farras Aldi Alfikri",
                "nim" => "1804030114",
                // "post" => Post::all()
                "post" => Post::latest()->get(),
            ]
        );
    }
    public function show(Post $post)
    {
        return view('guests.posts.post', [
            "title" => "Single Post",
            "active" => "home",
            "post" => $post,
        ]);
    }
    public function home()
    {
        return view('guests.index', [
            "beritas" => Post::latest()->filter(['category' => 'sayuran'])->limit(3)->get(),
            "kegiatans" => Post::latest()->filter(['category' => 'buah-buahan'])->limit(3)->get(),
            'ormawas' => User::where('role', 'pedagang')->with('lapak')->limit(4)->get(),
        ]);
    }
}
