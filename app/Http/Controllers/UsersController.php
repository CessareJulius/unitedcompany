<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index(Request $request) {
        if ($request) {
            $query=trim($request->get('buscar'));
            $users=User::where('user','LIKE','%'.$query.'%')
            ->orderBy('user','asc')
            ->paginate(7);
            
            $roles = [];
            foreach($users as $us) {
                $rol = User::getRole($us->id);
                if ($rol) { 
                    $roles[$us->id]=$rol;   
                }
            }
            
            return view('users.index',["users"=>$users,"buscar"=>$query,"roles"=>$roles]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $roles = Role::all();
        return view('users.create',["roles"=>$roles]);

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
            'user' => 'required|string|max:20|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
         $user = User::create([
            'name' => $request->get('name'),
            'email' =>  $request->get('email'),
            'user' =>  $request->get('user'),
            'password' => bcrypt($request->get('password')) 
        ]);
        $rol = Role::find($request->get('tipo'));
        $user->attachRole($rol);
        return redirect('users');
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
