<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/09/15
 Prop�sito:						Controlador para visualizar el manejo de los convenios de las brigadas
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2017 *******************************
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code



/** ********************************************************************************************************************** */
/** ********************************************************************************************************************** */
/** ********************************************************************************************************************** */
/** ********************************************************************************************************************** */
/** 								Define las constantes de la aplicaci�n propias                                         */
/** ********************************************************************************************************************** */
/** ********************************************************************************************************************** */
/** ********************************************************************************************************************** */
/** ********************************************************************************************************************** */
defined('CTE_SAVE_INFORMATION_PROGRAM')      OR define('CTE_SAVE_INFORMATION_PROGRAM', 'saveInformation'); // Validador para datatables
defined('CTE_PAIS_DEFECTO')      OR define('CTE_PAIS_DEFECTO', 170); // Validador para pais
defined('CTE_PAIS_DEFECTO_2')      OR define('CTE_PAIS_DEFECTO_2', 840); // Validador para pais

defined('CTE_LONGITUD_MINIMA')      OR define('CTE_LONGITUD_MINIMA',3); // Validador para pais
defined('CTE_LONGITUD_MINIMA_TEL')      OR define('CTE_LONGITUD_MINIMA_TEL',7); // Validador para pais
defined('CTE_LONGITUD_MAXIMA_TEL')      OR define('CTE_LONGITUD_MAXIMA_TEL',10); // Validador para pais
//Habilita envio de correo electr�nico
defined('CTE_CORREO_ELECTRONICO')      OR define ('CTE_CORREO_ELECTRONICO',true);//TODO esta variable se debe cambiar en el momento de entrar a producci�n
//Valida tipo de documento de identidad en la modificaci�n
defined('CTE_VALIDA_DOCUMENTO')      OR define ('CTE_VALIDA_DOCUMENTO',true);//TODO esta variable se debe cambiar en el momento de entrar a producci�n

defined('SERVER_HOUR')      OR define('SERVER_HOUR', 0); // Cambio para la hora del servidor
defined('SERVER_NUMBER')      OR define('SERVER_NUMBER', 999999999); // Cambio para la hora del servidor
defined('FORMAT_DATE')      OR define('FORMAT_DATE', false); //Para el manejo de las fechas


defined('CHAR_INIT')      OR define('CHAR_INIT', 7); // Cambio para la hora del servidor
defined('CHAR_END')      OR define('CHAR_END', 500); // Cambio para la hora del servidor


//Caracteres unicode
defined('LETRA_MIN_A')      OR define ('LETRA_MIN_A','\u00e1');
defined('LETRA_MIN_E')      OR define ('LETRA_MIN_E','\u00e9');
defined('LETRA_MIN_I')      OR define ('LETRA_MIN_I','\u00ed');
defined('LETRA_MIN_O')      OR define ('LETRA_MIN_O','\u00f3');
defined('LETRA_MIN_U')      OR define ('LETRA_MIN_U','\u00fa');
defined('LETRA_MAY_A')      OR define ('LETRA_MAY_A','\u00c1');
defined('LETRA_MAY_E')      OR define ('LETRA_MAY_E','\u00c9');
defined('LETRA_MAY_I')      OR define ('LETRA_MAY_I','\u00cd');
defined('LETRA_MAY_O')      OR define ('LETRA_MAY_O','\u00d3');
defined('LETRA_MAY_U')      OR define ('LETRA_MAY_U','\u00da');
defined('LETRA_MIN_N')      OR define ('LETRA_MIN_N','\u00f1');
defined('LETRA_MAY_N')      OR define ('LETRA_MAY_N','\u00d1');

//Redondeo a miles

defined('MILES_ROUND')      OR define('MILES_ROUND', true); //Se debe dejar en false si no se quiere redondeo

//Tama�o m�ximo para archivos
defined('FILE_MAX')         OR define ('FILE_MAX','3145728');
//Carpeta para archivos de ordenes
defined('ORDERS_FOLDER')         OR define ('ORDERS_FOLDER','assets/attachedOrders/');

//Carpeta para imagenes de cotizaciones
defined('STOKEPRICE_FOLDER')         OR define ('STOKEPRICE_FOLDER','assets/attachedStokePrice/');

//Constantes generales
defined('DEFAULT_PAGE')      OR define('DEFAULT_PAGE', 'MainApp/board'); //
defined('MAX_LIST')      OR define ('MAX_LIST',20);
defined('MAIN_MODULE')      OR define ('MAIN_MODULE',-1);
defined('VIEW_LIST_PERMISSION')      OR define ('VIEW_LIST_PERMISSION',10);
defined('VIEW_BUTTON_PERMISSION')      OR define ('VIEW_BUTTON_PERMISSION',11);
defined('CTE_VALOR_SI')      OR define('CTE_VALOR_SI', 1); //
defined('CTE_VALOR_NO')      OR define('CTE_VALOR_NO', 2); //
defined('ACTIVO_ESTADO')      OR define('ACTIVO_ESTADO', 'S'); //
defined('INACTIVO_ESTADO')      OR define('INACTIVO_ESTADO', 'N'); //
defined('CERRADO_ESTADO')      OR define('CERRADO_ESTADO', 'C'); //
defined('CTE_PROCESO_NORMAL')      OR define('CTE_PROCESO_NORMAL', '1'); //
defined('CTE_PROCESO_REPROCESO')      OR define('CTE_PROCESO_REPROCESO', '-1'); //
defined('CTE_NOSEGUIMIENTO')      OR define('CTE_NOSEGUIMIENTO', '19'); //
defined('IDIOMA_DEFECTO')      OR define('IDIOMA_DEFECTO', '1'); //
defined('PERIODO')      OR define('PERIODO', '6'); //
defined('MAX_NOTIFICACIONES')      OR define('MAX_NOTIFICACIONES', '4'); //
defined('MAX_NOTIFICACIONES_BOARD')      OR define('MAX_NOTIFICACIONES_BOARD', '600'); //

defined('BG_BOX_INTERFACE')      OR define('BG_BOX_INTERFACE', 'bg-dark'); //

defined('BG_BOX_INTERFACE1')      OR define('BG_BOX_INTERFACE1', 'bg-success'); //
defined('BG_BOX_INTERFACE2')      OR define('BG_BOX_INTERFACE2', 'bg-info'); //
defined('ID_TREE_FUNCTION')      OR define('ID_TREE_FUNCTION', '100'); //
defined('INTERCONSULTAS')      OR define('INTERCONSULTAS', '-1'); //
defined('NORMAL_PROCESS')      OR define('NORMAL_PROCESS', '1'); //
defined('BRIGADE_PROCESS')      OR define('BRIGADE_PROCESS', '2'); //
defined('PARTNER_PROCESS')      OR define('PARTNER_PROCESS', '3'); //
defined('OPEN_STATE')      OR define('OPEN_STATE', 'A'); //
defined('CLOSE_STATE')      OR define('CLOSE_STATE', 'C'); //
defined('CANCEL_STATE')      OR define('CANCEL_STATE', 'X'); //
defined('SUSPEND_STATE')      OR define('SUSPEND_STATE', 'S'); //
defined('OPC_ABI')      OR define('OPC_ABI', '-'); //

defined('ORDER_OBSERVATION_2')      OR define('ORDER_OBSERVATION_2', '2'); //
defined('ORDER_OBSERVATION_TEXT_2')      OR define('ORDER_OBSERVATION_TEXT_2', 'Se ha creado la orden, aunque a&aacute;n es necesario configurar el despiece'); //
defined('ORDER_OBSERVATION_1')      OR define('ORDER_OBSERVATION_1', '1'); //
defined('ORDER_OBSERVATION_TEXT_1')      OR define('ORDER_OBSERVATION_TEXT_1', 'Se ha creado la orden, Dicha orden no tiene elementos para configurar despieces'); //
defined('SUSPEND_OBSERVATION')      OR define('SUSPEND_OBSERVATION', '0'); //

defined('NORMAL_FLOW')      OR define('NORMAL_FLOW', '1'); //
defined('ANORMAL_FLOW')      OR define('ANORMAL_FLOW', '-1'); //


defined('ADMISION_STATE_ACTIVE')      OR define('ADMISION_STATE_ACTIVE', '1'); //
defined('ADMISION_STATE_INACTIVE')      OR define('ADMISION_STATE_INACTIVE', '0'); //

defined('CLASE_TIPOORDEN_1')      OR define('CLASE_TIPOORDEN_1', '1'); //
defined('CLASE_TIPOORDEN_2')      OR define('CLASE_TIPOORDEN_2', '2'); //
defined('CLASE_TIPOORDEN_3')      OR define('CLASE_TIPOORDEN_3', '3'); //
defined('CLASE_TIPOORDEN_4')      OR define('CLASE_TIPOORDEN_4', '4'); //
defined('MONTH_OK')      OR define('MONTH_OK', '10'); // Para habilitar el a�o siguiente para la generaci�n del calendario

defined('CTE_VALOR_PROCESO')      OR define('CTE_VALOR_PROCESO', 14); //
defined('CTE_VALOR_REPROCESO')      OR define('CTE_VALOR_REPROCESO', 15); //

// Relacionado con los estados
defined('TYPE_STATE_END_ERROR')      OR define('TYPE_STATE_END_ERROR', '4'); // Tipo de eestado finaliza incorrectamente (Cancelar)
defined('STATE_CANCEL')      OR define('STATE_CANCEL', '-2'); // Tipo de eestado finaliza incorrectamente (Cancelar)
defined('STATE_CORRECT')      OR define('STATE_CORRECT', '-3'); // fINALIZAR
defined('STATE_SUSPEND')      OR define('STATE_SUSPEND', '-1'); // sUSPENDER
defined('ORDER_STATE')      OR define('ORDER_STATE', '1'); //TODO Estado incial de ordenes

//Estados Hogar de paso
defined('SHELTER_FREE')      OR define('SHELTER_FREE', '1'); //
defined('SHELTER_RESERVE')      OR define('SHELTER_RESERVE', '2'); //
defined('SHELTER_FULL')      OR define('SHELTER_FULL', '3'); //
defined('SHELTER_MANT')      OR define('SHELTER_MANT', '4'); //
defined('BOOKING_INCREASE')      OR define('BOOKING_INCREASE', '0'); //84600

//Estados Patrocinios
defined('SPONSOR_WAIT_STATE')      OR define('SPONSOR_WAIT_STATE', 'P'); //
defined('SPONSOR_OK_STATE')      OR define('SPONSOR_OK_STATE', 'S'); //
defined('SPONSOR_NOT_STATE')      OR define('SPONSOR_NOT_STATE', 'N'); //

//Comodines Para correo electr�nico
defined('CTE_JOCKER_ORDER')      OR define('CTE_JOCKER_ORDER', '#ORDEN#'); //
defined('CTE_JOCKER_STATE')      OR define('CTE_JOCKER_STATE', '#ESTADO#'); //
defined('CTE_JOCKER_PATIENT')      OR define('CTE_JOCKER_PATIENT', '#PACIENTE#'); //

defined('DATE_FORMAT_EVOLUTION')      OR define('DATE_FORMAT_EVOLUTION', 'yyyy/mm/dd'); //
//Grupos
defined('GRUPO_NO_REQUERIDO')      OR define('GRUPO_NO_REQUERIDO', '28'); //
defined('GRUPO_ASOCIADO')      OR define('GRUPO_ASOCIADO', '27'); //
defined('GRUPO_OBLIGATORIO')      OR define('GRUPO_OBLIGATORIO', '26'); //

//Perfiles
defined('PROFILE_DEFAULT_STOKEPRICE')      OR define('PROFILE_DEFAULT_STOKEPRICE', '-1'); // EJecutivo
defined('PROFILE_DEFAULT_STOKEPRICE_REQUEST')      OR define('PROFILE_DEFAULT_STOKEPRICE_REQUEST', '12'); // EJecutivo
defined('PROFILE_DEFAULT_TECNIC')      OR define('PROFILE_DEFAULT_TECNIC', '8'); //

// No requiere para etados
defined('VALUE_STATE_NOT')      OR define('VALUE_STATE_NOT', '50'); //
//Entidades
defined('NEPS')      OR define('NEPS', '2689'); //
