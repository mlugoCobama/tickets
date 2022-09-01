<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketsRequest;
use App\Models\AreasModel;
use App\Models\ComentariosModel;
use App\Models\CorreosModel;
use App\Models\EstatusModel;
use App\Models\TicketsModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class TicketsController extends Controller
{
    private $tickets;
    private $correos;
    private $user;
    private $areas;
    private $comentarios;
    private $estatus;

    /**
     * Constructor para obtener el id empresa
     * con base al usuario que esta usando la sesion
     */
    public function __construct(
                                    TicketsModel $tickets,
                                    AreasModel $areas,
                                    CorreosModel $correos,
                                    User $user,
                                    ComentariosModel $comentarios,
                                    EstatusModel $estatus
                                    )
    {

        $this->tickets = $tickets;
        $this->areas = $areas;
        $this->correos = $correos;
        $this->user = $user;
        $this->comentarios = $comentarios;
        $this->estatus = $estatus;
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
        $ticket = $this->tickets::create([
                                'correo_id' => $request->correoId,
                                'quien_asigna' =>  $request->asignadoPor,
                                'asignado_a' =>  $request->asignadoA,
                                'fecha_asignacion' =>  date('Y-m-d H:i:s'),
                                'area_id' =>  $request->area,
                                'status' =>  $request->estatus,
                            ]);

        $this->comentarios::create([
                                'comentario' => $request->comentario,
                                'user_id' =>  Auth::id(),
                                'ticket_id' =>  $ticket->id,
                                'created_at' =>  date('Y-m-d H:i:s'),
                            ]);




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
        $areas = $this->areas->get();

        $tecnicos = $this->user->where('tipo', 2)->get();

        $estatus = $this->estatus->activo()->get();

        $correo = $this->correos->with('ticket')->where('id', $id)->get();

        $comentarios = $this->comentarios->where( 'ticket_id',  $correo->first()->ticket()->first()->id )->get();

        return view("tickets.show", compact('correo', 'areas', 'tecnicos', 'comentarios', 'estatus'));
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

    private function procesar_data( $datos )
    {
        for ($i=0; $i < count( $datos ); $i++)
        {
            if ($datos[$i]['value'] != '')
            {
                $data[ $datos[$i]['name'] ] = $datos[$i]['value'];
            }
            else
            {
                return 'error';
                exit;
            }
        }
        return array_chunk( $data, 1 );
    }
}
