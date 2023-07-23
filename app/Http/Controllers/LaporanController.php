<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role == 'pedagang') {
            return view('dashboard.laporan.index', [
                'transaksis' => Transaksi::select('transaksi.*', DB::raw("SUM(transaksi.amount) as total_amount"))
                    ->where('lapak_id', $user->id)
                    ->where('status', 'SELESAI')
                    ->groupBy('uuid')
                    ->get(),
            ]);
        }
        return view('dashboard.laporan.index', [
            'transaksis' => Transaksi::select('transaksi.*', DB::raw("SUM(transaksi.amount) as total_amount"))
                ->where('user_id', $user->id)
                ->where('status', 'SELESAI')
                ->groupBy('uuid')
                ->get(),
        ]);
    }
}
