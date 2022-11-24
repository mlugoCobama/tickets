<style>
    @page {
       font-size: 14px;
       font-family: Arial, Helvetica, sans-serif;
    }
    .page-break {
        page-break-after: always;
    }
    .cols {
        width: 100%;
        overflow: auto;
        position: absolute;
        left: 0;
        top: 0;
    }
    .cols div {
        flex: 1;
    }
    .col1 {
        float: left;
        width: 100%;
        clear: both;
    }

    .data-id_inventario {

        margin-bottom: 1px;
        margin-left: 620px;
        font-weight: bold;
        font-size: 16px;
    }
    .data-fecha {
        margin-top: -28px;
        margin-bottom: 1px;
        margin-left: 588px;
    }
    .data-empresa {
        margin-top: 14px;
        margin-bottom: 1px;
        margin-left: 140px;
    }
    .data-titular {
        margin-top: -16px;
        margin-bottom: 1px;
        margin-left: 140px;
    }
    .data-usuario {
        margin-top: -16px;
        margin-bottom: 1px;
        margin-left: 140px;
    }
    .data-usuario_as {
        margin-top: -16px;
        margin-bottom: 1px;
        margin-left: 180px;
    }
    .invoice-info-page{
        font-size: 10px;
        margin-top: 20px;
    }
    .row{
        width: 100%;
        height: 100px;
        overflow: auto;
        margin-top: 170px;
        margin-left: 20px;
    }
    .row div {
        flex: 1;
    }
    table#datosHardware{
       font-size: 12px;
       border: 2px solid;
       border-collapse: collapse;
    }
    table#datosHardware th, td {
        border: 2px solid #000;
    }
    .data-firma-titular {

        margin-bottom: 1px;
        margin-left: 500px;
    }

</style>
<img src="{{'data:image/jpeg;base64,' . base64_encode($url_formato)}}" alt="" width="100%" height="100%">
<div class="cols">
    <div class="col1">
        <div class="col data-id_inventario" style=" {{ $empresa == 1 ? 'margin-top: 120px;' : 'margin-top: 110px;'}} ">
            <p class="nombre">{{ $usuario->id }}</p>
        </div>
        <div class="col data-fecha">
            <p class="nombre">{{ date('d-m-Y', strtotime( $usuario->created_at )) }}</p>
        </div>
        <div class="col data-empresa">
            <p class="nombre">{{ $usuario->empresa->nombre }}</p>
        </div>
        <div class="col data-titular">
            <p class="nombre">{{ $usuario->titular }}</p>
        </div>
        <div class="col data-usuario">
            <p class="nombre">{{ $usuario->ucoip }}</p>
        </div>
        <div class="col data-usuario_as">
            <p class="nombre">{{ $usuario->usuario_as }}</p>
        </div>
        <div class="row invoice-info-page">

            <table id="datosHardware" width="650px">
                <thead>
                    <tr>
                        <th></th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Número de Serie</th>
                        <th>Caracteristicas</th>
                        <th>Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuario->hardware as $h)
                        <tr>
                            <td>{{$h->tipoHardware()->first()->tipo}}</td>
                            <td>{{$h->marca}}</td>
                            <td>{{$h->modelo}}</td>
                            <td>{{$h->no_serie}}</td>
                            <td>{{$h->caracteristicas}}</td>
                            <td>{{$h->observaciones}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col data-firma-titular" style=" {{ $empresa == 1 ? 'margin-top: 280px;' : 'margin-top: 310px;'}} ">
            <p class="nombre">{{ $usuario->titular }}</p>
        </div>
    </div>
</div>
