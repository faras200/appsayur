<?php

namespace App\Http\Controllers;

use App\Models\Dana;
use App\Models\Pengajuan;
use App\Models\Persetujuan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use App\Mail\EmailNotification;
use App\Models\Ormawa;
use Illuminate\Support\Facades\Mail;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->role != 'upt_it'){
            if(auth()->user()->role == 'baak' || auth()->user()->role == 'warek' ||auth()->user()->role == 'bem' || auth()->user()->role == 'dema'){
            $persetujuan = Persetujuan::notapprove()->get();
                if($persetujuan->isEmpty()){
                    $pengajuan = null;
                }else{
                    foreach($persetujuan as $p ){
                        $pengajuan[] = pengajuan::firstwhere('persetujuan_id', $p->id) ;
                    }
                }
            }else if(auth()->user()->role == 'ormawa')
            {
                $pengajuan = Pengajuan::latest()->where('ormawa_id', auth()->user()->ormawa_id)->get();
            }
        }else{
            $pengajuan = Pengajuan::where('status', '!=', 'setuju')->get();
        }
        //dd($pengajuan);
        // if(isset($pengajuan)){

        // }
        $ajuan = null ;
        if(auth()->user()->role == 'bem' || auth()->user()->role == 'dema'){
            $ajuan = Pengajuan::where('ormawa_id', auth()->user()->ormawa_id)->get();
        }
        return view('dashboard.pengajuan.index', [
            'pengajuans' => $pengajuan,
            'ajuan' => $ajuan,
        ]);
    }

    public function arsip()
    {
        // $persetujuan = Persetujuan::approve()->get();
        // foreach($persetujuan as $p ){
        //     $pengajuan[] = Pengajuan::firstwhere('persetujuan_id', $p->id);
        // }
            $role = auth()->user()->role;
        if($role != 'upt_it'){
            $persetujuan = Persetujuan::approve()->get();
            if($persetujuan->isEmpty()){
                $pengajuan = null;
            }else{
                foreach($persetujuan as $p ){
                    $pengajuan[] = pengajuan::firstwhere('persetujuan_id', $p->id);
                }
            }
            }else{
                $pengajuan = Pengajuan::latest()->where('status', '=', 'setuju')->get();
            }
        return view('dashboard.pengajuan.arsip', [
            'pengajuans' => Str::is($role, 'upt_it') ? $pengajuan : @array_reverse($pengajuan),
        
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pengajuan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->input());
        $validasi = $request->validate([
            'subjek' => 'required',
            'jenis' => 'required',
            'baak' => 'required',
            'file' => 'required',
        ]);
        Persetujuan::create([
            'baak' => $request->input('baak'),
            'warek' => $request->input('warek','0'),
            'bem' => $request->input('bem', '0'),
            'dema' => $request->input('dema', '0')
        ]);
        
        $id_persetujuan = Persetujuan::latest()->first('id');
        $validasi['persetujuan_id'] = $id_persetujuan->id;
        $validasi['ormawa_id'] = auth()->user()->ormawa_id;
        $data = $validasi;
        $data['pengaju'] = Ormawa::firstwhere('id', $validasi['ormawa_id'] );
        $data['pengaju'] = $data['pengaju']->nama ;
        $data['objek'] = 'Ada Pengajuan Baru';
        $data['pesan_status'] = 'Pengajuan Baru' ;
        $data['view'] = 'emailku';
        if($request->input('dema') == 1 ){
            Mail::to("farasaldi200@gmail.com")->send(new EmailNotification($data));
        }else if($request->input('bem') == 1){
            Mail::to("farasaldi200@gmail.com")->send(new EmailNotification($data));
        }else if($request->input('warek') == 1){
            Mail::to("farasaldi200@gmail.com")->send(new EmailNotification($data));
        }else if($request->input('baak') == 1){
            Mail::to("farasaldi200@gmail.com")->send(new EmailNotification($data));
        }
        Pengajuan::create($validasi);
        return redirect('/dashboard/pengajuan')->with('success', 'Berhasil Menambah Data Pengajuan!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail_arsip($id)
    {
        return view('dashboard.pengajuan.detail_arsip',[
            'pengajuan' => Pengajuan::where('id',$id)->first()
        ]);
    }
    public function show($id)
    {
        return view('dashboard.pengajuan.show',[
            'pengajuan' => Pengajuan::where('id',$id)->first()
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
        return view('dashboard.pengajuan.edit',[
            'pengajuan' => Pengajuan::where('id',$id)->first(),
        ]);
    }
    public function status($id)
    {
        return view('dashboard.pengajuan.status',[
            'pengajuan' => Pengajuan::where('id',$id)->first(),
        ]);
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
        //dd($request->input());
        if($request->input('acc')){
            Persetujuan::where('id', $request->input('persetujuan_id'))->update([
                auth()->user()->role => '2',
            ]);
            if(auth()->user()->role == 'baak'){
                Pengajuan::where('id', $id)->update(['status' => 'setuju']);
                $pengajuan = Pengajuan::firstwhere('id',$id);
                $data['jenis'] = $pengajuan->jenis;
                $data['view'] = 'emailku';
                $data['pengaju'] = null;
                $data['subjek'] = $pengajuan->subjek;
                $data['objek'] = 'Pengajuan Berhasil Disetujui';
                $data['pesan_status'] = 'Selamat Pengajuan Anda Berhasil Disetujui' ;
                Mail::to("farasaldi30@gmail.com")->send(new EmailNotification($data));
            }
            return redirect('/dashboard/pengajuan')->with('success', 'Berhasil Menyetujui Pengajuan!!');
        }elseif($request->input('revisi')){
            Pengajuan::where('id',$id)->update([
                'catatan_revisi' => $request->input('catatan_revisi'),
                'status' => 'revisi'
            ]);
            return redirect('/dashboard/pengajuan')->with('success', 'Berhasil Menyimpan Catatan Revisi !!');
        }elseif($request->input('tolak')){
            Pengajuan::where('id',$id)->update([
                'status' => 'tolak'            
            ]);
            return redirect('/dashboard/pengajuan')->with('success', 'Pengajuan ditolak!!');
        }
        $validasi = $request->validate([
            'subjek' => 'required',
            'jenis' => 'required',
            'file' => 'required',
        ]);
        Persetujuan::where('id', $request->input('persetujuan_id'))->update([
            'baak' => $request->input('baak'),
            'warek' => $request->input('warek','0'),
            'bem' => $request->input('bem', '0'),
            'dema' => $request->input('dema', '0')
        ]);
        
        Pengajuan::where('id', $id)->update($validasi);
        return redirect('/dashboard/pengajuan')->with('success', 'Berhasil Mengubah Data Pengajuan!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Persetujuan::destroy($request->psj);
        Pengajuan::destroy($id);
        return redirect('/dashboard/pengajuan')->with('success', 'Berhasil Menghapus Data Pengajuan!!');
    }
}
