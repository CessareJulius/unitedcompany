<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use CanResetPassword;
use DB;
use Auth;
use Redirect;
use App\Role;
use App\Membership;
use App\Memberships;
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
        'name','lastname','user','email', 'password','address','phone','dni','birthday','fecha_registro'
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function rol()
    {
        //return $this->hasMany('Role')->first()->display_name;
        
        return $this->hasMany('Role');
        
    }
    public function membership() {
        return $this->hasOne('App\Membership');
    }
    
    public function payments() {
        return $this->hasMany('App\Payments');
    }



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
    static public function access($roles) {
        
        if (Auth::user()->hasRole($roles)) {
            
            return true;
        }
        return false;
    
    }
}
