<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Farmacos;
use App\Inventario;
use App\Venta;
use App\DetalleVenta;
use PDF;
use Auth;
class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if (!Auth::user()->hasRole(['empleado','root','admin'])) {
            return redirect('/');
        }
        if ($request) {
            $query=trim($request->get('buscar'));
            $ventas = DB::table('venta')
            
            ->where('nro_factura','LIKE','%'.$query.'%')
            ->orderBy('id','asc')
            ->get();
        
        
            $cantidad = [];
            
            foreach($ventas as $ven) {
                $can = DB::table('detalle_venta')->select('count(id) as cantidad')->where('idventa','=',$ven->id)->count();
                $cantidad[$ven->id] = $can;
            }
        
            return view('venta.index',["ventas"=>$ventas,"buscar"=>$query,"cantidad"=>$cantidad]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        if (!Auth::user()->hasRole(['empleado','root','admin'])) {
            return redirect('/');
        }
        $farmacos = DB::table('inventario')->join('farmacos','inventario.idFarmacos','=','farmacos.id')->get();
        return view('venta.create',['farmacos'=>$farmacos]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        if (!Auth::user()->hasRole(['empleado','root','admin'])) {
            return redirect('/');
        }
        $this->validate($request,[
            'nro_factura'=>'int|required|min:5',
            //'idfarmaco'=>'required',
            
        ]);
        
        $venta = new Venta();
        $venta->nro_factura = $request->get('nro_factura');
        $venta->fecha_hora = Carbon::now();
        $venta->nombrecliente = $request->get('nombrecliente');
        $venta->cedulacliente = $request->get('cedulacliente');
        $venta->save();
        $total = 0;
        for ($i=0;$i<count($request->get('idfarmaco'));$i++) {
            
            
            $farmaco = $request->get('idfarmaco')[$i];
            $detalle = new DetalleVenta();
            $detalle->idfarmaco = $request->get('idfarmaco')[$i];
            $detalle->precio_venta = $request->get('precio_venta')[$i];
            $detalle->cantidad = $request->get('cantidad')[$i];
          
            $detalle->idventa = $venta->id;
            $detalle->save();

            
        
        }

        return redirect('venta');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){ 
        if (!Auth::user()->hasRole(['empleado','root','admin'])) {
            return redirect('/');
        }
        $venta = Venta::findOrFail($id);
        
        $detalleventa = DB::table('detalle_venta as dv')->join('farmacos as f','f.id','=','dv.idfarmaco')
        ->select('f.nombre','dv.cantidad','f.id','dv.precio_venta')
        ->where('dv.idventa','=',$id)
        ->get();
        $total=0;
        foreach($detalleventa as $de) {
            $total+= $de->precio_venta * $de->cantidad;
        }


        return view('venta.show',["venta"=>$venta,"detalleventa"=>$detalleventa,"total"=>$total]);
    }
    public function pdfDetalleVenta($id) {
        if (!Auth::user()->hasRole(['empleado','root','admin'])) {
            return redirect('/');
        }
    
        $venta = Venta::findOrFail($id);
        
        $detalleventa = DB::table('detalle_venta as dv')->join('farmacos as f','f.id','=','dv.idfarmaco')
        ->select('f.nombre','dv.cantidad','f.id','dv.precio_venta')
        ->where('dv.idventa','=',$id)
        ->get();
        $total=0;
        foreach($detalleventa as $de) {
            $total+= $de->precio_venta * $de->cantidad;
        }

      
        $data = ["venta"=>$venta,"detalleventa"=>$detalleventa,"total"=>$total];
        
        $view = \View::make('venta.pdfdetalleventa', compact('venta','detalleventa','total'))->render();
    
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setpaper('a4', 'landscape');
        return $pdf->download('Venta-'.$id.'pdf');
       
        
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
    public function destroy($id) {
        if (!Auth::user()->hasRole(['empleado','root','admin'])) {
            return redirect('/');
        }
        Ingreso::findOrFail($id)->delete();
        
        DetalleIngreso::where('idventa','=',$id)->delete();
        
        return redirect('venta');
    }
}
