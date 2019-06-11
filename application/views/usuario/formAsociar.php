<div class="container">
    <h3>Asociar una nueva cuenta</h3>
    <hr><br>
    <small class="form-text text-muted">
        *Antes de completar este formulario, asegurese de tener el código de cuenta de su colaborador.
    </small>
    <br>

    <div class="form-group">
        <label>Ingrese código de cuenta a asociar </label>
        <input type="text" class="form-control" id="code">
    </div>
    <br>
    <h5>Recuerde lo siguiente:</h5>
    <ul>
        <li>En el momento en que Ud. agrega a este colaborador, su nombre aparecerá como disponible para ser agregado a un caso o documento.</li>
        <li>Por defecto, el nuevo colaborador no tiene permisos ni acceso a ningun caso ni documento de su cuenta.</li>
        <li>En el menu Usuarios->Usuarios Asociados, Ud. puede remover esta cuenta de sus colaboradores en caso sea necesario.</li>
    </ul>
    <br>
    <button class="btn btn-primary" id="btnAsociar">Asociar</button>
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