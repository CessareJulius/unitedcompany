<?php


namespace App\Http\Controllers\clientarea;
use App\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

use Carbon\Carbon;
use App\Proyectos;
use Session;
use DB;
class proyectoController extends Controller
{


    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    
      $proyectos = Proyectos::orderBy('created_at','asc')->where('user_id',Auth::user()->id)->paginate(7);
      
    
      return view('clientarea.proyectos.index',["proyectos"=>$proyectos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientarea.proyectos.create');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        
        $this->validate($request, [
            'titulo' => 'required|string|max:255',
            'idea_negocio' => 'required|string|max:500',
            'objetivo' => 'required|string|max:500',
            'presupuesto'=>'required|integer|max:9999999',
            'herramientas' => 'required|string|max:500',
            'ubicacion' => 'required|string|max:255',
           
        ]);
        
        $user = Proyectos::create([
            'idea_negocio'=>$request->get('idea_negocio'),
            'objetivo'=>$request->get('objetivo'),
            'presupuesto'=>$request->get('presupuesto'),
            'herramientas'=>$request->get('herramientas'),
            'ubicacion'=>$request->get('ubicacion'),
            'user_id'=>Auth::user()->id
        ]);
        
        Session::flash('alert',["tipo"=>'success','mensaje'=>'Se ha envíado correctamente tu proyecto.']);
        return redirect('admin/proyectos');
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
        
        $proyecto = Proyectos::find($id);
   
        return view('clientarea.proyectos.edit',["proyecto"=>$proyecto]);
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
            

        
        $this->validate($request, [
            'titulo' => 'required|string|max:255',
            'idea_negocio' => 'required|string|max:500',
            'objetivo' => 'required|string|max:500',
            'presupuesto'=>'required|integer|max:9999999',
            'herramientas' => 'required|string|max:500',
            'ubicacion' => 'required|string|max:255',
           
        ]);
        $proyecto = User::findOrFail($id);
        
        $col = ['titulo','idea_negocio','objetivo','presupuesto','herramientas','ubicacion'];       
        foreach($col as $c) {
            if ($request->get($c)) {
                $proyecto->$c = $request->get($c);
            }
        }

        $proyecto->update();


        return redirect('clientarea\proyectos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect('admin/clientes'); 
     }
}
