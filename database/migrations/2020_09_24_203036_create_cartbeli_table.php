<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartbeliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartbeli', function (Blueprint $table) {
            $table->id();
            $table->string('transaksi');
            $table->string('kode');
            $table->string('qty');
            $table->string('hargacartbeli');
            $table->string('disc1');
            $table->string('disc2');
            $table->string('discnominal');
            $table->string('subtotal');
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
        Schema::dropIfExists('cartbeli');
    }
}
