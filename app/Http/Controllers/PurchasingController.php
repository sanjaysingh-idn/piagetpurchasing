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
        // 1. Validasi input (nomor_po dihapus dari required karena di-generate otomatis)
        $attr = $request->validate([
            'nama_barang'   => 'required',
            'qty'           => 'required',
            'harga'         => 'required',
            'supplier'      => 'required',
            'total_harga'   => 'required',
            'keterangan'    => 'nullable',
            'input_by'      => 'nullable',
        ]);

        // 2. Logika pembuatan komponen format PO
        $now = Carbon::now();
        $tahun = $now->format('Y');      // Contoh: 2026
        $tanggal = $now->format('d');    // Contoh: 15

        // Mengubah angka bulan ke Romawi
        $array_romawi = [1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'];
        $bulanRomawi = $array_romawi[$now->month];

        // 3. Menentukan Nomor Urut (Reset otomatis setiap hari)
        $hariIni = $now->toDateString(); // Format: YYYY-MM-DD

        // Cari data terakhir yang dibuat pada hari ini
        $poTerakhir = Purchasing::whereDate('created_at', $hariIni)
            ->orderBy('id', 'desc')
            ->first();

        if ($poTerakhir) {
            // Mengambil 3 digit terakhir dari nomor_po lama, lalu ditambah 1
            $noUrutTerakhir = substr($poTerakhir->nomor_po, -3);
            $nomorUrut = str_pad((int)$noUrutTerakhir + 1, 3, '0', STR_PAD_LEFT);
        } else {
            // Jika belum ada transaksi sama sekali hari ini, mulai dari 001
            $nomorUrut = '001';
        }

        // 4. Gabungkan menjadi format: PO / Tahun / Bulan Romawi / Tanggal / Nomor Urut
        $nomorPO = "PO/{$tahun}/{$bulanRomawi}/{$tanggal}/{$nomorUrut}";

        // 5. Masukkan nomor_po hasil generate ke dalam array data
        $attr['nomor_po'] = $nomorPO;

        // 6. Simpan ke database
        Purchasing::create($attr);

        return back()->with('message', 'Purchasing Order berhasil diajukan dengan nomor: ' . $nomorPO);
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
