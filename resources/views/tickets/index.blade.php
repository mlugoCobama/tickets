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

                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" data-toggle="tab" href="#pendientes">
                                <i class="fa-solid fa-user-large-slash"></i>
                                Pendientes de Asignar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#asignados">
                                <i class="fa-solid fa-user-check"></i>
                                Asignados
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#resultos">
                                <i class="fa-solid fa-circle-check"></i>
                                Resueltos
                            </a>
                        </li>
                    </ul><!--ul class nav nav-tabs-->
                    <div class="tab-content">
                        <div id="pendientes" class="tab-pane fade active show">

                            <table id="" class="display table table-head-fixed text-nowrap table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th class="text-center">Ver Detalle</th>
                                        <th>ID</th>
                                        <th>Enviado Por</th>
                                        <th>Asunto</th>
                                        <th>Fecha </th>
                                        <th>Estatus</th>
                                        <th>Area</th>
                                        <th>Asignado A</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ticketsNoAsignado as $correo)
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
                                                    {{ $correo->ticket()->first()->comentarios()->first()->estatus()->first()->nombre }}
                                                @else
                                                    Sin Estatus
                                                @endif
                                            </td>
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
                                        <th>Estatus</th>
                                        <th>Area</th>
                                        <th>Asignado A</th>
                                    </tr>
                                </tfoot>
                            </table>

                        </div><!--pendientes-->
                        <div id="asignados" class="tab-pane fade">
                            <table id="" class="display table table-head-fixed text-nowrap table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th class="text-center">Ver Detalle</th>
                                        <th>ID</th>
                                        <th>Enviado Por</th>
                                        <th>Asunto</th>
                                        <th>Fecha </th>
                                        <th>Estatus</th>
                                        <th>Area</th>
                                        <th>Asignado A</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allCorreos as $correo)
                                        @if ($correo->ticket()->first()->status != 9)

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
                                                        {{ $correo->ticket()->first()->comentarios()->first()->estatus()->first()->nombre }}
                                                    @else
                                                        Sin Estatus
                                                    @endif
                                                </td>
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

                                        @endif
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr >
                                        <th class="text-center">Ver Detalle</th>
                                        <th>ID</th>
                                        <th>Enviado Por</th>
                                        <th>Asunto</th>
                                        <th>Fecha </th>
                                        <th>Estatus</th>
                                        <th>Area</th>
                                        <th>Asignado A</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div><!--#asigandos-->
                        <div id="resultos" class="tab-pane fade">
                            <table id="" class="display table table-head-fixed text-nowrap table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th class="text-center">Ver Detalle</th>
                                        <th>ID</th>
                                        <th>Enviado Por</th>
                                        <th>Asunto</th>
                                        <th>Fecha </th>
                                        <th>Estatus</th>
                                        <th>Area</th>
                                        <th>Asignado A</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allCorreos as $correo)
                                        @if ($correo->ticket()->first()->status == 9)

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
                                                        {{ $correo->ticket()->first()->comentarios()->first()->estatus()->first()->nombre }}
                                                    @else
                                                        Sin Estatus
                                                    @endif
                                                </td>
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

                                        @endif
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr >
                                        <th class="text-center">Ver Detalle</th>
                                        <th>ID</th>
                                        <th>Enviado Por</th>
                                        <th>Asunto</th>
                                        <th>Fecha </th>
                                        <th>Estatus</th>
                                        <th>Area</th>
                                        <th>Asignado A</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div><!--div#resultados-->
                    </div><!--div.tab-contenct-->

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
