<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReasignacionTicket extends Mailable
{
    use Queueable, SerializesModels;
    private $idTicket;
    private $solicitante;
    private $comentarios;
    private $tecnicoAsignado;
    private $area;
    private $reasignacion;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($idTicket, $solicitante, $comentarios, $tecnicoAsignado, $area, $reasignacion)
    {
        $this->idTicket = $idTicket;
        $this->solicitante = $solicitante;
        $this->comentarios = $comentarios;
        $this->tecnicoAsignado = $tecnicoAsignado;
        $this->area = $area;
        $this->reasignacion = $reasignacion;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('tickets@cobama.com.mx', 'Sistema de Tickets')
                ->subject('Solicitud de reasignación de ticket')
                ->markdown('mail.reasignacion')
                ->with([
                    'idTicket' => $this->idTicket,
                    'solicitante' => $this->solicitante->name,
                    'comentarios' => $this->comentarios,
                    'tecnicoAsignado' => $this->tecnicoAsignado->name,
                    'area' => $this->area->nombre,
                    'idReasignacion' => $this->reasignacion->id
                ]);
    }
}
