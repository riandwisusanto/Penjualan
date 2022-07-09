<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    /** @var Type $var description */
    protected $table = 'barang';

    /** @var Type $var description */
    protected $primaryKey = 'id';

    /** @var Type $var description */
    public $timestamps = false;

    /** @var Type $var description */
    public $incrementing = false;

    public function penjualan()
    {
        return $this->hasMany('App\Models\Penjualan', 'id_barang', 'id');
    }
}
