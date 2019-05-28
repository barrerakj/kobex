<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//---------------------------------------------
//Rutas de Usuario
//---------------------------------------------

//Rutas para datos de usuario
$route['usuario/obtener'] = 'Usuario/obtener';
$route['usuario/actualizar'] = 'Usuario/actualizar';
$route['usuario/actualizar_pass'] = 'Usuario/actualizar_pass';
$route['usuario/listar'] = 'Usuario/listar';
$route['usuario/rol/(:any)'] = 'Usuario/rol/$1';
$route['usuario/desasociar/(:any)'] = 'Usuario/desasociar/$1';
$route['usuario/listar_sesiones'] = 'Usuario/sesiones';

//Rutas para vistas de opciones de usuario
$route['usuario/listado'] = 'Usuario/pagListado';
$route['usuario/sesiones'] = 'Usuario/pagSesiones';
$route['usuario/cuenta'] = 'Usuario/formCuenta';



//---------------------------------------------
//Rutas de Clientes
//---------------------------------------------

//Rutas para datos de clientes
$route['cliente/eliminar/(:any)'] = 'Cliente/eliminar/$1';
$route['cliente/guardar/(:any)'] = 'Cliente/guardar/$1';
$route['cliente/listar'] = 'Cliente/listar';

//Rutas para vistas de opciones de cliente
$route['cliente/nuevo'] = 'Cliente/formInfo';
$route['cliente/editar/(:any)'] = 'Cliente/formInfo/$1';
$route['cliente/listado'] = 'Cliente/pagListado';




//---------------------------------------------
//Rutas de Plantillas
//---------------------------------------------

//Rutas para datos de plantilla
$route['plant/guardar'] = 'Plantilla/guardar';
$route['plant/archivo'] = 'Plantilla/archivo';
$route['plant/listar'] = 'Plantilla/listar';
$route['plant/eliminar/(:any)'] = 'Plantilla/eliminar/$1';

//Rutas para vistas de opciones de plantilla
$route['plant/nueva'] = 'Plantilla/formNueva';
$route['plant/listado'] = 'Plantilla/pagListado';



//---------------------------------------------
//Rutas de Documentos
//---------------------------------------------

//Rutas para datos de documentos
$route['doc/obtener'] = 'Documento/obtener';
$route['doc/obtener/(:any)'] = 'Documento/obtener/$1';
$route['doc/guardar'] = 'Documento/guardar';
$route['doc/archivo'] = 'Documento/archivo';
$route['doc/actualizar_version'] = 'Documento/actualizar_version';
$route['doc/finalizar/(:any)'] = 'Documento/finalizar/$1';
$route['doc/reanudar/(:any)'] = 'Documento/reanudar/$1';
$route['doc/listar/(:any)'] = 'Documento/listar/$1';
$route['doc/versiones'] = 'Documento/versiones';
$route['doc/ultVersion/(:any)'] = 'Documento/ultVersion/$1';


//Rutas para vistas de opciones de documento
$route['doc/nuevo'] = 'Documento/formNuevo';
$route['doc/enproceso'] = 'Documento/pagEnProceso';
$route['doc/archivado'] = 'Documento/pagArchivado';
$route['doc/detalle/(:any)'] = 'Documento/pagDetalle/$1';
$route['doc/actualizar/(:any)'] = 'Documento/formActualizar/$1';




//---------------------------------------------
//Rutas de Casos
//---------------------------------------------


//Rutas para vistas de opciones de casos
$route['caso/nuevo'] = 'Caso/formNuevo';
$route['caso/enproceso'] = 'Caso/pagEnProceso';
$route['caso/archivado'] = 'Caso/pagArchivado';




//---------------------------------------------
//Rutas de Autenticacion
//---------------------------------------------

//Rutas para vistas de autenticacion
$route['aut/entrar'] = 'Autenticacion/formEntrar';
$route['aut/crear'] = 'Autenticacion/formCrear';
$route['aut/confirmar'] = 'Autenticacion/pagConfirmar';
$route['aut/recuperar'] = 'Autenticacion/formRecuperar';
$route['aut/salir'] = 'Autenticacion/pagSalir';

//Rutas para datos de autenticacion
$route['aut/verificar'] = 'Autenticacion/verificar';
$route['aut/nuevo'] = 'Usuario/nuevo';



//---------------------------------------------
//Rutas de Generales
//---------------------------------------------

//Ruta de inicio
$route['inicio'] = 'Inicio/pagInicio';
$route['ayuda'] = 'Inicio/pagAyuda';

//Rutas por defecto
$route['default_controller'] = 'Autenticacion/formEntrar';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
