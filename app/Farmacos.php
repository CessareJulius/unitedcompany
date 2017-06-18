<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farmacos extends Model
{
    protected $table = "farmacos";

    protected $primaryKey='id';

    public $timestamps=false;


    protected $fillable = [
        "nombre",
        "cantidad",
        "presentacion",
        "precio_compra",
        "precio_venta"
    ];

    protected $guarded = [];
}
