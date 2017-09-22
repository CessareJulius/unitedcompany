<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
class EmailController extends Controller
{
    public function expiration(){
        //$title = $request->input('title');
        //$content = $request->input('content');
        $usuario = \App\User::find(3);
        
        $title = "Aviso de expiración de membresía ";
        $content = 'Le informamos que su membresía '.$usuario->membership->tipo." está pronta a expirar<br>Le recordamos que debe renovar nuestros servicios <br>Un saludo, UnitedCompany.";
        Mail::send('email.expiration', ['title' => $title, 'content' => $content], function ($message)
        {

            $message->from('hola@unitedcompanyweb.com', 'United Company');
            $message->subject('Aviso de expiración de membresía - United Company');
            $message->to('randygil@webcoding.cl');

        });

        return response()->json(['message' => 'Request completed']); 
    }
}
