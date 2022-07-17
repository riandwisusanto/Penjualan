<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use Illuminate\Http\Request;
use Exception;

class PembeliController extends Controller
{
    public function index()
    {
        $data = Pembeli::orderBy('id', 'desc')->get();

        return view('pembeli.index', compact('data'));
    }

    public function create()
    {
        return view('pembeli.create');
    }

    public function store(Request $request)
    {
        $latest     = Pembeli::orderBy('id', 'desc')->first();
        $id         = 1;
        if($latest != null)
            $id     = $latest->id + 1;

        $model            = new Pembeli();
        $model->id        = $id;
        $model->nama      = $request->nama;
        $model->no_hp     = $request->no_hp;
        $model->alamat    = $request->alamat;      

        try {
            $model->save();
        } catch (Exception $e) {
            session()->flash('warning', $e->getMessage());
            return redirect("pembeli");
        }

        session()->flash('success', 'Berhasil menyimpan data pembeli');
        return redirect("pembeli");
    }

    public function show($id)
    {
        $data   = Pembeli::where('id', $id)->first();

        return view('pembeli.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $model            = Pembeli::where('id', $id)->first();
        $model->nama      = $request->nama;
        $model->no_hp     = $request->no_hp;
        $model->alamat    = $request->alamat;   

        try {
            $model->save();
        } catch (Exception $e) {
            session()->flash('warning', $e->getMessage());
            return redirect("pembeli");
        }

        session()->flash('success', 'Berhasil mengedit data pembeli');
        return redirect("pembeli");
    }

    public function destroy(Request $request, $id)
    {
        $data = Pembeli::where('id', $id)->first();

        try {
            $data->delete();
        } catch (Exception $e) {
            session()->flash('warning', $e->getMessage());
            return redirect("pembeli");
        }

        session()->flash('success', 'Berhasil menghapus data pembeli');
        return redirect("pembeli");
    }
}
