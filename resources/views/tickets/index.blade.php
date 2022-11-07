@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
<br>
    <!--div class="row">
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Mis Tickets</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search" ></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Enviado Por</th>
                                <th>Asunto</th>
                                <th>Fecha </th>
                                <th>Mensaje</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($misCorreos as $correo)
                                <tr>
                                    <td>{{ $correo->id }}</td>
                                    <td>{{ $correo->enviado }}</td>
                                    <td>{{ $correo->asunto }}</td>
                                    <td>{{ $correo->created_at }}</td>
                                    <td>{{ $correo->mensaje }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div-->

    <div class="row viewTickets">
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tickets</h3>
                </div>

                <div class="card-body">
                    <table id="tableTickets" class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr >
                                <th class="text-center">Ver Detalle</th>
                                <th>ID</th>
                                <th>Enviado Por</th>
                                <th>Asunto</th>
                                <th>Fecha </th>
                                <th>Asignado A</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allCorreos as $correo)
                                <tr>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-info btn-sm verDetalle" data-id="{{ $correo->id }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </td>
                                    <td>{{ $correo->id }}</td>
                                    <td>{{ $correo->enviado }}</td>
                                    <td>{{ $correo->asunto }}</td>
                                    <td>{{ date('d-m-Y H:i:s', strtotime( $correo->created_at )); }} </td>
                                    <td>
                                        @if ( $correo->ticket()->exists() )
                                            {{ $correo->ticket()->first()->asignado_a()->first()->name }}
                                        @else
                                            Sin asignación
                                        @endif
                                    </td>
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
<script src="../../../vendor/tickets.js"></script>

@stop
