<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?php echo base_url()."helpers/bootstrap/css/" ?>bootstrap.css" />
    
    <!-- General pourpose javascript for app -->
    <script src="<?php echo base_url()."helpers/js/general/" ?>general.js"></script>

    <!-- Custom css file for this view -->
    <?php 
      if(isset($css))
        echo '<link rel="stylesheet" href="'.base_url().'helpers/css/'.$css.'"/>';
    ?>
    <title>Kobex - Control de versión de documentos</title>
</head>
<body style="background: #FAFCFC;">

<style>
.dropdown-menu {
  background: #DDEDED;
}
</style>

<nav class="navbar navbar-expand-lg navbar-light fixed-top"  style="background: #DDEDED;">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <a class="navbar-brand" href="<?php echo base_url()."inicio" ?>">Kobex</a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url()."inicio" ?>">Inicio <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Casos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="<?php echo base_url()."caso/nuevo" ?>">Nuevo</a>
          <a class="dropdown-item" href="<?php echo base_url()."caso/enproceso" ?>">En Proceso</a>
          <a class="dropdown-item" href="<?php echo base_url()."caso/archivado" ?>">Archivados</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Clientes
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="<?php echo base_url()."cliente/nuevo" ?>">Nuevo</a>
          <a class="dropdown-item" href="<?php echo base_url()."cliente/listado" ?>">Listado</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Documentos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="<?php echo base_url()."doc/nuevo" ?>">Nuevo</a>
          <a class="dropdown-item" href="<?php echo base_url()."doc/enproceso" ?>">En Proceso</a>
          <a class="dropdown-item" href="<?php echo base_url()."doc/archivado" ?>">Archivados</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Plantillas
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="<?php echo base_url()."plant/nueva" ?>">Nueva</a>
          <a class="dropdown-item" href="<?php echo base_url()."plant/listado" ?>">Listado</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Usuarios
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="<?php echo base_url()."usuario/asociar" ?>">Asociar nueva cuenta</a>
          <a class="dropdown-item" href="<?php echo base_url()."usuario/listado" ?>">Usuarios Asociados</a>
          <a class="dropdown-item" href="<?php echo base_url()."usuario/sesiones" ?>">Registro</a>
        </div>
      </li>
    </ul>
    <div class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
    </div>
    <div class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: rgba(0, 0, 0, 0.5);">
        <?php echo $email; ?>
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <a class="dropdown-item" href="<?php echo base_url()."usuario/cuenta" ?>">Mi cuenta</a>
        <a class="dropdown-item" href="<?php echo base_url()."ayuda" ?>">Ayuda</a>
        <a id="CerrarSesion" class="dropdown-item" href="<?php echo base_url()."aut/salir" ?>">Cerrar Sesión</a>
      </div>
    </div>
  </div>
</nav>

<br><br><br><br>
