<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $barang    = Barang::sum('qty_brg');
        $penjualan = Penjualan::count();
        $jual      = Penjualan::with('barang')->where('status', 1)->get();
        $laba      = $jual->reduce(function($acc, $row) {
                        $kotor  = ($row->barang->harga_jual - $row->barang->harga_beli) * $row->qty; 
                        $bersih = $kotor - (10 * $kotor / 100);

                        return $acc + $bersih;
                    });
        return view('dashboard.index', compact('barang', 'penjualan', 'laba'));
    }
}
