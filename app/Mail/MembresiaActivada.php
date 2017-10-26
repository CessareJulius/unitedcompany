<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MembresiaActivada extends Mailable
{
    use Queueable, SerializesModels;
    public $tipo;
    public $usuario;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tipo = 'Bronce',$usuario)
    {
        $this->tipo = $tipo;

        $this->usuario = $usuario;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.membresia-activada')->subject('Membresía Activada');
    }
}
