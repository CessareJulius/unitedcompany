<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyectos extends Model
{
    protected $table = "proyectos";
    
    protected $primaryKey='id';

    public $timestamps=true;


    protected $fillable = [
        'idea_negocio',
        'objetivo',
        'presupuesto',
        'herramientas',
        'ubicacion',
        'user_id',
        'titulo'
        
    ];

   
    function user() {
        return $this->belongsTo('App\User','user_id','id');
    }
    protected $guarded = [];

}
