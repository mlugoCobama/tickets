<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
/**
 * Modelos
 */
use App\Models\UsuariosEmpresasModel;
use App\Models\CatHardware;
use App\Models\CatSoftware;
use App\Models\RecursosCompartidosModel;
use App\Models\CatEmpresas;
use App\Models\HardwareModel;
use App\Models\SoftwareModel;

class PDFInventarioController extends Controller
{
    private $usuariosEmpresas;
    private $catHardware;
    private $catSoftware;
    private $recursosCompartido;
    private $catEmpresas;
    private $hardwareTabla;
    private $softwareTabla;
    private $recursosTabla;

    public function __construct(
                                    UsuariosEmpresasModel $usuariosEmpresas,
                                    CatHardware $catHardware,
                                    CatSoftware $catSoftware,
                                    RecursosCompartidosModel $recursosCompartido,
                                    CatEmpresas $catEmpresas,
                                    HardwareModel $hardwareTabla,
                                    SoftwareModel $softwareTabla,
                                    RecursosCompartidosModel $recursosTabla
                                )
                            {
                                $this->usuariosEmpresas   = $usuariosEmpresas;
                                $this->catHardware        = $catHardware;
                                $this->catSoftware        = $catSoftware;
                                $this->recursosCompartido = $recursosCompartido;
                                $this->catEmpresas = $catEmpresas;
                                $this->hardwareTabla = $hardwareTabla;
                                $this->softwareTabla = $softwareTabla;
                                $this->recursosTabla = $recursosTabla;
                            }

    public function index($id)
    {
        /**
         * Obtenemos la empresa de la cual se esta haciendo el reporte
         */
        $empresa = $this->catEmpresas->where('id', $id)->first();
        /**
         * obtenemos el catalogo de software y hardware
         */
        $hardware = $this->catHardware->get();
        $software = $this->catSoftware->get();
        $recursos = $this->recursosCompartido->get();
        /**
         * Obtenemos los usuarios que son de la empresa
         */
        $usuarios = $this->usuariosEmpresas->select('id')->where('cat_empresa_id', $id)->get()->toArray();
        /**
         * Obtenemos el inventario de hardware de la empresa
         */
        $inventarioHardware = $this->hardwareTabla
                                    ->whereIn( 'usuario_empresa_id', $usuarios)
                                    ->get();
        /**
         * Obtenemos el inventario de software de la empresa
         */
        $inventarioSoftware = $this->softwareTabla
                                    ->whereIn( 'usuario_empresa_id', $usuarios)
                                    ->get();
        /**
         * Obtenemos el inventario de recursos_compartidos de la empresa
         */
        $inventarioRecursos = $this->recursosTabla
                                    ->whereIn( 'usuario_empresa_id', $usuarios)
                                    ->get();

        /**
         * obtenemos el log de la empresa
         */
        /**
         * Obtenemos el codigo de la foto de fondo
         */
        if ( $contains = Str::contains($empresa->dominio, ['renault', 'Renault']) )
        {
            $url_logo = file_get_contents(public_path('vendor/adminlte/dist/img/logo_renault.png'));
        }
        else
        {
            $url_logo = file_get_contents(public_path('vendor/adminlte/dist/img/logo_nissan.jpeg'));
        }

        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
        ->loadView('pdf.inventario', compact('hardware', 'software', 'recursos', 'empresa', 'inventarioHardware', 'inventarioSoftware', 'inventarioRecursos', 'url_logo'))
        ->stream('inventario_'.$id.'.pdf');
    }

    function reporte_filtros( int $empresa_id, string $area, string $puesto, string $ucoip) {

        ini_set('memory_limit', '512M');
        /**
         * Obtenemos la empresa de la cual se esta haciendo el reporte
         */
        $empresa = $this->catEmpresas->where('id', $empresa_id)->first();

        $datosReporte = DB::select("CALL SP_reporte_inventario(".$empresa_id.",".$area.",".$puesto.",".$ucoip.")");
        /**
         * obtenemos el log de la empresa
         */
        /**
         * Obtenemos el codigo de la foto de fondo
         */
        if ( $contains = Str::contains($empresa->dominio, ['renault', 'Renault']) )
        {
            $url_logo = file_get_contents(public_path('vendor/adminlte/dist/img/logo_renault.png'));
        }
        else
        {
            $url_logo = file_get_contents(public_path('vendor/adminlte/dist/img/logo_nissan.jpeg'));
        }


        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
        ->setPaper('a4', 'landscape')
        ->setWarnings(false)
        ->loadView('pdf.inventarioFiltro', compact('datosReporte', 'url_logo', 'empresa'))
        ->stream('inventario_'.$empresa_id.'.pdf');

    }
}
