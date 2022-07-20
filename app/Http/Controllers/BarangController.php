<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Exception;

class BarangController extends Controller
{
    public function index()
    {
        $data = Barang::orderBy('id', 'desc')->get();

        return view('barang.index', compact('data'));
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
        
        $harga_beli      = explode(',', $request->harga_beli);
        $harga_beli      = str_replace('.', '', $harga_beli[0]);

        $harga_jual      = explode(',', $request->harga_jual);
        $harga_jual      = str_replace('.', '', $harga_jual[0]);

        $model            = new Barang();
        $model->id        = $id;
        $model->nama_brg  = $request->nama_brg;
        $model->qty_brg   = $request->qty;
        $model->harga_beli= (int)$harga_beli;
        $model->harga_jual= (int)$harga_jual;
        $model->keterangan= $request->ket;
        $model->gambar    = $filenameSimpan;        
        $model->tanggal   = date('Y-m-d');
        $model->no_sku    = $request->no_sku;
        $model->kode_brg  = $request->kode_brg;
        $model->warna     = $request->warna;
        // $model->diskon    = $request->diskon;

        try {
            $model->save();
        } catch (Exception $e) {
            session()->flash('warning', $e->getMessage());
            return redirect("barang");
        }

        session()->flash('success', 'Berhasil menyimpan barang');
        return redirect("barang");
    }

    public function destroy(Request $request, $id)
    {
        $data = Barang::where('id', $id)->first();

        try {
            $data->delete();
        } catch (Exception $e) {
            session()->flash('warning', $e->getMessage());
            return redirect("barang");
        }

        if(file_exists(public_path('storage/image/'.$data->gambar)))
            unlink(public_path('storage/image/'.$data->gambar));

        session()->flash('success', 'Berhasil menghapus barang');
        return redirect("barang");
    }

    public function show($id)
    {
        $data = Barang::where('id', $id)->first();

        return view('barang.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $harga_beli      = explode(',', $request->harga_beli);
        $harga_beli      = str_replace('.', '', $harga_beli[0]);

        $harga_jual      = explode(',', $request->harga_jual);
        $harga_jual      = str_replace('.', '', $harga_jual[0]);

        $model            = Barang::where('id', $id)->first();
        $model->nama_brg  = $request->nama_brg;
        $model->qty_brg   = $request->qty;
        $model->harga_beli= (int)$harga_beli;
        $model->harga_jual= (int)$harga_jual;
        $model->keterangan= $request->ket;       
        $model->tanggal   = date('Y-m-d');
        $model->no_sku    = $request->no_sku;
        $model->kode_brg  = $request->kode_brg;
        $model->warna     = $request->warna;
        // $model->diskon    = $request->diskon;

        if($request->hasFile('gambar')){
            $filenameWithExt = $request->file('gambar')->getClientOriginalName();
            $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension       = $request->file('gambar')->getClientOriginalExtension();
            $filenameSimpan  = $filename.'_'.time().'.'.$extension;
            $request->file('gambar')->storeAs('public/image', $filenameSimpan);

            if(file_exists(public_path('storage/image/'.$model->gambar)))
                unlink(public_path('storage/image/'.$model->gambar));
            $model->gambar    = $filenameSimpan;
        }

        try {
            $model->save();
        } catch (Exception $e) {
            session()->flash('warning', $e->getMessage());
            return redirect("barang");
        }

        session()->flash('success', 'Berhasil mengedit barang');
        return redirect("barang");
    }
}
