<div class="container">
    <h3>Detalle de Documento</h3>
    <hr>
    <div class="infoClienteDocumento"></div>
    <div class="row">
        <div class="col-12 col-md-7">
            <table class="table table-hover scroll-y">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Fecha y Hora</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody class="tbody"></tbody>
            </table>
            <div class="row justify-content-between AccionesDocumento" style="margin-right: 0;"></div>
            <hr>
        </div>
        <div class="col-12 col-md-5 DocView"></div>
    </div>
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