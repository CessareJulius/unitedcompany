<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Role;
use App\Espacio;

class espacioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $buscar = $request->get('buscar');
      $espacios = Espacio::where('nombre','LIKE','%'.$buscar.'%')
            ->orderBy('nombre','asc')
            ->paginate(7);
      return view('admin.espacios.index',["espacios"=>$espacios,"buscar"=>$buscar]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasRole(['root','gerente'])) {
            return redirect('/');
        }
        return view('admin.espacios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::user()->hasRole(['root','gerente'])) {
            return redirect('/');
        }
        $this->validate($request, [
            'nombre' => 'required|string|max:40',
            'direccion' => 'required|string|max:255',
            'observaciones' => 'required|string|max:255',
            
           
        ]);
        $espacio = new Espacio();
        $espacio->nombre = $request->get('nombre');
        $espacio->direccion = $request->get('direccion');
        $espacio->observaciones = $request->get('observaciones');
        $espacio->save();
        
        return redirect('admin/espacios');
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
        $espacio = Espacio::findOrFail($id);
        return view('admin.espacios.edit',["espacio"=>$espacio]);
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
        if (!Auth::user()->hasRole(['root','admin'])) {
            return redirect('/');
         }


         $this->validate($request, [
            'name' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);
        $espacio = Espacio::findOrFail($id);
        $col = ['nombre','direccion','observaciones'];
        foreach($col as $c) {
            if ($request->get($c)) {
                $espacio->$c = $request->get($c);
            }
        }
   
        $espacio->update();

    
        return redirect('admin/espacios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $espacio = Espacio::findOrFail($id);
        $espacio->delete();
        return redirect('admin/espacios'); 
     }
}
