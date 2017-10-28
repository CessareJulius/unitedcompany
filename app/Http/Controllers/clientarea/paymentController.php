<?php

namespace App\Http\Controllers\clientarea;
use User;
use Session;
use DB;
use Auth;
use App\Payments;
use App\Paypal;
use App\Cuenta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class paymentController extends Controller
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
        
        //$pagos = Auth::user()->payments;
        /*$pagos = Auth::user()->whereHas('payments',function($query) {
             $query->where('status','>',0);
        })->get(); 
        */
        $pagos = Payments::where([['status','>',0],['user_id','=',Auth::user()->id]])->get();
       
        $status = ['Eliminado','Pendiente por consignar','Pendiente por aceptación','Pagado'];
        return view('clientarea.payments.index',["pagos"=>$pagos,"status"=>$status]);
    }
    public function create() {
        if (Session::has('pago')) {
            //dd(Session::get('pago'));
            $pago = new Payments();

            $pago->fecha_solicitud = DB::RAW('CURRENT_TIMESTAMP');
            $pago->razon_pago = session('pago')['razon_pago'];
            $pago->total = session('pago')['total'];
            $pago->user_id=Auth::user()->id;
            $pago->status=1;
            $pago->save();
            Session::forget('pago');
            Session::flash('alert',["tipo"=>"info","mensaje"=>"Pago solicitado, debe consignar para completar su operación"]);
            return redirect('clientarea/payments');
        }
    }
    public function store(Request $request,$id) {
        $pago = Payments::findOrFail($id);
        $cuenta_paypal = $request->get('cuenta_paypal');
        $referencia_bancaria = $request->get('referencia_bancaria');
            if ($cuenta_paypal) {
                $pago->status = 2;
                $pago->fecha_pago = Carbon::now()->toDatetimeString();
                $paypal = new Paypal();
                $paypal->payment_id = $pago->id;
                $paypal->cuenta = $cuenta_paypal;
                $paypal->save();
                
                $pago->update();
                Session::flash('alert',["tipo"=>"success","mensaje"=>"Pago confirmado, su solicitud debe ser aprobada por un administrador"]);
                return redirect('clientarea/payments');
            }
            if ($referencia_bancaria) {
                $pago->status = 2;
                $pago->fecha_pago = Carbon::now()->toDatetimeString();
                $paypal = new Cuenta();
                $paypal->payment_id = $pago->id;
                $paypal->referencia = $referencia_bancaria;
                $paypal->save();
                
                $pago->update();
                Session::flash('alert',["tipo"=>"success","mensaje"=>"Pago confirmado, su solicitud debe ser aprobada por un administrador"]);
                return redirect('clientarea/payments');
            }
        
        
        
    }

    

}
