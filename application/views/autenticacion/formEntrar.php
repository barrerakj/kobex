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
    <link href="<?php echo base_url()."helpers/css/autenticacion/" ?>formEntrar.css" rel="stylesheet">

    <!-- General pourpose javascript for this form -->
    <script src="<?php echo base_url()."helpers/js/" ?>jquery.js"></script>

    <!-- Custom javascript for this form -->
    <script src="<?php echo base_url()."helpers/js/autenticacion/" ?>formEntrar.js"></script>
  </head>

  <body class="text-center">
    <div class="form-signin">
      <img class="mb-4" src="../../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Bienvenido a Kobex</h1>

      <label for="email" class="sr-only">Correo Electrónico</label>
      <input type="email" id="email" class="form-control" placeholder="Correo Electrónico" autofocus>
      
      <label for="pass" class="sr-only">Contraseña</label>
      <input type="password" id="pass" class="form-control" placeholder="Contraseña">
      
      <button id="btnEntrar" class="btn btn-lg btn-primary btn-block" type="button">Entrar</button>
      <p class="mt-5 mb-3 text-muted">¿Olvido su contraseña? <a href="<?php echo base_url()."aut/recuperar" ?>">Haga click aqui</a></p>
      <p class="mb-3 text-muted"><a href="<?php echo base_url()."aut/crear" ?>">Crear una cuenta</a></p>
    </div>
  </body>
</html>