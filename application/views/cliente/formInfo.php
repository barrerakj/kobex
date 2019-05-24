<div class="container">
    <h3>Información de Cliente</h3>
    <hr><br>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Nombres</label>
            <?php if(isset($cliente)) { ?>
                <input type="text" class="form-control" id="nombre" value="<?php echo $cliente[0]['name']; ?>">
            <?php } else { ?>
                <input type="text" class="form-control" id="nombre">
            <?php } ?>
        </div>
        <div class="form-group col-md-6">
            <label>Apellidos</label>
            <?php if(isset($cliente)) { ?>
                <input type="text" class="form-control" id="apellido" value="<?php echo $cliente[0]['lastname']; ?>">
            <?php } else { ?>
                <input type="text" class="form-control" id="apellido">
            <?php } ?>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Teléfono 1</label>
            <?php if(isset($cliente)) { ?>
                <input type="text" class="form-control" id="telefono1" value="<?php echo $cliente[0]['phone1']; ?>">
            <?php } else { ?>
                <input type="text" class="form-control" id="telefono1">
            <?php } ?>
        </div>
        <div class="form-group col-md-6">
            <label>Télefono 2</label>
            <?php if(isset($cliente)) { ?>
                <input type="text" class="form-control" id="telefono2" value="<?php echo $cliente[0]['phone2']; ?>">
            <?php } else { ?>
                <input type="text" class="form-control" id="telefono2">
            <?php } ?>
        </div>
    </div>
    <div class="form-group">
        <label>Dirección</label>
        <?php if(isset($cliente)) { ?>
            <input type="text" class="form-control" id="direccion" value="<?php echo $cliente[0]['address']; ?>">
        <?php } else { ?>
            <input type="text" class="form-control" id="direccion">
        <?php } ?>
    </div>
    <div class="form-group">
        <label>Otros datos importantes</label>
        <?php if(isset($cliente)) { ?>
            <textarea class="form-control" rows="4" id="otros"> <?php echo $cliente[0]['more']; ?> </textarea>
        <?php } else { ?>
            <textarea class="form-control" rows="4" id="otros"></textarea>
        <?php } ?>
    </div>
    <br>
    <?php if(isset($cliente)) { ?>
        <button type="button" class="btn btn-lg btn-secondary btnGuardar" id="id" value="<?php echo $cliente[0]['idCliente']; ?>">Actualizar</button>
    <?php } else { ?>
        <button type="button" class="btn btn-lg btn-secondary btnGuardar" id="id" value="0">Guardar</button>
    <?php } ?>
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