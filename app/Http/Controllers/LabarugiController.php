<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class LabarugiController extends Controller
{
    public function index(Request $request)
    {
        $date  = date('Y-m');
        if(isset($request->date))
            $date = $request->date;

        $data_transaksi = Transaksi::with('detail.barang')
                ->where('tgl_transaksi', 'like', '%'.$date.'%')
                ->where('status', 1)
                ->orderBy('id', 'desc')
                ->get();
        $laba_kotor = 0;
        $data = [];
        foreach ($data_transaksi as $value) {
            foreach ($value->detail as $val) {
                $kotor = $val->barang->harga_jual - $val->barang->harga_beli;
                $kotor = $kotor * $val->qty;
                $kotor = $kotor - ($kotor * $val->diskon / 100);
                $laba_kotor += $kotor;

                array_push($data, $val);
            }
        }
        $min         = 10 * $laba_kotor / 100;
        $laba_bersih = $laba_kotor - $min;

        return view('labarugi.index', compact('date', 'data', 'laba_kotor', 'laba_bersih', 'min'));
    }
}
