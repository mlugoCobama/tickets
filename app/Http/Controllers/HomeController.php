<?php

namespace App\Http\Controllers;

use App\Mail\CorreoPrueba;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($cat_empresa_id = 0)
    {
        $url = env('APP_URL');

        $empresas = \DB::table('cat_empresas')->get();

        $ticketsTecnico = \DB::select("call SP_ticket_tecnicos( $cat_empresa_id )");
        $ticketsAreas = \DB::select("call SP_ticket_areas( $cat_empresa_id )");
        $ticketsEmpresas = \DB::select("call SP_ticket_empresas()");
        $ticketsEstatus = \DB::select("call SP_ticket_estatus( $cat_empresa_id )");

        if ($cat_empresa_id == 0)
        {
            $totalCorreos = \DB::table('correos')->count();
            $totalResueltos = \DB::table('tickets')->where('status', 9)->count();
            $totalProceso = \DB::table('tickets')->where('status', '<>',9)->count();
        }
        else
        {
            $totalCorreos = \DB::table('tickets')->where('cat_empresa_id', $cat_empresa_id)->count();
            $totalResueltos = \DB::table('tickets')->where('status', 9)->where('cat_empresa_id', $cat_empresa_id)->count();
            $totalProceso = \DB::table('tickets')->where('status', '<>',9)->where('cat_empresa_id', $cat_empresa_id)->count();
        }

        return view('home', compact('ticketsTecnico', 'ticketsAreas', 'ticketsEmpresas', 'ticketsEstatus', 'totalCorreos', 'totalResueltos', 'totalProceso', 'cat_empresa_id', 'empresas'));

    }

    public function show()
    {
        /*
        $tickets = \DB::select('SELECT ticket_id, MAX(estatus_id) as estatus FROM comentarios WHERE ticket_id in ( select id from tickets where tickets.id = comentarios.ticket_id )  group by ticket_id;');
        $i = 1;
        foreach ($tickets as $item ) {
            echo $i."----". $item->ticket_id." ".$item->estatus."<br>";

            \DB::table('tickets')
                ->where('id', $item->ticket_id)
                ->update(['status' => $item->estatus]);

            $i++;
        }
        */
        Mail::to('ingmchlugo@gmail.com')->send( new CorreoPrueba() );
    }
}
