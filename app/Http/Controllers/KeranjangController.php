<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $keranjangs = Keranjang::select('keranjangs.*', 'posts.user_id as lapak', 'users.username as lapak_name')
            ->join('posts', 'keranjangs.post_id', 'posts.id')
            ->join('users', 'posts.user_id', 'users.id')
            ->where('keranjangs.user_id', $user->id)
            ->get()->groupBy('lapak_name');
        // dd($keranjangs);
        return view('guests.keranjang.index', [
            'keranjangs' => $keranjangs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $user = Auth::user();

        $keranjang = Keranjang::where('user_id', $user->id)
            ->where('post_id', $id)->first();
        if ($request->action == 'remove') {
            if ($keranjang->qty > 1) {
                $qty = $keranjang->qty - 1;
                $keranjang->update([
                    'qty' => $qty,
                ]);
            }
        } else {
            if ($keranjang) {
                $qty = $keranjang->qty + 1;
                $keranjang->update([
                    'qty' => $qty,
                ]);
            } else {
                Keranjang::create([
                    'user_id' => $user->id,
                    'post_id' => $id,
                    'qty' => 1,
                ]);
            }
        }

        return redirect('/keranjang');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Keranjang::destroy($request->id);

        return response()->json([
            'success' => true,
        ]);
    }
}
