<?php

/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	06/02/2017
 Modificaci�n:                	2019/11/06
 Prop�sito:						Helper de la aplicaci�n.
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2017 *******************************
 */
if (!function_exists('showTittleAplication')) {

    function showTittleAplication()
    {
        /**
         * Pinto el nombre de la aplicaci�n
         */
        return "EVOLUTION";
    }
}

if (!function_exists('showPreloadMessage')) {

    function showPreloadMessage()
    {
        /**
         * Pinto el nombre de la aplicaci�n
         */
        return "Evolution CICIREC";
    }
}
if (!function_exists('pintaFooter')) {

    function showFooter($opcion)
    {
        /**
         * Pinto datos del footer de las vistas
         */
        $page = new FunctionsGeneral();
        if ($opcion == 'TEMPLATE') {
            return "Template by Metronic " . date('Y');
        } else if ($opcion == 'AUTHOR') {
            return "Centro Integral de Rehabilitaci&oacute;n de Colombia ";
        } else if ($opcion == 'VERSION') {
            return $page->FunctionsGeneral->getFieldFromTableNotId("ADM_VERSIONAPP", "NOMBRE", "ESTADO", ACTIVO_ESTADO);
        }
    }
}

if (!function_exists('showCommon')) {

    function showCommon($mensaje, $page, $ruta, $dataTable = null, $dateValue = null)
    {
        /**
         * Pinto datos del header de la p�gina Web
         */

        // Pinto el head del HTML
        // $page->load->view('common/head');
        pintaMensaje($page, $mensaje, $dataTable, $dateValue);
        // Pinto el preloader
        $page->load->view('common/preloader');
        // Pinto panel para las notificaciones+
        $page->load->view('common/notification');
        // Pinto panel de usuario
        // 1.4 Header del body (barra superior)
        $usuarioSession = $page->Users->getNombresUsuario($page->session->userdata('usuario'));
        $dato['NOMBRES'] = $usuarioSession->NOMBRES;
        $dato['APELLIDOS'] = $usuarioSession->APELLIDOS;
        $usuRolper = $page->FunctionsGeneral->getFieldFromTableNotId("ADM_USUROLPER", "ID_ROLPERFIL", "ID_USUARIO", $page->session->userdata('usuario'));
        $idPerfil = $page->FunctionsGeneral->getFieldFromTableNotId("ADM_ROLPERFIL", "ID_PERFIL", "ID", $usuRolper);

        $page->load->view('common/userProfile', $dato);
        // Pinto panel de usuario
        $menu = menuPrint($page->session->userdata('usuario'), $page->FunctionsAdmin, $ruta);
        if ($menu != null) {
            $detalleMenu['menu'] = $menu;
        } else {
            $detalleMenu['menu'] = null;
        }
        $page->load->view('common/menu', $detalleMenu);
        // Pinto migas de pan
        $return = $page->FunctionsAdmin->returnRouteActual($ruta);
        $route['route'] = $return[0];
        $route['programa'] = $return[1];
        $page->load->view('common/breadCrumb', $route);
    }
}

if (!function_exists('showCommonEnds')) {

    function showCommonEnds($page, $ruta, $dataTable = null)
    {
        /**
         * Pinto datos del footer de las vistas
         */

        // Pinto el registro de javascript
        $page->load->view('common/footer');
        // Pinto el registro de javascript
        $page->load->view('common/scriptJS');
    }
}

// si no existe la funci�n invierte_date_time la creamos
if (!function_exists('menuPrint')) {

    function menuPrint($usuario, $modelo, $ruta = null)
    {
        $menu = $modelo->selectModulesUser($usuario, '');
        $detalleMenu = array();
        $tempo = '';
        if ($menu != null) {
            foreach ($menu as $value) {
                if ($value->ID_TIPOMOD == 1) {
                    // Men� �nico
                    if ($ruta == $value->PAGINA) {
                        $active = "active";
                        $open = "open";
                        $selected = "selected";
                    } else {
                        $active = "";
                        $open = "";
                        $selected = "";
                    }
                    $tempo .= "
                    		<li class=\"" . $active . "\">
                    			<a class=\" waves-effect waves-dark $active\"
                    					href=\"" . base_url() . $value->PAGINA . "\">
                    					<i class=\"" . $value->CLASE . "\"></i>
	                    					<span class=\"hide-menu\">$value->NOMBRE</span>
	                    					</a>
	
	                    					</li>
	
	                    					";
                    // $tempo .=base_url();
                } else {
                    // Multi nivel
                    $secundario = $modelo->selectSubModulesUser($usuario, $value->ID, $ruta);
                    // Men� �nico
                    if ($secundario[0] > 0) {
                        $active = "active";
                        $open = "open";
                        $selected = "selected";
                    } else {
                        $active = "";
                        $open = "";
                        $selected = "";
                    }

                    $tempo .= "
                    		<li class=\"" . $active . "\">
                    			<a class=\"has-arrow waves-effect waves-dark\"
                    					href=\"javascript:void(0)\"
                    					aria-expanded=\"false\">
                    					<i class=\"" . $value->CLASE . "\"></i>
	                    					<span class=\"hide-menu\">$value->NOMBRE</span>
	                    					</a>
	                    					<ul aria-expanded=\"false\" class=\"collapse\">
	                    					" . $secundario[1] . "
                                </ul>
                            </li>
	
                                        					";
                }
            }
        }

        return $tempo;
    }
}

if (!function_exists('validLabelStateContact')) {

    function validLabelStateContact($id)
    {
        /**
         * Valido el tiempo para las reservas tipo d�a
         */
        return "label label-sm label-" . $id;
    }
}
if (!function_exists('arreglaFechas')) {

    function arreglaFechas($string)
    {
        /**
         * Recibe una cadena con las fechas iniciales y finales y las separa para poder ser trabajadas dentro de la aplicaci�n
         */
        $fechas = explode('-', $string);
        $fechas[0] = trim($fechas[0]);
        $fechas[1] = trim($fechas[1]);
        return $fechas;
    }
}
if (!function_exists('pintaMensaje')) {

    function pintaMensaje($page, $clasificacion, $dataTable = null, $dateValue = null)
    {
        /**
         * Recibe una p�gina (Controlador) y una clasificaci�n para pintar un mensaje de acuerdo a esta
         */
        $datos = $page->FunctionsAdmin->selectValoresMensajeAplicacion($clasificacion, 1);
        if ($datos != null) {
            $mensaje = $datos[0]->MENSAJE;
            if ($page->session->userdata('id') != '0') {
                $mensaje .= " " . $page->session->userdata('id');
            } else {
                $mensaje .= " ";
            }

            $sweetAlert['titulo'] = $datos[0]->TITULO;
            $sweetAlert['mensaje'] = $mensaje;
            $sweetAlert['clase'] = $datos[0]->CLASE;
            // Reinicio el valor de la variable de sesi�n
            $page->session->set_userdata('auxiliar', null);
            $page->session->set_userdata('id', 0);
            // Pinto la pantalla respectiva
            // $page->load->view('common/headSweetAlert',$gritter);
            $sweetAlert['validador'] = 1;
        } else {
            $sweetAlert['titulo'] = null;
            $sweetAlert['mensaje'] = null;
            $sweetAlert['clase'] = null;
            $sweetAlert['validador'] = null;
        }
        $sweetAlert['idTabla'] = $dataTable;
        $sweetAlert['dateValue'] = $dateValue;
        $page->load->view('common/head', $sweetAlert);
    }
}

if (!function_exists('intervaloTiempo')) {

    function intervaloTiempo($init, $finish, $divide)
    {
        /*
         * segundos minuto = 60
         * segundos hora = 3600
         * segundos d�a = 86400
         * segundos mes = 2592000
         * segundos a�o = 31104000
         */

        // formateamos las fechas a segundos tipo 1374998435
        $diferencia = strtotime($finish) - strtotime($init);
        $tiempo = floor($diferencia / $divide);



        /* echo "Cuando llega la informacion Final: ",$finish," Inicio: ",$init."<br>";
        
        $finish=defineFormatoFecha($finish, FORMAT_DATE);
        $init=defineFormatoFecha($init, FORMAT_DATE);*/


        /*
        echo " Final: ",$finish," Inicio: ",$init."<br>";
        echo "<br>----".defineFormatoFecha($finish, FORMAT_DATE)." ".defineFormatoFecha($init, FORMAT_DATE)."---<br>";
        echo "tiempo: ".$tiempo,"\tDivide: ".$divide," \tDiferencia: ".$diferencia," \tFinal: ",strtotime($finish)," \tInicio: ",strtotime($init)."<br>";
        */
        /*
        $finish='2018/06/02';
        $init='2017/06/01';
        
        // formateamos las fechas a segundos tipo 1374998435
        $diferencia = strtotime($finish) - strtotime($init);
        $tiempo = floor($diferencia / $divide);
        
        echo " Final: ",$finish," Inicio: ",$init."<br>";
        echo "<br>----".defineFormatoFecha($finish, FORMAT_DATE)." ".defineFormatoFecha($init, FORMAT_DATE)."---<br>";
        echo "tiempo: ".$tiempo,"\tDivide: ".$divide," \tDiferencia: ".$diferencia," \tFinal: ",strtotime($finish)," \tInicio: ",strtotime($init)."<br>";
        */

        return $tiempo;
    }
}

if (!function_exists('sumaTiempo')) {

    function sumaTiempo($init, $aumento)
    {
        /*
         * segundos minuto = 60
         * segundos hora = 3600
         * segundos d�a = 86400
         * segundos mes = 2592000
         * segundos a�o = 31104000
         */
        // formateamos las fechas a segundos tipo 1374998435

        // Paso la fecha de comienzo a timestamp
        $tiempo = strtotime($init);
        // Paso los dias a segundos
        $sumar = $aumento * 86400;
        return date("Y/m/d", $tiempo + $sumar);;
    }
}
if (!function_exists('obtieneArrayFechas')) {

    function obtieneArrayFechas($fecha, $tamano)
    {
        /**
         * Obtiene un array de fechas de acurdo al tama�o $tamano
         */
        // Paso la fecha de comienzo a timestamp
        // Tiempo actual
        $tiempo = strtotime($fecha);
        $j = 0;
        for ($i = $tamano; $i >= 0; $i--) {
            $sumar = $i * 86400;
            $array[$j] = date("d/m/Y", $tiempo - $sumar);
            $j++;
        }
        return $array;
        // Paso los dias a segundos
    }
}

if (!function_exists('obtieneCantidadRegistrosFechasEnTabla')) {

    function obtieneCantidadRegistrosFechasEnTabla($fechas, $tabla, $campoAdicinal = null, $valorAdicinal = null, $campoAdicinal2 = null, $valorAdicinal2 = null)
    {
        $dato = new FunctionsGeneral();
        for ($i = 0; $i < count($fechas); $i++) {
            $min = $fechas[$i] . " 00:00:00";
            $max = $fechas[$i] . " 23:59:59";
            $array[$i] = $dato->getQuantityFieldFromTable($tabla, "FCREA >=", $min, "FCREA <=", $max, $campoAdicinal, $valorAdicinal, $campoAdicinal2, $valorAdicinal2);
            // echo $min." ".$max." ".$array[$i]."<br>";
        }
        return $array;
    }
}

if (!function_exists('devuelveDatoListaPantalla')) {

    function devuelveDatoListaPantalla($id)
    {
        $dato = new FunctionsGeneral();
        return $dato->getFieldFromTable("ADM_DETLISTA", 'NOMBRE', $id);
    }
}

if (!function_exists('devuelveDatoListaTablaPantalla')) {

    function devuelveDatoListaTablaPantalla($tabla, $campo, $id)
    {
        $dato = new FunctionsGeneral();
        return $dato->getFieldFromTable($tabla, $campo, $id);
    }
}

if (!function_exists('devuelveDatoValorListaPantalla')) {

    function devuelveDatoValorListaPantalla($id)
    {
        $dato = new FunctionsGeneral();
        return $dato->getFieldFromTable("ADM_DETLISTA", 'VALOR', $id);
    }
}

if (!function_exists('devuelveNombreUsuario')) {

    function devuelveNombreUsuario($id)
    {
        $dato = new FunctionsGeneral();
        if ($id != '') {
            return $dato->getFieldFromTable("ADM_USUARIO", 'NOMBRES', $id) . " " . $dato->getFieldFromTable("ADM_USUARIO", 'APELLIDOS', $id);
        } else {
            return "";
        }
    }
}

if (!function_exists('traslateIdToEsalud')) {

    function traslateIdToEsalud($id)
    {
        $dato = new FunctionsGeneral();
        if ($id == '3') {
            return "CC";
        } else if ($id == '4') {
            return "CE";
        } else if ($id == '5') {
            return "PA";
        } else if ($id == '34') {
            return "RC";
        } else if ($id == '35') {
            return "TI";
        } else if ($id == '36') {
            return "NUIP";
        }
    }
}

if (!function_exists('validaEstadosGenerales')) {

    function validaEstadosGenerales($valor, $opcion)
    {
        /**
         * Obtengo el nombre y el color de la etiqueta de acuerdo al estado que se tenga definido
         */
        if ($opcion == 'CLASE') {
            if ($valor == 'S') {
                return 'label label-sm label-success';
            } else if ($valor == 'N') {
                return 'label label-sm label-danger';
            } else if ($valor == 'I') {
                return 'label label-sm label-info';
            }
        } else if ($opcion == 'NOMBRE') {

            if ($valor == 'S') {
                return 'Activo';
            } else if ($valor == 'N') {
                return 'Inactivo';
            } else if ($valor == 'I') {
                return 'Ingreso no habilitado';
            }
            return $valor;
        }
    }
}

if (!function_exists('validaComodin')) {

    function validaComodin($valor, $opcion)
    {
        /**
         * Obtengo el valor cuando es comodin
         */
        if ($opcion == 'CLASE') {
            if ($valor == CTE_VALOR_SI) {
                return 'label label-sm label-info';
            }
        } else if ($opcion == 'NOMBRE') {
            if ($valor == CTE_VALOR_SI) {
                return '<i class="fa fa-free-code-camp fa-2x"> </i>';
            } else {
                $valor = '';
            }
            return $valor;
        }
    }
}

if (!function_exists('cadenaAleatoria')) {

    function cadenaAleatoria($id)
    {
        /**
         * Genera una cadena aleatoria de acuerdo a los parametros ingresados en la funci�n
         */
        $dato = new FunctionsGeneral();
        $mayuscula = $dato->getFieldFromTable("ADM_PARAMETROS", 'MAYUSCULAS', $id);
        $numeros = $dato->getFieldFromTable("ADM_PARAMETROS", 'NUMEROS', $id);
        $especiales = $dato->getFieldFromTable("ADM_PARAMETROS", 'ESPECIALES', $id);
        $length = $dato->getFieldFromTable("ADM_PARAMETROS", 'LONGITUD', $id);
        $random = null;
        $source = 'abcdefghijkmnopqrstuvwxyz';
        if ($mayuscula == '1')
            $source .= 'ABCDEFGHJKMNOPQRSTUVWXYZ';
        if ($numeros == '1')
            $source .= '1234567890';
        if ($especiales == '1')
            $source .= '@#~$%()=^*+[]{}-_';
        if ($length > 0) {
            $rstr = "";
            $source = str_split($source, 1);
            for ($i = 1; $i <= $length; $i++) {
                mt_srand((float) microtime() * 1000000);
                $num = mt_rand(1, count($source));
                $random .= $source[$num - 1];
            }
        }
        return $random;
    }
}

if (!function_exists('cambiaHoraServer')) {

    function cambiaHoraServer($opc = null)
    {
        date_default_timezone_set('America/Bogota');
        // Fecha del server:

        /*if ($opc == 1) {
            $fecha = date("d-m-Y");
        } else if ($opc == 2) {
            $fecha = date("d/m/Y");
        } else {
            $fecha = date("d/m/Y H:i:s");
        }*/

        if ($opc == 1) {
            $fecha = date("Y-m-d H:i");
        } else if ($opc == 2) {
            $fecha = date("Y/m/d H:i");
        } else {
            $fecha = date("Y/m/d H:i");
        }

        // echo "<br>".$fecha;
        return $fecha;
    }
}

if (!function_exists('cambiaHoraServerInverso')) {

    function cambiaHoraServerInverso($opc = null)
    {
        date_default_timezone_set('America/Bogota');
        // Fecha del server:

        /*  if ($opc == 1) {
            $fecha = date("d-m-Y");
        } else if ($opc == 2) {
            $fecha = date("d/m/Y");
        } else {
            $fecha = date("d/m/Y H:i:s");
        }*/

        if ($opc == 1) {
            $fecha = date("Y-m-d");
        } else if ($opc == 2) {
            $fecha = date("Y/m/d");
        } else {
            $fecha = date("Y/m/d H:i:s");
        }
        // echo "<br>".$fecha;
        return $fecha;
    }
}

if (!function_exists('defineFormatoFecha')) {

    function defineFormatoFecha($fecha, $opcion)
    {
        if ($opcion) {
            if (strstr($fecha, '/') != '') {
                list($dia, $mes, $ano) = explode("/", $fecha);
            } else {
                list($dia, $mes, $ano) = explode("-", $fecha);
            }

            return $ano . "/" . $mes . "/" . $dia;
        } else {
            return $fecha;
        }
    }
}

if (!function_exists('defineFormatoFechaInverso')) {

    function defineFormatoFechaInverso($fecha, $opcion)
    {
        if ($opcion) {
            if (strstr($fecha, '/') != '') {
                list($ano, $mes, $dia) = explode("/", $fecha);
            } else {
                list($ano, $mes, $dia) = explode("-", $fecha);
            }

            return $dia . "/" . $mes . "/" . $ano;
        } else {
            return $fecha;
        }
    }
}
if (!function_exists('getOriginIP')) {

    function getOriginIP()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) { // Compartida y Varnish
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { // Proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}

if (!function_exists('paintMessageMail')) {

    function paintMessageMail($page, $tituloCorreo, $messages, $instrucciones = null, $validador = null)
    {
        $dato = new FunctionsGeneral();
        /**
         * Funcion para pintar el HTML del correo electr�nico
         */
        if ($validador == 'sendInformationContact2' || $validador == 'sendInformationContactWeb2' || $validador == 'sendInformationContact4') {
            // Envio de alerta de creaci�n de correo
            // Verifico el mensaje que esta disponible
            $idMailing = $dato->getFieldFromTable("ADM_PARAMETROS", "ID_MAILING", 1);
            return creaCuerpoMensaje($page->encryption->decrypt($dato->getFieldFromTable("OPE_MAILTEXT", "SALUDO", $idMailing)), $page->encryption->decrypt($dato->getFieldFromTable("OPE_MAILTEXT", "CUERPO1", $idMailing)), $page->encryption->decrypt($dato->getFieldFromTable("OPE_MAILTEXT", "CUERPO2", $idMailing)));
        } else {
            $subject = $dato->FunctionsGeneral->getFieldFromTableNotId("ITE_REGLASMAIL", "ASUNTO", "NOMBRE", $validador);

            //Defino comidines y remplazos
            $comodines = array(CTE_JOCKER_ORDER);
            $remplazos = array('');
            //Reemplazo comodines para el mensaje

            $subject = str_replace($comodines, $remplazos, $subject);

            return "
		        <html>
		            <head>
		                <style type=\"text/css\">
		                    
		                      .box{
		                        position:relative;
		                        margin-top:50px;
		                         
		                    }
		                    .box .box-header{
		                        position:relative;
		                        background:#03a9f3;
		                        padding-top:20px;
		                        padding-right:20px;
		                        height:50px;        
		                        width:80%;
		                        text-align: right;
		                        font-size:25px;
		                    }
		                    .box .box-footer{
		                        position:relative;
		                        background:#03a9f3;
		                        padding-top:10px;
		                        padding-left:20px;
		                        height:20px;        
		                        width:80%;
		                        text-align: left;
		                        font-size:16px;
		                    }
		                    .box-mensaje{
		                        position:relative;
		                        margin-top:50px;
		                         
		                    }
		                    .box-mensaje .box-mensaje-header{
		                        position:relative;
		                        background:#ffffff;
		                        border-top:3px solid #03a9f3;
		                        border-bottom:1px solid #03a9f3;
		                        border-left:1px solid #03a9f3;
		                        border-right:1px solid #03a9f3;
		                        padding-top:20px;
		                        padding-left:20px;
		                        padding-right:20px;
		                        height:30px;        
		                        width:50%;
		                        text-align: justify;
		                        font-size:15px;
		                    }.box-mensaje .box-mensaje-body{
		                        position:relative;
		                        background:#ffffff;
		                        border-bottom:1px solid #03a9f3;
		                        border-left:1px solid #03a9f3;
		                        border-right:1px solid #03a9f3;
		                        padding-top:20px;
		                        padding-left:20px;
		                        padding-right:20px;
		                        height:250px;        
		                        width:50%;
		                        text-align: justify;
		                        font-size:12px;
		                    }
		                  </style>
		            </head>
		            <body class=\"body\">
		                <center>
		                    <div class=\"box\">
		                        <div class=\"box-header\" style=\"color: white;\">
		                           " . $tituloCorreo . "
		                        </div>
		                        <center>
		                            <div class=\"box-mensaje\">
		                                <div class=\"box-mensaje-header\">
		                                    <b style=\"color: #03a9f3;\">" . html_escape($subject) . "</b>
		                                </div>
		                                <div class=\"box-mensaje-body\">
		                                    " . $messages . "<BR>" . $instrucciones . "
                                            Est&aacute; es una alerta autom&aacute;tica generada por el sistema de informaci&oacute;n EVOLUTION
		                                </div>
		                            </div>
		                            <br><br><br><br>
		                        </center>
		                        <div class=\"box-footer\">
		                            
		                        </div>
		                    </div>
		                </center>
		            </body>
		        </html>";
        }
    }
}

if (!function_exists('devuelveCantidadPorEstado')) {

    function devuelveCantidadPorEstado($estado, $operador, $opcion = null)
    {
        $dato = new FunctionsGeneral();
        if ($opcion == null) {
            return $dato->getQuantityFieldFromTable('OPE_CONTACTO', 'OPERADOR', $operador, 'ESTADO', $estado);
        } else {
            return $dato->getQuantityFieldFromTable('OPE_CONTRATO', 'OPERADOR', $operador, 'ESTADO', $estado);
        }
    }
}

if (!function_exists('creaCuerpoMensaje')) {

    function creaCuerpoMensaje($saludo, $cuerpo1, $cuerpo2)
    {
        return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
		
#contenedor {
    height: auto;
    width: auto;
    margin-right: auto;
    margin-left: auto;
}
#contenedor #cabecera {
    height: 150px;
    width: auto;
}
#contenedor #cabecera #izquierdo {
    height: 150px;
    width: 50%;
    float:left;
}
#contenedor #cabecera #derecho {
    height: 150px;
    width: 50%;
    float:right;
    text-align:right;
}
body {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 14px;
    font-style: normal;
    font-weight: normal;
    color: #000000;
    text-align:justify;
    margin:20px;
}
.lista {
    color: #990000;
    font-weight:bold;
}
-->
</style>
</head>
		
<body>
<div id="contenedor">
  <div id="cabecera">
    <div id="izquierdo"> <img src="https://organizacionsaludcolombia.org/assets/image_out/saludColombia_Mail.png" style="height: 150px;" alt="" /></div>
    <div id="derecho"> <img src="https://organizacionsaludcolombia.org/assets/image_out/osc_Mail.png" style="height: 150px;" alt="" /> </div>
  </div>
  <div id="cuerpo">
    <p><strong>' . $saludo . '</strong></p>
    ' . $cuerpo1 . '<center><img src="https://organizacionsaludcolombia.org/assets/image_out/bannerMail.jpg" style="height: 300px;" alt="" /></center>
    ' . $cuerpo2 . '
    <center><img src="https://organizacionsaludcolombia.org/assets/image_out/footer.png" style="height: 164px;" alt="" </center>
  <p>&nbsp;</p>
</div>
</body>
</html>
		
';
    }
}

if (!function_exists('verificaHistorioClave')) {

    function verificaHistorioClave($clave, $hash, $nuevaVerifica, $usuario, $page, $opcion)
    {
        $tempo = false;
        if ($opcion == 1) {
            if (password_verify($clave, $hash)) {
                $tempo = true;
            }
        } else {
            if ($clave == $hash) {
                $tempo = true;
            }
        }
        // Verifico hashes
        if ($tempo) {
            // Verifico hist�rico de la contrase�a
            $historicoTam = $page->FunctionsGeneral->getFieldFromTable("ADM_PARAMETROS", "HISTORICO", 1);
            // Listado de claves
            $historico = $page->Users->getClaveUsuarioHistorico($usuario);
            $bandera = true;
            $idTempo = SERVER_NUMBER;
            if ($historico != null) {
                foreach ($historico as $value) {
                    // Obtengo el hash de la clave generada anteriormente
                    $tempo = $page->encryption->decrypt($value->CLAVE);
                    if ($idTempo > $value->ID) {
                        $idTempo = $value->ID;
                    }
                    // Comparo claves
                    // echo $tempo." ".$nuevaVerifica."<br>";
                    if ($tempo == $nuevaVerifica) {
                        $bandera = false;
                    }
                }
            }
        }
        return $bandera;
    }
}

if (!function_exists('retornaArrayTablas')) {

    function retornaArrayTablas($bandera)
    {
        /**
         * Funci�n para retornar las tablas que se relacionan en el �rbol de �rdenes
         */
        $array[0] = 'ORD_TIPOMIEM';
        $array[1] = 'ORD_ARBOL';
        $array[3] = 'ORD_DATOSNIV';
        $array[4] = 'ORD_DATOSNIVVAL';
        $array[6] = 'ORD_ARBOLVALORES';
        if ($bandera == 1) {
            $array[2] = 'ORD_NIVELAMP';
            $array[5] = 'ORD_NAMPTMIEM';
            $array[7] = 'ID_NIVELAMP';
        } else {
            $array[2] = 'ORD_NIVSERVICIO';
            $array[5] = 'ORD_NIVSERTIPORD';
            $array[7] = 'ID_NIVSERVICIO';
        }
        return $array;
    }
}

if (!function_exists('retornaTipoOrdenFromArbolCodigo')) {

    function retornaTipoOrdenFromArbolCodigo($id)
    {
        /**
         * Funci�n para retornar el tipo de orden asociado a un c�digo del producto o servicio con c�digo $id
         */
        // Obtengo el valor del �rbol codigo
        $dato = new FunctionsGeneral();
        $idArbol = $dato->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "ID_ARBOLVALORES", $id);
        // echo $idArbol;
        // Busco en tercer subnivel
        $idVista = $dato->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "ID", $idArbol);
        $tabla = "VIEW_ORD_ARBOL_TS";
        if ($idVista == '') {
            // echo "aqui";
            // Busco en segundo sub nivel
            $idVista = $dato->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "ID", $idArbol);
            $tabla = "VIEW_ORD_ARBOL_SS";
            // Busco en primer sub nivel
            if ($idVista == '') {
                // echo "adentro";
                $idVista = $dato->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "ID", $idArbol);
                $tabla = "VIEW_ORD_ARBOL_PS";
            }
        } else {
            // echo "abajo";
        }
        // echo $idVista;
        // tIPOMIEM
        $return = null;
        $idTipoMiem = $dato->FunctionsGeneral->getFieldFromTable($tabla, "ID_TIPOMIEM", $idVista);
        $return[0] = $dato->FunctionsGeneral->getFieldFromTable("ORD_TIPOMIEM", "ID_TIPOORDEN", $idTipoMiem);
        $return[1] = $idArbol;
        $return[2] = $dato->FunctionsGeneral->getFieldFromTable("ORD_TIPOMIEM", "ID_MIEMBROS", $idTipoMiem);
        return $return;
    }
}

if (!function_exists('formatDate')) {

    function formatDate($date)
    {
        /**
         * Funci�n para traer la fecha desde un arreglo
         */
        $date = explode(" ", $date);
        return $date[0];
    }
}

if (!function_exists('datosGeneroPersona')) {

    function datosGeneroPersona($valor, $opcion, $tamano = null)
    {
        /**
         * Obtengo el nombre y el color de la etiqueta de acuerdo al estado que se tenga definido
         */
        if ($opcion == 'CLASE') {
            if ($valor == 'M') {
                return 'label label-sm label-success';
            } else if ($valor == 'F') {
                return 'label label-sm label-info';
            }
        } else if ($opcion == 'NOMBRE') {
            if ($tamano == '') {
                $tamano = "fa-2x";
            } else {
                $tamano = $tamano;
            }
            if ($valor == 'M') {
                return '<i class="fa fa-male ' . $tamano . '"></i>';
            } else if ($valor == 'F') {
                return '<i class="fa fa-female ' . $tamano . '"></i> ';
            }
            return $valor;
        }
    }
}
if (!function_exists('generarCalendario')) {

    function generarCalendario($ano, $anoFin, $variable)
    {
        $l = 0;
        // Ciclo para la creaci�n de A�os
        for ($i = $ano; $i <= $anoFin; $i++) {
            // Ciclo para la creaci�n de Meses
            for ($j = 1; $j < 13; $j++) {
                // Ciclo para la creaci�n de d�as
                if ($j == 1 || $j == 3 || $j == 5 || $j == 7 || $j == 8 || $j == 10 || $j == 12) {
                    $limite = 31;
                } else if ($j == 4 || $j == 6 || $j == 9 || $j == 11) {
                    $limite = 30;
                } else if ($j == 2) {
                    if ($i % 4 == 0) {
                        $limite = 29;
                    } else {
                        $limite = 28;
                    }
                }
                if ($j < 10) {
                    $j = "0" . $j;
                }
                for ($k = 1; $k <= $limite; $k++) {
                    if ($k < 10) {
                        $k = "0" . $k;
                    }
                    // //echo $k." ".$j." ".$i."<br>";
                    if ($variable == 1) {
                        $return[$l] = $i . "/" . $j . "/" . $k . " 00:00:00";
                    } else {
                        $return[$l] = $i . "/" . $j . "/" . $k;
                    }

                    $l++;
                }
                // //echo "---<br>";
            }
        }
        return $return;
    }
}

if (!function_exists('validaColorEstado')) {

    function validaColorEstado($id)
    {
        /**
         * Valido el color de los estados
         */
        if ($id == '1') {
            return "success";
        } else if ($id == '2') {
            return "info";
        } else if ($id == '3') {
            return "primary";
        } else if ($id == '4') {
            return "danger";
        }
    }
}

if (!function_exists('retornaInformacionHuesped')) {

    function retornaInformacionHuesped($idUsuarioHp, $page)
    {
        /**
         * Obtiene informaci�n del hu�sped y retorna de acuerdo a la opci�n dada
         */

        // Busco el encabezado del usuario
        $idEncUsuario = $page->FunctionsGeneral->getFieldFromTable("HP_USUARIOHP", "ID_ENCUSUARIO", $idUsuarioHp);

        // Tipo de usuario, tipo y documento de identificaci�n
        $idTipo = $page->FunctionsGeneral->getFieldFromTable("HP_ENCUSUARIO", "TIPOUSUARIO", $idEncUsuario);
        $tipoDoc = $page->FunctionsGeneral->getFieldFromTable("HP_ENCUSUARIO", "TIPODOC", $idEncUsuario);

        $documento = $page->FunctionsGeneral->getFieldFromTable("HP_ENCUSUARIO", "DOCUMENTO", $idEncUsuario);
        $entidad = $page->FunctionsGeneral->getFieldFromTable("HP_ENCUSUARIO", "ENTIDAD", $idEncUsuario);
        $procedencia = $page->FunctionsGeneral->getFieldFromTable("HP_ENCUSUARIO", "PROCEDENCIA", $idEncUsuario);
        if ($idTipo != 1) {
            // Todos menos pacientes
            $data['nombre'] = $page->encryption->decrypt($page->FunctionsGeneral->getFieldFromTableNotId("HP_USUARIO", "NOMBRES", "ID_ENCUSUARIO", $idEncUsuario)) . " " . $page->encryption->decrypt($page->FunctionsGeneral->getFieldFromTableNotId("HP_USUARIO", "APELLIDOS", "ID_ENCUSUARIO", $idEncUsuario));
            $data['soloNombres'] = $page->encryption->decrypt($page->FunctionsGeneral->getFieldFromTableNotId("HP_USUARIO", "NOMBRES", "ID_ENCUSUARIO", $idEncUsuario));
            $data['apellidos'] = $page->encryption->decrypt($page->FunctionsGeneral->getFieldFromTableNotId("HP_USUARIO", "APELLIDOS", "ID_ENCUSUARIO", $idEncUsuario));
            $data['nacimiento'] = $page->encryption->decrypt($page->FunctionsGeneral->getFieldFromTableNotId("HP_USUARIO", "FECHA_NAC", "ID_ENCUSUARIO", $idEncUsuario));
        } else {
            // Pacientes
            $data['nombre'] = $page->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "PRI_NOM_PCTE", "TP_ID_PCTE", $page->FunctionsGeneral->getFieldFromTable("ADM_DETLISTA", "VALOR", $tipoDoc), "NUM_ID_PCTE", $documento) . " " . $page->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "SEG_NOM_PCTE", "TP_ID_PCTE", $page->FunctionsGeneral->getFieldFromTable("ADM_DETLISTA", "VALOR", $tipoDoc), "NUM_ID_PCTE", $documento) . " " . $page->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "PRI_APELL_PCTE", "TP_ID_PCTE", $page->FunctionsGeneral->getFieldFromTable("ADM_DETLISTA", "VALOR", $tipoDoc), "NUM_ID_PCTE", $documento) . " " . $page->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "SEG_APELL_PCTE", "TP_ID_PCTE", $page->FunctionsGeneral->getFieldFromTable("ADM_DETLISTA", "VALOR", $tipoDoc), "NUM_ID_PCTE", $documento);
            $data['apellidos'] = $page->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "PRI_APELL_PCTE", "TP_ID_PCTE", $page->FunctionsGeneral->getFieldFromTable("ADM_DETLISTA", "VALOR", $tipoDoc), "NUM_ID_PCTE", $documento) . " " . $page->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "SEG_APELL_PCTE", "TP_ID_PCTE", $page->FunctionsGeneral->getFieldFromTable("ADM_DETLISTA", "VALOR", $tipoDoc), "NUM_ID_PCTE", $documento);
            $data['soloNombres'] = $page->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "PRI_NOM_PCTE", "TP_ID_PCTE", $page->FunctionsGeneral->getFieldFromTable("ADM_DETLISTA", "VALOR", $tipoDoc), "NUM_ID_PCTE", $documento) . " " . $page->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "SEG_NOM_PCTE", "TP_ID_PCTE", $page->FunctionsGeneral->getFieldFromTable("ADM_DETLISTA", "VALOR", $tipoDoc), "NUM_ID_PCTE", $documento);
            $tempo = explode(" ", $page->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "FECH_NCTO_PCTE", "TP_ID_PCTE", $page->FunctionsGeneral->getFieldFromTable("ADM_DETLISTA", "VALOR", $tipoDoc), "NUM_ID_PCTE", $documento));
            $data['nacimiento'] = $tempo[0];
        }
        $data['idTipo'] = $idTipo;

        $data['tipoDoc'] =  $page->FunctionsGeneral->getFieldFromTable("ADM_DETLISTA", "VALOR", $tipoDoc);
        $data['tipoDocId'] =  $tipoDoc;
        $data['documento'] = $documento;
        $data['entidad'] = $entidad;
        $data['procedencia'] = $procedencia;
        return $data;
    }
}
if (!function_exists('formatBytes')) {

    function formatBytes($bytes, $precision = 2)
    {
        /**
         * Retornar el valor de un byte en otras medidas
         */
        $units = array(
            'B',
            'KB',
            'MB',
            'GB',
            'TB'
        );

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}

if (!function_exists('numberFormatEvolution')) {

    function numberFormatEvolution($numero)
    {

        /**
         * Retorno el formateo de numeros
         */
        return number_format($numero, 2, ',', '.');
    }
}
if (!function_exists('calSumaDespiece')) {

    function calSumaDespiece($param_trm, $param_valor, $param_cantidad)
    {

        $totalDespiece = $param_valor * $param_cantidad;

        /**
         * Retorno el formateo de numeros
         */
        return $totalDespiece * $param_trm;
    }
}


if (!function_exists('monthYearBefore')) {

    function monthYearBefore($month, $year)
    {

        /**
         * Retorno el a�o mes anterior de acuerdo a los valores ingresados
         */
        $mesAnterior = $month - 1;
        if ($mesAnterior < 10) {
            $mesAnterior = "0" . $mesAnterior;
        }
        if ($mesAnterior == 12) {
            $anoAnterior = $year - 1;
        } else {
            $anoAnterior = $year;
        }

        $return[0] = $mesAnterior;
        $return[1] = $anoAnterior;
        return $return;
    }
}


if (!function_exists('traslateIdToSponsorShipKind')) {

    function traslateIdToSponsorShipKind($id)
    {
        $dato = new FunctionsGeneral();
        if ($id == '1') {
            return "<small class='label label-sm label-primary'> <i class= \"fa fa-puzzle-piece \"></i> Servicios</small>";
        } else if ($id == '2') {
            return "<small class='label label-sm label-danger'> <i class= \"fa fa-dot-circle-o\"></i>  Especial</small>";
        } else if ($id == '3') {
            return "<small class='label label-sm label-info'> <i class= \"fa fa-car\"></i>  Transporte</small>";
        }
    }
}

if (!function_exists('validaEstadosGeneralesPatrocinios')) {

    function validaEstadosGeneralesPatrocinios($valor, $opcion)
    {
        /**
         * Obtengo el nombre y el color de la etiqueta de acuerdo al estado que se tenga definido
         */
        if ($opcion == 'CLASE') {
            if ($valor == 'S') {
                return 'label label-sm label-success';
            } else if ($valor == 'N') {
                return 'label label-sm label-danger';
            } else if ($valor == 'P') {
                return 'label label-sm label-info';
            }
        } else if ($opcion == 'NOMBRE') {

            if ($valor == 'S') {
                return 'Legalizado';
            } else if ($valor == 'N') {
                return 'Anulado';
            } else if ($valor == 'P') {
                return 'Pendiente';
            }
            return $valor;
        }
    }
}
if (!function_exists('escribeMes')) {
    function escribeMes()
    {
        /** Escribe los meses del a�o, dejando por defecto el mes actual*/
        $mes = date('m');
        $mes = $mes - 1;
        for ($i = 0; $i < 12; $i++) {
            if ($i == $mes) {
                $variable[$i] = 'selected';
            } else {
                $variable[$i] = '';
            }
        }
        $array[0] = "<option value='01' $variable[0] >Enero</option>";
        $array[1] = "<option value='02'$variable[1]>Febrero</option>";
        $array[2] = "<option value='03'$variable[2]>Marzo</option>";
        $array[3] = "<option value='04'$variable[3]>Abril</option>";
        $array[4] = "<option value='05'$variable[4]>Mayo</option>";
        $array[5] = "<option value='06'$variable[5]>Junio</option>";
        $array[6] = "<option value='07'$variable[6]>Julio</option>";
        $array[7] = "<option value='08'$variable[7]>Agosto</option>";
        $array[8] = "<option value='09'$variable[8]>Septiembre</option>";
        $array[9] = "<option value='10'$variable[9]>Octubre</option>";
        $array[10] = "<option value='11' $variable[10]>Noviembre</option>";
        $array[11] = "<option value='12'$variable[11]>Diciembre</option>";
        $tempo = '';
        for ($i = 0; $i < 12; $i++) {
            $tempo = $tempo . "<br>" . $array[$i];
        }
        return $tempo;
    }
}
if (!function_exists('escribeAno')) {
    function escribeAno()
    {
        /** Escribe los a�os, dejando por defecto el actual*/
        $ano = date('Y');
        $tempo = '';
        for ($i = 2018; $i <= 2050; $i++) {
            if ($ano == $i) {
                $valor = 'selected';
            } else {
                $valor = '';
            }
            $array[$i] = "<option value='$i' $valor >$i</option>";
            $tempo = $tempo . "<br>" . $array[$i];
        }
        return $tempo;
    }
}



if (!function_exists('arrayColor')) {
    function arrayColor()
    {
        /** Define array de colores*/
        $array[0] = "green";
        $array[1] = "orange";
        $array[2] = "purple";
        $array[3] = "red";
        $array[4] = "olive";
        $array[5] = "black";
        $array[6] = "yellow";
        $array[7] = "cian";


        return $array;
    }
}


if (!function_exists('arrayLetras')) {
    function arrayLetras()
    {
        /** Define array de letras*/
        $array[1] = "a";
        $array[2] = "b";
        $array[3] = "c";
        $array[4] = "d";
        $array[5] = "e";


        return $array;
    }
}
if (!function_exists('defineArrayMeses')) {

    function defineArrayMeses()
    {

        /**Define un arreglo de meses*/
        $mes[1][0] = "Enero";
        $mes[1][1] = "Ene";
        $mes[1][2] = "01";
        $mes[1][3] = "31";
        $mes[2][0] = "Febrero";
        $mes[2][1] = "Feb";
        $mes[2][2] = "02";
        $mes[2][3] = "28";
        $mes[3][0] = "Marzo";
        $mes[3][1] = "Mar";
        $mes[3][2] = "03";
        $mes[3][3] = "31";
        $mes[4][0] = "Abril";
        $mes[4][1] = "Abr";
        $mes[4][2] = "04";
        $mes[4][3] = "30";
        $mes[5][0] = "Mayo";
        $mes[5][1] = "May";
        $mes[5][2] = "05";
        $mes[5][3] = "31";
        $mes[6][0] = "Junio";
        $mes[6][1] = "Jun";
        $mes[6][2] = "06";
        $mes[6][3] = "30";
        $mes[7][0] = "Julio";
        $mes[7][1] = "Jul";
        $mes[7][2] = "07";
        $mes[7][3] = "31";
        $mes[8][0] = "Agosto";
        $mes[8][1] = "Ago";
        $mes[8][2] = "08";
        $mes[8][3] = "31";
        $mes[9][0] = "Septiembre";
        $mes[9][1] = "Sep";
        $mes[9][2] = "09";
        $mes[9][3] = "30";
        $mes[10][0] = "Octubre";
        $mes[10][1] = "Oct";
        $mes[10][2] = "10";
        $mes[10][3] = "31";
        $mes[11][0] = "Noviembre";
        $mes[11][1] = "Nov";
        $mes[11][2] = "11";
        $mes[11][3] = "30";
        $mes[12][0] = "Diciembre";
        $mes[12][1] = "Dic";
        $mes[12][2] = "12";
        $mes[12][3] = "31";

        return $mes;
    }
}


if (!function_exists('retornaOrdenesActualesParaNotificacion')) {

    function retornaOrdenesActualesParaNotificacion($usuario)
    {
        /**
         * Retorna las funciones
         */

        $modelo = new OrdersModel();

        $return = $modelo->selectListOrdersFromHistoryFull($usuario);
        return $return;
    }
}

if (!function_exists('numberFormatApp')) {

    function numberFormatApp($numero)
    {

        /**
         * Retorno el formateo de numeros
         */
        return number_format($numero, 2, ',', '.');
    }
}
