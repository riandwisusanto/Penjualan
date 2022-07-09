<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;

class LabarugiController extends Controller
{
    public function index()
    {
        $data = Penjualan::with('barang')->where('status', 1)->orderBy('id', 'desc')->get();
        $laba_kotor  = $data->reduce(function($acc, $row) {
                            $kotor  = ($row->barang->harga_jual - $row->barang->harga_beli) * $row->qty; 

                            return $acc + $kotor;
                        });
        $min         = 10 * $laba_kotor / 100;
        $laba_bersih = $laba_kotor - $min;

        return view('labarugi.index', compact('data', 'laba_kotor', 'laba_bersih', 'min'));
    }
}
