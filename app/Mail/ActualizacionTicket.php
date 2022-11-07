<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActualizacionTicket extends Mailable
{
    use Queueable, SerializesModels;
    private $comentarios;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $comentarios)
    {
        $this->comentarios = $comentarios;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('tickets@cobama.com.mx', 'Sistema de Tickets')
                ->subject('Actualización a tu solicitud')
                ->markdown('mail.actualizacion')
                ->with([
                    'estatus' => $this->comentarios->estatus()->first()->nombre,
                    'comentario' => $this->comentarios->comentario
                ]);
    }
}
