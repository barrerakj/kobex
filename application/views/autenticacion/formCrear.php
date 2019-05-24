<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Kobex - Control de versión de documentos</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo base_url()."helpers/bootstrap/css/" ?>bootstrap.css" />

    <!-- General pourpose javascript for this form -->
    <script src="<?php echo base_url()."helpers/js/" ?>jquery.js"></script>
    <script src="<?php echo base_url()."helpers/js/" ?>popper.js"></script>
    <script src="<?php echo base_url()."helpers/bootstrap/js/" ?>bootstrap.js"></script>

    <!-- Custom javascript for this form -->
    <script src="<?php echo base_url()."helpers/js/autenticacion/" ?>formCrear.js"></script>
  </head>

  <body>
    <div class="container">
        <form>
            <br><br>
            <h3>Crear una cuenta nueva</h3>
            <br><br>
            <h5>Información personal</h5>
            <hr>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Nombre</label>
                    <input type="text" class="form-control" id="nombre">
                </div>
                <div class="form-group col-md-6">
                    <label>Apelllido</label>
                    <input type="text" class="form-control" id="apellido">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Teléfono</label>
                    <input type="text" class="form-control" id="telefono">
                </div>
            </div>
            <div class="form-group">
                <label>Dirección</label>
                <input type="text" class="form-control" id="direccion" placeholder="Dirección, municipio y departamento">
            </div>
            <br><br>
            <h5>Información de acceso</h5>
            <hr>
            <div class="form-row">
                <div class="form-group  col-md-6">
                    <label>Correo Electrónico</label>
                    <input type="email" class="form-control" id="correo">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Contraseña</label>
                    <input type="password" class="form-control" id="pass1">
                </div>
                <div class="form-group col-md-6">
                    <label>Repita contraseña</label>
                    <input type="password" class="form-control" id="pass2">
                </div>
            </div>
            <br><br>
            <h5>Información de cuenta</h5>
            <hr>
            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-4">
                            <h6>Quiero crear una cuenta nueva</h6>
                        </div>
                        <div class="col-md-8">
                            <button type="button" class="btn btn-sm btn-outline-info btn-cuenta-nueva">Seleccionar plan</button>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="card cuenta-nueva" style="display: none;">
                <div class="card-body">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="radio" id="basico" value="option1">
                        <label class="form-check-label" for="inlineCheckbox1">Plan Básico</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="radio" id="premium" value="option2">
                        <label class="form-check-label" for="inlineCheckbox2">Plan Premium</label>
                    </div>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-5">
                            <h6>Quiero asociarme a una cuenta existente</h6>
                        </div>
                        <div class="col-md-7">
                            <button type="button" class="btn btn-sm btn-outline-info btn-cuenta-existente">Introducir código</button>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card cuenta-existente" style="display: none;">
                <div class="card-body">
                    <div class="form-group col-md-6">
                        <label>Introduzca el código de la cuenta</label>
                        <input type="text" class="form-control" id="codigo">
                    </div>
                </div>
            </div>
            <br><br>
            <h5>Otra información</h5>
            <hr>
            <div class="form-group">
                <div class="form-check">
                <input class="form-check-input" type="checkbox">
                <label class="form-check-label" for="gridCheck">
                    He leido y acepto los <a href="#">Términos y Condiciones</a>.
                </label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                <input class="form-check-input" type="checkbox">
                <label class="form-check-label" for="gridCheck">
                    Deseo recibir un correo electrónico semanal con sugerencias de uso y ayuda de Kobex.
                </label>
                </div>
            </div>
            <br>
            <button type="button" class="btn btn-primary btn-block btn-crear">Crear mi cuenta</button>
        </form>
        <br><br>
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
  </body>
</html>