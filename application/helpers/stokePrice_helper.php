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


if(!function_exists('defineValue')){
	function defineValue($margenElemento,$margenServicios,$margenProductos, $idTipo,$materiales,$manoObra,$asociados){
		/**Calculo el valor del producto, servicio, elemento teniendo en cuenta los valores dados*/

		//Formula del c�lculo del precio de la cotizaci�n definida en el excel
		// =REDOND.MULT(($materiales+$manoObra)/(1-$Margen);100)+$asociados

	    

		if($idTipo=='39'){
		    //Elemento
			$valor = defineValueFormule($margenElemento,$materiales,$manoObra,$asociados);
		}else if($idTipo=='40'){
		    //Producto
		    $valor = defineValueFormule($margenProductos,$materiales,$manoObra,$asociados);
		    
		}else if($idTipo=='41'){
		    //Servicio.
		    $valor = defineValueFormule($margenServicios,$materiales,$manoObra,$asociados);
		    
		}
	
	    //Redondeo a los miles
	    if(MILES_ROUND){
	        return round($valor,-2);
	    }else{
	        return $valor;
	    }
	    
		
	}
}

if(!function_exists('defineValueFormule')){
	function defineValueFormule($margen,$materiales,$manoObra,$asociados){
		/**Calculo el valor del producto, servicio, elemento teniendo en cuenta los valores dados*/

		//Formula del c�lculo del precio de la cotizaci�n definida en el excel
		// =REDOND.MULT(($materiales+$manoObra)/(1-$Margen);100)+$asociados

	    $valor = (($materiales+$manoObra)/(1-($margen/100)))+ $asociados;

	    //Redondeo a los miles
	    if(MILES_ROUND){
	        return round($valor,-2);
	    }else{
	        return $valor;
	    }
	    
		
	}
}

if(!function_exists('companyListValidation')){
	function companyListValidation($page, $empresa){
		/**valido si es una empresa con lista compuesta y que valide c�digos propios o valores propios*/
	    $empresaTarifa= $page->FunctionsGeneral->getFieldFromTable("COT_TARIFAEMPRESA", "ID_EMPRESA", $empresa);
	    //echo $empresaTarifa." ".$empresa;
        $idCompuesta= $page->FunctionsGeneral->getFieldFromTableNotId("COT_EMPRESALISTA","ID","ID_EMPRESA", $empresaTarifa);
 		if ($idCompuesta!=''){
 			$return[0]=$idCompuesta;
 			$return[1]= $page->FunctionsGeneral->getFieldFromTable("COT_EMPRESALISTA", "ID_CERRADA", $idCompuesta);;
 			$return[2]= $page->FunctionsGeneral->getFieldFromTable("COT_EMPRESALISTA", "ID_CODIGO", $idCompuesta);;
 		}else{
 			$return[0]='NA';
 			$return[1]= 'NA';
 			$return[2]='NA';
 		}

 		//RETORNO LOS VALORES RESPECTIVOS
 		return  $return;
	    
		
	}
}

if(!function_exists('printCode')){
	function printCode($page, $validador, $id,$codigo,$nombre,$contador=null){
		/**retorna el c�digo que debe imprimir para la cotizaci�n*/

		if($validador[0]!='NA'){
			if($validador[2]==CTE_VALOR_SI){
				$tempo= $page->FunctionsGeneral->getFieldFromTableNotIdFields("COT_LISTAELEMENTOS","AUXILIAR","ID_EMPRESA",$validador[0],"ID_CODIGO", $id, "ESTADO",ACTIVO_ESTADO);
				if ($tempo==''){
					$return= $codigo."(**)";
					$nombre=$nombre;
					$contador++;
				}else{
					$return= $tempo;
					$nombre=$page->FunctionsGeneral->getFieldFromTableNotIdFields("COT_CODIGONEPS","NOMBRE","CODIGO",$tempo, "ESTADO",ACTIVO_ESTADO);
				}
			}
			if($validador[1]==CTE_VALOR_SI){
				$tempo= $page->FunctionsGeneral->getFieldFromTableNotIdFields("COT_LISTAELEMENTOS","ID","ID_EMPRESA",$validador[0],"ID_CODIGO", $id, "ESTADO",ACTIVO_ESTADO);
				if ($tempo==''){
					$return= $codigo."(**)";
					$nombre=$nombre;
					$contador++;
				}else{
					$return= $codigo;
					$nombre=$nombre;
				}
			}
		}else{
			$return= $codigo;	
			$nombre=$nombre;
		}
	    
	    $retorna[0]=$return;
	    $retorna[1]=$contador;
	    $retorna[2]=$nombre;
	    return $retorna;
	    
		
	}
}


if(!function_exists('trmTranslate')){
	function trmTranslate($page,$codigo){
		/**retorna el valor en pesos*/
		$pais= $page->FunctionsGeneral->getFieldFromTableNotId("COT_DESCRIPCION", "ID_PAIS", "ID", $codigo);
		if ($pais==CTE_PAIS_DEFECTO){
			$trm=1;
		}else{
			$trm= $page->FunctionsGeneral->getFieldFromTableNotId("ADM_TRM", "VALOR", "ID", 1);
		}
		//ECHO "---> ".$pais." ".$codigo." ".$trm."<br>";
		

		return $trm;
		
	    
		
	}
}


if(!function_exists('defineValueElementsMaterials')){
	function defineValueElementsMaterials($page,$codigo,$opcion=null){
		/**retorna el valor en pesos del despiece asociado al producto con id $id*/
		
		$page->load->model('StokePriceModel');

		//Calculo TRM
    	$trm=trmTranslate($page,$page->FunctionsGeneral->getFieldFromTableNotIdFields ( "VIEW_COT_DESCRIPCION", "ID", "CODIGO",$codigo ));

		//Obtengo ubicaci�n dentro del �rbol de productos 
		
		$idArbol=$page->FunctionsGeneral->getFieldFromTableNotId("ORD_ARBOLCODIGO","ID","CODIGO",$codigo);
		//Verifico si tiene despiece
		if ($page->FunctionsGeneral->getQuantityFieldFromTable("COT_VIEW_DESPIECE_PRODUCTO","PRODUCTO",$idArbol)==0){
			if($opcion!=null){
				//Se debe tomar el valor definido de materiales dentro de la descripci�n del producto
				$materiales = $page->FunctionsGeneral->getFieldFromTableNotIdFields ( "VIEW_COT_DESCRIPCION", "ASOCIADOS", "CODIGO",$codigo );
				
			}else{
				$materiales = $page->FunctionsGeneral->getFieldFromTableNotIdFields ( "VIEW_COT_DESCRIPCION", "MATERIALES", "CODIGO",$codigo )* $trm;
				//echo $materiales." ".$trm."<br>";
			}
			
			
		}else{
			//Debo obtener el valor de los elementos teniendo en cuenta el costo asociado 
				$materiales=defineValueElements($page,$idArbol,$opcion);
		}

		return $materiales;
	    
		
	}
}


if(!function_exists('defineValueElements')){
	function defineValueElements($page,$id,$opcion=null){
		/**retorna el valor en pesos del despiece asociado al producto con id $id*/
		
		$page->load->model('StokePriceModel');

		$lista= $page->StokePriceModel->selectValueFromElementListOfProduct($id);
		$total=0;
		foreach ($lista as $value) {
			
			if($opcion==null){
				//Calculo el valor de la TRM asociada
				$trm=trmTranslate($page,$value->ID_DESC);	
			}else{
				$trm=1;
			}
			

			//obtengo el valor total
			if ($value->COSTO_MATERIALES==''){
				//Le sumo cero
				$total+= 0;
			}else{


				if($opcion==null){
					//Calculo el valor de la TRM asociada
					$costo=$value->COSTO_MATERIALES;	
				}else{
					$costo=$value->COSTO_ASOCIADOS	;
				}
				// Se calcula con base a la cantidad, el costo de materiales y la TRM
				$temporal= $value->CANTIDAD* $costo * $trm;
				$total+= $temporal;
			}
			//echo $value->ID_DESC." ".$value->CODIGO_ELEMENTO." ".$value->COSTO_MATERIALES." ".$temporal." ".$total."<br>";
			
		}

		return $total;
		
	    
		
	}
}

if(!function_exists('defineProfitStokePriceProduct')){
	function defineProfitStokePriceProduct($page,$codigo,$empresa,$margenProductos=null,$margenElementos=null,$margenServicios=null){
		/**retorna el valor en pesos del despiece asociado al producto con id $id*/
		
		$tarifa=$page->FunctionsGeneral->getFieldFromTableNotIdFields("COT_TARIFAEMPRESA", "ID_TARIFA", "ID", $empresa);
        $tipo = $page->FunctionsGeneral->getFieldFromTableNotIdFields("VIEW_COT_DESCRIPCION", "ID_TIPO", "ID", $codigo);
        if($tipo=='39'){
        	//Verifico si se trae un valor por defecto
        	if($margenElementos==null){
				$margen = $page->FunctionsGeneral->getFieldFromTableNotIdFields ( "COT_TARIFA", "MARGEN_ELEMENTOS", "ID",$tarifa );
        	}else{
        		$margen=$margenElementos;
        	}
            
        }else if ($tipo==40){
            //Verifico si se trae un valor por defecto
            if($margenProductos==null){
				$margen = $page->FunctionsGeneral->getFieldFromTableNotIdFields ( "COT_TARIFA", "MARGEN_PRODUCTOS", "ID",$tarifa );
        	}else{
        		$margen=$margenProductos;
        	}
        }else{
        	//Verifico si se trae un valor por defecto
            if($margenServicios==null){
				$margen = $page->FunctionsGeneral->getFieldFromTableNotIdFields ( "COT_TARIFA", "MARGEN_SERVICIOS", "ID",$tarifa );
        	}else{
        		$margen=$margenServicios;
        	}
            
        }
		
	    return $margen;
		
	}
}


if(!function_exists('defineIvaValue')){
	function defineIvaValue($idTipo,$id,$page){
		
		$iva=0;
		if($idTipo=='39'){
		    //Elemento identifico el grupo al cual pertenece
		    $grupo=$page->FunctionsGeneral->getFieldFromTableNotIdFields ( "ORD_ELEMENTO", "ID_GRUELEM", "CODIGO",$id );
		    $iva=$page->FunctionsGeneral->getFieldFromTableNotIdFields ( "ORD_GRUELEM", "IVA", "ID",$grupo );
		    $iva=$page->FunctionsGeneral->getFieldFromTableNotIdFields ( "ADM_DETLISTA", "VALOR", "ID",$iva );
			//$valor = defineValueFormule($margenElemento,$materiales,$manoObra,$asociados);
		}else {
		    //Servicio o producto.
		    $grupo=$page->FunctionsGeneral->getFieldFromTableNotIdFields ( "VIEW_ORD_ARBOLPRODUCTOS", "ID_TIPOORDEN", "CODIGO",$id );
		    $iva=$page->FunctionsGeneral->getFieldFromTableNotIdFields ( "ORD_TIPOORDEN", "IVA", "ID",$grupo );
		    $iva=$page->FunctionsGeneral->getFieldFromTableNotIdFields ( "ADM_DETLISTA", "VALOR", "ID",$iva );
		    
		}
	
	    //Retorna el valor de IVA encontrado
	    return $iva/100;
	    
		
	}
}


if(!function_exists('defineValorUnitario')){
	function defineValorUnitario($valor,$cantidad,$costoAdicional){
		
		//Saco el porcentaje de costo adicional asociado a cada producto
		$costoAdicional=$costoAdicional/$cantidad;
		
	    return $valor+$costoAdicional;
	    
		
	}
}

?>
