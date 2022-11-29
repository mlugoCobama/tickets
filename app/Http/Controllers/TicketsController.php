<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
/**
 * Validaciones de formularios
 */
use App\Http\Requests\TicketsRequest;
use App\Http\Requests\UpdateTicketRequest;
/**
 * Plantillas de correos
 */
use App\Mail\ActualizacionTicket;
use App\Mail\NotificacionTicket;
use App\Mail\ReasignacionTicket;
use App\Mail\NotificacionTecnicoTicket;
/**
 * Modelos
 */
use App\Models\AreasModel;
use App\Models\CatEmpresas;
use App\Models\ComentariosModel;
use App\Models\CorreosModel;
use App\Models\EstatusModel;
use App\Models\ReasignacionModel;
use App\Models\TicketsModel;
use App\Models\User;
class TicketsController extends Controller
{
    private $tickets;
    private $correos;
    private $user;
    private $areas;
    private $comentarios;
    private $estatus;
    private $reasignacion;
    private $cat_empresas;

    public function __construct(
                                    TicketsModel $tickets,
                                    AreasModel $areas,
                                    CorreosModel $correos,
                                    User $user,
                                    ComentariosModel $comentarios,
                                    EstatusModel $estatus,
                                    ReasignacionModel $reasignacion,
                                    CatEmpresas $cat_empresas
                                    )
    {
        $this->tickets = $tickets;
        $this->areas = $areas;
        $this->correos = $correos;
        $this->user = $user;
        $this->comentarios = $comentarios;
        $this->estatus = $estatus;
        $this->reasignacion = $reasignacion;
        $this->cat_empresas = $cat_empresas;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarioActual = Auth::user();

        if ( $usuarioActual->tipo == 1 )
        {
            $ticketsNoAsignado = $this->correos
                                        ->whereNotExists( function ($query) {
                                            $query->select( 'id' )
                                                  ->from('tickets')
                                                  ->whereColumn('tickets.correo_id', 'correos.id');
                                        })
                                        ->orderByDesc('created_at')
                                        ->get();

            $allCorreos = $this->correos
                                ->whereExists( function ($query) {
                                    $query->select( 'id' )
                                        ->from('tickets')
                                        ->whereColumn('tickets.correo_id', 'correos.id');
                                })
                                ->orderByDesc('created_at')
                                ->get();
        }
        elseif ( $usuarioActual->tipo == 2 )
        {

            $ticketsNoAsignado = collect();

            $allCorreos =  $this->correos->join('tickets', 'tickets.correo_id', '=', 'correos.id')
                                        ->where('tickets.asignado_a', Auth::id())
                                        ->orderByDesc('correos.created_at')
                                        ->get(['correos.*']);
        }

        return view('tickets.index', compact('allCorreos', 'ticketsNoAsignado'));

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketsRequest $request)
    {
        $correo = $this->correos->where('id', $request->correoId)->first();
        /**
         * Se genera el ticket relacionado al correo
         */
        $ticket = $this->tickets::create([
                                'correo_id' => $request->correoId,
                                'quien_asigna' =>  $request->asignadoPor,
                                'asignado_a' =>  $request->asignadoA,
                                'cat_empresa_id' =>  $request->cat_empresa_id,
                                'fecha_asignacion' =>  date('Y-m-d H:i:s'),
                                'area_id' =>  $request->area,
                                'status' =>  $request->estatus,
                            ]);
        /**
         * Se guardan los comentarios del ticket
         */
        $comentarios = $this->comentarios::create([
                                'comentario' => $request->comentario,
                                'user_id' =>  Auth::id(),
                                'estatus_id' => $request->estatus,
                                'ticket_id' =>  $ticket->id,
                                'created_at' =>  date('Y-m-d H:i:s'),
                            ]);
        /**
         * Se envia correo de notificacion al usuario
         */
        Mail::to( Arr::last( explode(' ', $correo->enviado) ))->send(new NotificacionTicket( $ticket, $comentarios ));
        /**
         * Se le envia correo al tecnico asignado
         */
        $tecnico = $this->user->where('id', $request->asignadoA)->first();
        Mail::to($tecnico->email)->send( new NotificacionTecnicoTicket($tecnico, $ticket) );
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comentarios = array();

        $areas = $this->areas->get();

        $tecnicos = $this->user->where('tipo', 2)->get();

        $estatus = $this->estatus->activo()->get();

        $correo = $this->correos->where('id', $id)->first();

        $ticket = $this->tickets->where('correo_id', $correo->id)->first();

        $empresas = $this->cat_empresas->get();

        if ( !is_null( $ticket ) )
        {
            $comentarios = $this->comentarios->where( 'ticket_id',  $ticket->id )->orderby('created_at', 'desc')->get();
        }
        return view("tickets.show", compact('correo', 'areas', 'tecnicos', 'comentarios', 'estatus', 'empresas', 'ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, $id)
    {
        /**
         * Recuperamos el ticket
         */
        $ticket = $this->tickets->where('id', $id)->first();
        /**
         * Validamos si se hara la reasignacion del ticket
         */
        if ($request->reasignar == 'true')
        {
            /**
             * Obtenemos el usuario que solicita la reasingacion
             */
            $solicitante = Auth::user();
            /**
             * Comentario de la reasignacion
             */
            $comentario = $request->comentario;
            /**
             * Obtenemos el nombre de tecnico a asignar
             */
            $tecnicoAsignado = $this->user->select('name')->where('id', $request->asignadoA)->first();
            /**
             * Obtenemos la area del asignado
             */
            $area = $this->areas->select('nombre')->where('id', $request->area)->first();
            /**
             * se guarda la informacion de la reasignacion para control
             */
            $reasignacion = $this->reasignacion::create([
                'solicitante_id' => $solicitante->id,
                'comentario' => $comentario,
                'asignado_id' => $request->asignadoA,
                'area_id' => $request->area,
                'ticket_id' => $id,
                'estatus_id' => $request->estatus,
                'created_at' => date("Y-m-d H:i:s")
            ]);
            /**
             * obtenemos los correos que son administradores
             */
            $correosAdministradores = $this->user
                                            ->select('email')
                                            ->where('tipo', 1)
                                            ->where('activo', 1)
                                            ->get();
            /**
             * Se envia la notificacion a los administradores del sistema
             */
            Mail::to($correosAdministradores->toArray())->send(new ReasignacionTicket( $id, $solicitante, $request->comentario, $tecnicoAsignado, $area, $reasignacion ));
        }
        else
        {
            /**
             * Recuperamos el correo
             */
            $correo = $this->correos->where('id', $ticket->correo_id)->first();
            /**
             * Se guarda el comentario del ticket
             */
            $this->comentarios::create([
                'comentario' => $request->comentario,
                'user_id' =>  Auth::id(),
                'estatus_id' => $request->estatus,
                'ticket_id' =>  $id,
                'created_at' =>  date('Y-m-d H:i:s'),
            ]);
            /**
             * obtenemos el ultimo comentario
             */
            $comentario = $this->comentarios->where('ticket_id', $id)->orderBy('created_at', 'desc')->first();
            /**
             * Se envia la actualizacion al usuario
             */
            Mail::to(Arr::last( explode(' ', $correo->enviado)))->send( new ActualizacionTicket( $comentario) );
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
