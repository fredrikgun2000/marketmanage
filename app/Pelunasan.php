<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelunasan extends Model
{
    protected $table='Pelunasan';
    protected $fillable=['transaksi','tanggalbayar','totalbayar','sisa'];
    // $table->string('transaksi');
    // $table->string('tanggalbayar');
    // $table->string('totalbayar');
    // $table->string('sisa');
}
