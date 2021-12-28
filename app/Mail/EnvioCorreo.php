<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class EnvioCorreo extends Mailable
{
    use Queueable, SerializesModels;
     public $user;
     public $solicitud;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id , $alumno_id)
    {
        $this->user = User::where('id', $id )->first();
        $this->solicitud = $this->user->solicitudes()->wherePivot('id', $alumno_id )->first();

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
       if($this->solicitud->pivot->estado == 1){
           return $this->view('correo.aprobada');


        }

        if($this->solicitud->pivot->estado == 2){
            return $this->view('correo.aceptadaO');
        }


        if($this->solicitud->pivot->estado == 3){
            return $this->view('correo.rechazada');
        }




    }
}
