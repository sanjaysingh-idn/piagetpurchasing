<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');

        $bulanan = DB::table('purchasings')
            ->where('purchasings.status', '=', 'setuju')
            ->whereMonth('purchasings.created_at', $currentMonth)
            ->sum('purchasings.total_harga');

        $tahunan = DB::table('purchasings')
            ->where('purchasings.status', '=', 'setuju')
            ->whereYear('purchasings.created_at', $currentYear)
            ->sum('purchasings.total_harga');
        // dd($tahunan);
        return view('page.dashboard', [
            'title'             => 'Dashboard',
            'bulanan'           => $bulanan,
            'tahunan'           => $tahunan,
        ]);
    }
}
