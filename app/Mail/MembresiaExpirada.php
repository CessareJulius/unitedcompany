<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MembresiaExpirada extends Mailable
{
    use Queueable, SerializesModels;
    public $tipo;
    public $link;
    public $subject;
    public $view;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tipo = 'Bronce',$link,$subject,$view)
    {
        $this->tipo = $tipo;
        $this->link = $link;
        $this->subject = $subject;
        switch($view) {
            case 1:
                $view = 'email.expiration-alert';
                break;
            case 2: 
                $view = 'email.expiration';
                break;
        }
        $this->view = $view;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->view)->subject($this->subject);
    }
}
