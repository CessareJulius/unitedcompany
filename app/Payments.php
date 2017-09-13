<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $table = "payments";
    
    protected $primaryKey='id';

    public $timestamps=false;


    protected $fillable = [
        'fecha_solicitud',
        'fecha_pago',
        'razon_pago',
        'status',
        'total',
        'user_id'
    ];

   
    function user() {
        $this->belongsTo('App\User','id','user_id');
    }
    protected $guarded = [];

}
