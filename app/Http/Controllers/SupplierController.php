<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        return view('page.supplier', [
            'title'     => 'Daftar Supplier',
            'suppliers' => Supplier::all(),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'nama'         => 'required',
            'alamat'       => 'required',
            'kontak'       => 'required',
            'keterangan'   => 'required',
        ]);

        Supplier::create($attr);

        return back()->with('message', 'Supplier berhasil ditambah');
    }

    public function show(Supplier $supplier)
    {
        //
    }

    public function edit(Supplier $supplier)
    {
        //
    }

    public function update(Request $request, Supplier $supplier)
    {
        //
    }

    public function destroy($id)
    {
        Supplier::destroy($id);

        return back()->with('message_delete', 'Supplier berhasil dihapus');
    }
}
