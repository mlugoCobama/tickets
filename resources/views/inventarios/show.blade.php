<br>
<div class="col-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fa-sharp fa-solid fa-warehouse"></i>
                Inventario ID: {{$id}}
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-info btn-sm generarResguardo"><i class="fa-solid fa-file-contract"></i></i> Generar Resguardo</button>
                <button type="button" class="btn btn-primary btn-sm regresar"><i class="fa-solid fa-angles-left"></i> Regresar</button>
                <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="{{$id}}">

            </div>
        </div><!--.card-header-->
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <dl class="row">
                        <dt class="col-sm-3">Empresa</dt>
                        <dd class="col-sm-9">{{ $usuario->empresa()->first()->nombre }}</dd>
                    </dl>
                </div>
                <div class="col">
                    <dl class="row">
                        <dt class="col-sm-2">Titular</dt>
                        <dd class="col-sm-10">{{ $usuario->titular }}</dd>
                    </dl>
                </div>
                <div class="col">
                    <dl class="row">
                        <dt class="col-sm-2">Area</dt>
                        <dd class="col-sm-10">{{ $usuario->area }}</dd>
                    </dl>
                </div>
            </div><!--.row-->
            <div class="row">
                <div class="col">
                    <dl class="row">
                        <dt class="col-sm-3">Puesto</dt>
                        <dd class="col-sm-9">{{ $usuario->puesto }}</dd>
                    </dl>
                </div>
                <div class="col">
                    <dl class="row">
                        <dt class="col-sm-2">UCoIP</dt>
                        <dd class="col-sm-10">{{ $usuario->ucoip }}</dd>
                    </dl>
                </div>
                <div class="col">
                    <dl class="row">
                        <dt class="col-sm-4">Usuario Auto system</dt>
                        <dd class="col-sm-8">{{ $usuario->usuario_as }}</dd>
                    </dl>
                </div>
            </div><!--.row-->
            <div class="row">
                <div class="col">
                    <dl class="row">
                        <dt class="col-sm-2">IP</dt>
                        <dd class="col-sm-10">{{ $usuario->ip }}</dd>
                    </dl>
                </div>
                <div class="col">
                    <dl class="row">
                        <dt class="col-sm-3">Extension</dt>
                        <dd class="col-sm-9">{{ $usuario->extension }}</dd>
                    </dl>
                </div>
                <div class="col">
                    <dl class="row">
                        <dt class="col-sm-3">Movil</dt>
                        <dd class="col-sm-9">{{ $usuario->movil }}</dd>
                    </dl>
                </div>
            </div><!--.row-->
        </div><!--.card-body-->
    </div><!--.card-->

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fa-sharp fa-solid fa-warehouse"></i>
                Hardware
            </h3>
        </div><!--.card-header-->
        <div class="card-body">
            <table class="table table-striped table-sm">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Tipo</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Número de Serie</th>
                        <th scope="col">IMEI</th>
                        <th scope="col">Memoria RAM</th>
                        <th scope="col">Disco Duro</th>
                        <th scope="col">Procesador</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuario->hardware as $h)
                    <tr>
                        @if ($h->cat_hardware_id == 1)
                            <td>{{ $h->tipoHardware()->first()->tipo }}</td>
                            <td>{{ $h->marca }}</td>
                            <td>{{ $h->modelo }}</td>
                            <td>{{ $h->no_serie }}</td>
                            <td></td>
                            <td>{{ $h->memoria_ram }}</td>
                            <td>{{ $h->disco_duro }}</td>
                            <td>{{ $h->procesador }}</td>

                        @elseif ($h->cat_hardware_id == 8)
                            <td>{{ $h->tipoHardware()->first()->tipo }}</td>
                            <td>{{ $h->marca }}</td>
                            <td>{{ $h->modelo }}</td>
                            <td>{{ $h->no_serie }}</td>
                            <td>{{ $h->caracteristicas }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        @else

                            <td>{{ $h->tipoHardware()->first()->tipo }}</td>
                            <td>{{ $h->marca }}</td>
                            <td>{{ $h->modelo }}</td>
                            <td>{{ $h->no_serie }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!--.card-body-->
    </div><!--.card-->
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fa-sharp fa-solid fa-warehouse"></i>
                Software
            </h3>
        </div><!--.card-header-->
        <div class="card-body">
            <table class="table table-striped table-sm">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Tipo</th>
                        <th scope="col">Versión</th>
                        <th scope="col">Licencia</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuario->software as $s)
                    <tr>
                        <td>{{ $s->tipoSoftware()->first()->tipo }}</td>
                        <td>{{ $s->version }}</td>
                        <td>{{ $s->licencia }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!--.card-body-->
    </div><!--.card-->
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fa-sharp fa-solid fa-warehouse"></i>
                Recursos Compartidos
            </h3>
        </div><!--.card-header-->
        <div class="card-body">
            <table class="table table-striped table-sm">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Unidad</th>
                        <th scope="col">Ruta</th>
                        <th scope="col">Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuario->recursoCompartido as $s)
                    <tr>
                        <td>{{ $s->unidad }}</td>
                        <td>{{ $s->ruta }}</td>
                        <td>{{ $s->observaciones }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!--.card-body-->
    </div><!--.card-->
</div>
