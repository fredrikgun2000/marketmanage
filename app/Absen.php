<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class absen extends Model
{
	protected $table='absen';
	protected $fillable=['tanggal','waktu','staff','pengabsen'];
    // $table->string('tanggal');
    // $table->string('waktu');
    // $table->string('staff');
    // $table->string('pengabsen');
}
