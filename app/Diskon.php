<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    protected $table='diskon';
    protected $fillable=['kodebarang','tanggalmulai','tanggalakhir','minitem','diskon'];
}
