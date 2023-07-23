<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Lapak;
use App\Models\Pengajuan;
use App\Models\Persetujuan;
use App\Models\Post;
use App\Models\Transaksi;
use App\Models\User;
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
            'anggota' => User::where('role', 'pembeli')->count(),
            'pengajuan' => Pengajuan::count(),
            'lapak' => Lapak::count(),
            'post' => Post::count(),
            'category' => Category::count(),
            'dana' => Transaksi::where('status', 'SELESAI')->count(),
            'ajuan' => $ajuan,
        ]);
    }

    public function bayar()
    {
        $serverkey = 'SB-Mid-server--qyBIk84MZouHfE3_JkdhAR-';
        $base = base64_encode($serverkey);
        $auth = 'Basic ' . $base;
        $user = Auth::user();
        $jayParsedAry2 = [
            "transaction_details" => [
                "gross_amount" => 250000,
                "order_id" => 'INV' . date('ymd') . rand(99, 9999),
            ],
            "credit_card" => [
                "secure" => true,
            ],
            "customer_details" => [
                "email" => $user->email,
                "first_name" => $user->username,
            ],
        ];
        // dd($jayParsedAry2);
        try {
            $output = self::$client->request('POST', self::$hostUrl . '/snap/v1/transactions', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => $auth,
                ],
                'json' => $jayParsedAry2,
            ]);
            $output = json_decode($output->getBody(), true);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            $output = $e->getResponse();
            // $output = json_decode($output, true);
            // $output['success'] = false;
            // $output['error'] = 'Accurate, Sedang Terjadi Gangguan!!';
        } catch (\GuzzleHttp\Exception\RequestException $er) {
            $output = $er->getResponse();
            $output['success'] = false;
            $output['error'] = 'Masalah Koneksi';
        }

        return $output;
    }

    public function notifhandler()
    {
        $notif = new \Midtrans\Notification();
    }

    public function bayar2($jumlah, $id)
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server--qyBIk84MZouHfE3_JkdhAR-';
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
// Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        $user = Auth::user();
        $params = [
            "transaction_details" => [
                "gross_amount" => $jumlah,
                "order_id" => $id,
            ],
            "credit_card" => [
                "secure" => true,
            ],
            "customer_details" => [
                "email" => $user->email,
                "first_name" => $user->username,
            ],
        ];

        return \Midtrans\Snap::getSnapToken($params);
    }
}
