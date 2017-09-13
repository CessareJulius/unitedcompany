<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memberships extends Model
{
    protected $table = "memberships";
    
    protected $primaryKey='id';

    public $timestamps=false;


    protected $fillable = [
        "tipo",
        "precio"
    ];
    protected $guarded = [];

}
