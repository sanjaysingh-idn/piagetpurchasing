<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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

    public function laporanpembelian()
    {
        return view('laporan.laporanpembelian', [
            'title'         => 'Form Laporan Pembelian',
        ]);
    }

    public function datapembelian(Request $request)
    {
        // Validate the date inputs
        $request->validate([
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('end_date'))->endOfDay();

        // Get all purchasing records within the date range
        $purchasing = Purchasing::whereBetween('created_at', [$startDate, $endDate])->get();

        // Calculate total purchases
        $totalPurchases = $purchasing->count();

        // Filter and count accepted purchases (status 'setuju')
        $acceptedPurchases = $purchasing->where('status', 'setuju');
        $totalAcceptedPurchases = $acceptedPurchases->count();

        // Calculate the total price of accepted purchases
        $totalAcceptedPrice = $acceptedPurchases->sum('total_harga');

        return view('laporan.datapembelian', [
            'title'                 => 'Laporan Pengajuan Pembelian',
            'startDate'             => $startDate,
            'endDate'               => $endDate,
            'purchasing'            => $purchasing,
            'dateRange'             => $startDate->format('d F Y') . ' - ' . $endDate->format('d F Y'),
            'totalPurchases'        => $totalPurchases,
            'totalAcceptedPurchases' => $totalAcceptedPurchases,
            'totalAcceptedPrice'    => $totalAcceptedPrice,
        ]);
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
