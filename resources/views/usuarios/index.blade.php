@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
<br>
    <div class="row viewUsuarios">
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Usuario</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-danger btn-sm deleteUsuario" style="display:none"><i class="fas fa-trash-alt"></i> Elminar</button>
                        <button type="button" class="btn btn-warning btn-sm editUsuario" style="display:none"><i class="fas fa-edit"></i> Editar</button>
                        <button id="newUser" type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-circle-plus"></i> Nuevo</button>
                        <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="">

                    </div>
                </div>

                <div class="card-body">
                    <table id="tableUsuarios" class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr class="thead-light">
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Tipo </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $u)
                                <tr data-id="{{ $u->id }}">
                                    <td>{{ $u->id }}</td>
                                    <td>{{ $u->name }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td>{{  $u->tipo == 1 ? 'Administrador' : 'Técnico' }} </td>
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloModal">Usuario</h5>
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
    <!--link rel="stylesheet" href="/css/admin_custom.css"-->
@stop

@section('js')


<script src="https://kit.fontawesome.com/7fe718abe6.js" crossorigin="anonymous"></script>
<script src="../../../vendor/usuarios.js"></script>

@stop
