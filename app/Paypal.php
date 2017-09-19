<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paypal extends Model
{
    protected $table = "pago_paypal";
    
    protected $primaryKey='id';

    public $timestamps=false;


    protected $fillable = [
        'cuenta_paypal',
        'payment_id',
        
    ];

   
    function payment() {
        $this->belongsTo('App\Payments','id','payment_id');
    }
    protected $guarded = [];

}
