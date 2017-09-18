<?php


namespace App\Http\Controllers;
use App\Cliente;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Role;
use Carbon\Carbon;
use DB;
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
      //$clientes = Cliente::where('nombres','LIKE','%'.$buscar.'%') ->orderBy('nombres','asc') ->paginate(7);
      //$clientes =  User::where('');
    //   $clientes = User::with(['roles' => function($query) {
    //        $query->where('id', 3);
    //      }])->paginate(7);
    //    $clientes = User::with('roles')->get();
    //    dd($clientes);
    
     $clientes = Role::where('name','cliente')->first()->users()->orderBy('fecha_registro','asc')->paginate(7);
    //$clientes = Role::with('users')->where('name', 'cliente')->paginate(7);
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
            'dni' => 'required|numeric|max:999999999',
            'birthday'=>'date',
            'telefono'=>'required|numeric',
            'direccion' =>  'required|string|max:255',
            'user' => 'required|string|max:20|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
           
        ]);
        
         $user = User::create([
            'name' => $request->get('nombres'),
            'lastname'=> $request->get('apellidos'),
            'email' =>  $request->get('email'),
            'user' =>  $request->get('user'),
            'address'=> $request->get('direccion'),
            'birthday'=> $request->get('birthday'),
            'phone'=> $request->get('telefono'),
            'dni'=> $request->get('dni'),
            'password' => bcrypt($request->get('password')),
            'fecha_registro'=> DB::raw('CURRENT_TIMESTAMP')
        ]);
        $rol = Role::find(1);
        $user->attachRole($rol);
        
        
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
        //$cliente = User::findOrFail($id);
        $cliente = Role::where('name','cliente')->first()->users()->where('id',$id)->first();
   
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
            'lastname' => 'string|max:255',
            'dni' => 'numeric|max:999999999',
            'birthday'=>'date',
            'phone'=>'numeric',
            'address' =>  'string|max:255',
            
            
            
        ]);
        $cliente = User::findOrFail($id);
       
        $col = ['user','email','password','name','lastname','dni','birthday','phone','address'];       
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
        
        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect('admin/clientes'); 
     }
}
