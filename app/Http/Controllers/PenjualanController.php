<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Exception;

class PenjualanController extends Controller
{
    public function index()
    {
        $data = Penjualan::with('barang')->orderBy('id', 'desc')->get();

        return view('penjualan.index', compact('data'));
    }

    public function create()
    {
        $barang = Barang::orderBy('id', 'desc')->where('qty_brg', '>', 0)->get();

        return view('penjualan.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $latest     = Penjualan::orderBy('id', 'desc')->first();
        $id         = 1;
        if($latest != null)
            $id     = $latest->id + 1;

        $model            = new Penjualan();
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
            return redirect("penjualan");
        }

        session()->flash('success', 'Berhasil menyimpan transaksi');
        return redirect("penjualan");
    }

    public function show($id)
    {
        $data   = Penjualan::where('id', $id)->first();
        $barang = Barang::orderBy('id', 'desc')->get();

        return view('penjualan.edit', compact('data', 'barang'));
    }

    public function update(Request $request, $id)
    {
        $model            = Penjualan::where('id', $id)->first();
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
            return redirect("penjualan");
        }

        session()->flash('success', 'Berhasil mengedit transaksi');
        return redirect("penjualan");
    }

    public function destroy(Request $request, $id)
    {
        $data = Penjualan::where('id', $id)->first();

        try {
            $data->delete();

            $barang = Barang::where('id', $data->id_barang)->first();
            $barang->qty_brg = ($barang->qty_brg + $data->qty);
            $barang->save();
        } catch (Exception $e) {
            session()->flash('warning', $e->getMessage());
            return redirect("penjualan");
        }

        session()->flash('success', 'Berhasil menghapus transaksi');
        return redirect("penjualan");
    }
}
