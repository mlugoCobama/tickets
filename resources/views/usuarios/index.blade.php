@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
<br>
    <div class="row viewUsuarios">
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Usuario</h3>
                </div>

                <div class="card-body">
                    <table id="tableUsuarios" class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr >
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Tipo </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $u)
                                <tr>
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
