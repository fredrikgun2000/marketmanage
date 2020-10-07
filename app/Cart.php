<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table='cart';
    protected $fillable=['transaksi','kode','qty','hargacart','disc1','disc2','discnominal','modaltotal','subtotal','untung'];
}
// $table->string('transaksi');
// $table->string('kode');
//           $table->string('qty');
//           $table->string('hargacart');
//           $table->string('disc1');
//           $table->string('disc2');
//           $table->string('discnominal');
//           $table->string('subtotal');