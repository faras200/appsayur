<?php

namespace App\Http\Controllers;

use App\Models\Lapak;
use Illuminate\Http\Request;

class LapakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // dd(Lapak::all());
        return view('dashboard.lapak.index', [
            'lapaks' => Lapak::all(),
            'Ormawas' => Lapak::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.lapak.create');
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

        Lapak::create($validasi);

        return redirect('/dashboard/lapak')->with('success', 'Berhasil Menambahkan Data Lapak!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('dashboard.lapak.show', [
            'lapak' => Lapak::where('id', $id)->first(),
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
        return view('dashboard.lapak.edit', [
            'lapak' => Lapak::where('id', $id)->first(),
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
            'logo' => 'required',
        ]);

        Lapak::where('id', $id)->update($validasi);

        return redirect('/dashboard/lapak')->with('success', 'Berhasil Mengubah Data Lapak!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Lapak::destroy($id);

        return redirect('/dashboard/lapak')->with('success', 'Berhasil Menghapus Data Lapak!!');
    }
}
