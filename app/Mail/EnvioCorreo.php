<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnvioCorreo extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $alumno_id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user , $alumno_id)
    {
        $this->$user = $user;
        $this->alumno_id = $alumno_id;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        {if ($user->solicitudes->pivot->estado == 0)


        }
        {if ($user->solicitudes->pivot->estado == 1)

        }
        {if ($user->solicitudes->pivot->estado == 2)

        }
        {if ($user->solicitudes->pivot->estado == 3)

        }
    }
}
