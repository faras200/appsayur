<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.users.index', [
            'admins' => User::where('role', 'pembeli')->get(),
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
        return view('dashboard.users.edit', [
            'admin' => User::where('id', $id)->first(),
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
        $rules = [
            'name' => 'required|max:255',
        ];
        $emails = User::where('id', $id)->get();
        foreach ($emails as $email):
            if ($request->email != $email->email) {
                $rules['email'] = 'required|unique:users';
            } elseif ($request->username != $email->username) {
        }
        endforeach;

        if (!is_null($request->password)) {
            $rules['password'] = 'required|min:8';
            $validasi = $request->validate($rules);
            $validasi['password'] = Hash::make($validasi['password']);
        } else {
            $validasi = $request->validate($rules);
        }

        User::where('id', $id)
            ->update($validasi);

        return redirect('/dashboard/users')->with('success', 'Berhasil Mengubah Users!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        User::destroy($id);

        return redirect('/dashboard/users')->with('success', 'Berhasil Menghapus Users!!');
    }
}
