<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table = "ingreso";

    protected $primaryKey='id';

    public $timestamps=false;


    protected $fillable = [
      "nro_factura",
      "fecha_hora"
    ];

    protected $guarded = [];
}
