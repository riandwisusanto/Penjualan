<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;

class LabarugiController extends Controller
{
    public function index(Request $request)
    {
        $date  = date('Y-m');
        if(isset($request->date))
            $date = $request->date;

        $data = Penjualan::with('barang')
                ->where('tgl_jual', 'like', '%'.$date.'%')
                ->where('status', 1)
                ->orderBy('id', 'desc')
                ->get();
        $laba_kotor  = $data->reduce(function($acc, $row) {
                            $kotor  = ($row->barang->harga_jual - $row->barang->harga_beli) * $row->qty; 

                            return $acc + $kotor;
                        });
        $min         = 10 * $laba_kotor / 100;
        $laba_bersih = $laba_kotor - $min;

        return view('labarugi.index', compact('date', 'data', 'laba_kotor', 'laba_bersih', 'min'));
    }
}
