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

    <!-- Custom styles for this form -->
    <style>
    /* Customize the label (the container) */
        .container-radio {
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 18px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        }

        /* Hide the browser's default radio button */
        .container-radio input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
        }

        /* Create a custom radio button */
        .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #eee;
        border-radius: 50%;
        }

        /* On mouse-over, add a grey background color */
        .container-radio:hover input ~ .checkmark {
        background-color: #ccc;
        }

        /* When the radio button is checked, add a blue background */
        .container-radio input:checked ~ .checkmark {
        background-color: #2196F3;
        }

        /* Create the indicator (the dot/circle - hidden when not checked) */
        .checkmark:after {
        content: "";
        position: absolute;
        display: none;
        }

        /* Show the indicator (dot/circle) when checked */
        .container-radio input:checked ~ .checkmark:after {
        display: block;
        }

        /* Style the indicator (dot/circle) */
        .container-radio .checkmark:after {
        top: 9px;
        left: 9px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: white;
        }
    </style>
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
            <p>Por favor seleccione el plan que este mas acorde a sus necesidades. Despues de seleccionar su plan, un colaborador de Kobex le contactará en un rango de 24 horas hábiles para ayudarle con su pago y activación de cuenta.</p>
            <div class="card-deck mb-3 text-center">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Gratis</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">$0</h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Prueba gratuita por 10 dias</li>
                            <li>Espacio para casos, documentos y clientes ilimitado</li>
                            <li>Asociación a 1 cuenta</li>
                            <li>Acceso al centro de ayuda</li>
                            <li>&nbsp</li>
                            <li>&nbsp</li>
                            <li>&nbsp</li>
                        </ul>
                        <label class="container-radio">
                            Plan Gratuito
                            <input type="radio" name="radio" id="plan_gratis" value="1">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Plan Básico</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">$9 <small class="text-muted">/ al mes</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Acceso 24/7 al sitio y todas sus funcionalidades</li>
                            <li>Espacio para casos, documentos y clientes ilimitado</li>
                            <li>Asociación a 1 cuenta</li>
                            <li>Ayuda por correo electrónico en horario laboral</li>
                            <li>Acceso al centro de ayuda</li>
                        </ul>
                        <label class="container-radio">
                            Plan Básico
                            <input type="radio" name="radio" id="basico" value="2">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Plan Premium</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">$15 <small class="text-muted">/ al mes</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Acceso 24/7 al sitio y todas sus funcionalidades</li>
                            <li>Espacio para casos, documentos y clientes ilimitado</li>
                            <li>Asociación a cuentas ilimitadas</li>
                            <li>Ayuda por teléfono y correo electrónico 24/7</li>
                            <li>Acceso al centro de ayuda</li>
                        </ul>
                        <label class="container-radio">
                            Plan Premium
                            <input type="radio" name="radio" id="premium" value="3">
                            <span class="checkmark"></span>
                        </label>
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