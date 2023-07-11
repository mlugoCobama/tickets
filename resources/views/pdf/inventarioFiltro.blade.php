<style>
    @page {
       font-size: 14px;
       font-family: Arial, Helvetica, sans-serif;
    }
     table#datosHardware{
       font-size: 12px;
       border: 2px solid;
       border-collapse: collapse;
    }
    table#datosHardware th, td {
        border: 2px solid #000;
    }
    h2, h1 {
        display: table-caption;
        text-align: center;
    }

    img {
        width: 20%;
        float: right;
        margin-top: -35px;
    }

</style>

<title>Inventario General</title>

<h1>Inventario General</h1>

<img src="{{'data:image/jpeg;base64,' . base64_encode($url_logo)}}" alt="">

<p> Empresa: {{$empresa->nombre}}</p>
<p> Fecha: {{ date('d-m-Y') }}</p>

<br>
<br>

<table id="datosHardware" >
    <thead>
        <tr>
            <th>Area</th>
            <th width="30px">Puesto</th>
            <th>UcoIP</th>
            <th>Tipo</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Número Serie</th>
            <th>Memoria RAM</th>
            <th>Disco Duro</th>
            <th>Procesador</th>
            <th>Caracteristicas</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datosReporte as $item)
            <tr>
                <td>{{ $item->area }}</td>
                <td>{{ $item->puesto }}</td>
                <td>{{ $item->ucoip }}</td>
                <td>{{ $item->tipo }}</td>
                <td>{{ $item->marca }}</td>
                <td>{{ $item->modelo }}</td>
                <td>{{ $item->no_serie }}</td>
                <td>{{ $item->memoria_ram }}</td>
                <td>{{ $item->disco_duro }}</td>
                <td>{{ $item->procesador }}</td>
                <td>{{ $item->caracteristicas }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{--
<h2>Hardware</h2>

@foreach ($hardware as $h)

    @if ( $inventarioHardware->where('cat_hardware_id', $h->id)->count() >0 )

        <h3>{{ $h->tipo }}</h3>

        <table id="datosHardware" width="700px">
            <thead>
                <tr>
                    @if ($h->id == 1)
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Número de Serie</th>
                        <th>Memoria RAM</th>
                        <th>Disco Duro</th>
                        <th>Procesador</th>
                        <th>Caracteristicas</th>
                        <th>Observaciones</th>
                    @elseif ($h->id == 8)
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Número de Serie</th>
                        <th>IMEI</th>
                    @else
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Número de Serie</th>
                        <th>Caracteristicas</th>
                        <th>Observaciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($inventarioHardware->where('cat_hardware_id', $h->id) as $item)
                    <tr>

                        @if ( $h->id == 1 )
                            <td>{{ $item->marca }}</td>
                            <td>{{ $item->modelo }}</td>
                            <td>{{ $item->no_serie }}</td>
                            <td>{{ $item->memoria_ram }}</td>
                            <td>{{ $item->disco_duro }}</td>
                            <td>{{ $item->procesador }}</td>
                            <td>{{ $item->caracteristicas }}</td>
                            <td>{{ $item->observaciones }}</td>
                        @elseif ( $h->id == 8 )
                            <td>{{ $item->marca }}</td>
                            <td>{{ $item->modelo }}</td>
                            <td>{{ $item->no_serie }}</td>
                            <td>{{ $item->caracteristicas }}</td>
                        @else
                            <td>{{ $item->marca }}</td>
                            <td>{{ $item->modelo }}</td>
                            <td>{{ $item->no_serie }}</td>
                            <td>{{ $item->caracteristicas }}</td>
                            <td>{{ $item->observaciones }}</td>
                        @endif

                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endforeach

<h2>Software</h2>

@foreach ($software as $h)

    <h3>{{ $h->tipo }}</h3>

    <table id="datosHardware" width="700px">
        <thead>
            <tr>
                <th>Versión</th>
                <th>Licencia</th>
                <th>Observaciones</th>
            </tr>
        </thead>
        <tbody>
            @if ( $inventarioSoftware->where('cat_software_id', $h->id)->count() >0 )

                @foreach ($inventarioSoftware->where('cat_software_id', $h->id) as $item)
                    <tr>
                        <td>{{ $item->version }}</td>
                        <td>{{ $item->licencia }}</td>
                        <td>{{ $item->observaciones }}</td>
                    </tr>
                @endforeach

            @else
                <tr style="text-align: center">
                    <td colspan="3">Sin Información</td>
                </tr>

            @endif
        </tbody>
    </table>

@endforeach

<h2>Recursos Compartidos</h2>

<table id="datosHardware" width="700px">
    <thead>
        <tr>
            <th>Unidad</th>
            <th>Ruta</th>
            <th>Observaciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($inventarioRecursos as $item)
            <tr>
                <td>{{ $item->unidad }}</td>
                <td>{{ $item->ruta }}</td>
                <td>{{ $item->observaciones }}</td>
            </tr>
        @empty
            <tr style="text-align: center">
                <td colspan="3">Sin Información</td>
            </tr>
        @endforelse
    </tbody>
</table>
--}}
