@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
<br>
    <div class="row viewTickets">
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tickets</h3>
                </div>

                <div class="card-body">
                    <table id="tableTickets" class="table table-head-fixed text-nowrap table-striped table-sm">
                        <thead>
                            <tr >
                                <th class="text-center">Ver Detalle</th>
                                <th>ID</th>
                                <th>Enviado Por</th>
                                <th>Asunto</th>
                                <th>Fecha </th>
                                <th>Area</th>
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
                                    <td>{{ date('d/m/Y H:i:s', strtotime( $correo->created_at )); }} </td>
                                    <td>
                                        @if ( $correo->ticket()->exists() )
                                            {{ $correo->ticket()->first()->area()->first()->nombre }}
                                        @else
                                            Sin Area
                                        @endif

                                    </td>
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
                        <tfoot>
                            <tr >
                                <th class="text-center">Ver Detalle</th>
                                <th>ID</th>
                                <th>Enviado Por</th>
                                <th>Asunto</th>
                                <th>Fecha </th>
                                <th>Area</th>
                                <th>Asignado A</th>
                            </tr>
                        </tfoot>
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
<script src="https://cdn.datatables.net/plug-ins/1.13.1/sorting/date-euro.js"></script>
<script src="../../../vendor/tickets.js"></script>

@stop
