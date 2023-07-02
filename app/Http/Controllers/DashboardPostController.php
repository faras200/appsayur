<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.posts.index', [
            'posts' => Post::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'title' => 'required|max:255',
            'slug'  => 'required|unique:posts',
            'image'  => 'required|max:5000',
            'category_id' => 'required',
            'body' => 'required'
        ]);

        // if ($request->file('image')) {
        //     $validasi['image'] = $request->file('image')->store('post-images');
        // }
        $validasi['user_id'] = auth()->user()->id;
        $validasi['excerpt'] = Str::limit(strip_tags($request->body), 150);

        Post::create($validasi);

        return redirect('/dashboard/posts')->with('success', 'Berhasil Menambah Post!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        return view('dashboard.posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image'  => 'required|max:5000',
            'body' => 'required'
        ];


        if ($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }
        $validasi = $request->validate($rules);

        $validasi['user_id'] = auth()->user()->id;
        $validasi['excerpt'] = Str::limit(strip_tags($request->body), 150);

        Post::where('id', $post->id)
            ->update($validasi);

        return redirect('/dashboard/posts')->with('success', 'Berhasil Mengubah Post!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if ($post->image) {
        //     Storage::delete($post->image);
        // }
        Post::destroy($id);

        return redirect('/dashboard/posts')->with('success', 'Berhasil Menghapus Post!!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
