<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Purchasing;
use Illuminate\Http\Request;

class PurchasingController extends Controller
{
    public function index()
    {
        $status = ['verifikasi', 'setuju', 'tolak'];
        return view('page.purchasing.index', [
            'title'         => 'Purchase Order List',
            'purchasing'    => Purchasing::all(),
            'status'        => $status
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'status' => 'required|string',
        ]);

        // Find the existing Purchasing record
        $purchasing = Purchasing::findOrFail($id);

        // Update the status
        $purchasing->status = $request->status;
        $purchasing->save();

        // Redirect back with a success message
        return redirect()->route('purchasing.index')->with('message', 'Status Purchasing berhasil diperbarui');
    }

    public function create()
    {
        return view('page.purchasing.create', [
            'title'         => 'Form Purchase Order',
            'suppliers'     => Supplier::all(),
        ]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $attr = $request->validate([
            'nomor_po'      => 'required',
            'nama_barang'   => 'required',
            'qty'           => 'required',
            'harga'         => 'required',
            'supplier'      => 'required',
            'total_harga'   => 'required',
            'keterangan'    => 'nullable',
            'input_by'      => 'nullable',
        ]);

        Purchasing::create($attr);

        return back()->with('message', 'Purchasing Order berhasil diajukan');
    }

    public function show(Purchasing $purchasing)
    {
        //
    }

    public function edit($id)
    {
        // Retrieve the Purchasing record by ID
        $purchasing = Purchasing::findOrFail($id);

        // Retrieve the list of suppliers
        $suppliers = Supplier::all();

        // Return the edit view with the purchasing record and suppliers
        return view('page.purchasing.edit', [
            'title'         => 'Edit Purchasing Order',
            'purchasing'    => $purchasing,
            'suppliers'     => $suppliers
        ]);
    }

    public function update(Request $request, Purchasing $purchasing)
    {
        //
    }

    public function destroy($id)
    {
        Purchasing::destroy($id);

        return back()->with('message_delete', 'Data Purchasing Order berhasil dihapus');
    }
}
