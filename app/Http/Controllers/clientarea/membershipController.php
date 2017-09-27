<?php

namespace App\Http\Controllers\clientarea;
use User;
use DB;
use Session;
use Auth;
use App\Payments;
use App\Memberships;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class membershipController extends Controller
{


    
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('role:cliente');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        $m = Auth::user()->membership;
        if (!$m) {
            //return $this->create();
            return redirect('clientarea/membership/create');
        }
        if ($m->status=='Suspendido') {
            Session::flash('membership','suspendido');
        }
        
        return view('clientarea.membership.index',['membership'=>$m]);
    }
    public function create() {
        return view('clientarea.membership.create');
    }
    public function store($id) {
        $m = Memberships::find($id);
        $total=$m->precio;
        $pago = [
            "razon_pago"=>"Suscripción de membresía $m->tipo",
            "total"=> $total
        ];
   
        Session::put('pago',$pago);
        
   
        return view('clientarea.payments.invoice');
   
    }
    public function renovation() {
        $m = Auth::user()->membership;
        dd($m->status);
        if (!$m || $m->status!='Expirado') {
            return redirect('clientarea');
        }
        $total=$m->membership->precio;
        $tipo=$m->membership->tipo;
        $pago = [
            'razon_pago'=>"Renovación de suscripción $tipo",
            "total"=>$total
        ];
        Session::put('pago',$pago);
           
        return view('clientarea.payments.invoice');
    }

    

}
