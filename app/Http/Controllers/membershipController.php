<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Carbon\Carbon;
use App\Membership;
class membershipController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $us = User::find($id);
        $mid = $request->get('membresia');
        $mem = $us->membership;
        if ($mem) {
            if ($mid==$mem->membership_id) {
            //Session::flash('alert',["tipo"=>"warning","mensaje"=>"La membresá"])
            return redirect('admin/clientes');
            }
        }

        if (!$mem) {
            $u = new Membership();
            //$u->fecha_suscripcion = DB::
            //$fecha = Carbon::now()->adddays(31);
            $u->membership_id = $mid;
            $u->status = 'Activo';
            $u->fecha_suscripcion = Carbon::now()->toDatetimeString();
            $u->expiration = Carbon::now()->addDays(31)->toDatetimeString();
            $u->user_id = $us->id;
            $u->save();
            Session::flash('alert',["tipo"=>"info","mensaje"=>"Se ha suscrito el usuario $us->user a la membresia ".$u->membership["tipo"]]);
            return redirect('admin/clientes');
        }else{
            $mem->membership_id = $mid;
            $mem->update();
            Session::flash('alert',["tipo"=>"info","mensaje"=>"Se ha cambiado la membresía del usuario $us->user a ".$mem->membership["tipo"]]);
            return redirect('admin/clientes');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function suspend($id) {
        $c = User::find($id);
        $m = $c->membership;
        
        $m->status = 'Suspendido';
        $m->update();

        Session::flash('alert',["tipo"=>'success','mensaje'=>'Se ha suspendido la membresía']);
        return redirect('admin/clientes');
    }

    public function unsuspend($id) {
        $c = User::find($id);
        $m = $c->membership;
        $m->status = 'Activo';
        $m->update();

        Session::flash('alert',["tipo"=>'success','mensaje'=>'Se ha quitado la suspención de la membresía']);
        return redirect('admin/clientes');
    }
    public function delete($id) {
        $c = User::find($id);
        $m = $c->membership;
        $m->delete();
        Session::flash('alert',["tipo"=>'success','mensaje'=>'Se ha eliminado la membresía']);
        return redirect('admin/clientes');
    }

    public function extend(Request $request,$id) {
        
        $dias = $request->get('dias');
        $c = User::find($id);
        $m = $c->membership;

        $m->expiration = Carbon::parse($m->expiration)->addDays($dias)->toDatetimeString();
        $m->update();
        Session::flash('alert',["tipo"=>'success','mensaje'=>"Se ha extendido la membresía $dias días"]);
        return redirect('admin/clientes');
        //$u->expiration = Carbon::now()->addDays(31)->toDatetimeString();

    }
}
