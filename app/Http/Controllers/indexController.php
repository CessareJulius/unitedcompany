<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContratoFormRequest;
class indexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
  

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('index');
    } 

    public function contrato(ContratoFormRequest $request) {
        
         \Mail::send('email.contrato',
            array(
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'user_message' => $request->get('message')
                
            ), function($message)
        {
            $message->from('randygil@webcoding.cl');
            $message->to('randygil@webcoding.cl', 'Randy')->subject('Ofvir Contrato');
    });

         return \Redirect::route('index')
      ->with('message', 'Gracias, nos pondremos en contacto contigo en breve');
    }
}
