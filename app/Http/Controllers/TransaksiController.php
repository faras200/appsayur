<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->role == 'pedagang') {
            return view('dashboard.transaksi.index', [
                'transaksis' => Transaksi::select('transaksi.*', DB::raw("SUM(transaksi.amount) as total_amount"))
                    ->where('lapak_id', $user->id)
                    ->where('status', 'PENDING')
                    ->groupBy('id')
                    ->get(),
            ]);
        }
        return view('dashboard.transaksi.index', [
            'transaksis' => Transaksi::select('transaksi.*', DB::raw("SUM(transaksi.amount) as total_amount"))
                ->where('user_id', $user->id)
                ->where('status', 'PENDING')
                ->orderBy('created_at')
                ->groupBy('uuid')
                ->get(),
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
    public function show($id)
    {
        $user = Auth::user();
        if ($user->role == 'pedagang') {
            $transaksi = Transaksi::select('transaksi.uuid', 'transaksi.status', 'transaksi.amount', 'transaksi.qris', 'detail_transaksi.qty', 'posts.user_id as lapak', 'users.username as lapak_name', 'posts.*')
                ->join('detail_transaksi', 'transaksi.id', 'detail_transaksi.transaksi_id')
                ->join('posts', 'detail_transaksi.post_id', 'posts.id')
                ->join('users', 'posts.user_id', 'users.id')
                ->where('transaksi.id', $id)
                ->get();
        } else {
            $transaksi = Transaksi::select('transaksi.uuid', 'transaksi.status', 'transaksi.amount', 'transaksi.qris', 'detail_transaksi.qty', 'posts.user_id as lapak', 'users.username as lapak_name', 'posts.*')
                ->join('detail_transaksi', 'transaksi.id', 'detail_transaksi.transaksi_id')
                ->join('posts', 'detail_transaksi.post_id', 'posts.id')
                ->join('users', 'posts.user_id', 'users.id')
                ->where('transaksi.uuid', $id)
                ->get();
        }

        // dd($transaksi);
        // return $transaksi[0]->qris;
        return view('dashboard.transaksi.show', [
            'keranjangs' => $transaksi->groupBy('lapak_name'),
            'snap_token' => $transaksi[0]->qris,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Transaksi::where('id', $id)->update([
            'status' => 'SELESAI',
        ]);

        return redirect('/dashboard/transaksi')->with('success', 'Transaksi Berhasil Di Selesaikan!!');
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
    public function destroy($id)
    {
        //
    }
}
