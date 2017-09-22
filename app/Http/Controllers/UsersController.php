<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use DB;
use Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct(){
        $this->middleware('role:admin|root');
    }

    public function index(Request $request) {
       
        
        if (!Auth::user()->hasRole(['root','admin'])) {
            return redirect('/');
        }
        if ($request) {
            $query=trim($request->get('buscar'));
            /*$users=User::where('user','LIKE','%'.$query.'%')
            ->orderBy('user','asc')
            ->paginate(7)->with('roles'=>function($req) {
            });
            */
            $users = Role::where('name','!=','cliente')->first()->users()->orderBy('fecha_registro','asc')->paginate(7);
           /* $roles = [];
            $i = 0;
            foreach($users as $us) {
                $rol = User::getRole($us->id);
                if ($rol) { 
                    $roles[$us->id]=$rol;   
                    if ($rol->name=='cliente') {
                        $users->forget($i);
                    }
                }
                $i++;

            }*/
            
            
            


            return view('admin.users.index',["users"=>$users,"buscar"=>$query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
         if (!Auth::user()->hasRole(['root','admin'])) {
            return redirect('/');
        }
            /*if (Auth::user()->hasRole(['root'])) {
                $roles[3] = Role::find(3);
                $roles[4] = Role::find(4);
             }
            */

             if (Auth::user()->hasRole(['root'])) {
                $roles[3] = Role::find(1);
                $roles[4] = Role::find(3);
             }
            
        return view('admin.users.create',["roles"=>$roles]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if (!Auth::user()->hasRole(['root','admin'])) {
            return redirect('/');
        }
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'user' => 'required|string|max:20|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'tipo' => 'required'
        ]);
         $user = User::create([
            'name' => $request->get('name'),
            'email' =>  $request->get('email'),
            'user' =>  $request->get('user'),
            'password' => bcrypt($request->get('password')),
            'fecha_registro'=> DB::raw('CURRENT_TIMESTAMP')
        ]);
        $rol = Role::find($request->get('tipo'));
        $user->attachRole($rol);
        return redirect('admin/users');
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
        
        if (!Auth::user()->hasRole(['root','admin'])) {
            return redirect('/');
        }
        
        
        $usuario = User::findOrFail($id);
        
        $rol = User::getRole($id);
 
        $idrolactual = User::getRole(Auth::user()->id)->role_id;
        
        if ($idrolactual>=$rol->role_id) {
               return redirect('admin/users');
        }
        $roles = [];

        //Si el usuario autenticado es gerente o root le permite crear los siguientes roles
        if (Auth::user()->hasRole(['gerente','root'])) {
            $roles = Role::findMany([2,3]);
         }

        if (Auth::user()->hasRole(['root'])) {
             $roles = Role::findMany([1,2,3]);
        }
     
        
        return view("admin.users.edit",["usuario"=>$usuario,"roles"=>$roles,"rol"=>$rol]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
         if (!Auth::user()->hasRole(['root','admin'])) {
            return redirect('/');
         }


         $this->validate($request, [
            'name' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);
        
        $user = User::find($id);
        if($request->get('name')) { 
            $user->name = $request->get('name');
        }
        if($request->get('email')) { 
            $user->email = $request->get('email');
        }
        
        if($request->get('password')) { 
            $user->password = $request->get('password');
        }
        $user->update();

        DB::table('role_user')->where('user_id','=',$id)->delete();
        $rol = Role::find($request->get('tipo'));
        $user->attachRole($rol);
        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
         if (!Auth::user()->hasRole(['root','admin'])) {
            return redirect('/');
        }
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('admin/users');
    }
}
