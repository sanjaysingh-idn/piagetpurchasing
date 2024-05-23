<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $role = ['admin', 'staff', 'pimpinan', 'bendahara'];

        return view('page.user', [
            'title'     => 'Daftar Pegawai',
            'users'     => User::all(),
            'role'      => $role
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // dd($request);
        $attr = $request->validate([
            'name'          => 'required|max:255',
            'nip'           => 'required',
            'jabatan'       => 'required',
            'email'         => 'required|email:dns|max:150',
            'role'          => 'required',
            'kontak'        => 'required',
            'password'      => 'required|string|min:8|max:255',
        ]);

        $attr['password'] = Hash::make($request->password);

        User::create($attr);

        return back()->with('message', 'Akun berhasil ditambah');
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy($id)
    {
        User::destroy($id);

        return back()->with('message_delete', 'Data Akun berhasil dihapus');
    }
}
