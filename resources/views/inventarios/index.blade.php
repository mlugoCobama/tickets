@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
<br>
    <div class="row viewInventarios">
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa-sharp fa-solid fa-warehouse"></i>
                        Inventarios
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-danger btn-sm deleteInventario" style="display:none"><i class="fas fa-trash-alt"></i> Elminar</button>
                        <button type="button" class="btn btn-warning btn-sm editInventario" style="display:none"><i class="fas fa-edit"></i> Editar</button>
                        <button type="button" class="btn btn-info btn-sm showInventario" style="display:none"><i class="fa-solid fa-eye"></i> Ver Detalle</button>
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalReporte"><i class="fa-solid fa-file-pdf"></i> Generar Reporte</button>
                        <button type="button" class="btn btn-primary btn-sm" id="newInventario" ><i class="fa-solid fa-circle-plus"></i> Nuevo</button>
                        <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="">

                    </div>
                </div>

                <div class="card-body table-responsive">
                    <table id="tableInventarios" class="table table-head-fixed text-nowrap table-striped table-sm">
                        <thead>
                            <tr >
                                <th>Empresa</th>
                                <th>Titular</th>
                                <th>Area</th>
                                <th>Puesto</th>
                                <th>Fecha de asignación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                                <tr data-id="{{$usuario->id}}">
                                    <td>{{ $usuario->empresa->nombre }}</td>
                                    <td>{{ $usuario->titular }}</td>
                                    <td>{{ $usuario->area }}</td>
                                    <td>{{ $usuario->puesto }}</td>
                                    <td>{{ date('d-m-Y H:i:s', strtotime( $usuario->created_at )) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr >
                                <th>Empresa</th>
                                <th>Titular</th>
                                <th>Area</th>
                                <th>Puesto</th>
                                <th>Fecha de asignación</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloModal"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body">
                        ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary float-left" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                    <button type="button" class="btn btn-sm btn-primary" id="action"><i class="fas fa-save"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL -->
    <div class="modal fade" tabindex="-1" id="modalReporte" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Generar Reporte</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col">
                        <label for="cat_empresa_id">Agencia *:</label>
                        <select name="cat_empresa_id" id="cat_empresa_id" class="form-control form-control-sm">
                            <option value="0">Selecciona una agencia</option>
                            @foreach ($empresas as $e)
                                <option value="{{$e->id}}">{{ $e->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="otrosFiltros" style="display: none">

                        <div class="col">
                            <label for="cat_area_id">Area :</label>
                            <select name="cat_area_id" id="cat_area_id" class="form-control form-control-sm">
                                <option value="">Selecciona una opción</option>
                                @foreach ($empresas as $e)
                                    <option value="{{$e->id}}">{{ $e->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="cat_puesto_id">Puesto :</label>
                            <select name="cat_puesto_id" id="cat_puesto_id" class="form-control form-control-sm">
                                <option value="">Selecciona una opción</option>
                                @foreach ($empresas as $e)
                                    <option value="{{$e->id}}">{{ $e->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="cat_ucoip_id">UcoIP :</label>
                            <select name="cat_ucoip_id" id="cat_ucoip_id" class="form-control form-control-sm">
                                <option value="">Selecciona una opción</option>
                                @foreach ($empresas as $e)
                                    <option value="{{$e->id}}">{{ $e->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" id="generarReporte">Generar</button>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')

    <link rel="stylesheet" href="../../../vendor/estilos.css">

@stop

@section('js')

<script src="https://kit.fontawesome.com/7fe718abe6.js" crossorigin="anonymous"></script>
<script src="../../../vendor/inventarios.js"></script>

@stop
