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

    

}
