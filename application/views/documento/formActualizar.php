<div class="container">
    <h3>Actualizar versión de Documento</h3>
    <hr><br>
    <div class="infoClienteDocumento"></div>
    <hr><br>
    <h6><b>1. Detalle de última versión</b></h6>
    <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Usuario</th>
            <th scope="col">Fecha y Hora</th>
            <th scope="col">Descripción</th>
            </tr>
        </thead>
        <tbody class="tbody"></tbody>
    </table>
    <br><br>
    <h6><b>2. Información de la nueva versión</b></h6>
    <hr>
    <div class="form-group">
        <label>Agregue una descripción para la nueva versión del documento, explicando brevemente los cambios</label>
        <textarea class="form-control" id="descripcion" rows="3" placeholder="Escriba aqui la descripción"></textarea>
    </div>
    <br>
    <div class="form-group">
        <label>Adjunte la nueva versión de este documento</label>
        <input type="file" name="file" class="form-control-file" id="archivo">
    </div>
    <br>
    <button type="submit" class="btn btn-lg btn-secondary btnActualizar">Actualizar</button>
    <hr>
</div>

<div aria-live="polite" aria-atomic="true" style="min-height: 200px;">
    <div class="toast" style="position: absolute; top: 15%; right: 0;" data-delay="10000">
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