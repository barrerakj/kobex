<div class="container">
    <h3>Nuevo Documento</h3>
    <hr><br>
    <div class="form-row">
        <div class="form-group col-12">
            <label>Caso:</label>
            <input type="text" readonly class="form-control" value="<?php echo $nombre_caso; ?>">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-12">
            <label">Clientes:</label>
            <input type="text" readonly class="form-control" value="<?php echo $nombre_clientes; ?>">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-12">
            <label>Escoja su plantilla (de ser necesario)</label>
            <select class="form-control sltPlantillas"></select>
        </div>
    </div>
    <div id="descargar_plantilla" style="display: none;"></div>
    <hr>
    <div class="form-group">
        <label>Nombre del Documento</label>
        <input type="text" class="form-control" id="nombre">
    </div>
    <div class="form-group">
        <label>Proporcione una descripción breve y útil para poder identificar este documento con facilidad</label>
        <textarea class="form-control" id="descripcion" rows="3"></textarea>
    </div>
    <br>
    <div class="form-group">
        <label>Adjunte la primera versión de este documento</label>
        <input type="file" class="form-control-file" id="archivo">
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