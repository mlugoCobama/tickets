<?php

namespace App\Http\Controllers;

use App\Models\ReasignacionModel;
use App\Models\TicketsModel;
use App\Models\ComentariosModel;
use App\Models\User;
use Illuminate\Http\Request;
use Webklex\IMAP\Facades\Client;
use App\Mail\NotificacionTecnicoTicket;
use Illuminate\Support\Facades\Mail;
//use Webklex\PHPIMAP\Client;

class mailConnectionController extends Controller
{
    private $tickets;
    private $comentarios;
    private $reasignacion;
    private $user;
    /**
     *
     */
    public function __construct(
                                    TicketsModel $tickets,
                                    ComentariosModel $comentarios,
                                    ReasignacionModel $reasignacion,
                                    User $user
                                    )
    {
        $this->tickets = $tickets;
        $this->comentarios = $comentarios;
        $this->reasignacion = $reasignacion;
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        $oClient = Client::account('default');
        $oClient->connect();

        $aFolder = $oClient->getFolders();
        */
        $host = "{open.cobama.com.mx:143}";
        $user = "tickets@cobama.com.mx";
        $pass = "Mhtemplos2022+";


        $conn = imap_open($host, $user,$pass) or die("can't connect: " . imap_last_error());

        $mailsNoLeidos = imap_search($conn, 'ALL');

        echo "<h1> MESSAGE</h1>\n";
        print_r($mailsNoLeidos);
        echo "<h1>*************</h1>\n";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /**
         * Obtenemos la informacion de la reasignacion
         */
        $reasignacion = $this->reasignacion->where('id', $id)->first();
        /**
         * Se hace la actualizacion del ticket
         */
        TicketsModel::where('id', $reasignacion->ticket_id)
                    ->update([
                        'asignado_a' => $reasignacion->asignado_id,
                        'area_id' => $reasignacion->area_id,
                        'status' => $reasignacion->estatus_id
                    ]);
        /**
         * Se guardan los comentarios del ticket
         */
        $this->comentarios::create([
            'comentario' => 'El usuario '.$reasignacion->solicitante()->first()->name.' solicito la reasignacion del ticket',
            'user_id' =>  $reasignacion->solicitante_id,
            'estatus_id' => 11,
            'ticket_id' =>  $reasignacion->ticket_id,
            'created_at' =>  $reasignacion->created_at,
        ]);
        /**
         * Se le envia correo al tecnico asignado
         */
        $tecnico = $this->user->where('id', $reasignacion->asignado_id)->first();
        $ticket = TicketsModel::where('id', $reasignacion->ticket_id)->first();
        Mail::to('ingmchlugo@gmail.com')->send( new NotificacionTecnicoTicket($tecnico, $ticket) );

        $this->comentarios::create([
            'comentario' => $reasignacion->comentario,
            'user_id' =>  $reasignacion->solicitante_id,
            'estatus_id' => $reasignacion->estatus_id,
            'ticket_id' =>  $reasignacion->ticket_id,
            'created_at' =>  date('Y-m-d H:i:s'),
        ]);

        return redirect()->route('tickets.index');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
