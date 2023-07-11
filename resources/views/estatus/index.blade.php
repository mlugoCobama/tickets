@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
<br>
    <div class="row viewEstatus">
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Estatus</h3>
                </div>

                <div class="card-body">
                    <table id="tableEstatus" class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr >
                                <th>ID</th>
                                <th>Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estatus as $e)
                                <tr>
                                    <td>{{ $e->id }}</td>
                                    <td>{{ $e->nombre }}</td>
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
<!--script src="../../../vendor/tickets.js"></!--script>

@stop
