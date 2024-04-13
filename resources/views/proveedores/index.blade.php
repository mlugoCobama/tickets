@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
<br>
    <div class="row viewProveedores">
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Proveedores</h3>
                </div>

                <div class="card-body">
                    <table id="tableProveedores" class="table table-head-fixed text-nowrap table-sm">
                        <thead>
                            <tr >
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Contacto</th>
                                <th>Telefono</th>
                                <th>Localidad</th>
                                <th>Condiciones</th>
                                <th>Servicios</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proveedores as $e)
                                <tr>
                                    <td>{{ $e->id }}</td>
                                    <td>{{ $e->nombre }}</td>
                                    <td>{{ $e->contacto }}</td>
                                    <td>{{ $e->telefono }}</td>
                                    <td>{{ $e->localidad }}</td>
                                    <td>{{ $e->condiciones }}</td>
                                    <td>{{ $e->servicios }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row viewDetail" style="display: none">
    </div>

@stop

@section('css')
    <!--link rel="stylesheet" href="/css/admin_custom.css"-->
@stop

@section('js')


<script src="https://kit.fontawesome.com/7fe718abe6.js" crossorigin="anonymous"></script>
<script src="../../../vendor/proveedores.js"></script>

@stop
