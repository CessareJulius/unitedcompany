<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "clientes";

    protected $primaryKey='id';

    public $timestamps=false;


    protected $fillable = [
        "nombres",
        "apellidos",
        "direccion",
        "telefono",
        "doc",
        "num_doc",
        "id_user"
    ];

    public function user() {
        return $this->hasOne('App\User','id','id_user');
    }

    protected $guarded = [];
}
