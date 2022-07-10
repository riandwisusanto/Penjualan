<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;
use Exception;

class ConfigController extends Controller
{
    public function index()
    {
        $data = Config::where('id', 1)->first();
        return view('config.index', compact('data'));
    }

    public function store(Request $request)
    {
        $model            = Config::where('id', 1)->first();
        $model->name      = $request->name;

        if($request->hasFile('gambar')){
            $filenameWithExt = $request->file('gambar')->getClientOriginalName();
            $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension       = $request->file('gambar')->getClientOriginalExtension();
            $filenameSimpan  = $filename.'_'.time().'.'.$extension;
            $request->file('gambar')->storeAs('public/logo', $filenameSimpan);

            if(file_exists(public_path('storage/logo/'.$model->logo)))
                unlink(public_path('storage/logo/'.$model->logo));
            $model->logo    = $filenameSimpan;
        }

        try {
            $model->save();
        } catch (Exception $e) {
            session()->flash('warning', $e->getMessage());
            return redirect("pengaturan");
        }

        session()->flash('success', 'Berhasil memperbarui pengaturan');
        return redirect("pengaturan");
    }
}
