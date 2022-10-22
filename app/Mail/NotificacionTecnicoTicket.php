<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionTecnicoTicket extends Mailable
{
    use Queueable, SerializesModels;
    private $tecnico;
    private $ticket;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tecnico, $ticket)
    {
        $this->tecnico = $tecnico;
        $this->ticket = $ticket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('tickets@cobama.com.mx', 'Sistema de Tickets')
                ->subject('Se te ha asignado un nuevo ticket')
                ->markdown('mail.notificacionTecnico')
                ->with([
                    'tecnico' => $this->tecnico->name,
                    'idTicket' => $this->ticket->id
                ]);
    }
}
