<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use DB;
use Auth;
use Illuminate\Support\Collection;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct(){
        $this->middleware('role:root');
    }

    public function index(Request $request) {
       
     
        if ($request) {
            $query=trim($request->get('buscar'));
            
            /*$users = Role::where('name','!=','cliente')->get();
            foreach($users as $u) {
                $usuarios = $usuarios->merge($u->users());
            }*/
            //User::whereHas('');
            //$usuarios = User::with('roles')->where('name','=','cliente')->get();
           /* $usuarios = Role::with('users')->where(
                [
                    ['name','cliente']
                ]
            )->get();*/
            $root = Role::where('name','root')->first()->users;
            $admin = Role::where('name','admin')->first()->users;
            $usuarios = $root->merge($admin);
            $usuarios = $this->paginateCollection($usuarios,7);
            
            
            return view('admin.users.index',["users"=>$usuarios,"buscar"=>$query]);
        }
    }


    function paginateCollection($collection, $perPage, $pageName = 'page', $fragment = null)
    {
        $currentPage = \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPage($pageName);
        $currentPageItems = $collection->slice(($currentPage - 1) * $perPage, $perPage);
        parse_str(request()->getQueryString(), $query);
        unset($query[$pageName]);
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $currentPageItems,
            $collection->count(),
            $perPage,
            $currentPage,
            [
                'pageName' => $pageName,
                'path' => \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPath(),
                'query' => $query,
                'fragment' => $fragment
            ]
        );
    
        return $paginator;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
 
            
            if (Auth::user()->hasRole(['admin'])) {
                $roles[3] = Role::find(1);
                
             }
             if (Auth::user()->hasRole(['root'])) {
                $roles[1] = Role::find(1);
                $roles[2] = Role::find(2);
                $roles[3] = Role::find(3);
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

    
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'user' => 'required|string|max:20|unique:users',
            
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'tipo' => 'required'
        ]);
         $user = User::create([

            'name' => $request->get('name'),
            'lastname' => $request->get('lastname'),
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
        
   
        
        $usuario = User::findOrFail($id);
        
        $rol = User::getRole($id);
 


        //Si el usuario autenticado es gerente o root le permite crear los siguientes roles
        if (Auth::user()->hasRole(['root'])) {
            $roles = Role::findMany([1,2,3]);
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
        if($request->get('user')) { 
            $user->user = $request->get('user');
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
       
        
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('admin/users');
    }
}
