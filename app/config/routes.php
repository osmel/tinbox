<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/


///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////Disenos//////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////


$route['default_controller']	 		= 'fcalendario';
$route['404_override'] 					= '';

///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////fotocalendario//////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////


$route['validacion_comprimir']							= 'fotocalendario/validacion_comprimir';

$route['fotocalendario/(:any)']							= 'fotocalendario/index/$1';
$route['validar_nuevo_fotocalendario']				= 'fotocalendario/validar_nuevo_fotocalendario';

$route['guardar_lista']							= 'fotocalendario/guardar_lista';
$route['noguardar_lista']							= 'fotocalendario/noguardar_lista';


$route['leer_lista']							= 'fotocalendario/leer_lista';
$route['diseno_lista']							= 'fotocalendario/diseno_lista';

$route['calenda_activos']							= 'fotocalendario/calenda_activos';

$route['eliminar_diseno_completo']							= 'fotocalendario/eliminar_diseno_completo';


$route['disenos_completos']									= 'fotocalendario/disenos_completos';


///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////Imagen//////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////


$route['fotoimagen/(:any)']							= 'fotoimagen/index/$1';
$route['imagen_encontrada']							= 'fotoimagen/imagen_encontrada';
$route['guardar_imagen']							= 'fotoimagen/guardar_imagen';
$route['upload']									= 'fotoimagen/upload';
$route['buscarimagen']								= 'fotoimagen/buscarimagen';

$route['num_diseno']								= 'fotoimagen/num_diseno';

$route['revisar_imagenes']								= 'fotoimagen/revisar_imagenes';



///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////Revise//////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////


$route['fotorevise/(:any)']							= 'fotorevise/index/$1';

$route['eliminar_diseno_revise']							= 'fotorevise/eliminar_diseno_revise';






///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////Usuarios/////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////

//$route['default_controller']	 		= 'Main';
//$route['404_override'] 					= '';
$route['login']							= 'main/login';
$route['forgot']						= 'main/forgot';
$route['session']						= 'main/session';
$route['historicoaccesos']              = 'main/historicoaccesos';


$route['usuarios']						= 'main/listado_usuarios';
$route['procesando_usuarios']    		= 'main/procesando_usuarios';
$route['nuevo_usuario']                 = 'main/nuevo_usuario';
$route['validar_nuevo_usuario']         = 'main/validar_nuevo_usuario';
$route['eliminar_usuario/(:any)/(:any)']		= 'main/eliminar_usuario/$1/$2';
$route['validando_eliminar_usuario']    = 'main/validando_eliminar_usuario';
$route['actualizar_perfil']		         = 'main/actualizar_perfil';
$route['editar_usuario/(:any)']			= 'main/actualizar_perfil/$1';
$route['validacion_edicion_usuario']    = 'main/validacion_edicion_usuario';

$route['validar_login']					= 'main/validar_login';
$route['validar_recuperar_password']	= 'main/validar_recuperar_password';
$route['salir']							= 'main/logout';

//$route['procesando_home']    			= 'main/procesando_home';
//$route['procesando_inicio']    			= 'main/procesando_inicio';
//$route['cargar_dependencia']    		= 'main/cargar_dependencia';





///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
////////////////Listado de todos los catalogos/////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
$route['catalogos']						= 'catalogos/listado_catalogos';

//equipo
$route['equipos']					     = 'catalogos/listado_equipos';
$route['procesando_cat_equipos']    		= 'catalogos/procesando_cat_equipos';

$route['nuevo_equipo']                  = 'catalogos/nuevo_equipo';
$route['validar_nuevo_equipo']          = 'catalogos/validar_nuevo_equipo';

$route['editar_equipo/(:any)']			 = 'catalogos/editar_equipo/$1';
$route['validacion_edicion_equipo']     = 'catalogos/validacion_edicion_equipo';

$route['eliminar_equipo/(:any)/(:any)'] = 'catalogos/eliminar_equipo/$1/$2';
$route['validar_eliminar_equipo']    	 = 'catalogos/validar_eliminar_equipo';


//tecnico
$route['tecnicos']              = 'catalogos/listado_tecnicos';
$route['procesando_cat_tecnicos']        = 'catalogos/procesando_cat_tecnicos';

$route['nuevo_tecnico']                  = 'catalogos/nuevo_tecnico';
$route['validar_nuevo_tecnico']          = 'catalogos/validar_nuevo_tecnico';

$route['editar_tecnico/(:any)']       = 'catalogos/editar_tecnico/$1';
$route['validacion_edicion_tecnico']     = 'catalogos/validacion_edicion_tecnico';

$route['eliminar_tecnico/(:any)/(:any)'] = 'catalogos/eliminar_tecnico/$1/$2';
$route['validar_eliminar_tecnico']      = 'catalogos/validar_eliminar_tecnico';





//estatu
$route['estatus']					     = 'catalogos/listado_estatus';
$route['procesando_cat_estatus']        = 'catalogos/procesando_cat_estatus';

$route['nuevo_estatu']                  = 'catalogos/nuevo_estatu';
$route['validar_nuevo_estatu']          = 'catalogos/validar_nuevo_estatu';

$route['editar_estatu/(:any)']			 = 'catalogos/editar_estatu/$1';
$route['validacion_edicion_estatu']     = 'catalogos/validacion_edicion_estatu';

$route['eliminar_estatu/(:any)/(:any)'] = 'catalogos/eliminar_estatu/$1/$2';
$route['validar_eliminar_estatu']    	 = 'catalogos/validar_eliminar_estatu';





///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
//////////////////////////////////////Clientes/////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////

//clientes
$route['clientes']					         = 'clientes/listado_clientes';
$route['procesando_clientes']    		     = 'clientes/procesando_clientes';

$route['nuevo_cliente']                      = 'clientes/nuevo_cliente';
$route['validar_nuevo_cliente']              = 'clientes/validar_nuevo_cliente';


$route['detalles_cliente/(:any)']			 = 'clientes/detalles_cliente/$1';
$route['validacion_detalles_cliente']        = 'clientes/validacion_detalles_cliente';



$route['orden/(:any)']					 	= 'clientes/orden/$1';
$route['validar_nuevo_orden']              	= 'clientes/validar_nuevo_orden';
$route['validar_editar_orden']              	= 'clientes/validar_editar_orden';


$route['reingreso/(:any)']					= 'clientes/reingreso/$1';
$route['validar_reingreso']              	= 'clientes/validar_reingreso';


$route['cliente/(:any)']					 	= 'clientes/cliente/$1';
$route['validar_editar_cliente']              	= 'clientes/validar_editar_cliente';

$route['eliminar_cliente/(:any)/(:any)/(:any)'] 	= 'clientes/eliminar_cliente/$1/$2/$3';
$route['validar_eliminar_cliente'] 	= 'clientes/validar_eliminar_cliente';


///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
//////////////////////////////////////Historico de orden////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////



$route['procesando_historico_orden']    		     = 'clientes/procesando_historico_orden';

///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
//////////////////////////////////////Historico de orden////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////


$route['imprimir_reportes']    		     = 'informes/imprimir_reportes';
$route['imprimir_detalle']    		     = 'informes/imprimir_detalle';




/* End of file routes.php */
/* Location: ./application/config/routes.php */
