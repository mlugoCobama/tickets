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
        width: 25%;
        float: right;

    }

</style>

<title>Inventario General</title>

<h1>Inventario General</h1>

<img src="{{'data:image/jpeg;base64,' . base64_encode($url_logo)}}" alt="">

<p> Empresa: {{$empresa->nombre}}</p>
<p> Fecha: {{ date('d-m-Y') }}</p>

<br>

<h2>Hardware</h2>

@foreach ($hardware as $h)

    <h3>{{ $h->tipo }}</h3>

    <table id="datosHardware" width="700px">
        <thead>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Número de Serie</th>
                <th>Caracteristicas</th>
                <th>Observaciones</th>
            </tr>
        </thead>
        <tbody>

            @if ( $inventarioHardware->where('cat_hardware_id', $h->id)->count() >0 )

                @foreach ($inventarioHardware->where('cat_hardware_id', $h->id) as $item)
                    <tr>
                        <td>{{ $item->marca }}</td>
                        <td>{{ $item->modelo }}</td>
                        <td>{{ $item->no_serie }}</td>
                        <td>{{ $item->caracteristicas }}</td>
                        <td>{{ $item->observaciones }}</td>
                    </tr>
                @endforeach

            @else

                <tr style="text-align: center">
                    <td colspan="5">Sin Información</td>
                </tr>

            @endif

        </tbody>
    </table>

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

