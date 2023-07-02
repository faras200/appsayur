<?php

namespace App\Http\Controllers;

use App\Models\Ormawa;
use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaOrmawaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return view('dashboard.ormawa.anggota.index', [
            'ormawa' => Ormawa::where('id', $id)->first(),
            'anggotas' => Anggota::where('ormawa_id', $id)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        return view('dashboard.ormawa.anggota.create', [
            'id' => $request->ormawa_id
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
            'nama' => 'required',
            'nim' => 'required|max:10|min:10',
            'email' => 'required|email:dns',
            'no_hp' => 'required',
            'jabatan' => 'required',
            'alamat' => 'required',
        ]);
        $validasi['ormawa_id'] = $request->input('ormawa_id');

        Anggota::create($validasi);

        return redirect('/dashboard/ormawa/' . $validasi['ormawa_id'])->with('success', 'Berhasil Menambahkan Data Anggota!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('dashboard.ormawa.anggota.edit', [
            'anggota' => Anggota::where('id', $id)->first(),
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
        $validasi = $request->validate([
            'nama' => 'required',
            'nim' => 'required|max:10|min:10',
            'email' => 'required|email:dns',
            'no_hp' => 'required',
            'jabatan' => 'required',
            'alamat' => 'required',
        ]);

        Anggota::where('id', $id)->update($validasi);

        return redirect('/dashboard/ormawa/' . $request->input('ormawa_id'))->with('success', 'Berhasil Mengubah Data Anggota!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Anggota::destroy($id);

        return redirect('/dashboard/ormawa/' . $request->ormawa)->with('success', 'Berhasil Menghapus Anggota!!');
    }
}
