<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartBeli extends Model
{
    protected $table='cartbeli';
    protected $fillable=['transaksi','kode','qty','hargacartbeli','disc1','disc2','discnominal','subtotal','untung'];
}
// $table->string('transaksi');
// $table->string('kode');
//           $table->string('qty');
//           $table->string('hargacartBeli');
//           $table->string('disc1');
//           $table->string('disc2');
//           $table->string('discnominal');
//           $table->string('subtotal');