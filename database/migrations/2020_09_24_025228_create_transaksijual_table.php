<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksijualTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksijual', function (Blueprint $table) {
            $table->id();
            $table->string('notransaksi');
            $table->string('tanggal');
            $table->string('penjual');
            $table->string('subtotalt');
            $table->string('disc1t');
            $table->string('discnominalt');
            $table->string('modaltotalcart');
            $table->string('grandtotal');
            $table->string('untungtotal');
            $table->string('metode');
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
        Schema::dropIfExists('transaksijual');
    }
}
