<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use PDF;
/**
 * Modelos
 */
use App\Models\UsuariosEmpresasModel;
class PDFResguardoController extends Controller
{
    private $usuariosEmpresas;

    public function __construct(
                                    UsuariosEmpresasModel $usuariosEmpresas
                                )
                            {
                                $this->usuariosEmpresas   = $usuariosEmpresas;
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
}
