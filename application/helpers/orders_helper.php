<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						Helper de la aplicaci�n.
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2017 *******************************
 */


if(!function_exists('searchPatient')){
	function searchPatient($history,$identification,$name,$lastName,$page,$state){
		/** Realizo la busqueda del paciente de acuerdo a alguno de los parametros de busqueda*/
		
		if($history!=''){
			//Se buscar� por historia cl�nica
			return $page->EsaludModel->getPatientInformation($history,1,$state);
		}else if($identification!=''){
			//Se buscar� por documento de identidad
			return $page->EsaludModel->getPatientInformation($identification,2,$state);
		}else if($name!=''){
			//Se buscar� por nombre del paciente
			return $page->EsaludModel->getPatientInformation($name,3,$state);
		}else if($lastName!=''){
			//Se buscar� por apellido del paciente
			return $page->EsaludModel->getPatientInformation($lastName,4,$state);
		}else{
			//Se buscar� por apellido del paciente
			return $page->EsaludModel->getPatientInformation($history,5,$state);
		}
	}
}

if(!function_exists('freeCookies')){
	function freeCookies($page){
		/** Libero los valores de las cookies. Todo lo que tiene que ver con ordenes*/

		$page->session->set_userdata('id', 0);
		$page->session->set_userdata('tipoOrden','');
		$page->session->set_userdata('encOrden','');
	}
}

if(!function_exists('deleteOrders')){
	function deleteOrderInformation($page,$orden){
		/** Rutina para eliminar una orden con todas las tablas anexas
		 * 
		 *  delete from ORD_ORDACTESTOBS;
			delete from ORD_ORDENEQUIPO;
			delete from ORD_ORDACTEST;
			delete from ORD_ORDACTDES;
			delete from ORD_ORDEN;
			delete from ORD_ENCORDEN;
		 * 
		 * 
		 * */
		//1.1. Eliminando en ORD_ORDACTESTOBS
		$idOrdActEst=$page->FunctionsGeneral->getFieldFromTableNotId("ORD_ORDACTEST","ID","ID_ORDEN",$orden);
		
		$page->OrdersModel->deleteObsStateOrder($idOrdActEst);
		
		//1.2. Eliminando en ORD_ORDENEQUIPO
		$page->OrdersModel->deleteTeamStateOrder( $page->FunctionsGeneral->getFieldFromTable ( "ORD_ORDACTEST", "ID_TORDPROEST", $idOrdActEst ));
			
		//1.3. Eliminando en ORD_ORDACTEST
		$page->OrdersModel->deleteStateOrder($idOrdActEst);
			
		//1.4. Eliminando en ORD_ORDACTESTDES
		$page->OrdersModel->deleteElementOfOrder($orden);
			
		
			
		//1.5. Eliminando en ORD_ORDEN
		$page->OrdersModel->deleteOrder($orden);

		
	}
}

if(!function_exists('paintActualState')){
	function paintActualState($page,$idOrden){
		/** Pinta los estados actuales de la orden*/
		$estados=$page->OrdersModel->selectActualState($idOrden);
		$return='';
		if($estados!=null){
		foreach ($estados as $estado){
			if ($estado->ID!=STATE_SUSPEND && $estado->ID!=STATE_CANCEL ){
				//Pinto el estado
				if($estado->MOMENTO==SUSPEND_STATE){
					$return.= $estado->NOMBRE." <small style='color:red;'><B>(Suspendido)</B> </small><BR>";
				}else{
					$return.= $estado->NOMBRE."<BR>";
				}
				
			}
			
		}
		}
		return $return;
	}
}

if(!function_exists('calculoPorcentajeOrden')){
	function calculoPorcentajeOrden($estadosDefinidos,$estadosEjecutados) {
		/**Obtiene el avance de la orden*/
		// echo $cantidadEstadosTotal." ".$return[1];
		/*$main->valorPorcentaje = 
		$main->porcentaje = ($main->valorPorcentaje * TAMANOBARRA) / CIENTOPORCIENTO;*/
		//return ((round ( ($estadosEjecutados / $estadosDefinidos)  ) * 100) ) . "%";
		return round(( ($estadosEjecutados / $estadosDefinidos)*100),2);
	}
}

if(!function_exists('colorPorcentajeOrden')){
	function colorPorcentajeOrden($valor) {
		/**Obtiene el color del avance del proceso de atenci�n*/
		if($valor<=40){
			return "bg-danger";
		}else if($valor<=90 && $valor>=40){
			return "bg-error";
		}else{
			return "bg-success";
		}
		
		
	}
}

if(!function_exists('retornarMes')){
	function retornarMes($mes) {
		/**Retorna mes*/
		if($mes=='01'){
			return "Ene";
		}if($mes=='02'){
			return "Feb";
		}if($mes=='03'){
			return "Mar";
		}if($mes=='04'){
			return "Abr";
		}if($mes=='05'){
			return "May";
		}if($mes=='06'){
			return "Jun";
		}if($mes=='07'){
			return "Jul";
		}if($mes=='08'){
			return "Ago";
		}if($mes=='09'){
			return "Sep";
		}if($mes=='10'){
			return "Oct";
		}if($mes=='11'){
			return "Nov";
		}if($mes=='12'){
			return "Dic";
		}

		return ($estadosEjecutados / $estadosDefinidos)*100;
	}
}

if(!function_exists('nestableFunction')){
    function nestableFunction($pagina,$id,$tipoOrden,$nombre,$page) {
        /**Retorna enlace*/
       
        $nestable = '
                        <a href="' . base_url () . $pagina . $page->encryption->encrypt ($id) . '/' . $page->encryption->encrypt ( $tipoOrden ) . '">
						<li class="dd-item" data-id="SL1_' . $id . '">
						    
				            		<div class=" ' . BG_BOX_INTERFACE1 . '" style="color: white;">
					            			' .$nombre .  '
					            			    
					            	</div>
                                    <br>
					            			    
			            </li></a>';
        return $nestable;
    }
}

if(!function_exists('findListInformation')){
    function findListInformation($page,$list,$value) {
        /**Retorna la informaci�n de la lista respectiva*/
       
       if($list==55){
       		//Retorno informac��n del proveedor
       		return $page->FunctionsGeneral->getFieldFromTable("ORD_PROVEEDOR", "NOMBRE",$value);
       }if($list==56){
       		//Retorno informac��n del t�cnico
       		return $page->FunctionsGeneral->getFieldFromTable("ADM_USUARIO", "NOMBRES",$value)." ".$page->FunctionsGeneral->getFieldFromTable("ADM_USUARIO", "APELLIDOS",$value);
       }
        
    }
}


if(!function_exists('listAditionalInformation')){
 	function listAditionalInformation($page, $lista,$opcion=null){
	    /**Cargo los valores adicionales de la lista*/
	    
	    if ($opcion==null){
	    	$return="<option value=\"\"> ----- </option>";	
	    }else{
	    	$return="";
	    }
	    
	    if ($lista==55){
	        //Lista de proveedores
	        $listado=$page->FunctionsGeneral->selectValoresListaTabla("ORD_PROVEEDOR", 'ASC');
	        foreach ($listado->result() as $value){
	            $return .="<option value=\"".$value->ID."\">".$value->NOMBRE."</option>";
	        }
	    }else if ($lista==56){
	    	$listado=$page->FunctionsAdmin->selectUsersFromProfile(PROFILE_DEFAULT_TECNIC);
	        foreach ($listado as $value){
	            $return .="<option value=\"".$value->ID."\">".$value->NOMBRES." ".$value->APELLIDOS."</option>";
	        }
	    }
	    
	    return $return;
	    
	}

}
if (! function_exists('calSumaDespieceOrden')) {

    function calSumaDespieceOrden($page, $cantidad, $codigo)
    {   
		$price = $page->FunctionsGeneral->getFieldFromTableNotId("COT_DESCRIPCION", "MATERIALES", "AUXILIAR", $codigo);
		$total = $price * $cantidad;
		
        return $total;
    }
}
if(! function_exists('businessDays')) {
	function businessDays($fecha1, $fecha2) {
		$diferencia = 0;
		$fecha1CalcSegundos = strtotime($fecha1);
		$fecha2CalcSegundos = strtotime($fecha2);
		for($fecha1CalcSegundos;$fecha1CalcSegundos<=$fecha2CalcSegundos;$fecha1CalcSegundos=strtotime('+1 day ' . date('Y/m/d',$fecha1CalcSegundos))){ 			
			if((strcmp(date('D',$fecha1CalcSegundos),'Sun')!=0) && (strcmp(date('D',$fecha1CalcSegundos),'Sat')!=0)){
				$diferencia = $diferencia+1;
			}
			
		}
		return $diferencia;
	}
}
if(!function_exists('TrafficLightReferencesTempo')) {
	function TrafficLightReferencesTempo($dias, $number1=null, $number2=null, $references) {
		if($dias < $number1){
			$message="A tiempo";
		} else if($dias >=$number1 and $dias < $number2){
			$message="A punto de cumplirse el tiempo";
		} else if($dias >=$number2){
			$message="Por fuera del tiempo";
		} else {
			$message="Sin fechas para evaluar";
		}
		
		return "<td style='text-align: center'> $message </td>";
	}
}

if(!function_exists('TracingTrafficLightColors')) {
	function TracingTrafficLightColors($nom, $dias, $number1=null, $number2=null, $color1, $color2, $color3) {
		$color = null;
		if($nom!=''){    
			if($dias < $number1){
				$color="background-color: $color1; color : white;";

			} else if($dias >=$number1 and $dias < $number2){
				$color="background-color: $color2; color : white;";
			} else if($dias >=$number2){
				$color="background-color: $color3; color : white;";
			} else {
				$color="background-color: #fff; color : black;";
			}   
		}
		return  "<td style = '$color'> $dias </td>";
	}
}
if(!function_exists('TracingTrafficLightMessage')) {
	function TracingTrafficLightMessage($fecha1=null, $fecha2=null, $prefijo) { 
		$dias = businessDays($fecha2, $fecha1);
		if($fecha2!=null && $fecha1!=null) {
			switch($prefijo) {
				case 'PRO':
					return TrafficLightReferencesTempo($dias, 40, 60, 'green', 'orange', 'red'); 
				break;
				case 'CS':
					return TrafficLightReferencesTempo($dias, 40, 60, 'green', 'orange', 'red'); 
				break;
				case 'CMI':
					return TrafficLightReferencesTempo($dias, 40, 60, 'green', 'orange', 'red'); 
				break;
				case 'CMS':
					return TrafficLightReferencesTempo($dias, 40, 60, 'green', 'orange', 'red'); 
				break;
				case 'KIT':
					return TrafficLightReferencesTempo($dias, 40, 60, 'green', 'orange', 'red'); 
				break;
				case 'ORP':
					return TrafficLightReferencesTempo($dias, 40, 60, 'green', 'orange', 'red'); 
				break;
				case 'ARR':
					return TrafficLightReferencesTempo($dias, 40, 60, 'green', 'orange', 'red'); 
				break;
				case 'CORT':
					return TrafficLightReferencesTempo($dias, 40, 60, 'green', 'orange', 'red'); 
				break;
				case 'OTL':
					return TrafficLightReferencesTempo($dias, 40, 60, 'green', 'orange', 'red'); 
				break;
				case 'ORT':
					return TrafficLightReferencesTempo($dias, 10, 15, 'green', 'orange', 'red'); 
				break;
				case 'LB':
					return TrafficLightReferencesTempo($dias, 10, 15, 'green', 'orange', 'red'); 
				break;
				case 'ORTP':
					return TrafficLightReferencesTempo($dias, 25, 45, 'green', 'orange', 'red'); 
				break;
				case 'MOV':
					return TrafficLightReferencesTempo($dias, 25, 45, 'green', 'orange', 'red'); 
				break;
				case 'COJ':
					return TrafficLightReferencesTempo($dias, 25, 45, 'green', 'orange', 'red'); 
				break;
				case 'SLS':
					return TrafficLightReferencesTempo($dias, 25, 45, 'green', 'orange', 'red'); 
				break;
				case 'RMOV':
					return TrafficLightReferencesTempo($dias, 45, 25, 'green', 'orange', 'red'); 
				break;
				default:

					
			}
		}

		
	}
}
if(!function_exists('TracingTrafficLight')) {
	function TracingTrafficLight($fecha1=null, $fecha2=null, $nom, $prefijo) { 
		$dias = businessDays($fecha2, $fecha1);
		if($fecha2!=null && $fecha1!=null) {
			switch($prefijo) {
				case 'PRO':
					return TracingTrafficLightColors($nom, $dias, 40, 60, 'green', 'orange', 'red'); 
				break;
				case 'CS':
					return TracingTrafficLightColors($nom, $dias, 40, 60, 'green', 'orange', 'red'); 
				break;
				case 'CMI':
					return TracingTrafficLightColors($nom, $dias, 40, 60, 'green', 'orange', 'red'); 
				break;
				case 'CMS':
					return TracingTrafficLightColors($nom, $dias, 40, 60, 'green', 'orange', 'red'); 
				break;
				case 'KIT':
					return TracingTrafficLightColors($nom, $dias, 40, 60, 'green', 'orange', 'red'); 
				break;
				case 'ORP':
					return TracingTrafficLightColors($nom, $dias, 40, 60, 'green', 'orange', 'red'); 
				break;
				case 'ARR':
					return TracingTrafficLightColors($nom, $dias, 40, 60, 'green', 'orange', 'red'); 
				break;
				case 'CORT':
					return TracingTrafficLightColors($nom, $dias, 40, 60, 'green', 'orange', 'red'); 
				break;
				case 'OTL':
					return TracingTrafficLightColors($nom, $dias, 40, 60, 'green', 'orange', 'red'); 
				break;
				case 'ORT':
					return TracingTrafficLightColors($nom, $dias, 10, 15, 'green', 'orange', 'red'); 
				break;
				case 'LB':
					return TracingTrafficLightColors($nom, $dias, 10, 15, 'green', 'orange', 'red'); 
				break;
				case 'ORTP':
					return TracingTrafficLightColors($nom, $dias, 25, 45, 'green', 'orange', 'red'); 
				break;
				case 'MOV':
					return TracingTrafficLightColors($nom, $dias, 25, 45, 'green', 'orange', 'red'); 
				break;
				case 'COJ':
					return TracingTrafficLightColors($nom, $dias, 25, 45, 'green', 'orange', 'red'); 
				break;
				case 'SLS':
					return TracingTrafficLightColors($nom, $dias, 25, 45, 'green', 'orange', 'red'); 
				break;
				case 'RMOV':
					return TracingTrafficLightColors($nom, $dias, 45, 25, 'green', 'orange', 'red'); 
				break;
				default:

					
			}
		}

		
	}
}
if(!function_exists('calcDaysTrafficLight')) {
	function calcDaysTrafficLight($fechaActual, $fechaEstado) {
		
		if($dia != 1) {
			$dia .= ' Días';
		} else {
			$dia .= ' Día';
		}
		return $dia;
	}
}
if(!function_exists('parametersTrafficLight')) {
	function parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor) {
		$dia = businessDays($fecha2, $fecha1);
        if($dia >=$aMin and $dia <=$aMax){
			$var="background-color: $aColor; color : black;";
		} else if($dia >=$mMin and $dia <=$mMax){
			$var="background-color: $mColor; color : black;";
		} else if($dia >=$bMin and $dia <=$bMax){
			$var="background-color: $bColor; color : black;";	
		} else {
			$var="background-color: #fff; color : black;";
		}

		return "<td style = '$var'>$dia</td>";
	}
}
if(!function_exists('trafficLight')) {
	function trafficLight($fecha1, $fecha2, $estadoId, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor) {
		switch($estadoId) {
			case -3:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case -2:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case -1:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 1:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 2:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 3:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;
			
			case 4:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 5:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 6:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 7:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 8:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 9:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 10:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 11:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 12:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 13:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 14:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 15:

				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 16:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 17:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 18:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 19:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;
			case 20:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 21:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 22:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 23:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 24:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 25:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 26:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 27:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 28:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 29:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 30:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 31:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

			case 32:
				return parametersTrafficLight($fecha1, $fecha2, $diferencia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);
			break;

		}
	}
}
if(!function_exists('trafficLightStokePrice')) {
	function trafficLightStokePrice($fechaActual, $fechaSolicitudCotizacion, $fechaEmisionCotizacion) {
		if($fechaEmisionCotizacion != null | $fechaEmisionCotizacion != ''){
			//get seconds
			$segundosFechaEmisionCotizacion = strtotime($fechaEmisionCotizacion);
			$segundosFechaSolicitudCotizacion = strtotime($fechaSolicitudCotizacion);
			$segundosTranscurridos = $segundosFechaEmisionCotizacion - $segundosFechaSolicitudCotizacion;
			//hours values
			$result = floor($segundosTranscurridos / 3600);
			if($result == 1) {
				$result .= " Hora";
			}  else if($result <0){
				$style = "background-color: red; color: #fff; text-align: center;";
			} else if($result <= 24){
				$style = "background-color: green; color: #fff; text-align: center;";
			}
			if($result == 0 || $result > 1 || $result < 1){
				$result .= " Horas";
			}
		   

			if($result > 24) {
				$result = businessDays($fechaSolicitudCotizacion, $fechaEmisionCotizacion);
				if($result == 1){
					$result .= " Dia";
					$style = "background-color: yellow; color: #000; text-align: center;";
				}else if($result > 1){
					$style = "background-color: red; color: #fff; text-align: center;";
				}
				if($result == 0 || $result > 1 ){
					$result .= " Dias";
				}
				
			}




		} else {
			$segundosFechaActual = strtotime($fechaActual);
			$segundosFechaSolicitudCotizacion = strtotime($fechaSolicitudCotizacion);

			//hours values
			$segundosTranscurridos = $segundosFechaActual - $segundosFechaSolicitudCotizacion;

			//hours values
			$result = floor($segundosTranscurridos / 3600);
			if($result == 1) {
				$result .= " Hora";
				$style = "background-color: green; color: #fff; text-align: center;";
			} else if ($result <= 24) {
				$style = "background-color: green; color: #fff; text-align: center;";
			}
			if($result == 0 || $result > 1){
				$result .= " Horas";
			}
			
			if($result > 24) {
				$result = businessDays($fechaSolicitudCotizacion, $fechaActual);
				if($result == 1){
					$result .= " Dia";
					$style = "background-color: yellow; color: #000; text-align: center;";

				}else if($result > 1){
					$style = "background-color: red; color: #fff; text-align: center;";
				}
				if($result == 0 || $result > 1){
					$result .= " Dias";
				}
			}

		}

		echo "<td style='$style'>$result</td>";

	}
}


if(!function_exists('selectPatienInformationFromOrder')) {
	function selectPatienInformationFromOrder($encOrden,$page) {

		$page->load->model('EsaludModel'); // Libreria principal de las funciones referentes a la lectura de informacion del sistema ESALUD

		//Empresa
        $idEmpresa=$page->FunctionsGeneral->getFieldFromTableNotId("ORD_CONTACTOUSUARIO", "ID_EMPRESA", "ID_ENCORDEN",$encOrden);

        //Telefono
        $telefono=$page->encryption->decrypt($page->FunctionsGeneral->getFieldFromTableNotId("ORD_CONTACTOUSUARIO", "MOVIL", "ID_ENCORDEN",$encOrden));

        //TELEFONO 2
        $telefono2=$page->encryption->decrypt($page->FunctionsGeneral->getFieldFromTableNotId("ORD_CONTACTOUSUARIO", "TELEFONO", "ID_ENCORDEN",$encOrden));

        //DIRECCION
        $direccion=$page->encryption->decrypt($page->FunctionsGeneral->getFieldFromTableNotId("ORD_CONTACTOUSUARIO", "DIRECCION", "ID_ENCORDEN",$encOrden));

        //MUNICIPIO
        $idMunicipio=$page->FunctionsGeneral->getFieldFromTableNotId("ORD_CONTACTOUSUARIO", "ID_MUNICIPIO", "ID_ENCORDEN",$encOrden);

        $idDepartamento=$page->FunctionsGeneral->getFieldFromTableNotId("ADM_MUNICIPIO", "ID_DEPARTAMENTO", "ID",$idMunicipio);

        if($idMunicipio==''){
        	$municipio='';
        }else{
        	$municipio=$page->FunctionsGeneral->getFieldFromTableNotId("ADM_MUNICIPIO", "NOMBRE", "ID",$idMunicipio)."(".$page->FunctionsGeneral->getFieldFromTableNotId("ADM_DEPARTAMENTO", "NOMBRE", "ID",$idDepartamento).")";
	
        }
        
        //Codigo interno
        $interno=$page->FunctionsGeneral->getFieldFromTableNotId("COT_TARIFAEMPRESA", "ID_EMPRESA", "ID",$idEmpresa);
	//	echo 'interno'.$interno;

        //Empresa Nombre
        $empresaNombre=$page->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_APB","NOM_APB","ID_APB",$interno);

        $return[0]=$empresaNombre;

		$return[1]=$telefono;
    	$return[2]=$telefono2;
		$return[3]=$direccion;
		$return[4]=$municipio;
		$return[5]=$idMunicipio;
		$return[6]=$idDepartamento;
		$return[7]=$interno;

        return $return;
	}
}





?>
