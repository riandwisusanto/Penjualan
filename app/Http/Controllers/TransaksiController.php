<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pembeli;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Exception;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = Transaksi::with('pembeli')->orderBy('id', 'desc')->get();

        return view('transaksi.index', compact('data'));
    }

    public function create()
    {
        $pembeli = Pembeli::orderBy('id', 'desc')->get();
        $barang  = Barang::orderBy('id', 'desc')->where('qty_brg', '>', 0)->get();

        return view('transaksi.create', compact('barang', 'pembeli'));
    }

    public function store(Request $request)
    {
        $latest     = Transaksi::orderBy('id', 'desc')->first();
        $id         = 1;
        if($latest != null)
            $id     = $latest->id + 1;

        $model            = new Transaksi();
        $model->id        = $id;
        $model->id_barang = $request->id_barang;
        $model->qty       = $request->qty;
        $model->keterangan= $request->ket;      
        $model->tgl_jual  = date('Y-m-d');
        $model->status    = (int)$request->lunas;
        if($request->lunas == 1)
            $model->tgl_lunas  = date('Y-m-d');

        try {
            $model->save();

            $barang = Barang::where('id', $model->id_barang)->first();
            $barang->qty_brg = ($barang->qty_brg - $model->qty);
            $barang->save();
        } catch (Exception $e) {
            session()->flash('warning', $e->getMessage());
            return redirect("transaksi");
        }

        session()->flash('success', 'Berhasil menyimpan transaksi');
        return redirect("transaksi");
    }

    public function show($id)
    {
        $data   = Transaksi::where('id', $id)->first();
        $barang = Barang::orderBy('id', 'desc')->get();

        return view('transaksi.edit', compact('data', 'barang'));
    }

    public function update(Request $request, $id)
    {
        $model            = Transaksi::where('id', $id)->first();
        $qty_awal         = $model->qty;
        $model->id_barang = $request->id_barang;
        $model->keterangan= $request->ket;      
        $model->tgl_jual  = date('Y-m-d');
        $model->qty       = $request->qty;
        $model->status    = (int)$request->lunas;
        if($request->lunas == 1)
            $model->tgl_lunas  = date('Y-m-d');

        try {
            $barang = Barang::where('id', $model->id_barang)->first();
            $qty    = $barang->qty_brg + $qty_awal;
            $barang->qty_brg = $qty - $request->qty;
            $barang->save();

            $model->save();
        } catch (Exception $e) {
            session()->flash('warning', $e->getMessage());
            return redirect("transaksi");
        }

        session()->flash('success', 'Berhasil mengedit transaksi');
        return redirect("transaksi");
    }

    public function destroy(Request $request, $id)
    {
        $data = Transaksi::where('id', $id)->first();

        try {
            $data->delete();

            $barang = Barang::where('id', $data->id_barang)->first();
            $barang->qty_brg = ($barang->qty_brg + $data->qty);
            $barang->save();
        } catch (Exception $e) {
            session()->flash('warning', $e->getMessage());
            return redirect("transaksi");
        }

        session()->flash('success', 'Berhasil menghapus transaksi');
        return redirect("transaksi");
    }
}
