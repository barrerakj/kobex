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

  </head>

  <body class="text-center">
    <form class="form-signin">
      <img class="mb-4" src="../../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Recuperar Contraseña</h1>
      <h1 class="h6 mb-3 font-weight-normal text-muted">Ingrese el correo electrónico que uso para registrarse y enviaremos una clave temporal.</h1>
      <label for="inputEmail" class="sr-only">Correo Electrónico</label>
      <input type="email" id="inputEmail" class="form-control" placeholder="Correo Electrónico" required autofocus>
      <br><br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Recuperar</button>
    </form>
  </body>
</html>