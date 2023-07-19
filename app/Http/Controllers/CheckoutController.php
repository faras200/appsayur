<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $keranjangs = Keranjang::select('keranjangs.*', 'posts.user_id as lapak', 'users.username as lapak_name')
            ->join('posts', 'keranjangs.post_id', 'posts.id')
            ->join('users', 'posts.user_id', 'users.id')
            ->where('keranjangs.user_id', $user->id)
            ->get()->groupBy('lapak_name');
        $jumlahsemua = 0;
        $transaksi = null;
        $uuid = 'INV' . date('ymd') . rand(100, 999999);
        foreach ($keranjangs as $keranjangse) {
            $transaksi = Transaksi::create([
                'user_id' => $user->id,
            ]);
            $alltrx[] = $transaksi->id;
            $jumlah = 0;
            foreach ($keranjangse as $index => $keranjang) {
                $jumlahsemua += ($keranjang->qty * $keranjang->post->harga);
                $jumlah += ($keranjang->qty * $keranjang->post->harga);

                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'post_id' => $keranjang->post->id,
                    'qty' => $keranjang->qty,
                ]);

                if ($index == $keranjangse->count() - 1) {
                    $transaksi->update([
                        'uuid' => $uuid,
                        'lapak_id' => $keranjang->lapak,
                        'amount' => $jumlah,
                    ]);
                }
            }
        }

        $snap_token = app('App\Http\Controllers\DashboardController')->bayar2($jumlahsemua, $uuid);

        Transaksi::whereIn('id', $alltrx)->update([
            'qris' => $snap_token,
            'status' => 'PENDING',
        ]);
        Keranjang::where('keranjangs.user_id', $user->id)->delete();

        //$detail_transaksi = Transaksi::whereIn('id', $alltrx)->get();
        return view('guests.checkout.index', [
            'keranjangs' => $keranjangs,
            'snap_token' => $snap_token,
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
        //
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
    public function destroy($id)
    {
        //
    }
}
