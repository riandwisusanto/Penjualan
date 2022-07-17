<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    /** @var Type $var description */
    protected $table = 'pembeli';

    /** @var Type $var description */
    protected $primaryKey = 'id';

    /** @var Type $var description */
    public $timestamps = false;

    /** @var Type $var description */
    public $incrementing = false;
}
