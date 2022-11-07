<div class="row">
    <div class="col">
        <div class="form-group" >
            <label for="tipo">Tipo *:</label>
            <select name="tipo" id="tipo" class="form-control form-control-sm">
                <option value="1" {{ $usuario->tipo == 1 ? 'selected':'' }}>Administrador</option>
                <option value="2" {{ $usuario->tipo == 2 ? 'selected':'' }}>Técnico</option>
            </select>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre *:</label>
            <input type="text" class="form-control form-control-sm" id="nombre" placeholder="Nombre " value="{{$usuario->name}}">
            @csrf
        </div>
        <div class="form-group tipo-punto-venta">
            <label for="correo">Correo Electronico *:</label>
            <input type="text" class="form-control form-control-sm" id="correo" placeholder="Correo Electronico" value="{{$usuario->email}}">
        </div>
        <div class="form-group tipo-punto-venta">
            <label for="password1">Password *:</label>
            <input type="password" class="form-control form-control-sm" id="password1" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="password2">Confirmar Password *:</label>
            <input type="password" class="form-control form-control-sm" id="password2" placeholder="Confirmar Password">
        </div>
    </div>
</div>
<div class="form-group">
    <small class="form-text text-muted"> <b>*Campos obligatorios.</b></small>
</div>
<div class="alert alert-danger print-error-msg" role="alert" style="display:none">
    <ul></ul>
</div>
