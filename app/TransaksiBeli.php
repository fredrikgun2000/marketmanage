<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiBeli extends Model
{
    protected $table='transaksibeli';
    protected $fillable=['notransaksi','tanggal','supplier','subtotalt','disc1t','discnominalt','grandtotal','metode','pembayaran','tempo','pelunasan','tanggalbayar'];
    // $table->string('notransaksi');
    // $table->string('tanggal');
    // $table->string('penjual');
    // $table->string('subtotal');
    // $table->string('disc1t');
    // $table->string('discnominalt');
    // $table->string('grandtotal');
    // $table->string('metode');
}
