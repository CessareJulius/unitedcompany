<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    protected $table = "pago_cuenta";
    
    protected $primaryKey='id';

    public $timestamps=false;


    protected $fillable = [
        'referencia',
        'payment_id',
        
    ];

   
    function payment() {
        $this->belongsTo('App\Payments','id','payment_id');
    }
    protected $guarded = [];

}
