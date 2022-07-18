<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $barang    = Barang::count();
        $sum_barang= Barang::sum('qty_brg');
        $transaksi = Transaksi::count();
        $data_jual = Transaksi::with('detail.barang')->where('status', 1)->get();
        $jual = 0;
        foreach ($data_jual as $value) {
            foreach ($value->detail as $val) {
                $kotor = $val->barang->harga_jual - $val->barang->harga_beli;
                $kotor = $kotor - ($kotor * $val->barang->diskon / 100);
                $kotor = $kotor * $val->qty;
                $jual += $kotor;
            }
        }
        $laba  = $jual - (10 * $jual / 100);
        $year_now  = date('Y');
        if(isset($request->year)){
            $year_now = $request->year;
        }
        $data      = Barang::with(['detailtransaksi', 'detailtransaksi.transaksi'])
                    ->whereHas('detailtransaksi.transaksi', function($query) use ($year_now){ 
                        $query->whereYear('tgl_transaksi', $year_now); 
                    })->get();
        $year      = [
            2022, 2023, 2024, 2025, 2026, 2027, 2028, 2029, 2030, 2031, 2032, 2033, 2034, 2035
        ];
        return view('dashboard.index', compact('barang', 'transaksi', 'laba', 'sum_barang', 'data', 'year', 'year_now'));
    }
}
