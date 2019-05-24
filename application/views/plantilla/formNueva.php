<div class="container">
    <h3>Nueva Plantilla</h3>
    <hr><br>
    <div class="form-group">
        <label>Nombre de la Plantilla</label>
        <input type="text" class="form-control" id="nombre" placeholder="Nombre">
    </div>
    <div class="form-group">
        <label>Descripción de la Plantilla</label>
        <textarea class="form-control" id="descripcion" rows="3" placeholder="Descripción"></textarea>
    </div>
    <form class="form-group" enctype="multipart/form-data">
        <label>Adjunte la plantilla</label>
        <input type="file" name="file" class="form-control-file" id="archivo">
    </form>
    <br>
    <button type="submit" class="btn btn-lg btn-secondary btnGuardar">Guardar</button>
    <hr>

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

</div>