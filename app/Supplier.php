<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table='Supplier';
    protected $fillable=['nama','telepon'];
}
