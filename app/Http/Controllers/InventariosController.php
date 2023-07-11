<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
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

class InventariosController extends Controller
{
    private $catHardware;
    private $catSoftware;
    private $catEmpresas;
    private $software;
    private $hardware;
    private $usuariosEmpresas;
    private $recursosCompartido;
    /**
     *
     */
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
        /**
         * Obtenemos todo el catalago de empresas
         */
        $empresas = $this->catEmpresas->get();
        /**
         * Obtenemos los usuarios activos
         */
        $usuarios = $this->usuariosEmpresas->where('activo', 1)->with('empresa')->get();

        return view('inventarios.index', compact('usuarios', 'empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /**
         * Obtenemos todo el catalago de empresas
         */
        $empresas = $this->catEmpresas->get();
        /**
         * Obtenemos todo el catalago de hardware
         */
        $hardware = $this->catHardware->get();
        /**
         * Obtenemos todo el catalago de software
         */
        $software = $this->catSoftware->get();

        return view('inventarios.create', compact('hardware', 'software', 'empresas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * Formulario datos usuario
         */
        $formUsuario = collect();
        /**
         * Formularios Hardware
         */
        $formCPU = collect();
        $formMonitor = collect();
        $formTeclado = collect();
        $formMouse = collect();
        $formDiadema = collect();
        $formRegulador = collect();
        $formTelefonoFijo = collect();
        $formTelefonoMovil = collect();
        $formMultifuncional = collect();
        $formTableta = collect();
        $formOtro = collect();
        /**
         * Formulario Software
         */
        $formSistemaOperativo = collect();
        $formOffice = collect();
        /**
         * Formulario Recursos Compartidos
         */
        $formRecursosCompartidos = collect();
        /**
         * Unserializamos los datos de los formularios
         */
        parse_str($request->formUsuario, $formUsuario);
        parse_str($request->formCPU, $formCPU);
        parse_str($request->formMonitor, $formMonitor);
        parse_str($request->formTeclado, $formTeclado);
        parse_str($request->formMouse, $formMouse);
        parse_str($request->formDiadema, $formDiadema);
        parse_str($request->formRegulador, $formRegulador);
        parse_str($request->formTelefonoFijo, $formTelefonoFijo);
        parse_str($request->formTelefonoMovil, $formTelefonoMovil);
        parse_str($request->formMultifuncional, $formMultifuncional);
        parse_str($request->formTableta, $formTableta);
        parse_str($request->formOtro, $formOtro);
        parse_str($request->formSistemaOperativo, $formSistemaOperativo);
        parse_str($request->formOffice, $formOffice);
        parse_str($request->formRecursosCompartidos, $formRecursosCompartidos);
        /**
         * Validamos los formularios necesarios
         */
        $this->validarFormulario(
            $formUsuario,
            //$formCPU,
            //$formMonitor,
            //$formTeclado,
            //$formRegulador,
            //$formTelefonoFijo,
            //$formTelefonoMovil,
            //$formMultifuncional,
            //$formSistemaOperativo,
            //$formOffice
        );

        $usuario = $this->usuariosEmpresas::create($formUsuario);
        $usuarioID = $usuario->id;


        $this->insertarDatos($formCPU, $usuarioID, 1);
        $this->insertarDatos($formMonitor, $usuarioID, 1);
        $this->insertarDatos($formTeclado, $usuarioID, 1);
        $this->insertarDatos($formMouse, $usuarioID, 1);
        $this->insertarDatos($formDiadema, $usuarioID, 1);
        $this->insertarDatos($formRegulador, $usuarioID, 1);
        $this->insertarDatos($formTelefonoFijo, $usuarioID, 1);
        $this->insertarDatos($formTelefonoMovil, $usuarioID, 1);
        $this->insertarDatos($formMultifuncional, $usuarioID, 1);
        $this->insertarDatos($formTableta, $usuarioID, 1);
        $this->insertarDatos($formOtro, $usuarioID, 1);
        $this->insertarDatos($formSistemaOperativo, $usuarioID, 2);
        $this->insertarDatos($formOffice, $usuarioID, 2);
        $this->insertarDatos($formRecursosCompartidos, $usuarioID, 3);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = $this->usuariosEmpresas->where('id', $id)->with(['hardware', 'software', 'recursoCompartido'])->first();

        return view('inventarios.show', compact('id', 'usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /**
         * Obtenemos todo el catalago de empresas
         */
        $empresas = $this->catEmpresas->get();
        /**
         * Obtenemos todo el catalago de hardware
         */
        $hardware = $this->catHardware->get();
        /**
         * Obtenemos todo el catalago de software
         */
        $software = $this->catSoftware->get();
        /**
         * Obtenemos el usuario a editar
         */
        $usuario = $this->usuariosEmpresas->where('id', $id)->with(['hardware', 'software'])->first();

        return view('inventarios.edit', compact('id', 'usuario','hardware', 'software', 'empresas'));
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
        /**
         * Formulario datos usuario
         */
        $formUsuario = collect();
        /**
         * Formularios Hardware
         */
        $formCPU = collect();
        $formMonitor = collect();
        $formTeclado = collect();
        $formMouse = collect();
        $formDiadema = collect();
        $formRegulador = collect();
        $formTelefonoFijo = collect();
        $formTelefonoMovil = collect();
        $formMultifuncional = collect();
        $formTableta = collect();
        $formOtro = collect();
        /**
         * Formulario Software
         */
        $formSistemaOperativo = collect();
        $formOffice = collect();
        /**
         * Formulario Recursos Compartidos
         */
        $formRecursosCompartidos = collect();
        /**
         * Unserializamos los datos de los formularios
         */
        parse_str($request->formUsuario, $formUsuario);
        parse_str($request->formCPU, $formCPU);
        parse_str($request->formMonitor, $formMonitor);
        parse_str($request->formTeclado, $formTeclado);
        parse_str($request->formMouse, $formMouse);
        parse_str($request->formDiadema, $formDiadema);
        parse_str($request->formRegulador, $formRegulador);
        parse_str($request->formTelefonoFijo, $formTelefonoFijo);
        parse_str($request->formTelefonoMovil, $formTelefonoMovil);
        parse_str($request->formMultifuncional, $formMultifuncional);
        parse_str($request->formTableta, $formTableta);
        parse_str($request->formOtro, $formOtro);
        parse_str($request->formSistemaOperativo, $formSistemaOperativo);
        parse_str($request->formOffice, $formOffice);
        parse_str($request->formRecursosCompartidos, $formRecursosCompartidos);
        /**
         * Validamos los formularios necesarios
         */
        $this->validarFormulario(
            $formUsuario
            //$formCPU,
            //$formMonitor,
            //$formTeclado,
            //$formRegulador,
            //$formTelefonoFijo,
            //$formTelefonoMovil,
            //$formMultifuncional,
            //$formSistemaOperativo,
            //$formOffice
        );
        /**
         * Formularios obligatorios y validados
         */
        $this->usuariosEmpresas::where('id', $formUsuario['id'])
        ->update($formUsuario);

        $this->actualizarDatos($formCPU, 1);
        $this->actualizarDatos($formMonitor, 1);
        $this->actualizarDatos($formTeclado, 1);
        $this->actualizarDatos($formMouse, 1);
        $this->actualizarDatos($formDiadema, 1);
        $this->actualizarDatos($formRegulador, 1);
        $this->actualizarDatos($formTelefonoFijo, 1);
        $this->actualizarDatos($formTelefonoMovil, 1);
        $this->actualizarDatos($formMultifuncional, 1);
        $this->actualizarDatos($formTableta, 1);
        $this->actualizarDatos($formOtro, 1);
        $this->actualizarDatos($formSistemaOperativo, 2);
        $this->actualizarDatos($formOffice, 2);
        $this->actualizarDatos($formRecursosCompartidos, 3);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->usuariosEmpresas::where('id', $id)
                                ->update(['activo' => 0]);
    }

    private function insertarDatos($form, $usuario, $tipo)
    {
        $form['usuario_empresa_id'] = $usuario;

        if ($tipo == 1)
        {
            if ( $form['marca'] != '' && $form['modelo'] != '' && $form['no_serie'] != '' )
            {
                $this->hardware::create($form);
            }
        }
        elseif( $tipo == 2 )
        {
            $this->software::create($form);
        }
        elseif( $tipo == 3 )
        {
            if ( $form['unidad'] != '' && $form['ruta'] != ''  )
            {
                $this->recursosCompartido::create($form);
            }
        }


    }

    private function actualizarDatos($form, $tipo)
    {
        if ($tipo == 1)
        {
            if ( $form['marca'] != '' && $form['modelo'] != '' && $form['no_serie'] != '' )
            {
                $this->hardware::where('id', $form['id'])
                                ->update($form);
            }
        }
        elseif( $tipo == 2 )
        {
            $this->software::where('id', $form['id'])
                            ->update($form);
        }
        elseif( $tipo == 3 )
        {
            if( isset( $form['id'] ) ){

                $this->recursosCompartido::where('id', $form['id'])
                ->update($form);
            }
        }
    }

    private function validarFormulario(
        $formUsuario
        //$formCPU,
        //$formMonitor,
        //$formTeclado,
        //$formRegulador,
        //$formTelefonoFijo,
        //$formTelefonoMovil,
        //$formMultifuncional,
        //$formSistemaOperativo,
        //$formOffice
    )
    {
        /**
         * Validar formUsuario
         **/
        Validator::validate($formUsuario, [
            'cat_empresa_id' => 'required',
            'titular' => 'required',
            'area' => 'required',
            'puesto' => 'required',
            'ucoip' => 'required',
            'ip' => 'required|ip',
            'extension' => 'required',
            'movil' => 'required',
        ],[
            'cat_empresa_id.required' => 'La empresa es obligatorio',
            'titular.required' => 'El Titular es obligatorio',
            'area.required' => 'El area es obligatorio',
            'puesto.required' => 'El puesto es obligatorio',
            'ucoip.required' => 'El UCoIP duro es obligatorio',
            'extension.required' => 'La extensión es obligatorio',
            'movil.required' => 'El movil es obligatorio',
        ]);
        /*
         * Validar formCPU
         *
        Validator::validate($formCPU, [
            'marca' => 'required',
            'modelo' => 'required',
            'no_serie' => 'required',
            'memoria_ram' => 'required',
            'disco_duro' => 'required',
            'procesador' => 'required',
        ],[
            'marca.required' => 'La marca del CPU es obligatorio',
            'modelo.required' => 'El modelo del CPU es obligatorio',
            'no_serie.required' => 'El número de serie del CPU es obligatorio',
            'memoria_ram.required' => 'La memoria RAM del CPU es obligatorio',
            'disco_duro.required' => 'El disco duro del CPU es obligatorio',
            'procesador.required' => 'El procesador del CPU es obligatorio',
        ]);
        /*
         * Validar formMonitor
         *
        Validator::validate($formMonitor, [
            'marca' => 'required',
            'modelo' => 'required',
            'no_serie' => 'required',
        ],[
            'marca.required' => 'La marca del Monitor es obligatorio',
            'modelo.required' => 'El modelo del Monitor es obligatorio',
            'no_serie.required' => 'El número de serie del Monitor es obligatorio',
        ]);
        /*
         * Validar formTeclado
         *
        Validator::validate($formTeclado, [
            'marca' => 'required',
            'modelo' => 'required',
            'no_serie' => 'required',
        ],[
            'marca.required' => 'La marca del Teclado es obligatorio',
            'modelo.required' => 'El modelo del Teclado es obligatorio',
            'no_serie.required' => 'El número de serie del Teclado es obligatorio',
        ]);
        /*
         * Validar formRegulador
         *
        Validator::validate($formRegulador, [
            'marca' => 'required',
            'modelo' => 'required',
            'no_serie' => 'required',
        ],[
            'marca.required' => 'La marca del Regulador es obligatorio',
            'modelo.required' => 'El modelo del Regulador es obligatorio',
            'no_serie.required' => 'El número de serie del Regulador es obligatorio',
        ]);
        /*
         * Validar formTelefonoFijo
         *
        Validator::validate($formTelefonoFijo, [
            'marca' => 'required',
            'modelo' => 'required',
            'no_serie' => 'required',
        ],[
            'marca.required' => 'La marca del Telefono Fijo es obligatorio',
            'modelo.required' => 'El modelo del Telefono Fijo es obligatorio',
            'no_serie.required' => 'El número de serie del Telefono Fijo es obligatorio',
        ]);
        /*
         * Validar formTelefonoMovil
         *
        Validator::validate($formTelefonoMovil, [
            'marca' => 'required',
            'modelo' => 'required',
            'no_serie' => 'required',
            'caracteristicas' => 'required',
        ],[
            'marca.required' => 'La marca del Telefono Movil es obligatorio',
            'modelo.required' => 'El modelo del Telefono Movil es obligatorio',
            'no_serie.required' => 'El número de serie del Telefono Movil es obligatorio',
            'caracteristicas.required' => 'El IMEI del Telefono Movil es obligatorio',
        ]);
        /*
         * Validar formMultifuncional
         *
        Validator::validate($formMultifuncional, [
            'marca' => 'required',
            'modelo' => 'required',
            'no_serie' => 'required',
        ],[
            'marca.required' => 'La marca del Multifincional es obligatorio',
            'modelo.required' => 'El modelo del Multifincional es obligatorio',
            'no_serie.required' => 'El número de serie del Multifincional es obligatorio',
        ]);
        /*
         * Validar formSistemaOperativo
         *
        Validator::validate($formSistemaOperativo, [
            'version' => 'required',
            'licencia' => 'required'
        ],[
            'version.required' => 'La Versión del Sistema Operativo es obligatorio',
            'licencia.required' => 'La licencia del Sistema Operativo es obligatorio',
        ]);
        /*
         * Validar formOffice
         *
        Validator::validate($formOffice, [
            'version' => 'required',
            'licencia' => 'required'
        ],[
            'version.required' => 'La Versión del Office es obligatorio',
            'licencia.required' => 'La licencia del Office es obligatorio',
        ]);
        */
    }

    function getfiltros($id) {
        $response['areas'] = $this->usuariosEmpresas
                            ->select('area')
                            ->distinct()
                            ->where('cat_empresa_id', $id)
                            ->orderBy('area')
                            ->get();

        $response['puestos'] = $this->usuariosEmpresas
                            ->select('puesto')
                            ->distinct()
                            ->where('cat_empresa_id', $id)
                            ->orderBy('puesto')
                            ->get();

        $response['ucoip'] = $this->usuariosEmpresas
                            ->select('ucoip')
                            ->distinct()
                            ->where('cat_empresa_id', $id)
                            ->orderBy('ucoip')
                            ->get();

        return response()
                        ->json([
                            'success' => true,
                            'message' => '',
                            'data'    => $response
                        ]);
    }
}
