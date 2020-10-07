<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->string('transaksi');
            $table->string('kode');
            $table->string('qty');
            $table->string('hargacart');
            $table->string('disc1');
            $table->string('disc2');
            $table->string('discnominal');
            $table->string('modaltotal');
            $table->string('subtotal');
            $table->string('untung');
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
        Schema::dropIfExists('cart');
    }
}
