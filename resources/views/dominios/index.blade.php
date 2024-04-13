@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
<br>
    <div class="row viewDominios">
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Dominios</h3>
                </div>

                <div class="card-body">
                    <table id="tableDominios" class="table table-head-fixed text-nowrap table-sm">
                        <thead>
                            <tr >
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Costo</th>
                                <th>Fecha Contratación</th>
                                <th>Fecha Renovación</th>
                                <th>Tipo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dominios as $e)
                                <tr>
                                    <td>{{ $e->id }}</td>
                                    <td>{{ $e->nombre }}</td>
                                    <td> $ {{ $e->costo }}</td>
                                    <td>{{ date('d-m-Y', strtotime($e->fecha_contratacion)) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($e->fecha_renovacion)) }}</td>
                                    <td>
                                        @if ($e->tipo == 1)
                                            Dominio
                                        @else
                                            Certificado SSL
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
<!--script src="../../../vendor/dominios.js"></script-->

@stop
