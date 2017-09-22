<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class clientareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('role:cliente');
    }
    
    public function index()
    {
        return view('clientarea.index');
    }

}
