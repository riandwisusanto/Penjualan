<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    /** @var Type $var description */
    protected $table = 'config';

    /** @var Type $var description */
    protected $primaryKey = 'id';

    /** @var Type $var description */
    public $timestamps = false;
}
