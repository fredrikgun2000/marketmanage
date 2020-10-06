<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartPelanggan extends Model
{
    protected $table='cartpelanggan';
    protected $fillable=['tanggal','penjual','pelanggan'];
}
