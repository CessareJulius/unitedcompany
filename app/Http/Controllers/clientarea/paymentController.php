<?php

namespace App\Http\Controllers\clientarea;
use User;
use Session;
use DB;
use Auth;
use App\Payments;
use App\Paypal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class paymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $status = ['','Pendiente por consignar','Pendiente por aceptación','Pagado'];
        $pagos = Auth::user()->payments;
        
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
    public function store($id) {
        $pago = Payments::findOrFail($id);
        $paypal = $request->get('cuenta_paypal');
            if ($paypal) {
                $pago->status = 2;
                $paypal = new Paypal();
                $paypal->payment_id = $pago->id;
                $paypal->cuenta = $paypal;
                $paypal->save();
                $paypal->update();
                Session::flash('alert',["tipo"=>"primary","mensaje"=>"Pago confirmado, su solicitud debe ser aprobada por un administrador"]);
                return redirect('clientarea/payments');
            }
        
        
        
    }

    

}
