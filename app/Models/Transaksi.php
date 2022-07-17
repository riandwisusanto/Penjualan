<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DetailTransaksi;

class Transaksi extends Model
{
    /** @var Type $var description */
    protected $table = 'transaksi';

    /** @var Type $var description */
    protected $primaryKey = 'id';

    /** @var Type $var description */
    public $timestamps = false;

    /** @var Type $var description */
    public $incrementing = false;

    protected $appends = ['total'];

    public function getTotalAttribute()
    {
        $data = DetailTransaksi::with('barang')->where('id_transaksi', $this->id)->get();

        $total = $data->reduce(function($acc, $row){
            $sum = $row->qty * ($row->barang->harga_jual - (int)($row->barang->harga_jual * $row->barang->diskon / 100));
            return $acc + $sum;
        });

        return $total;
    }

    public function pembeli()
    {
        return $this->hasOne('App\Models\Pembeli', 'id', 'id_pembeli');
    }

    public function detail()
    {
        return $this->hasMany('App\Models\DetailTransaksi', 'id_transaksi', 'id');
    }
}
