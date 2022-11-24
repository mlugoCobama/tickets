<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionTicket extends Mailable
{
    use Queueable, SerializesModels;
    private $ticket;
    private $comentarios;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ticket, $comentarios)
    {
        $this->ticket = $ticket;
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
                ->subject('Seguimiento a tu solicitud')
                ->markdown('mail.notificacion')
                ->with([
                    'tecnico' => $this->ticket->asignado_a()->first()->name,
                    'estatus' => $this->comentarios->estatus()->first()->nombre,
                    'comentario' => $this->comentarios->comentario
                ]);
    }
}
