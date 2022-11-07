<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketsRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Mail\ActualizacionTicket;
use App\Mail\NotificacionTicket;
use App\Mail\ReasignacionTicket;
use App\Mail\NotificacionTecnicoTicket;
use App\Models\AreasModel;
use App\Models\ComentariosModel;
use App\Models\CorreosModel;
use App\Models\EstatusModel;
use App\Models\ReasignacionModel;
use App\Models\TicketsModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
class TicketsController extends Controller
{
    private $tickets;
    private $correos;
    private $user;
    private $areas;
    private $comentarios;
    private $estatus;
    private $reasignacion;
    /**
     *
     */
    public function __construct(
                                    TicketsModel $tickets,
                                    AreasModel $areas,
                                    CorreosModel $correos,
                                    User $user,
                                    ComentariosModel $comentarios,
                                    EstatusModel $estatus,
                                    ReasignacionModel $reasignacion
                                    )
    {
        $this->tickets = $tickets;
        $this->areas = $areas;
        $this->correos = $correos;
        $this->user = $user;
        $this->comentarios = $comentarios;
        $this->estatus = $estatus;
        $this->reasignacion = $reasignacion;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $misCorreos =  $this->correos->join('tickets', 'tickets.correo_id', '=', 'correos.id')
                                    ->where('tickets.asignado_a', Auth::id())
                                    ->orderByDesc('correos.created_at')
                                    ->get(['correos.*', 'tickets.*']);

        $allCorreos =  $this->correos->with('ticket')->orderByDesc('created_at')->get();

        return view('tickets.index', compact('allCorreos', 'misCorreos'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketsRequest $request)
    {
        /**
         * Se genera el ticket relacionado al correo
         */
        $ticket = $this->tickets::create([
                                'correo_id' => $request->correoId,
                                'quien_asigna' =>  $request->asignadoPor,
                                'asignado_a' =>  $request->asignadoA,
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
        Mail::to('mchlugo@hotmail.com')->send(new NotificacionTicket( $ticket, $comentarios ));
        /**
         * Se le envia correo al tecnico asignado
         */
        $tecnico = $this->user->where('id', $request->asignadoA)->first();
        Mail::to($tecnico->email)->send( new NotificacionTecnicoTicket($tecnico, $ticket) );
        /**
         * Redirigimos a la ruta index
         */
        //return redirect()->route('tickets.index');

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

        $correo = $this->correos->with('ticket')->where('id', $id)->get();

        $ticket = $correo->first()->ticket()->first();

        if ( !is_null( $ticket ) )
        {
            $comentarios = $this->comentarios->where( 'ticket_id',  $ticket->id )->orderby('created_at', 'desc')->get();
        }

        return view("tickets.show", compact('correo', 'areas', 'tecnicos', 'comentarios', 'estatus'));

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
            Mail::to($correo->enviado)->send( new ActualizacionTicket( $comentario) );
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
