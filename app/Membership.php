<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model {
    
    protected $table = "memberships_users";
    
    protected $primaryKey='id';

    public $timestamps=false;


    protected $fillable = [
        "fecha_suscripcion",
        "status",
        "expiration",
        "user_id",
        "membership_id",
        "notifiable"
    ];

    public function user() {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function membership() {
        return $this->belongsTo('App\Memberships','membership_id','id');
    }

    protected $guarded = [];

}
