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
                        <button type="button" class="btn btn-info btn-sm showInventario" style="display:none"><i class="fa-solid fa-eye"></i></i> Ver Detalle</button>
                        <button id="newInventario" type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-circle-plus"></i> Nuevo</button>
                        <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="">

                    </div>
                </div>

                <div class="card-body">
                    <table id="tableInventarios" class="table table-head-fixed text-nowrap">
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

@stop

@section('css')

    <link rel="stylesheet" href="../../../vendor/estilos.css">

@stop

@section('js')

<script src="https://kit.fontawesome.com/7fe718abe6.js" crossorigin="anonymous"></script>
<script src="../../../vendor/inventarios.js"></script>

@stop
