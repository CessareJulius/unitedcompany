<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = "detalle_venta";

    protected $primaryKey='id';

    public $timestamps=false;


    protected $fillable = [

        "codigo",
        "cantidad",
        "idventa",
        "idfarmaco"
    ];

    protected $guarded = [];
}
