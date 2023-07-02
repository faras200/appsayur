<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Anggota;
use App\Models\Category;
use App\Models\Dana;
use App\Models\Lapak;
use App\Models\Pengajuan;
use App\Models\Persetujuan;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //private static $hostUrl = 'https://api.midtrans.com'; //production
    private static $hostUrl = 'https://api.sandbox.midtrans.com'; //development
    private static $client;

    public function __construct()
    {
        self::$client = new \GuzzleHttp\Client;
    }

    public function index()
    {
        if (auth()->user()->role != 'upt_it') {
            if (auth()->user()->role == 'baak' || auth()->user()->role == 'warek' || auth()->user()->role == 'bem' || auth()->user()->role == 'dema') {
                $persetujuan = Persetujuan::notapprove()->get();
                if ($persetujuan->isEmpty()) {
                    $pengajuan = null;
                } else {
                    foreach ($persetujuan as $p) {
                        $pengajuan[] = pengajuan::firstwhere('persetujuan_id', $p->id);
                    }
                }
            } else if (auth()->user()->role == 'ormawa') {
                $pengajuan = Pengajuan::latest()->where('ormawa_id', auth()->user()->ormawa_id)->get();
            }
        } else {
            $pengajuan = Pengajuan::where('status', '!=', 'setuju')->get();
        }
        //dd($pengajuan);
        // if(isset($pengajuan)){

        // }
        $ajuan = null;
        if (auth()->user()->role == 'bem' || auth()->user()->role == 'dema') {
            $ajuan = Pengajuan::where('ormawa_id', auth()->user()->ormawa_id)->get();
        }
        return view('dashboard.index', [
            'admin' => Admin::count(),
            'anggota' => Anggota::count(),
            'pengajuan' => Pengajuan::count(),
            'lapak' => Lapak::count(),
            'post' => Post::count(),
            'category' => Category::count(),
            'dana' => Dana::count(),
            'ajuan' => $ajuan,
        ]);
    }

    public function bayar(Request $request)
    {
        $serverkey = 'SB-Mid-server--qyBIk84MZouHfE3_JkdhAR-'; //prod
        $base = base64_encode($serverkey);
        $auth = 'Basic ' . $base;
        $user = Auth::user();
        $jayParsedAry2 = [
            "payment_type" => $request->payment_type,
            "transaction_details" => [
                "gross_amount" => 250000,
                "order_id" => 'INV' . date('ymd') . rand(99999999999, 999999999999999999),
            ],
            "customer_details" => [
                "email" => $user->email,
                "first_name" => $user->username,
            ],
            "custom_expiry" => [
                "order_time" => date('Y-m-d H:i:s') . ' +0700',
                "expiry_duration" => 24,
                "unit" => "hours",
            ],
        ];
        try {
            $output = self::$client->request('POST', self::$hostUrl . '/v2/charge', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => $auth,
                ],
                'json' => $jayParsedAry2,
            ]);
            $output = json_decode($output->getBody(), true);
        } catch (\Exception $th) {
            throw $th;
        }
    }
}
