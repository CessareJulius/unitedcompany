<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use CanResetPassword;
use DB;
class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = [
        'name','user','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Función que permite mostrar el rol del usuario
     *
     * @param User_id $id
     * @return array 
     */
    static public function getRole($id) {
           $roles = DB::table('role_user as r')->join('roles as ro','ro.id','=','r.role_id')
           ->where('user_id','=',$id)->first();
           return $roles;
    }
}
