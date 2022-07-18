<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    /** @var Type $var description */
    protected $table = 'detail_transaksi';

    /** @var Type $var description */
    protected $primaryKey = 'id';

    /** @var Type $var description */
    public $timestamps = false;

    /** @var Type $var description */
    public $incrementing = false;

    public function barang()
    {
        return $this->hasOne('App\Models\Barang', 'id', 'id_barang');
    }

    public function transaksi()
    {
        return $this->hasOne('App\Models\Transaksi', 'id', 'id_transaksi');
    }
}
