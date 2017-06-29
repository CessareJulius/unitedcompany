<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Carbon\Carbon;
use App\Farmacos;
use App\Ingreso;
use App\Inventario;
use App\DetalleIngreso;
use PDF;
use Auth;
use Redirect;
class IngresoController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        
        if (!Auth::user()->hasRole(['encargado-ingreso','root','gerente'])) {
            return redirect('/');
        }
         if ($request) {
            $query=trim($request->get('buscar'));
            $ingresos = DB::table('ingreso')
            ->where('nro_factura','LIKE','%'.$query.'%')
            ->orderBy('id','asc')
            ->get();
        
        
            $cantidad = [];
            
            foreach($ingresos as $in) {
                $can = DB::table('detalle_ingreso')->select('count(id) as cantidad')->where('idingreso','=',$in->id)->count();
                
                $cantidad[$in->id] = $can;
            }
        
            return view('ingreso.index',["ingresos"=>$ingresos,"buscar"=>$query,"cantidad"=>$cantidad]);
        }
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $nro=Ingreso::orderBy('nro_factura')->limit(1)->first();
        if (!$nro) {
            $nro_factura=10000;
        }else {
            $nro_factura=$nro->nro_factura;
        }
        

        $farmacos = Farmacos::all();
        return view('ingreso.create',['farmacos'=>$farmacos,'nro_factura'=>$nro_factura]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        if (!Auth::user()->hasRole(['encargado-ingreso','root','gerente'])) {
            return redirect('/');
        }
        $this->validate($request,[
            'nro_factura'=>'int|required|min:5|unique:ingreso',
            
        ]);
    
        $ingreso = new Ingreso();
        $ingreso->nro_factura = $request->get('nro_factura');
        $ingreso->fecha_hora = Carbon::now();
        $ingreso->save();
        $total = 0;
        for ($i=0;$i<count($request->get('idfarmaco'));$i++) {
            
            
            $farmaco = $request->get('idfarmaco')[$i];
            $detalle = new DetalleIngreso();
            $detalle->idfarmaco = $request->get('idfarmaco')[$i];
            
            $detalle->cantidad = $request->get('cantidad')[$i];
            $detalle->precio_compra = $request->get('precio_compra')[$i];
            $detalle->precio_venta = $request->get('precio_venta')[$i];
            
            $detalle->idingreso = $ingreso->id;
            $detalle->save();

            $farm = Inventario::where('idFarmacos','=',$detalle->idfarmaco)->first();
            
            if (!$farm) {
            
                
                $farm = new Inventario;
                $farm->idFarmacos = $detalle->idfarmaco;
                $farm->cantidad = $detalle->cantidad;
                $farm->precio_compra = $detalle->precio_compra;
                $farm->precio_venta = $detalle->precio_venta;
                $farm->save();
            }
        }

        return redirect('ingreso');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){ 
        if (!Auth::user()->hasRole(['encargado-ingreso','root','gerente'])) {
            return redirect('/');
        }
        $ingreso = Ingreso::findOrFail($id);
        
        $detalleingreso = DB::table('detalle_ingreso as di')->join('farmacos as f','f.id','=','di.idfarmaco')
        ->select('f.nombre','di.cantidad','di.precio_compra','di.precio_venta','f.id')
        ->where('di.idingreso','=',$id)
        ->paginate(50);
        $total=0;
        foreach($detalleingreso as $de) {
            $total+= $de->precio_compra * $de->cantidad;
        }


        return view('ingreso.show',["ingreso"=>$ingreso,"detalleingreso"=>$detalleingreso,"total"=>$total]);
    }
    public function pdfDetalleIngreso($id) {
        if (!Auth::user()->hasRole(['encargado-ingreso','root','gerente'])) {
            return redirect('/');
        }
        $ingreso = Ingreso::findOrFail($id);
        
        $detalleingreso = DB::table('detalle_ingreso as di')->join('farmacos as f','f.id','=','di.idfarmaco')
        ->select('f.nombre','di.cantidad','di.precio_compra','di.precio_venta','f.id')
        ->where('di.idingreso','=',$id)
        ->paginate(99);
        $total=0;
        
        foreach($detalleingreso as $de) {
            $total+= $de->precio_compra * $de->cantidad;
        }
      
        $data = ["ingreso"=>$ingreso,"detalleingreso"=>$detalleingreso,"total"=>$total];
        
        $view = \View::make('ingreso.pdfdetalleingreso', compact('ingreso','detalleingreso','total'))->render();
    
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setpaper('a4', 'landscape');
        return $pdf->download('Ingreso-'.$id.'pdf');
       
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
        if (!Auth::user()->hasRole(['encargado-ingreso','root','gerente'])) {
            return redirect('/');
        }
        Ingreso::findOrFail($id)->delete();
        DetalleIngreso::where('idingreso','=',$id)->delete();
        
        return redirect('ingreso');
    }
}
