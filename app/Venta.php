<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = "venta";

    protected $primaryKey='id';

    public $timestamps=false;


    protected $fillable = [
      "nro_factura",
      "fecha_hora",
      "nombrecliente",
      "cedulacliente"
    ];

    protected $guarded = [];
}
