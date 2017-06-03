<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Farmacos;
class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        
            if ($request) {
                $query=trim($request->get('buscar'));
                $ingresos = DB::table('ingreso as i')
                // ->join('farmacos as f','i.id','=','f.id')
                // ->select('f.nombre','f.presentacion','f.codigo','i.cantidad','i.precio_venta','i.precio_compra','i.id')
                ->where('i.nro_factura','LIKE','%'.$query.'%')
                ->orderBy('f.id','asc')
                ->paginate(7);
            
                return view('ingreso.index',["ingresos"=>$ingresos,"buscar"=>$query]);
            }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $farmacos = Farmacos::all();
        return view('ingreso.create',['farmacos'=>$farmacos]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        
        //die($request->get('idfarmaco')[0]);
        for ($i=1;$i<=count($request->get('idfarmaco'));$i++) {
            dd($request->get('idfarmaco')[0]);
            
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
}
