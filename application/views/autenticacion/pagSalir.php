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

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url()."helpers/css/autenticacion/" ?>pagSalir.css" rel="stylesheet">

    <!-- General pourpose javascript for this form -->
    <script src="<?php echo base_url()."helpers/js/" ?>jquery.js"></script>

    <!-- Custom javascript for this form -->
    <script src="<?php echo base_url()."helpers/js/autenticacion/" ?>pagSalir.js"></script>
  </head>

  <body class="text-center">
    <div class="message">
      <h1 class="h3 mb-3 font-weight-normal">Gracias por usar Kobex</h1>

      La sesión ha finalizado correctamente. Haga click en el boton de abajo para entrar de nuevo.
      <hr>
      
      <a class="btn btn-lg btn-primary btn-block" href="<?php echo base_url()."aut/entrar" ?>">Autenticarme</a>
    </div>
  </body>
</html>