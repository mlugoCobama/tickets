<div class="col-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Ticket ID: <b> {{ $correo->first()->id }} </b> </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-primary btn-sm" id="return">
                    <i class="fa-solid fa-angles-left"></i>
                    Regresar
                </button>
            </div>
        </div>
        <div class="card-body " >
            <div class="row">
                <div class="col">
                    <p><b> Asunto: </b> {{$correo->first()->asunto}}</p>
                </div>

            </div>
            <div class="row">
                <div class="col">
                    <p><b>Enviado por:</b> {{ $correo->first()->enviado }}</p>
                </div>
                <div class="col">
                    <p><b>Fecha de apertura: </b> {{ date('d-m-Y H:i:s', strtotime( $correo->first()->created_at )); }} </p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p><b>Contenido del mensaje:</b></p>
                </div>

            </div>
            <div class="row">
                <div class="col">
                    {{ $correo->first()->mensaje_html }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Seguimiento</h3>
        </div>
        <div class="card-body " >
            <form id="save_tracing">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <label for="asignadoA" class="col-sm-3 col-form-label">Asignado a *:</label>
                            <div class="col-sm-9">
                                <select name="asignadoA" id="asignadoA" class="form-control form-control-sm" {{ $correo->first()->ticket()->exists() ? 'readonly disabled' : '' }} >
                                    <option value="">Elige una opción</option>

                                    @if ($correo->first()->ticket()->exists())
                                        @foreach ($tecnicos as $tecnico)
                                            <option value="{{ $tecnico->id }}" {{ $correo->first()->ticket()->first()->asignado_a == $tecnico->id ? 'selected' : '' }} >{{ $tecnico->name }}</option>
                                        @endforeach
                                    @else
                                        @foreach ($tecnicos as $tecnico)
                                            <option value="{{ $tecnico->id }}" >{{ $tecnico->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <p><b>Fecha de asignación: </b>

                            @if ( $correo->first()->ticket()->exists() )
                                {{ date('d-m-Y H:i:s', strtotime( $correo->first()->ticket()->first()->fecha_asignacion ));  }} </p>
                            @else
                                Sin fecha de asignacion
                            @endif
                            <input type="hidden" name="asignadoPor" id="asignadoPor" value="{{ \Auth::user()->id }}">
                            <input type="hidden" name="correoId" id="correoId" value="{{ $correo->first()->id }}">
                    </div>

                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <label for="area" class="col-sm-3 col-form-label">Area *:</label>
                            <div class="col-sm-9">
                                <select name="area" id="area" class="form-control form-control-sm" {{ $correo->first()->ticket()->exists() ? 'readonly disabled' : '' }}>
                                    <option value="">Elige una opción</option>
                                    @if ($correo->first()->ticket()->exists())
                                        @foreach ($areas as $area)
                                            <option value="{{$area->id}}" {{ $correo->first()->ticket()->first()->area_id == $area->id ? 'selected' : '' }} >{{ $area->nombre }}</option>
                                        @endforeach
                                    @else
                                        @foreach ($areas as $area)
                                            <option value="{{$area->id}}">{{ $area->nombre }}</option>
                                        @endforeach

                                    @endif

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3 row">
                            <label for="estatus" class="col-sm-3 col-form-label">Estatus *:</label>
                            <div class="col-sm-9">
                                <select name="estatus" id="estatus" class="form-control form-control-sm" >
                                    <option value="">Elige una opción</option>
                                    @if ($correo->first()->ticket()->exists())
                                        @foreach ($estatus as $e)
                                            <option value="{{$e->id}}" {{ $comentarios->first()->estatus_id == $e->id ? 'selected' : '' }} >{{ $e->nombre }}</option>
                                        @endforeach
                                    @else
                                        @foreach ($estatus as $e)
                                            <option value="{{$e->id}}"{{ $e->id == 1 ? 'selected' : ''  }}>{{$e->nombre}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <label for="estatus" class="col-sm-3 col-form-label">Reasignar Ticket:</label>
                            <div class="col-sm-9 form-check">
                                <input type="checkbox" class="form-check-input" id="reasingar" >
                                <label class="form-check-label" for="reasignar">Solicitar Reasignación</label>
                            </div>
                        </div>
                    </div>
                    <div class="col"></div>
                </div>
                <div class="row">
                    <div class="col">
                        <p><b>Comentarios *:</b></p>
                    </div>

                </div>
                <div class="row">
                    <div class="col">
                    <textarea class="form-control form-control-sm" name="comentario" id="comentario" cols="30" rows="5" required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <small class="form-text text-muted"> <b>*Campos obligatorios.</b></small>
                </div>
            </form>

            @if ( $correo->first()->ticket()->exists() )
                <div class="col-12">
                    <nav class="navbar" style="background-color: #e3f2fd;">
                        <div class="container-fluid">
                        <span class="navbar-brand mb-0 h1">
                            <i class="fa-solid fa-comment-dots"></i>
                            Historial de comentarios
                        </span>
                        </div>
                    </nav>

                    <div class="direct-chat-messages">

                        @foreach ($comentarios as $comentario)

                            <div class="direct-chat-msg">
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-left">
                                        <i class="fa-solid fa-user"></i>
                                        {{ $comentario->user()->first()->name }}
                                    </span>
                                    <span class="direct-chat-timestamp float-right">{{ date('d-m-Y H:i:s', strtotime( $comentario->created_at )); }}</span>
                                </div>


                                <div class="direct-chat-text">
                                    <p>Estatus: {{ $comentario->estatus()->first()->nombre }}</p>
                                    <p>{{ $comentario->comentario }}</p>
                                </div>

                            </div>

                        @endforeach

                    </div>
                </div>
            @endif

            <br>
            <div class="col-12 text-center">
                <button type="button" class="btn btn-danger btn-sm" id="return">
                    <i class="fa-solid fa-xmark"></i>
                    Cancelar
                </button>
                @if ( $correo->first()->ticket()->exists() )
                    <input type="hidden" name="ticket_id" id="ticket_id" value="{{ $correo->first()->ticket()->first()->id }}">
                    <button type="button" class="btn btn-primary btn-sm ml-3" id="update">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Actualizar
                    </button>
                @else
                    <button type="button" class="btn btn-primary btn-sm ml-3" id="save">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Guardar
                    </button>
                @endif
            </div>
            <br>
            <div class="alert alert-danger print-error-msg" role="alert" style="display:none">
                <ul></ul>
            </div>

        </div>
    </div>
</div>

