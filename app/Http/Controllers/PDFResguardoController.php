<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PDF;
/**
 * Modelos
 */
use App\Models\CatEmpresas;
use App\Models\CatHardware;
use App\Models\CatSoftware;
use App\Models\HardwareModel;
use App\Models\SoftwareModel;
use App\Models\UsuariosEmpresasModel;
use App\Models\RecursosCompartidosModel;

class PDFResguardoController extends Controller
{
    private $catHardware;
    private $catSoftware;
    private $catEmpresas;
    private $software;
    private $hardware;
    private $usuariosEmpresas;
    private $recursosCompartido;

    public function __construct(
                                    CatHardware $catHardware,
                                    CatSoftware $catSoftware,
                                    SoftwareModel $software,
                                    HardwareModel $hardware,
                                    UsuariosEmpresasModel $usuariosEmpresas,
                                    RecursosCompartidosModel $recursosCompartido,
                                    CatEmpresas $catEmpresas
                                )
                            {
                                $this->catHardware        = $catHardware;
                                $this->catSoftware        = $catSoftware;
                                $this->software           = $software;
                                $this->hardware           = $hardware;
                                $this->usuariosEmpresas   = $usuariosEmpresas;
                                $this->recursosCompartido = $recursosCompartido;
                                $this->catEmpresas = $catEmpresas;
                            }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $usuario = $this->usuariosEmpresas->where('id', $id)->with(['hardware', 'empresa'])->first();

        /**
         * Obtenemos el codigo de la foto de fondo
         */
        if ( $contains = Str::contains($usuario->empresa->dominio, ['renault', 'Renault']) )
        {
            $empresa = 1;
            $url_formato = file_get_contents(public_path('vendor/adminlte/dist/img/formato_resguardo_renault.jpg'));
        }
        else
        {
            $empresa = 0;
            $url_formato = file_get_contents(public_path('vendor/adminlte/dist/img/formato_resguardo.jpg'));
        }

        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('pdf.resguardo', compact('usuario', 'url_formato', 'empresa'))
                ->stream('resguardo_'.$id.'.pdf');

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
