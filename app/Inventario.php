<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model {
    protected $table = "inventario";

    protected $primaryKey = "id";

    public $timestamps = false;
    protected $fillable = [
        'idFarmacos',
        'precio_compra',
        'precio_venta',
        'cantidad'
    ];
}
