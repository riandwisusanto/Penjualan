<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $barang    = Barang::count();
        $sum_barang= Barang::sum('qty_brg');
        $penjualan = Penjualan::count();
        $jual      = Penjualan::with('barang')->where('status', 1)->get();
        $laba      = $jual->reduce(function($acc, $row) {
                        $kotor  = ($row->barang->harga_jual - $row->barang->harga_beli) * $row->qty; 
                        $bersih = $kotor - (10 * $kotor / 100);

                        return $acc + $bersih;
                    });
        $year_now  = date('Y');
        if(isset($request->year)){
            $year_now = $request->year;
        }
        $data      = Barang::with('penjualan')
                    ->whereHas('penjualan', function($query) use ($year_now){ 
                        $query->whereYear('tgl_jual', $year_now); 
                    })->get();
        $year      = [
            2022, 2023, 2024, 2025, 2026, 2027, 2028, 2029, 2030, 2031, 2032, 2033, 2034, 2035
        ];
        // return $data;
        return view('dashboard.index', compact('barang', 'penjualan', 'laba', 'sum_barang', 'data', 'year', 'year_now'));
    }
}
