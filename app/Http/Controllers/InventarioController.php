<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Inventario;
use App\Farmacos;
use Auth;
class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

       if (Auth::check()) {

            if ($request) {
                $query=trim($request->get('buscar'));
                $inventario = DB::table('inventario as i')
                ->join('Farmacos as f','i.id','=','f.id')
                ->select('f.nombre','f.presentacion','f.codigo','i.cantidad','i.precio_venta','i.precio_compra','i.id')
                ->where('f.nombre','LIKE','%'.$query.'%')
                ->orderBy('f.id','asc')
                ->paginate(7);
            
                return view('inventario.index',["inventario"=>$inventario,"buscar"=>$query]);
            }
       }else {
           return redirect('login?next=inventario');
       }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $farmacos = Farmacos::orderBy('nombre')->get();
        return view('inventario.create',["farmacos"=>$farmacos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
     
        $this->validate($request,[
            'cantidad'=>'int',
            'precio_venta'=>'numeric',
            'precio_compra'=>'numeric'
            ]
        );

        $inventario = Inventario::where('id','=',$request->get('farmaco'))->first();

        
        $inventario->idFarmacos = $request->get('farmaco');
        if (count($inventario)>0) {
            $cantidad = $inventario->cantidad;
            $inventario->update([
                "cantidad" =>$cantidad+$request->get('cantidad'),
                "precio_compra"=>$request->get('precio_compra'),
                "precio_venta"=>$request->get('precio_venta'),
            ]);
        }else {
            $inventario = new Inventario;
            $inventario->cantidad = $request->get('cantidad');
            
            $inventario->precio_compra = $request->get('precio_compra');
            $inventario->precio_venta = $request->get('precio_venta');
            $inventario->save();
        }
    
        
        return redirect('inventario');

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
    public function edit($id) {
        
    
            $inventario = DB::table('inventario as i')
            ->join('Farmacos as f','i.id','=','f.id')
            ->select('f.nombre','f.presentacion','f.codigo','i.cantidad','i.precio_venta','i.precio_compra','i.id')
            ->where('i.id','=',$id)
            ->get()->first();
            
        
            return view('inventario.edit',["inventario"=>$inventario]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        
        $this->validate($request,[
            'cantidad'=>'int',
            'precio_venta'=>'numeric',
            'precio_compra'=>'numeric'
            ]
        );

        $inventario = Inventario::findOrFail($id);
        $inventario->cantidad = $request->get('cantidad');
        $inventario->precio_compra = $request->get('precio_compra');
        $inventario->precio_venta = $request->get('precio_venta');

        $inventario->update();
        return redirect('inventario');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventario = Inventario::findOrFail($id);
        $inventario->delete();
        return redirect('inventario');
    }
}
