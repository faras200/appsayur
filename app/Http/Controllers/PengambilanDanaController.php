<?php

namespace App\Http\Controllers;

use App\Models\Dana;
use App\Models\Ormawa;
use Illuminate\Http\Request;
use App\Mail\EmailNotification;
use Illuminate\Support\Facades\Mail;

class PengambilanDanaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $role = auth()->user()->role;
        if($role == 'ormawa' || $role == 'bem' || $role == 'dema'){
            return view('dashboard.ambil-dana.index',[
                'danas' => Dana::where('ormawa_id', auth()->user()->ormawa_id)->get(),
            ]);
        }
        return view('dashboard.ambil-dana.index',[
            'danas' => Dana::where('status', 0)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.ambil-dana.create',[
            'ormawas' => Ormawa::all(),
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
            'ormawa_id' => 'required',
            'pengajuan_id' => 'required',
            'jadwal_pengambilan' => 'required',
            'jumlah_dana' => 'required'
        ]);
        $validasi['jumlah_dana'] = preg_replace('/\D/','',$request->input('jumlah_dana'));
        $validasi['status'] = '0';

        Dana::create($validasi);
        $data = $validasi;
        $data['objek'] = 'Jadwal Pengambilan Dana';
            $data['pesan_status'] = 'Tanggal Pegambilan Dana' ;
            $data['view'] = 'emaildana';
            Mail::to("farasaldi30@gmail.com")->send(new EmailNotification($data));
        return redirect('/dashboard/ambil-dana')->with('success', 'Berhasil Menambah Jadwal Pengambilan Dana!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('dashboard.ambil-dana.show', [
            'dana' => Dana::where('id', $id)->first()
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
        $validasi = $request->validate([
            'keterangan' => 'required',
            'bukti' => 'required',
            'tanggal_pengambilan' => 'required'
        ]);
        $validasi['status'] = '1';
        Dana::where('id',$id)->update($validasi);

        return redirect('/dashboard/ambil-dana')->with('success', 'Berhasil Menyelesaikan Ambil Dana!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Dana::destroy($id);
        return redirect('/dashboard/ambil-dana')->with('success', 'Berhasil Menghapus Data Ambil Dana!!');
    }
}
