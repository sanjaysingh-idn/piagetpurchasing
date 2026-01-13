<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
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

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // 1. Validasi Data
        $request->validate([
            'name'     => 'required|string|max:255',
            'nip'      => 'nullable|string|max:50',
            'jabatan'  => 'nullable|string|max:100',
            'kontak'   => 'nullable|numeric',
            'role'     => 'required',
            // Email harus unik, tapi abaikan untuk ID user yang sedang diupdate ini
            'email'    => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            // Password bersifat opsional (nullable), jika diisi minimal 8 karakter
            'password' => 'nullable|min:8',
        ]);

        // 2. Siapkan data untuk diupdate
        $data = [
            'name'    => $request->name,
            'nip'     => $request->nip,
            'jabatan' => $request->jabatan,
            'email'   => $request->email,
            'kontak'  => $request->kontak,
            'role'    => $request->role,
        ];

        // 3. Logika Password: Hanya enkripsi & update jika input password tidak kosong
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // 4. Eksekusi Update
        $user->update($data);

        // 5. Redirect dengan pesan sukses
        return redirect()->back()->with('message', 'Data akun berhasil diperbarui!');
    }

    public function destroy($id)
    {
        User::destroy($id);

        return back()->with('message_delete', 'Data Akun berhasil dihapus');
    }

    public function profile()
    {
        $user = Auth::user();

        return view('page.profile', [
            'title'     => 'My Profile',
            'user'      => $user
        ]);
    }

    public function profileUpdate(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'nip'   => 'nullable|string',
            'kontak' => 'nullable|numeric',
            'password' => 'nullable|min:8|confirmed', // 'confirmed' mewajibkan input password_confirmation
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->nip = $request->nip;
        $user->kontak = $request->kontak;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('message', 'Profil berhasil diperbarui!');
    }
}
