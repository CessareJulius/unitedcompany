<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Farmacos;
use Auth;
class FarmacosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function __construct() {
        $this->middleware('auth');
    }
    public function index(Request $request) {
        if (!Auth::user()->hasRole(['empleado','root','admin'])) {
            return redirect('/');
        }
        if ($request) {
            $query=trim($request->get('buscar'));
            $farmacos=Farmacos::where('nombre','LIKE','%'.$query.'%')
            ->orderBy('nombre','asc')
            ->paginate(7);
    
            return view('farmacos.index',["farmacos"=>$farmacos,"buscar"=>$query]);
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
        return view('farmacos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::user()->hasRole(['empleado','root','admin'])) {
            return redirect('/');
        }
        $this->validate($request,[
            'nombre'=>'max:35|required',
            'codigo'=>'unique:farmacos|required',
            
            'presentacion'=>'required'
        ]);

        $farmacos=new Farmacos;

        $nombre=$request->get('nombre');
        $codigo=$request->get('codigo');
        $presentacion=$request->get('presentacion');
        $farmacos->nombre=$nombre;
        $farmacos->codigo=$codigo;
        $farmacos->presentacion=$presentacion;
        $farmacos->save();

        return redirect('farmacos');


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
        if (!Auth::user()->hasRole(['empleado','root','admin'])) {
            return redirect('/');
        }
        $farmaco=Farmacos::findOrFail($id);
        
        return view('farmacos.edit',["farmaco"=>$farmaco]);
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        if (!Auth::user()->hasRole(['empleado','root','admin'])) {
            return redirect('/');
        }
        $this->validate($request,[
            'nombre'=>'max:35|required',
            'codigo'=>'unique:farmacos|required',
            'presentacion'=>'required'
        ]);
        $farmaco=Farmacos::findOrFail($id);
        $nombre=$request->get('nombre');
        $codigo=$request->get('codigo');
        $presentacion=$request->get('presentacion');
        $farmaco->nombre=$nombre;
        $farmaco->codigo=$codigo;
        $farmaco->presentacion=$presentacion;
        $farmaco->update();


        return redirect('farmacos');
        
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
        $farmacos=Farmacos::findOrFail($id);
        $farmacos->delete();
        return redirect('farmacos');
    }
}
