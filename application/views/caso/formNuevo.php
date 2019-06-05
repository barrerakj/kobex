<div class="container">
    <h3>Nuevo Caso</h3>
    <hr><br>
    <div class="form-group">
        <label>Nombre del Caso</label>
        <input type="text" class="form-control" id="nombre">
    </div>
    <div class="form-group">
        <label>Seleccione uno o varios Clientes</label>
        <select multiple class="form-control sltClientes" style="height: 200px;"></select>
    </div>
    <div class="form-group">
        <label>Seleccione a todos los colaboradores que estaran involucrados en el caso</label>
        <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Teléfono 1</th>
                <th scope="col">Permisos</th>
            </tr>
        </thead>
        <tbody class="tbody"></tbody>
    </table>
    </div>
    <br>
    <div class="form-group">
        <label>Proporcione una descripción breve y útil para poder identificar este caso con facilidad</label>
        <textarea class="form-control" id="descripcion" rows="3"></textarea>
    </div>
    <br>
    <button type="button" class="btn btn-lg btn-secondary btnGuardar">Guardar</button>
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