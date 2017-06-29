<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table = "ingreso";

    protected $primaryKey='id';

    public $timestamps=false;

   public function detalle() {
       return $this->hasMany('App\DetalleIngreso', 'idingreso', 'id');
   }

    protected $fillable = [
      "nro_factura",
      "fecha_hora"
    ];

    protected $guarded = [];
}
