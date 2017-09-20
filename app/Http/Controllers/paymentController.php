<?php

namespace App\Http\Controllers;
use User;
use Session;
use DB;
use Auth;
use App\Payments;
use App\Paypal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class paymentController extends Controller
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
        $status = ['','Pendiente por consignar','Pendiente por aceptación','Pagado'];
        $pagos = Payments::where('status', '>', 0)->orderBy('fecha_solicitud','asc')->get();
       
        
        return view('admin.payments.index',["pagos"=>$pagos,"status"=>$status]);
    }

    public function confirmar($id) {
        $pago = Payments::findOrFail($id);
        if ($pago->paypal)  {
            $pago->status=3;
            $pago->update();
            Session::flash('alert',["tipo"=>"success","mensaje"=>"Pago confirmado, avisando al usuario por correo"]);
            return redirect('admin/payments');
        }

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
            return redirect('admin/payments');
        }
    }
    public function store(Request $request,$id) {
        $pago = Payments::findOrFail($id);
        $cuenta_paypal = $request->get('cuenta_paypal');
            if ($cuenta_paypal) {
                $pago->status = 2;
                $pago->fecha_pago = Carbon::now()->toDatetimeString();
                $paypal = new Paypal();
                $paypal->payment_id = $pago->id;
                $paypal->cuenta = $cuenta_paypal;
                $paypal->save();
                
                $pago->update();
                Session::flash('alert',["tipo"=>"success","mensaje"=>"Pago confirmado, su solicitud debe ser aprobada por un administrador"]);
                return redirect('admin/payments');
            }
        
        
        
    }

    public function destroy($id) {
        $pago = Payments::findOrFail($id);
        $pago->status = 0;
        $pago->update();
        Session::flash('alert',["tipo"=>"success","mensaje"=>"Se ha eliminado el pago."]);
        return redirect('admin/payments');

    }

    

}
