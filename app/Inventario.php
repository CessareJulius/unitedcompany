<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model {
    private $table = "inventario";

    private $primaryKey = "id";

    protected $fillable = [
        'idFarmacos',
        'precio_compra',
        'precio_venta',
        'cantidad'
    ];
}
