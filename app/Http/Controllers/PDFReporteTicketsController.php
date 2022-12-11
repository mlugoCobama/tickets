<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PDF;

class PDFReporteTicketsController extends Controller
{
    public function index(Request $request)
    {
        $empresa = collect();
        $url = public_path('storage/tmp/');

        $cat_empresa_id  = $request->cat_empresa_id;
        $ticketsTecnico  = base64_encode( $request->SVGTecnico );
        $ticketsAreas    = $request->SVGArea;
        $ticketsEstatus  = $request->SVGEmpresa;
        $ticketsEmpresas = $request->SVGEstatus;

        if ($cat_empresa_id != 0)
        {
            $empresa = \DB::table('cat_empresas')->where('id', $request->cat_empresa_id)->get();
        }

        //return view('pdf.reporteTickets', compact('ticketsTecnico', 'ticketsAreas', 'ticketsEmpresas', 'ticketsEstatus', 'totalCorreos', 'totalResueltos', 'totalProceso', 'cat_empresa_id', 'empresas'));
        $pdf = PDF::loadView('pdf.reporteTickets', compact('ticketsTecnico', 'ticketsAreas', 'ticketsEmpresas', 'ticketsEstatus', 'cat_empresa_id', 'empresa'));

        $pdf->save($url.'reporte_tickets.pdf');

        /*
        $pdf->loadView('pdf.reporteTickets', compact('ticketsTecnico', 'ticketsAreas', 'ticketsEmpresas', 'ticketsEstatus', 'cat_empresa_id', 'empresa'))
        ->save($url.'reporte_tickets.pdf');
        */
    }
}
