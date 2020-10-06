<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksibeliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksibeli', function (Blueprint $table) {
            $table->id();
            $table->string('notransaksi');
            $table->string('tanggal');
            $table->string('supplier');
            $table->string('subtotalt');
            $table->string('disc1t');
            $table->string('discnominalt');
            $table->string('grandtotal');
            $table->string('metode');
            $table->string('pembayaran');
            $table->string('tempo');
            $table->string('pelunasan');
            $table->string('tanggalbayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksibeli');
    }
}
