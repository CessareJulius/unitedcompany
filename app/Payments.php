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

   
    function paypal() {
        return $this->hasOne('App\Paypal','payment_id','id');
    }
    function cuenta() {
        return $this->hasOne('App\Cuenta','payment_id','id');
    }
    function user() {
        return $this->belongsTo('App\User','user_id','id');
    }
    protected $guarded = [];

}
