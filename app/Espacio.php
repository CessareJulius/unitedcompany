<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Espacio extends Model
{
    protected $table = "espacios";

    protected $primaryKey='id';

    public $timestamps=false;


    protected $fillable = [
        "nombre",
        "direccion",
        "observaciones"
       
    ];


    protected $guarded = [];
}
