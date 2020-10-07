<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksijual extends Model
{
    protected $table='transaksijual';
    protected $fillable=['notransaksi','tanggal','penjual','subtotalt','disc1t','discnominalt','modaltotalcart','grandtotal','untungtotal','metode'];
    // $table->string('notransaksi');
    // $table->string('tanggal');
    // $table->string('penjual');
    // $table->string('subtotal');
    // $table->string('disc1t');
    // $table->string('discnominalt');
    // $table->string('grandtotal');
    // $table->string('metode');
}
