<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Exception;

class BarangController extends Controller
{
    public function index()
    {
        return view('barang.index');
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        if($request->hasFile('gambar')){
            $filenameWithExt = $request->file('gambar')->getClientOriginalName();
            $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension       = $request->file('gambar')->getClientOriginalExtension();
            $filenameSimpan  = $filename.'_'.time().'.'.$extension;
            $request->file('gambar')->storeAs('public/image', $filenameSimpan);
        }else{
            $filenameSimpan  = 'noimage.jpg';
        }

        $latest     = Barang::orderBy('id', 'desc')->first();
        $id         = 1;
        if($latest != null)
            $id     = $latest->id + 1;
        
        $model            = new Barang();
        $model->id        = $id;
        $model->nama_brg  = $request->nama_brg;
        $model->qty_brg   = $request->qty;
        $model->harga     = $request->harga;
        $model->keterangan= $request->ket;
        $model->gambar    = $filenameSimpan;        
        $model->tgl       = date('d-m-Y');

        try {
            $model->save();
        } catch (Exception $e) {
            return $e->getMessage();
        }

        session()->flash('success', 'Berhasil menyimpan barang');
        return redirect("barang");

    }
}
