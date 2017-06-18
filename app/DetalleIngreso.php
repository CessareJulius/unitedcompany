<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    protected $table = "detalle_ingreso";

    protected $primaryKey='id';

    public $timestamps=false;


    protected $fillable = [

        "codigo",
        "nombre",
        "cantidad",
        "precio_compra",
        "precio_venta",
        "id_ingreso",
        "id_farmaco"
    ];

    protected $guarded = [];
}
