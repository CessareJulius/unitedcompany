<?php


namespace App\Http\Controllers;
use App\Cliente;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Role;
class clienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $buscar = $request->get('buscar');
      $clientes = Cliente::where('nombres','LIKE','%'.$buscar.'%')
            ->orderBy('nombres','asc')
            ->paginate(7);
      return view('admin.clientes.index',["clientes"=>$clientes,"buscar"=>$buscar]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clientes.create');
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
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'num_doc' => 'required|string|max:30',
            'doc' =>  'required',
            'telefono'=>'required',
            'direccion' =>  'required|string|max:255',
            'user' => 'required|string|max:20|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
           
        ]);
         $user = User::create([
            'name' => $request->get('nombres'),
            'email' =>  $request->get('email'),
            'user' =>  $request->get('user'),
            'password' => bcrypt($request->get('password')) 
        ]);
        $rol = Role::find(3);
        $user->attachRole($rol);
        
        $cliente = new Cliente();
        $cliente->nombres = $request->get('nombres');
        $cliente->apellidos = $request->get('apellidos');
        $cliente->doc = $request->get('doc');
        $cliente->num_doc = $request->get('num_doc');
        $cliente->direccion = $request->get('direccion');
        $cliente->id_user = $user->id;
        $cliente->save();
        
        return redirect('admin/clientes');
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
        $cliente = Cliente::findOrFail($id);
        return view('admin.clientes.edit',["cliente"=>$cliente]);
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
        $cliente = Cliente::findOrFail($id);
        $user = User::find($cliente->id_user);


        $cliente->nombres = $request->get('nombres');
        if ( $request->get('email')) {
            $user->email = $request->get('email');   
        }    
        if ( $request->get('password')) {
            $user->password = $request->get('password');
        }
        $user->update();

        $col = ['nombres','apellidos','doc','num_doc','direccion'];
        foreach($col as $c) {
            if ($request->get($c)) {
                $cliente->$c = $request->get($c);
            }
        }
   
        $cliente->update();

    
        return redirect('admin/clientes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $user = User::findOrFail($cliente->id_user);
        $user->delete();
        $cliente->delete();
        return redirect('admin/clientes'); 
     }
}
