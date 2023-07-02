<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Ormawa;
use Illuminate\Http\Request;

class OrmawaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.ormawa.index', [
            'ormawas' => Ormawa::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.ormawa.create');
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
            'email' => 'required|email:dns',
        ]);
        $validasi['profil'] = $request->input('profil');
        $validasi['logo'] = $request->input('logo');

        Ormawa::create($validasi);

        return redirect('/dashboard/ormawa')->with('success', 'Berhasil Menambahkan Data Lapak!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('dashboard.ormawa.show', [
            'ormawa' => Ormawa::where('id', $id)->first(),
            'anggotas' => Anggota::where('ormawa_id', $id)->get(),
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
        return view('dashboard.ormawa.edit', [
            'ormawa' => Ormawa::where('id', $id)->first(),
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
            'email' => 'required|email:dns',
            'visi' => 'required',
            'misi' => 'required',
            'profil' => 'required',
            'logo' => 'required',
        ]);

        Ormawa::where('id', $id)->update($validasi);

        return redirect('/dashboard/ormawa')->with('success', 'Berhasil Mengubah Data Ormawa!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ormawa::destroy($id);

        return redirect('/dashboard/ormawa')->with('success', 'Berhasil Menghapus Data Ormawa!!');
    }
}
