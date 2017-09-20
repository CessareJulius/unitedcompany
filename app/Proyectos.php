<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyectos extends Model
{
    protected $table = "proyectos";
    
    protected $primaryKey='id';

    public $timestamps=false;


    protected $fillable = [
        'idea_negocio',
        'objetivo',
        'presupuesto',
        'herramientas',
        'ubicacion',
        'user_id'
        
    ];

   
    function payment() {
        $this->belongsTo('App\User','id','user_id');
    }
    protected $guarded = [];

}
