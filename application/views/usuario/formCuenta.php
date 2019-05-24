<div class="container">
    <h3>Información de Cuenta</h3>
    <hr><br><br>
    <h5>Información de Autenticación</h5>
    <hr><br>
    <div class="form-group">
        <label>Correo Electrónico</label>
        <input type="text" class="form-control" id="correo" readonly>
    </div>
    <div class="actualizar-pass" style="display: none;">
        <br>
        <div class="form-group">
            <label>Escriba su contraseña actual</label>
            <input type="password" class="form-control" id="pass-actual">
        </div>
        <div class="form-group">
            <label>Escriba la nueva contraseña</label>
            <input type="password" class="form-control" id="pass-nuevo">
        </div>
        <div class="form-group">
            <label>Escriba otra vez la nueva contraseña</label>
            <input type="password" class="form-control" id="pass-nuevo1">
        </div>
        <button class="btn btn-lg btn-outline-secondary btnActualizarPass">Actualizar Contraseña</button>
    </div>
    <button class="btn btn-lg btn-outline-secondary btnMostrarPass">Actualizar Contraseña</button>
    <br><br><br><br>
    <h5>Información Personal</h5>
    <hr><br>
    <div class="form-group">
        <label>Nombres</label>
        <input type="text" class="form-control" id="nombre">
    </div>
    <div class="form-group">
        <label>Apellidos</label>
        <input type="text" class="form-control" id="apellido">
    </div>
    <div class="form-group">
        <label>Dirección</label>
        <input type="text" class="form-control" id="direccion">
    </div>
    <div class="form-group">
        <label>Teléfono</label>
        <input type="text" class="form-control" id="telefono">
    </div>
    <div class="form-group">
        <label>Información Adicional</label>
        <textarea class="form-control" id="descripcion" rows="3"></textarea>
    </div>
    <br><br>
    <h5>Información de Cuenta Kobex</h5>
    <hr><br>
    <div class="form-group">
        <label>Asociado a </label>
        <input type="text" class="form-control" id="asociado" readonly>
    </div>
    <div class="form-group">
        <label>Tipo de Plan</label>
        <input type="text" class="form-control" id="plan" readonly>
    </div>
    <div class="form-group">
        <label>Fecha de Vencimiento de Plan</label>
        <input type="text" class="form-control" id="fecha" readonly>
    </div>
    <hr><br>

    <button type="button" class="btn btn-lg btn-block btn-primary btnGuardar">Guardar</button>
</div>

<div aria-live="polite" aria-atomic="true" style="min-height: 200px;">
    <div class="toast" style="position: fixed; top: 15%; right: 0;" data-delay="10000">
        <div class="toast-header">
        <strong class="mr-auto">Kobex</strong>
        <small>Hace 1 segundo</small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="toast-body"></div>
    </div>
</div> 