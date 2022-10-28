<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						P�gina Web.
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2018 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');

// Verifico si la orden tiene despiece asociado


if ($paciente!=null){
	foreach ($paciente as $value) {
    	$idResponsable=$value->ID_RESPONSABLE;
        $idPaciente=$value->TP_ID_PCTE;
        $docPaciente=$value->NUM_ID_PCTE;
        $empresaResponsable=$value->RESPONSABLE;

        $identificacion=" ".$value->TP_ID_PCTE." ".$value->NUM_ID_PCTE;
        $historia=$value->ID_PCTE;
        $nombres=$value->PRI_NOM_PCTE." ".$value->SEG_NOM_PCTE." ".$value->PRI_APELL_PCTE." ".$value->SEG_APELL_PCTE;
        $sexo=$value->SEXO;
        $edad=$value->FECH_NCTO_PCTE;
    }
}

//Encabezado de la orden
$idEncOrden = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ORDEN", "ID_ENCORDEN", "ID", $idPinta);
$datos=selectPatienInformationFromOrder($idEncOrden,$this);
$responsable=$datos[0];
$telefono=$datos[1];
$telefono2=$datos[2];
$telefono2Limpio=$datos[2];
if($datos[2]!=''){
	$telefono2 =" - ".$telefono2;
}
$direccion=$datos[3];
$municipio=$datos[4];
$idMunicipio=$datos[5];
$idDepartamento=$datos[6];
$correo=$this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "CORREO", "DOCUMENTO",$value->NUM_ID_PCTE));	

$alida= $this->FunctionsGeneral->getFieldFromTableNotId("ORD_CONTACTOUSUARIO", "ID_CONVENIO", "ID_ENCORDEN", $idEncOrden);
$alida= $this->FunctionsGeneral->getFieldFromTableNotId("ADM_ALIADA", "EMPRESA", "ID", $alida);
$empresaAliadaNombre=" (".$this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_APB","NOM_APB","ID_APB",$alida)." )";


?>
<!-- page css -->
<link href="<?= base_url()?>assets/dist/css/pages/tab-page.css"
	rel="stylesheet">
<!-- Date Picker Plugin JavaScript -->
<script
	src="<?= base_url()?>assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

<script
	src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.es.min.js"></script>


<!-- ============================================================== -->
<!-- Start JavaScript para pintar campos adicionales -->
<!-- ============================================================== -->
<script type="text/javascript">

					$(document).ready(function() {
					// Date Picker
					jQuery('.datepicker').datepicker({
					     autoclose: true,
					     todayHighlight: true,
					     format: '<?= DATE_FORMAT_EVOLUTION;?>',
					     language: 'es'
					 });
					});
                	// Traigo la informaci<?= LETRA_MIN_O?>n de las observaciones por estado
	                $(document).ready(function() {
						$("#estado").change(function() {
							$("#estado option:selected").each(function() {
								estado = $('#estado').val();
		 					$.post("<?= base_url()?>Integration/reloadObservationKind", {
		 						estado : estado
		 					}, function(data) {
		 							$("#tipo").html(data);
		 							});
							});
						})
					});
	             // Traigo la informaci<?= LETRA_MIN_O?>n de los reprocesos por estado
	                $(document).ready(function() {
						$("#estado").change(function() {
							$("#estado option:selected").each(function() {
								estado = $('#estado').val();
								idOrden = $('#idOrden').val();
		 					$.post("<?= base_url()?>Integration/reloadStatesBackProcess", {
		 						estado : estado,
		 						idOrden: idOrden
		 					}, function(data) {
		 							$("#reproceso").html(data);
		 							});
							});
						})
					});
					
	             	// Traigo la informaci<?= LETRA_MIN_O?>n si es permitido o no adjuntar archivos
	                $(document).ready(function() {
						$("#estado").change(function() {
							$("#estado option:selected").each(function() {
								estado = $('#estado').val();
		 					$.post("<?= base_url()?>Integration/reloadStateInformationAdd", {
		 						estado : estado
		 					}, function(data) {
		 						 if (data == <?= CTE_VALOR_SI?>){
		 							$(".adjunto").prop('disabled', false);
									$(".adjunto").show();
			 					 }else{
			 						$(".adjunto").prop('disabled', true);
									$(".adjunto").hide();
			 					 } 
		 						});
							});
						})
					});   

	             // Traigo la informaci<?= LETRA_MIN_O?>n de tipo de observaci<?= LETRA_MIN_O?>n
	                $(document).ready(function() {
						$("#tipo").change(function() {
							$("#tipo option:selected").each(function() {
								tipo = $('#tipo').val();
								estado = $('#estado').val();
		 					$.post("<?= base_url()?>Integration/reloadObservationStateInformation", {
		 						tipo : tipo,
		 						estado:estado
		 					}, function(data) {
		 						var tempo = data.split('|');
		 						//Acci<?= LETRA_MIN_O?>n sobre el estado
		 						//alert(data);
		 						
			 					if (tempo[0] == <?= CTE_VALOR_SI?>){
		 							$(".accion").val('Cierra');
		 							$(".accion").show();
						
		 							//<?php //TODO ?> Campos adicional 1
		 							if(tempo[5]!=<?= VALUE_STATE_NOT ?>){
			 							if (tempo[5]==57 || tempo[5]==52 || tempo[5]==51 || tempo[5]==58){
				 							valor=tempo[3]+" *";
										}else{
											valor=tempo[3];
										}	
			 							$("#labelCampo1").html(valor);
		 								$(".campo1").show();

		 								
		 								if (tempo[4]=="L"){
		 									//Es una lista
		 									$("#listaCampo1").show();
		 									$("#listaCampo1").prop('disabled', false);
		 									$("#listaCampo1").html(tempo[6]);
		 									if(tempo[5]==52){
			 									$("#listaCampo1").prop('required', true);
		 									}else{
		 										$("#listaCampo1").prop('required', false);
			 								}
			 								// Inactivo y oculto otro tipo de campos
		 									$("#campo1").hide();
		 									$("#campo1").prop('disabled', true);
		 									$("#fecha1").hide();
		 									$("#fecha1").prop('disabled', true);
		 									$("#numero1").hide();
		 									$("#numero1").prop('disabled', true);
		 									
			 							}else if (tempo[4]=="T"){
			 								//Es un campo de texto	
			 								$("#campo1").show();
		 									$("#campo1").prop('disabled', false);
		 									if(tempo[5]==51){
			 									$("#campo1").prop('required', true);
		 									}else{
		 										$("#campo1").prop('required', false);
			 								}
		 								// Inactivo y oculto otro tipo de campos
			 								$("#listaCampo1").hide();
		 									$("#listaCampo1").prop('disabled', true);
		 									$("#fecha1").hide();
		 									$("#fecha1").prop('disabled', true);
		 									$("#numero1").hide();
		 									$("#numero1").prop('disabled', true);
				 						}else if (tempo[4]=="D"){
				 							//Es un campo de fecha
			 								$("#fecha1").show();
		 									$("#fecha1").prop('disabled', false);
		 									if(tempo[5]==57){
			 									$("#fecha1").prop('required', true);
		 									}else{
		 										$("#fecha1").prop('required', false);
			 								}
		 								// Inactivo y oculto otro tipo de campos
			 								$("#listaCampo1").hide();
		 									$("#listaCampo1").prop('disabled', true);
		 									$("#campo1").hide();
		 									$("#campo1").prop('disabled', true);
		 									$("#numero1").hide();
		 									$("#numero1").prop('disabled', true);
				 						}else if (tempo[4]=="N"){
				 							//Es un campo de n�mero
			 								$("#numero1").show();
		 									$("#numero1").prop('disabled', false);
		 									if(tempo[5]==58){
			 									$("#numero1").prop('required', true);
		 									}else{
		 										$("#numero1").prop('required', false);
			 								}
		 								// Inactivo y oculto otro tipo de campos
			 								$("#listaCampo1").hide();
		 									$("#listaCampo1").prop('disabled', true);
		 									$("#fecha1").hide();
		 									$("#fecha1").prop('disabled', true);
		 									$("#campo1").hide();
		 									$("#campo1").prop('disabled', true);
				 						}
			 						}else{
			 							$(".campo1").hide();
			 							$("#campo1").hide();
			 							$("#campo1").prop('disabled', true);
	 									$("#listaCampo1").hide();
	 									$("#listaCampo1").prop('disabled', true);
	 									$("#fecha1").hide();
	 									$("#fecha1").prop('disabled', true);
	 									$("#numero1").hide();
	 									$("#numero1").prop('disabled', true);
				 					}
									//<?php //TODO ?> Campos adicional 2
		 							if(tempo[9]!=<?= VALUE_STATE_NOT ?>){
			 							if (tempo[9]==57 || tempo[9]==52 || tempo[9]==51 || tempo[9]==58){
				 							valor=tempo[7]+" *";
										}else{
											valor=tempo[7];
										}	
			 							$("#labelCampo2").html(valor);
		 								$(".campo2").show();

		 								//alert(tempo)
		 								if (tempo[8]=="L"){
		 									//Es una lista
		 									$("#listaCampo2").show();
		 									$("#listaCampo2").prop('disabled', false);
		 									$("#listaCampo2").html(tempo[10]);
		 									if(tempo[9]==52){
			 									$("#listaCampo2").prop('required', true);
		 									}else{
		 										$("#listaCampo2").prop('required', false);
			 								}
			 								// Inactivo y oculto otro tipo de campos
		 									$("#campo2").hide();
		 									$("#campo2").prop('disabled', true);
		 									$("#fecha2").hide();
		 									$("#fecha2").prop('disabled', true);
		 									$("#numero2").hide();
		 									$("#numero2").prop('disabled', true);
		 									
			 							}else if (tempo[8]=="T"){
			 								//Es un campo de texto	
			 								$("#campo2").show();
		 									$("#campo2").prop('disabled', false);
		 									if(tempo[9]==51){
			 									$("#campo2").prop('required', true);
		 									}else{
		 										$("#campo2").prop('required', false);
			 								}
		 								// Inactivo y oculto otro tipo de campos
			 								$("#listaCampo2").hide();
		 									$("#listaCampo2").prop('disabled', true);
		 									$("#fecha2").hide();
		 									$("#fecha2").prop('disabled', true);
		 									$("#numero2").hide();
		 									$("#numero2").prop('disabled', true);
				 						}else if (tempo[8]=="D"){
				 							//Es un campo de fecha
			 								$("#fecha2").show();
		 									$("#fecha2").prop('disabled', false);
		 									if(tempo[9]==57){
			 									$("#fecha2").prop('required', true);
		 									}else{
		 										$("#fecha2").prop('required', false);
			 								}
		 								// Inactivo y oculto otro tipo de campos
			 								$("#listaCampo2").hide();
		 									$("#listaCampo2").prop('disabled', true);
		 									$("#campo2").hide();
		 									$("#campo2").prop('disabled', true);
		 									$("#numero2").hide();
		 									$("#numero2").prop('disabled', true);
				 						}else if (tempo[8]=="N"){
				 							//Es un campo de n�mero
			 								$("#numero2").show();
		 									$("#numero2").prop('disabled', false);
		 									if(tempo[9]==58){
			 									$("#numero2").prop('required', true);
		 									}else{
		 										$("#numero2").prop('required', false);
			 								}
		 								// Inactivo y oculto otro tipo de campos
			 								$("#listaCampo2").hide();
		 									$("#listaCampo2").prop('disabled', true);
		 									$("#fecha2").hide();
		 									$("#fecha2").prop('disabled', true);
		 									$("#campo2").hide();
		 									$("#campo2").prop('disabled', true);
				 						}
			 						}else{
			 							$(".campo2").hide();
			 							$("#campo2").hide();
			 							$("#campo2").prop('disabled', true);
	 									$("#listaCampo2").hide();
	 									$("#listaCampo2").prop('disabled', true);
	 									$("#fecha2").hide();
	 									$("#fecha2").prop('disabled', true);
	 									$("#numero2").hide();
	 									$("#numero2").prop('disabled', true);
				 					}
									//<?php //TODO ?> Campos adicional 3
		 							if(tempo[13]!=<?= VALUE_STATE_NOT ?>){
			 							if (tempo[13]==57 || tempo[13]==52 || tempo[13]==51 || tempo[13]==58){
				 							valor=tempo[11]+" *";
										}else{
											valor=tempo[11];
										}	
			 							$("#labelCampo3").html(valor);
		 								$(".campo3").show();

		 								
		 								if (tempo[12]=="L"){
		 									//Es una lista
		 									$("#listaCampo3").show();
		 									$("#listaCampo3").prop('disabled', false);
		 									$("#listaCampo3").html(tempo[14]);
		 									if(tempo[13]==52){
			 									$("#listaCampo3").prop('required', true);
		 									}else{
		 										$("#listaCampo3").prop('required', false);
			 								}
			 								// Inactivo y oculto otro tipo de campos
		 									$("#campo3").hide();
		 									$("#campo3").prop('disabled', true);
		 									$("#fecha3").hide();
		 									$("#fecha3").prop('disabled', true);
		 									$("#numero3").hide();
		 									$("#numero3").prop('disabled', true);
		 									
			 							}else if (tempo[12]=="T"){
			 								//Es un campo de texto	
			 								$("#campo3").show();
		 									$("#campo3").prop('disabled', false);
		 									if(tempo[13]==51){
			 									$("#campo3").prop('required', true);
		 									}else{
		 										$("#campo3").prop('required', false);
			 								}
		 								// Inactivo y oculto otro tipo de campos
			 								$("#listaCampo3").hide();
		 									$("#listaCampo3").prop('disabled', true);
		 									$("#fecha3").hide();
		 									$("#fecha3").prop('disabled', true);
		 									$("#numero3").hide();
		 									$("#numero3").prop('disabled', true);
				 						}else if (tempo[12]=="D"){
				 							//Es un campo de fecha
			 								$("#fecha3").show();
		 									$("#fecha3").prop('disabled', false);
		 									if(tempo[13]==57){
			 									$("#fecha3").prop('required', true);
		 									}else{
		 										$("#fecha3").prop('required', false);
			 								}
		 								// Inactivo y oculto otro tipo de campos
			 								$("#listaCampo3").hide();
		 									$("#listaCampo3").prop('disabled', true);
		 									$("#campo3").hide();
		 									$("#campo3").prop('disabled', true);
		 									$("#numero3").hide();
		 									$("#numero3").prop('disabled', true);
				 						}else if (tempo[12]=="N"){
				 							//Es un campo de n�mero
			 								$("#numero3").show();
		 									$("#numero3").prop('disabled', false);
		 									if(tempo[13]==58){
			 									$("#numero3").prop('required', true);
		 									}else{
		 										$("#numero3").prop('required', false);
			 								}
		 								// Inactivo y oculto otro tipo de campos
			 								$("#listaCampo3").hide();
		 									$("#listaCampo3").prop('disabled', true);
		 									$("#fecha3").hide();
		 									$("#fecha3").prop('disabled', true);
		 									$("#campo3").hide();
		 									$("#campo3").prop('disabled', true);
				 						}
			 						}else{
			 							$(".campo3").hide();
			 							$("#campo3").hide();
			 							$("#campo3").prop('disabled', true);
	 									$("#listaCampo3").hide();
	 									$("#listaCampo3").prop('disabled', true);
	 									$("#fecha3").hide();
	 									$("#fecha3").prop('disabled', true);
	 									$("#numero3").hide();
	 									$("#numero3").prop('disabled', true);
				 					}

									//<?php //TODO ?> Campos adicional 4
		 							if(tempo[17]!=<?= VALUE_STATE_NOT ?>){
			 							if (tempo[17]==57 || tempo[17]==52 || tempo[17]==51 || tempo[17]==58){
				 							valor=tempo[15]+" *";
										}else{
											valor=tempo[15];
										}	
			 							$("#labelCampo4").html(valor);
		 								$(".campo4").show();

		 								
		 								if (tempo[16]=="L"){
		 									//Es una lista
		 									$("#listaCampo4").show();
		 									$("#listaCampo4").prop('disabled', false);
		 									$("#listaCampo4").html(tempo[18]);
		 									if(tempo[17]==52){
			 									$("#listaCampo4").prop('required', true);
		 									}else{
		 										$("#listaCampo4").prop('required', false);
			 								}
			 								// Inactivo y oculto otro tipo de campos
		 									$("#campo4").hide();
		 									$("#campo4").prop('disabled', true);
		 									$("#fecha4").hide();
		 									$("#fecha4").prop('disabled', true);
		 									$("#numero4").hide();
		 									$("#numero4").prop('disabled', true);
		 									
			 							}else if (tempo[16]=="T"){
			 								//Es un campo de texto	
			 								$("#campo4").show();
		 									$("#campo4").prop('disabled', false);
		 									if(tempo[17]==51){
			 									$("#campo4").prop('required', true);
		 									}else{
		 										$("#campo4").prop('required', false);
			 								}
		 								// Inactivo y oculto otro tipo de campos
			 								$("#listaCampo4").hide();
		 									$("#listaCampo4").prop('disabled', true);
		 									$("#fecha4").hide();
		 									$("#fecha4").prop('disabled', true);
		 									$("#numero4").hide();
		 									$("#numero4").prop('disabled', true);
				 						}else if (tempo[16]=="D"){
				 							//Es un campo de fecha
			 								$("#fecha4").show();
		 									$("#fecha4").prop('disabled', false);
		 									if(tempo[17]==57){
			 									$("#fecha4").prop('required', true);
		 									}else{
		 										$("#fecha4").prop('required', false);
			 								}
		 								// Inactivo y oculto otro tipo de campos
			 								$("#listaCampo4").hide();
		 									$("#listaCampo4").prop('disabled', true);
		 									$("#campo4").hide();
		 									$("#campo4").prop('disabled', true);
		 									$("#numero4").hide();
		 									$("#numero4").prop('disabled', true);
				 						}else if (tempo[16]=="N"){
				 							//Es un campo de n�mero
			 								$("#numero4").show();
		 									$("#numero4").prop('disabled', false);
		 									if(tempo[17]==58){
			 									$("#numero4").prop('required', true);
		 									}else{
		 										$("#numero4").prop('required', false);
			 								}
		 								// Inactivo y oculto otro tipo de campos
			 								$("#listaCampo4").hide();
		 									$("#listaCampo4").prop('disabled', true);
		 									$("#fecha4").hide();
		 									$("#fecha4").prop('disabled', true);
		 									$("#campo4").hide();
		 									$("#campo4").prop('disabled', true);
				 						}
			 						}else{
			 							$(".campo4").hide();
			 							$("#campo4").hide();
			 							$("#campo4").prop('disabled', true);
	 									$("#listaCampo4").hide();
	 									$("#listaCampo4").prop('disabled', true);
	 									$("#fecha4").hide();
	 									$("#fecha4").prop('disabled', true);
	 									$("#numero4").hide();
	 									$("#numero4").prop('disabled', true);
				 					}

									//<?php //TODO ?> Campos adicional 5
		 							if(tempo[21]!=<?= VALUE_STATE_NOT ?>){
			 							if (tempo[21]==57 || tempo[21]==52 || tempo[21]==51 || tempo[21]==58){
				 							valor=tempo[19]+" *";
										}else{
											valor=tempo[19];
										}	
			 							$("#labelCampo5").html(valor);
		 								$(".campo5").show();

		 								
		 								if (tempo[20]=="L"){
		 									//Es una lista
		 									$("#listaCampo5").show();
		 									$("#listaCampo5").prop('disabled', false);
		 									$("#listaCampo5").html(tempo[22]);
		 									if(tempo[21]==52){
			 									$("#listaCampo5").prop('required', true);
		 									}else{
		 										$("#listaCampo5").prop('required', false);
			 								}
			 								// Inactivo y oculto otro tipo de campos
		 									$("#campo5").hide();
		 									$("#campo5").prop('disabled', true);
		 									$("#fecha5").hide();
		 									$("#fecha5").prop('disabled', true);
		 									$("#numero5").hide();
		 									$("#numero5").prop('disabled', true);
		 									
			 							}else if (tempo[20]=="T"){
			 								//Es un campo de texto	
			 								$("#campo5").show();
		 									$("#campo5").prop('disabled', false);
		 									if(tempo[21]==51){
			 									$("#campo5").prop('required', true);
		 									}else{
		 										$("#campo5").prop('required', false);
			 								}
		 								// Inactivo y oculto otro tipo de campos
			 								$("#listaCampo5").hide();
		 									$("#listaCampo5").prop('disabled', true);
		 									$("#fecha5").hide();
		 									$("#fecha5").prop('disabled', true);
		 									$("#numero5").hide();
		 									$("#numero5").prop('disabled', true);
				 						}else if (tempo[20]=="D"){
				 							//Es un campo de fecha
			 								$("#fecha5").show();
		 									$("#fecha5").prop('disabled', false);
		 									if(tempo[21]==57){
			 									$("#fecha5").prop('required', true);
		 									}else{
		 										$("#fecha5").prop('required', false);
			 								}
		 								// Inactivo y oculto otro tipo de campos
			 								$("#listaCampo5").hide();
		 									$("#listaCampo5").prop('disabled', true);
		 									$("#campo5").hide();
		 									$("#campo5").prop('disabled', true);
		 									$("#numero5").hide();
		 									$("#numero5").prop('disabled', true);
				 						}else if (tempo[20]=="N"){
				 							//Es un campo de n�mero
			 								$("#numero5").show();
		 									$("#numero5").prop('disabled', false);
		 									if(tempo[21]==59){
			 									$("#numero5").prop('required', true);
		 									}else{
		 										$("#numero5").prop('required', false);
			 								}
		 								// Inactivo y oculto otro tipo de campos
			 								$("#listaCampo5").hide();
		 									$("#listaCampo5").prop('disabled', true);
		 									$("#fecha5").hide();
		 									$("#fecha5").prop('disabled', true);
		 									$("#campo5").hide();
		 									$("#campo5").prop('disabled', true);
				 						}
			 						}else{
			 							$(".campo5").hide();
			 							$("#campo5").hide();
			 							$("#campo5").prop('disabled', true);
	 									$("#listaCampo5").hide();
	 									$("#listaCampo5").prop('disabled', true);
	 									$("#fecha5").hide();
	 									$("#fecha5").prop('disabled', true);
	 									$("#numero5").hide();
	 									$("#numero5").prop('disabled', true);
				 					}
		 							
				 					
			 					 }else{
			 						$(".accion").val('Contin<?= LETRA_MIN_U?>a abierto');
									$(".accion").show();
									//Oculto los campos adicionales
									$(".campo1").hide();

									$("#campo1").hide();
									$("#campo1").prop('disabled', true);

 									$("#listaCampo1").hide();
 									$("#listaCampo1").prop('disabled', true);
 									
 									$("#fecha1").hide();
 									$("#fecha1").prop('disabled', true);

 									$("#numero1").hide();
 									$("#numero1").prop('disabled', true);

 									$(".campo2").hide();

									$("#campo2").hide();
									$("#campo2").prop('disabled', true);

 									$("#listaCampo2").hide();
 									$("#listaCampo2").prop('disabled', true);
 									
 									$("#fecha2").hide();
 									$("#fecha2").prop('disabled', true);

 									$("#numero2").hide();
 									$("#numero2").prop('disabled', true);

 									//Oculto los campos adicionales
									$(".campo3").hide();

									$("#campo3").hide();
									$("#campo3").prop('disabled', true);

 									$("#listaCampo3").hide();
 									$("#listaCampo3").prop('disabled', true);
 									
 									$("#fecha3").hide();
 									$("#fecha3").prop('disabled', true);

 									$("#numero3").hide();
 									$("#numero3").prop('disabled', true);


 									//Oculto los campos adicionales
									$(".campo4").hide();

									$("#campo4").hide();
									$("#campo4").prop('disabled', true);

 									$("#listaCampo4").hide();
 									$("#listaCampo4").prop('disabled', true);
 									
 									$("#fecha4").hide();
 									$("#fecha4").prop('disabled', true);

 									$("#numero4").hide();
 									$("#numero4").prop('disabled', true);

 									//Oculto los campos adicionales
									$(".campo5").hide();

									$("#campo5").hide();
									$("#campo5").prop('disabled', true);

 									$("#listaCampo5").hide();
 									$("#listaCampo5").prop('disabled', true);
 									
 									$("#fecha5").hide();
 									$("#fecha5").prop('disabled', true);

 									$("#numero5").hide();
 									$("#numero5").prop('disabled', true);
 								} 


								



 								
			 					//Tipo de observaci�n
			 					if (tempo[1] == <?= CTE_VALOR_PROCESO?>){
		 							$(".tipoObs").val('Proceso Normal');
									$(".tipoObs").show();
									$(".reproceso").hide();
									$("#reproceso").prop('disabled', true);
			 					 }else{
			 						$(".tipoObs").val('Reproceso');
									$(".tipoObs").show();
									$(".reproceso").show();
									$("#reproceso").prop('disabled', false);
									
			 					 } 
								 // Modifica despiece
			 					if (tempo[2] == <?= CTE_VALOR_NO?>){
		 							$(".despiece").hide();
									$("#despiece").prop('disabled', true);
			 					 }else{
			 						$(".despiece").show();									
			 						$("#despiece").prop('disabled', false);
									
			 					 } 
		 						});
							});
						})
					});  	
</script>


<script type="text/javascript">

		         	
			        $(document).ready(function() {
							$("#departamento").change(function() {
								$("#departamento option:selected").each(function() {
									departamento = $('#departamento').val();
			 					$.post("<?= base_url()?>/Integration/reloadCity", {
			 						departamento : departamento
			 					}, function(data) {
			 							$("#ciudad").html(data);
			 							});
								});
							})
						});
			        
					</script>
<!-- ============================================================== -->
<!-- End JavaScript para pintar campos adicionales -->
<!-- ============================================================== -->


<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<!-- Row -->
<div class="row">
	<!-- Column -->
	<div class="col-lg-4 col-xlg-4 col-md-4">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<h3><i class="<?= datosGeneroPersona($sexo,'CLASE','fa-1x')?>" ><?= datosGeneroPersona($sexo,'NOMBRE','fa-1x') ?> </i> Datos del usuario </h3>
					<br>
					
				</div>
				<div class="row">
					<p class="text-muted"><strong>Documento de identidad: </strong> <?= $identificacion;?></p>
				</div>
				<div class="row">
					<p class="text-muted"><strong>Historia: </strong> <?= $historia;?></p>
				</div>
				<div class="row">
					<p class="text-muted">
						
                        <strong>Nombres: </strong><?= $nombres;?></p>
				</div>

				<div class="row">
					<p class="text-muted">
						
                        <strong>Edad: </strong><?=intervaloTiempo($edad, cambiaHoraServer(2), 31104000);?> A&ntilde;os</p>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-xlg-4 col-md-4">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<h3><i class="fa fa-usd"></i> Cotizaci&oacute;n asociada </h3>
					<br>
					
				</div>
				<div class="row">
					<p class="text-muted"><strong>Entidad Responsable: </strong> <?= $responsable;?></p>
				</div>
				<div class="row">
					<p class="text-muted"><strong>Cotizaci&oacute;n: </strong> <?= $numeroCotizacion;?></p>
				</div>
				<div class="row">
					<p class="text-muted">
						
                        <strong>Autorizaci&oacute;n: </strong><?= $numeroAutorizacion;?></p>
				</div>
				<div class="row">
					<p class="text-muted">
						
                        <strong>Fecha de autorizaci&oacute;n: </strong><?= $fechaAutorizacion;?></p>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-xlg-4 col-md-4">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<h3><i class="fa fa-map-marker"></i> Contacto de usuario </h3>
					<br>
					
				</div>
				<div class="row">
					<p class="text-muted"><strong>Tel&eacute;fonos de contacto: </strong> <?= $telefono;?>  <?= $telefono2;?></p>
				</div>
				<div class="row">
					<p class="text-muted"><strong>Direcci&oacute;n: </strong> <?= $direccion;?></p>
				</div>
				<div class="row">
					<p class="text-muted">
						
                        <strong>Municipio: </strong><?= $municipio;?></p>
				</div>
				<div class="row">
					<p class="text-muted">
						
                        <strong>Correo electr&oacute;nico: </strong><?= $correo;?></p>
				</div>
			</div>
		</div>
	</div>
	

	<!-- Column -->
</div>
<div class="row">
	<!-- Column -->
	<div class="col-lg-4 col-xlg-3 col-md-5">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<!-- Column -->
					<div class="col-lg-12 col-xlg-12 col-md-12">
						<div class="card border-info">
							<div class="card-header bg-info">
								<h4 class="m-b-0 text-white">Tipo de proceso: <?= $tipoProceso;?>  <?= $empresaAliadaNombre;?> </h4>
							</div>
							<BR>
							<div class="card-header bg-dark">
								<h4 class="m-b-0 text-white"><?= $ordenNumero;?> <i
										class="fa fa-angle-double-right"></i> Estado(s) actual(es) <i
										class="fa fa-angle-double-right"></i> <?= paintActualState($this,$idPinta);?></h4>
							</div>
							<div class="card-body">
								<h5>
									<b> <i class="fa fa-thermometer-full fa-2x"></i> Avance del
										proceso de atenci&oacute;n
									</b> <span class="pull-right">
						                            		<?= calculoPorcentajeOrden($estadosDefinidos,$estadosEjecutados);?> %
						                            	</span>
								</h5>
								<br>
								<div class="progress ">
									<div class="progress-bar <?= colorPorcentajeOrden(calculoPorcentajeOrden($estadosDefinidos,$estadosEjecutados));?> wow animated progress-animated" style="width: <?= calculoPorcentajeOrden($estadosDefinidos,$estadosEjecutados);?>%; height:20px;" role="progressbar">
										<span class="sr-only"><?= calculoPorcentajeOrden($estadosDefinidos,$estadosEjecutados);?>% Completado</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr>
				<h5 class="card-title">Ruta del producto</h5>
	                                <?php
                                
                                if ($niveles == 3) {
                                    ?>   
		        <div class="row">

					<!-- Column -->
					<div class="col-lg-12 col-xlg-12 col-md-12">
						<div class="card">
							<div class="box <?= BG_BOX_INTERFACE;?> text-center">
								<h4 class="font-light text-white">
									Tipo de orden: <small class="text-white"><?= $nombreTipo;?></small>
								</h4>
							</div>
						</div>
					</div>
					<!-- Column -->
					<div class="col-lg-12 col-xlg-12 col-md-12">
						<div class="card">
							<div class="box <?= BG_BOX_INTERFACE;?> text-center">
								<h4 class="font-light text-white">
									Ubicaci&oacute;n: <small class="text-white"><?= $nombreMiembros;?></small>
								</h4>

							</div>
						</div>
					</div>
					<!-- Column -->
					<div class="col-lg-12 col-xlg-12 col-md-12">
						<div class="card">
							<div class="box <?= BG_BOX_INTERFACE;?> text-center">
								<h4 class="font-light text-white">
									Primer subnivel: <small class="text-white"><?= $nomPrimerSubNiv;?></small>
								</h4>

							</div>
						</div>
					</div>

					<!-- Column -->
					<div class="col-lg-12 col-xlg-12 col-md-12">
						<div class="card">
							<div class="box <?= BG_BOX_INTERFACE;?> text-center">
								<h4 class="font-light text-white">
									Segundo subnivel: <small class="text-white"><?= $nomSegundoSubNiv;?></small>
								</h4>

							</div>
						</div>
					</div>

					<!-- Column -->
					<div class="col-lg-12 col-xlg-12 col-md-12">
						<div class="card">
							<div class="box <?= BG_BOX_INTERFACE;?> text-center">
								<h4 class="font-light text-white">
									Tercer subnivel: <small class="text-white"><?= $nomTerceroSubNiv;?></small>
								</h4>

							</div>
						</div>
					</div>



				</div>
		                            <?php }?>
		                            <?php
                            
                            if ($niveles == 2) {
                                ?>   
		        <div class="row">
					<div class="col-lg-12 col-xlg-12 col-md-12">
						<div class="card">
							<div class="box <?= BG_BOX_INTERFACE;?> text-center">
								<h4 class="font-light text-white">
									Tipo de orden: <small class="text-white"><?= $nombreTipo;?></small>
								</h4>
							</div>
						</div>
					</div>
					<!-- Column -->
					<div class="col-lg-12 col-xlg-12 col-md-12">
						<div class="card">
							<div class="box <?= BG_BOX_INTERFACE;?> text-center">
								<h4 class="font-light text-white">
									Ubicaci&oacute;n: <small class="text-white"><?= $nombreMiembros;?></small>
								</h4>

							</div>
						</div>
					</div>
					<!-- Column -->
					<div class="col-lg-12 col-xlg-12 col-md-12">
						<div class="card">
							<div class="box <?= BG_BOX_INTERFACE;?> text-center">
								<h4 class="font-light text-white">
									Primer subnivel: <small class="text-white"><?= $nomPrimerSubNiv;?></small>
								</h4>

							</div>
						</div>
					</div>

					<!-- Column -->
					<div class="col-lg-12 col-xlg-12 col-md-12">
						<div class="card">
							<div class="box <?= BG_BOX_INTERFACE;?> text-center">
								<h4 class="font-light text-white">
									Segundo subnivel: <small class="text-white"><?= $nomSegundoSubNiv;?></small>
								</h4>

							</div>
						</div>
					</div>

				</div>
		                            <?php }?> 
		                            <?php
                            
                            if ($niveles == 1) {
                                ?>   
		        <div class="row">
					<div class="col-lg-12 col-xlg-12 col-md-12">
						<div class="card">
							<div class="box <?= BG_BOX_INTERFACE;?> text-center">
								<h4 class="font-light text-white">
									Tipo de orden: <small class="text-white"><?= $nombreTipo;?></small>
								</h4>
							</div>
						</div>
					</div>
					<!-- Column -->
					<div class="col-lg-12 col-xlg-12 col-md-12">
						<div class="card">
							<div class="box <?= BG_BOX_INTERFACE;?> text-center">
								<h4 class="font-light text-white">
									Ubicaci&oacute;n: <small class="text-white"><?= $nombreMiembros;?></small>
								</h4>

							</div>
						</div>
					</div>
					<!-- Column -->
					<div class="col-lg-12 col-xlg-12 col-md-12">
						<div class="card">
							<div class="box <?= BG_BOX_INTERFACE;?> text-center">
								<h4 class="font-light text-white">
									Primer subnivel: <small class="text-white"><?= $nomPrimerSubNiv;?></small>
								</h4>

							</div>
						</div>
					</div>
				</div>
	                                
		                            <?php }?>
		        <div class="row">
					<div class="col-lg-12 col-xlg-12 col-md-12">
						<div class="card">
							<div class="box <?= BG_BOX_INTERFACE;?> text-center">
								<h4 class="font-light text-white">
									Producto: <small class="text-white"><?= $codigo." - ".$nombre;?></small>
								</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Column -->
	<div class="col-lg-8 col-xlg-9 col-md-7">
		<form class=" form-horizontal" role="form" action="<?= base_url()?>OrdersAppOrder/saveUserInformation" id="form_sample_3" method="post" 
		autocomplete="off" enctype="multipart/form-data">
			<div class="card">
				<div class="card-body">
	                                <h5 class="card-title"><i class="fa fa-user" aria-hidden="true"></i> Datos de contacto del usuario </h5>
	                                <br>
	                                
	                                <div class="form-group">
										<label class="col-md-12" for="telefono">Tel&eacute;fono* </label>
										<div class="col-md-12">
											<input class="form-control " type="text" name="telefono" id="telefono" placeholder="Ej. 4565656" value="<?= $telefono;?>"   />
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-12" for="telefono2">Tel&eacute;fono opcional</label>
										<div class="col-md-12">
											<input class="form-control " type="text" name="telefono2" id="telefono2" placeholder="Ej. 4565656" value="<?= $telefono2Limpio;?>"   />
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-12" for="direccion">Direcci&oacute;n*</label>
										<div class="col-md-12">
											<input class="form-control " type="text" name="direccion" id="direccion" placeholder="Ej. Carrera 12 25 - 24 Apartamento 502" value="<?= $direccion;?>"   />
										</div>
									</div>

									
	                                         
	                                <div class="form-group pais">
	                                        	<label class="col-md-12" for="departamento">Departamento* </label>
	                                            <div class="col-md-12">
	                                            	<select class="form-control" id="departamento" name="departamento">
	                                                            <option value="">--- Seleccione una opci&oacute;n ---</option>
	                                                            <?php foreach ($listaDepartamento->result() as $value) {
	                                                                            if($value->ID==$idDepartamento){
	                                                                                $selected="selected='selected'";
	                                                                            }else{
	                                                                                $selected="";
	                                                                            }    
	                                                            ?>
	                                                            <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option>
	                                                            <?php
	                                                            }?>
	                                                        </select>
	                                                <div class="form-control-feedback" > </div>
	                                            </div>
	                                </div>  
	                                <div class="form-group pais" >
	                                        	<label class="col-md-12" for="ciudad">Ciudad (Municipio)* </label>
	                                            <div class="col-md-12">
	                                            	<select class="form-control" id="ciudad" name="ciudad">
	                                                            <option value="">--- Seleccione una opci&oacute;n ---</option>
	                                                            <?php foreach ($listaCiudad->result() as $value) {
	                                                                        if($value->ID==$idMunicipio){
	                                                                            $selected="selected='selected'";
	                                                                        }else{
	                                                                            $selected="";
	                                                                        }
	                                                                        if($value->ID_DEPARTAMENTO==$idDepartamento){
	                                                            ?>
	                                                            <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option>
	                                                            <?php
	                                                            			}
	                                                            }?>
	                                                        </select>
	                                                <div class="form-control-feedback" > </div>
	                                            </div>
	                                </div> 
				</div>	
			</div>
			<a href="<?= base_url().'/MainApp/board'; ?>"
				class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10">
				<i class="fa fa-arrow-left"></i> <span class="hidden-xs"> Retornar</span>
			</a>
			<button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar </button>
			<input type="hidden" name="id" id="id" value="<?= $id;?>"> 
			<input type="hidden" name="idOrden" id="idOrden" value="<?= $idOrden;?>">
		</form>
	</div>
	

	<!-- Column -->
</div>
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->

<!-- Timeline CSS -->



