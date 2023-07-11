<div class="container">
    <form id="formUsuario">
        <div class="row">
            <div class="col">
                <label for="cat_empresa_id">Empresa *:</label>
                <select name="cat_empresa_id" id="cat_empresa_id" class="form-control form-control-sm">
                    <option value="">Selecciona una empresa</option>
                    @foreach ($empresas as $e)
                        <option value="{{$e->id}}">{{ $e->nombre }}</option>
                   @endforeach
                </select>
            </div>
            <div class="col">
                <label for="titular">Titular *:</label>
                <input type="text" class="form-control form-control-sm" id="titular" name="titular" placeholder="Titular">
            </div>
            <div class="col">
                <label for="area">Area *:</label>
                <input type="text" class="form-control form-control-sm" id="area" name="area" placeholder="Area">
            </div>
            <div class="col">
                <label for="puesto">Puesto *:</label>
                <input type="text" class="form-control form-control-sm" id="puesto" name="puesto" placeholder="Puesto">
            </div>
            <div class="col">
                <label for="ucoip">UcoIP *:</label>
                <input type="text" class="form-control form-control-sm" id="ucoip" name="ucoip" placeholder="UcoIP ">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="usuario_as">Usuario Auto System:</label>
                <input type="text" class="form-control form-control-sm" id="usuario_as" name="usuario_as" placeholder="Usuario Auto System">
            </div>
            <div class="col">
                <label for="ip">IP *:</label>
                <input type="text" class="form-control form-control-sm" id="ip" name="ip" placeholder="IP">
            </div>
            <div class="col">
                <label for="extension">Extension *:</label>
                <input type="text" class="form-control form-control-sm" id="extension" name="extension" placeholder="Extension">
            </div>
            <div class="col">
                <label for="movil">Movil *:</label>
                <input type="text" class="form-control form-control-sm" id="movil" name="movil" placeholder="Movil">
                @csrf
            </div>
        </div>
    </form>
    <br>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" data-toggle="tab" href="#hardware">
                <i class="fas fa-server fa-xs"></i>
                Hardware
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#software">
                <i class="fab fa-microsoft"></i>
                Software
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#recursos_compartidos">
                <i class="fas fa-network-wired"></i>
                Recursos Compartidos
            </a>
        </li>
      </ul><!--ul class nav nav-tabs-->
      <div class="tab-content">
        <div id="hardware" class="tab-pane fade active show">
            <br>
            <div class="col">
                <div class="row">
                    <div class="col-3">
                        <div class="list-group">
                            @foreach ($hardware as $h)
                                <!--li class="list-group-item"-->
                                    <a  class="list-group-item list-group-item-action {{ $loop->first ? 'active':'' }}" aria-current="page" data-toggle="tab" href="#hardware_{{$h->id}}">
                                        <i class="{{ $h->icono }}"></i>
                                        {{ $h->tipo }}
                                    </a>
                                <!--/li-->
                            @endforeach
                        </div><!--div.list-group-->
                    </div><!--div.col-3-->
                    <div class="col-9">
                        <div class="tab-content">

                            @foreach ($hardware as $h)

                                <div id="hardware_{{$h->id}}" class="tab-pane fade {{ $loop->first ? 'active show':'' }}">

                                    @if ($h->id == 1)

                                        <div class="card">
                                            <div class="card-body">
                                                <form id="formCPU">
                                                    <div class="row">
                                                        <div class="col">
                                                            <input type="hidden" name="cat_hardware_id" id="cat_hardware_id" value="{{$h->id}}">
                                                            <label for="marca">Marca *:</label>
                                                            <input type="text" class="form-control form-control-sm" id="marca" name="marca" placeholder="Marca">
                                                        </div>
                                                        <div class="col">
                                                            <label for="modelo">Modelo *:</label>
                                                            <input type="text" class="form-control form-control-sm" id="modelo" name="modelo" placeholder="Modelo">
                                                        </div>
                                                    </div><!--div.row-->
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="no_serie">Número de Serie *:</label>
                                                            <input type="text" class="form-control form-control-sm" id="no_serie" name="no_serie" placeholder="Número de Serie">
                                                        </div>
                                                        <div class="col">
                                                            <label for="memoria_ram">Memoria Ram *:</label>
                                                            <input type="text" class="form-control form-control-sm" id="memoria_ram" name="memoria_ram" placeholder="Memoria Ram">
                                                        </div>
                                                    </div><!--div.row-->
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="disco_duro">Disco Duro *:</label>
                                                            <input type="text" class="form-control form-control-sm" id="disco_duro" name="disco_duro" placeholder="Disco Duro">
                                                        </div>
                                                        <div class="col">
                                                            <label for="procesador">Procesador *:</label>
                                                            <input type="text" class="form-control form-control-sm" id="procesador" name="procesador" placeholder="Procesador">
                                                        </div>
                                                    </div><!--div.row-->
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="caracteristicas">Caracteristicas :</label>
                                                            <input type="text" class="form-control form-control-sm" id="caracteristicas" name="caracteristicas" placeholder="Caracteristicas">
                                                        </div>
                                                        <div class="col">
                                                            <label for="observaciones">Observaciones :</label>
                                                            <input type="text" class="form-control form-control-sm" id="observaciones" name="observaciones" placeholder="Observaciones">
                                                        </div>
                                                    </div><!--div.row-->
                                                </form>
                                            </div><!--div.card-body-->
                                        </div><!--div.card-->

                                    @else

                                        <div class="card">
                                            <div class="card-body">
                                                <form id="form{{\Str::replace(' ', '',$h->tipo)}}">
                                                    <div class="col">
                                                        <input type="hidden" name="cat_hardware_id" id="cat_hardware_id" value="{{$h->id}}">
                                                        <label for="marca">Marca *:</label>
                                                        <input type="text" class="form-control form-control-sm" id="marca" name="marca" placeholder="Marca">
                                                    </div>
                                                    <div class="col">
                                                        <label for="modelo">Modelo *:</label>
                                                        <input type="text" class="form-control form-control-sm" id="modelo" name="modelo" placeholder="Modelo">
                                                    </div>
                                                    <div class="col">
                                                        <label for="no_serie">Número de Serie *:</label>
                                                        <input type="text" class="form-control form-control-sm" id="no_serie" name="no_serie" placeholder="Número de Serie">
                                                    </div>
                                                    <div class="col">
                                                        <label for="caracteristicas"> {{ $h->id == 8 ? 'IMEI' : 'Caracteristicas'}}  :</label>
                                                        <input type="text" class="form-control form-control-sm" id="caracteristicas" name="caracteristicas" placeholder="Caracteristicas">
                                                    </div>
                                                    <div class="col">
                                                        <label for="observaciones">Observaciones :</label>
                                                        <input type="text" class="form-control form-control-sm" id="observaciones" name="observaciones" placeholder="Observaciones">
                                                    </div>
                                                </form>
                                            </div><!--div.card-body-->
                                        </div><!--div.card-->

                                    @endif

                                </div>

                            @endforeach

                        </div><!--div.tab-contenct-->
                    </div><!--div.col-9-->
                </div><!--div.row-->
                <br>
            </div><!--div.col-->
        </div><!-- div #hardware -->
        <div id="software" class="tab-pane fade">
            <br>
            <div class="col">
                <div class="row">
                    <div class="col-3">
                        <div class="list-group">
                            @foreach ($software as $h)
                                <!--li class="list-group-item"-->
                                    <a  class="list-group-item list-group-item-action {{ $loop->first ? 'active':'' }}" aria-current="page" data-toggle="tab" href="#software_{{$h->id}}">
                                        <i class="{{ $h->icono }}"></i>
                                        {{ $h->tipo }}
                                    </a>
                                <!--/li-->
                            @endforeach
                        </div><!--div.list.group-->
                    </div><!--div.col-3-->
                    <div class="col-9">
                        <div class="tab-content">

                            @foreach ($software as $h)

                                <div id="software_{{$h->id}}" class="tab-pane fade {{ $loop->first ? 'active show':'' }}">
                                    <form id="form{{\Str::replace(' ', '',$h->tipo)}}">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="col">
                                                    <input type="hidden" name="cat_software_id" id="cat_software_id" value="{{$h->id}}">
                                                    <label for="version">Versión *:</label>
                                                    <input type="text" class="form-control form-control-sm" id="version" name="version" placeholder="Versión">
                                                </div>
                                                <div class="col">
                                                    <label for="licencia">Licencia *:</label>
                                                    <input type="text" class="form-control form-control-sm" id="licencia" name="licencia" placeholder="Licencia">
                                                </div>
                                                <div class="col">
                                                    <label for="observaciones">Observaciones :</label>
                                                    <input type="text" class="form-control form-control-sm" id="observaciones" name="observaciones" placeholder="Observaciones">
                                                </div>
                                            </div><!--div.card-body-->
                                        </div><!--div.card-->
                                    </form>
                                </div>

                            @endforeach

                        </div><!--div.tab-content-->
                    </div><!--div.col-9-->
                </div><!--div.row-->
            </div><!--div.col-->
        </div><!--div#software-->
        <div id="recursos_compartidos" class="tab-pane fade">
            <form id="formRecursosCompartidos">
                <div class="card">
                    <div class="card-body">
                        <div class="col">
                            <label for="unidad">Unidad :</label>
                            <input type="text" class="form-control form-control-sm" id="unidad" name="unidad" placeholder="Unidad">
                        </div>
                        <div class="col">
                            <label for="ruta">Ruta :</label>
                            <input type="text" class="form-control form-control-sm" id="ruta" name="ruta" placeholder="Ruta">
                        </div>
                        <div class="col">
                            <label for="observaciones">Observaciones :</label>
                            <input type="text" class="form-control form-control-sm" id="observaciones" name="observaciones" placeholder="Observaciones">
                        </div>
                    </div><!--div.card-body-->
                </div><!--div.card-->
            </form>
        </div><!--div#recursos_compartidos-->
    </div><!--div class tab-content-->
</div>
<div class="form-group">
    <small class="form-text text-muted"> <b>*Campos obligatorios.</b></small>
</div>
<div class="alert alert-danger print-error-msg" role="alert" style="display:none">
    <ul></ul>
</div>
