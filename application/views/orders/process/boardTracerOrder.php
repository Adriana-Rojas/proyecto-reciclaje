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

if ($listaLista != null) {
	// Si hay despiece
	$valida = true;
} else {
	$valida = false;
}


if ($paciente != null) {
	foreach ($paciente as $value) {
		$idResponsable = $value->ID_RESPONSABLE;
		//	$idEmpresaadriana = $value->ID_RESPONSABLEADRIANA;
		$idPaciente = $value->TP_ID_PCTE;
		$docPaciente = $value->NUM_ID_PCTE;
		$empresaResponsable = $value->RESPONSABLE;

		$identificacion = " " . $value->TP_ID_PCTE . " " . $value->NUM_ID_PCTE;
		$historia = $value->ID_PCTE;
		$nombres = $value->PRI_NOM_PCTE . " " . $value->SEG_NOM_PCTE . " " . $value->PRI_APELL_PCTE . " " . $value->SEG_APELL_PCTE;
		$sexo = $value->SEXO;
		$edad = $value->FECH_NCTO_PCTE;
	}
}

//Encabezado de la orden
$idEncOrden = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ORDEN", "ID_ENCORDEN", "ID", $idPinta);
$datos = selectPatienInformationFromOrder($idEncOrden, $this);

$responsable = $datos[0];
$telefono = $datos[1];
$telefono2 = $datos[2];
if ($datos[2] != '') {
	$telefono2 = " - " . $telefono2;
}
$direccion = $datos[3];
$municipio = $datos[4];
$ideps = $datos[7];
//echo "<script>console.log('NUM_ID_PCTE: " . $value->NUM_ID_PCTE . "' );</script>";
$correo = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "CORREO", "DOCUMENTO", $value->NUM_ID_PCTE));

$alida = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_CONTACTOUSUARIO", "ID_CONVENIO", "ID_ENCORDEN", $idEncOrden);
$alida = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_ALIADA", "EMPRESA", "ID", $alida);
$empresaAliadaNombre = " (" . $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_APB", "NOM_APB", "ID_APB", $alida) . " )";
$id_apb = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_APB", "ID_APB", "NOM_APB", "'NUEVA EPS S.A.'");
//echo 'idapb'.$id_apb;

?>
<!-- page css -->
<link href="<?= base_url() ?>assets/dist/css/pages/tab-page.css" rel="stylesheet">
<!-- Date Picker Plugin JavaScript -->
<script src="<?= base_url() ?>assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.es.min.js"></script>


<!-- ============================================================== -->
<!-- Start JavaScript para pintar campos adicionales -->
<!-- ============================================================== -->
<script type="text/javascript">
	$(document).ready(function() {
		// Date Picker
		jQuery('.datepicker').datepicker({
			autoclose: true,
			todayHighlight: true,
			format: '<?= DATE_FORMAT_EVOLUTION; ?>',
			language: 'es'
		});
	});
	// Traigo la informaci<?= LETRA_MIN_O ?>n de las observaciones por estado
	$(document).ready(function() {
		$("#estado").change(function() {
			$("#estado option:selected").each(function() {
				estado = $('#estado').val();
				$.post("<?= base_url() ?>Integration/reloadObservationKind", {
					estado: estado
				}, function(data) {
					$("#tipo").html(data);
				});
			});
		})
	});
	// Traigo la informaci<?= LETRA_MIN_O ?>n de los reprocesos por estado
	$(document).ready(function() {
		$("#estado").change(function() {
			$("#estado option:selected").each(function() {
				estado = $('#estado').val();
				idOrden = $('#idOrden').val();
				$.post("<?= base_url() ?>Integration/reloadStatesBackProcess", {
					estado: estado,
					idOrden: idOrden
				}, function(data) {
					$("#reproceso").html(data);
				});
			});
		})
	});

	// Traigo la informaci<?= LETRA_MIN_O ?>n si es permitido o no adjuntar archivos
	$(document).ready(function() {
		$("#estado").change(function() {
			$("#estado option:selected").each(function() {
				estado = $('#estado').val();
				$.post("<?= base_url() ?>Integration/reloadStateInformationAdd", {
					estado: estado
				}, function(data) {
					if (data == <?= CTE_VALOR_SI ?>) {
						$(".adjunto").prop('disabled', false);
						$(".adjunto").show();
					} else {
						$(".adjunto").prop('disabled', true);
						$(".adjunto").hide();
					}
				});
			});
		})
	});

	// Traigo la informaci<?= LETRA_MIN_O ?>n de tipo de observaci<?= LETRA_MIN_O ?>n
	$(document).ready(function() {
		$("#tipo").change(function() {
			$("#tipo option:selected").each(function() {
				tipo = $('#tipo').val();
				estado = $('#estado').val();
				$.post("<?= base_url() ?>Integration/reloadObservationStateInformation", {
					tipo: tipo,
					estado: estado
				}, function(data) {
					var tempo = data.split('|');
					//Acci<?= LETRA_MIN_O ?>n sobre el estado
					//alert(data);

					if (tempo[0] == <?= CTE_VALOR_SI ?>) {
						$(".accion").val('Cierra');
						$(".accion").show();

						//<?php //TODO 
							?> Campos adicional 1
						if (tempo[5] != <?= VALUE_STATE_NOT ?>) {
							if (tempo[5] == 57 || tempo[5] == 52 || tempo[5] == 51 || tempo[5] == 58) {
								valor = tempo[3] + " *";
							} else {
								valor = tempo[3];
							}
							$("#labelCampo1").html(valor);
							$(".campo1").show();


							if (tempo[4] == "L") {
								//Es una lista
								$("#listaCampo1").show();
								$("#listaCampo1").prop('disabled', false);
								$("#listaCampo1").html(tempo[6]);
								if (tempo[5] == 52) {
									$("#listaCampo1").prop('required', true);
								} else {
									$("#listaCampo1").prop('required', false);
								}
								// Inactivo y oculto otro tipo de campos
								$("#campo1").hide();
								$("#campo1").prop('disabled', true);
								$("#fecha1").hide();
								$("#fecha1").prop('disabled', true);
								$("#numero1").hide();
								$("#numero1").prop('disabled', true);

							} else if (tempo[4] == "T") {
								//Es un campo de texto	
								$("#campo1").show();
								$("#campo1").prop('disabled', false);
								if (tempo[5] == 51) {
									$("#campo1").prop('required', true);
								} else {
									$("#campo1").prop('required', false);
								}
								// Inactivo y oculto otro tipo de campos
								$("#listaCampo1").hide();
								$("#listaCampo1").prop('disabled', true);
								$("#fecha1").hide();
								$("#fecha1").prop('disabled', true);
								$("#numero1").hide();
								$("#numero1").prop('disabled', true);
							} else if (tempo[4] == "D") {
								//Es un campo de fecha
								$("#fecha1").show();
								$("#fecha1").prop('disabled', false);
								if (tempo[5] == 57) {
									$("#fecha1").prop('required', true);
								} else {
									$("#fecha1").prop('required', false);
								}
								// Inactivo y oculto otro tipo de campos
								$("#listaCampo1").hide();
								$("#listaCampo1").prop('disabled', true);
								$("#campo1").hide();
								$("#campo1").prop('disabled', true);
								$("#numero1").hide();
								$("#numero1").prop('disabled', true);
							} else if (tempo[4] == "N") {
								//Es un campo de n�mero
								$("#numero1").show();
								$("#numero1").prop('disabled', false);
								if (tempo[5] == 58) {
									$("#numero1").prop('required', true);
								} else {
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
						} else {
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
						//<?php //TODO 
							?> Campos adicional 2
						if (tempo[9] != <?= VALUE_STATE_NOT ?>) {
							if (tempo[9] == 57 || tempo[9] == 52 || tempo[9] == 51 || tempo[9] == 58) {
								valor = tempo[7] + " *";
							} else {
								valor = tempo[7];
							}
							$("#labelCampo2").html(valor);
							$(".campo2").show();

							//alert(tempo)
							if (tempo[8] == "L") {
								//Es una lista
								$("#listaCampo2").show();
								$("#listaCampo2").prop('disabled', false);
								$("#listaCampo2").html(tempo[10]);
								if (tempo[9] == 52) {
									$("#listaCampo2").prop('required', true);
								} else {
									$("#listaCampo2").prop('required', false);
								}
								// Inactivo y oculto otro tipo de campos
								$("#campo2").hide();
								$("#campo2").prop('disabled', true);
								$("#fecha2").hide();
								$("#fecha2").prop('disabled', true);
								$("#numero2").hide();
								$("#numero2").prop('disabled', true);

							} else if (tempo[8] == "T") {
								//Es un campo de texto	
								$("#campo2").show();
								$("#campo2").prop('disabled', false);
								if (tempo[9] == 51) {
									$("#campo2").prop('required', true);
								} else {
									$("#campo2").prop('required', false);
								}
								// Inactivo y oculto otro tipo de campos
								$("#listaCampo2").hide();
								$("#listaCampo2").prop('disabled', true);
								$("#fecha2").hide();
								$("#fecha2").prop('disabled', true);
								$("#numero2").hide();
								$("#numero2").prop('disabled', true);
							} else if (tempo[8] == "D") {
								//Es un campo de fecha
								$("#fecha2").show();
								$("#fecha2").prop('disabled', false);
								if (tempo[9] == 57) {
									$("#fecha2").prop('required', true);
								} else {
									$("#fecha2").prop('required', false);
								}
								// Inactivo y oculto otro tipo de campos
								$("#listaCampo2").hide();
								$("#listaCampo2").prop('disabled', true);
								$("#campo2").hide();
								$("#campo2").prop('disabled', true);
								$("#numero2").hide();
								$("#numero2").prop('disabled', true);
							} else if (tempo[8] == "N") {
								//Es un campo de n�mero
								$("#numero2").show();
								$("#numero2").prop('disabled', false);
								if (tempo[9] == 58) {
									$("#numero2").prop('required', true);
								} else {
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
						} else {
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
						//<?php //TODO 
							?> Campos adicional 3
						if (tempo[13] != <?= VALUE_STATE_NOT ?>) {
							if (tempo[13] == 57 || tempo[13] == 52 || tempo[13] == 51 || tempo[13] == 58) {
								valor = tempo[11] + " *";
							} else {
								valor = tempo[11];
							}
							$("#labelCampo3").html(valor);
							$(".campo3").show();


							if (tempo[12] == "L") {
								//Es una lista
								$("#listaCampo3").show();
								$("#listaCampo3").prop('disabled', false);
								$("#listaCampo3").html(tempo[14]);
								if (tempo[13] == 52) {
									$("#listaCampo3").prop('required', true);
								} else {
									$("#listaCampo3").prop('required', false);
								}
								// Inactivo y oculto otro tipo de campos
								$("#campo3").hide();
								$("#campo3").prop('disabled', true);
								$("#fecha3").hide();
								$("#fecha3").prop('disabled', true);
								$("#numero3").hide();
								$("#numero3").prop('disabled', true);

							} else if (tempo[12] == "T") {
								//Es un campo de texto	
								$("#campo3").show();
								$("#campo3").prop('disabled', false);
								if (tempo[13] == 51) {
									$("#campo3").prop('required', true);
								} else {
									$("#campo3").prop('required', false);
								}
								// Inactivo y oculto otro tipo de campos
								$("#listaCampo3").hide();
								$("#listaCampo3").prop('disabled', true);
								$("#fecha3").hide();
								$("#fecha3").prop('disabled', true);
								$("#numero3").hide();
								$("#numero3").prop('disabled', true);
							} else if (tempo[12] == "D") {
								//Es un campo de fecha
								$("#fecha3").show();
								$("#fecha3").prop('disabled', false);
								if (tempo[13] == 57) {
									$("#fecha3").prop('required', true);
								} else {
									$("#fecha3").prop('required', false);
								}
								// Inactivo y oculto otro tipo de campos
								$("#listaCampo3").hide();
								$("#listaCampo3").prop('disabled', true);
								$("#campo3").hide();
								$("#campo3").prop('disabled', true);
								$("#numero3").hide();
								$("#numero3").prop('disabled', true);
							} else if (tempo[12] == "N") {
								//Es un campo de n�mero
								$("#numero3").show();
								$("#numero3").prop('disabled', false);
								if (tempo[13] == 58) {
									$("#numero3").prop('required', true);
								} else {
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
						} else {
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

						//<?php //TODO 
							?> Campos adicional 4
						if (tempo[17] != <?= VALUE_STATE_NOT ?>) {
							if (tempo[17] == 57 || tempo[17] == 52 || tempo[17] == 51 || tempo[17] == 58) {
								valor = tempo[15] + " *";
							} else {
								valor = tempo[15];
							}
							$("#labelCampo4").html(valor);
							$(".campo4").show();


							if (tempo[16] == "L") {
								//Es una lista
								$("#listaCampo4").show();
								$("#listaCampo4").prop('disabled', false);
								$("#listaCampo4").html(tempo[18]);
								if (tempo[17] == 52) {
									$("#listaCampo4").prop('required', true);
								} else {
									$("#listaCampo4").prop('required', false);
								}
								// Inactivo y oculto otro tipo de campos
								$("#campo4").hide();
								$("#campo4").prop('disabled', true);
								$("#fecha4").hide();
								$("#fecha4").prop('disabled', true);
								$("#numero4").hide();
								$("#numero4").prop('disabled', true);

							} else if (tempo[16] == "T") {
								//Es un campo de texto	
								$("#campo4").show();
								$("#campo4").prop('disabled', false);
								if (tempo[17] == 51) {
									$("#campo4").prop('required', true);
								} else {
									$("#campo4").prop('required', false);
								}
								// Inactivo y oculto otro tipo de campos
								$("#listaCampo4").hide();
								$("#listaCampo4").prop('disabled', true);
								$("#fecha4").hide();
								$("#fecha4").prop('disabled', true);
								$("#numero4").hide();
								$("#numero4").prop('disabled', true);
							} else if (tempo[16] == "D") {
								//Es un campo de fecha
								$("#fecha4").show();
								$("#fecha4").prop('disabled', false);
								if (tempo[17] == 57) {
									$("#fecha4").prop('required', true);
								} else {
									$("#fecha4").prop('required', false);
								}
								// Inactivo y oculto otro tipo de campos
								$("#listaCampo4").hide();
								$("#listaCampo4").prop('disabled', true);
								$("#campo4").hide();
								$("#campo4").prop('disabled', true);
								$("#numero4").hide();
								$("#numero4").prop('disabled', true);
							} else if (tempo[16] == "N") {
								//Es un campo de n�mero
								$("#numero4").show();
								$("#numero4").prop('disabled', false);
								if (tempo[17] == 58) {
									$("#numero4").prop('required', true);
								} else {
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
						} else {
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

						//<?php //TODO 
							?> Campos adicional 5
						if (tempo[21] != <?= VALUE_STATE_NOT ?>) {
							if (tempo[21] == 57 || tempo[21] == 52 || tempo[21] == 51 || tempo[21] == 58) {
								valor = tempo[19] + " *";
							} else {
								valor = tempo[19];
							}
							$("#labelCampo5").html(valor);
							$(".campo5").show();


							if (tempo[20] == "L") {
								//Es una lista
								$("#listaCampo5").show();
								$("#listaCampo5").prop('disabled', false);
								$("#listaCampo5").html(tempo[22]);
								if (tempo[21] == 52) {
									$("#listaCampo5").prop('required', true);
								} else {
									$("#listaCampo5").prop('required', false);
								}
								// Inactivo y oculto otro tipo de campos
								$("#campo5").hide();
								$("#campo5").prop('disabled', true);
								$("#fecha5").hide();
								$("#fecha5").prop('disabled', true);
								$("#numero5").hide();
								$("#numero5").prop('disabled', true);

							} else if (tempo[20] == "T") {
								//Es un campo de texto	
								$("#campo5").show();
								$("#campo5").prop('disabled', false);
								if (tempo[21] == 51) {
									$("#campo5").prop('required', true);
								} else {
									$("#campo5").prop('required', false);
								}
								// Inactivo y oculto otro tipo de campos
								$("#listaCampo5").hide();
								$("#listaCampo5").prop('disabled', true);
								$("#fecha5").hide();
								$("#fecha5").prop('disabled', true);
								$("#numero5").hide();
								$("#numero5").prop('disabled', true);
							} else if (tempo[20] == "D") {
								//Es un campo de fecha
								$("#fecha5").show();
								$("#fecha5").prop('disabled', false);
								if (tempo[21] == 57) {
									$("#fecha5").prop('required', true);
								} else {
									$("#fecha5").prop('required', false);
								}
								// Inactivo y oculto otro tipo de campos
								$("#listaCampo5").hide();
								$("#listaCampo5").prop('disabled', true);
								$("#campo5").hide();
								$("#campo5").prop('disabled', true);
								$("#numero5").hide();
								$("#numero5").prop('disabled', true);
							} else if (tempo[20] == "N") {
								//Es un campo de n�mero
								$("#numero5").show();
								$("#numero5").prop('disabled', false);
								if (tempo[21] == 59) {
									$("#numero5").prop('required', true);
								} else {
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
						} else {
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


					} else {
						$(".accion").val('Contin<?= LETRA_MIN_U ?>a abierto');
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
					if (tempo[1] == <?= CTE_VALOR_PROCESO ?>) {
						$(".tipoObs").val('Proceso Normal');
						$(".tipoObs").show();
						$(".reproceso").hide();
						$("#reproceso").prop('disabled', true);
					} else {
						$(".tipoObs").val('Reproceso');
						$(".tipoObs").show();
						$(".reproceso").show();
						$("#reproceso").prop('disabled', false);

					}
					// Modifica despiece
					if (tempo[2] == <?= CTE_VALOR_NO ?>) {
						$(".despiece").hide();
						$("#despiece").prop('disabled', true);
					} else {
						$(".despiece").show();
						$("#despiece").prop('disabled', false);

					}
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
					<h3><i class="<?= datosGeneroPersona($sexo, 'CLASE', 'fa-1x') ?>"><?= datosGeneroPersona($sexo, 'NOMBRE', 'fa-1x') ?> </i> Datos del usuario </h3>
					<br>

				</div>
				<div class="row">
					<p class="text-muted"><strong>Documento de identidad: </strong> <?= $identificacion; ?></p>
				</div>
				<div class="row">
					<p class="text-muted"><strong>Historia: </strong> <?= $historia; ?></p>
				</div>
				<div class="row">
					<p class="text-muted">

						<strong>Nombres: </strong><?= $nombres; ?>
					</p>
				</div>

				<div class="row">
					<p class="text-muted">

						<strong>Edad: </strong><?= intervaloTiempo($edad, cambiaHoraServer(2), 31104000); ?> A&ntilde;os
					</p>
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
					<p class="text-muted"><strong>Entidad Responsable: </strong> <?= $responsable; ?></p>
				</div>
				<div class="row">
					<p class="text-muted"><strong>Cotizaci&oacute;n: </strong> <?= $numeroCotizacion; ?></p>

				</div>
				<div class="row">
					<p class="text-muted">

						<strong>Autorizaci&oacute;n: </strong><?= $numeroAutorizacion; ?>
					</p>
				</div>
				<div class="row">
					<p class="text-muted">

						<strong>Fecha de autorizaci&oacute;n: </strong><?= $fechaAutorizacion; ?>
					</p>
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
					<p class="text-muted"><strong>Tel&eacute;fonos de contacto: </strong> <?= $telefono; ?> <?= $telefono2; ?></p>
				</div>
				<div class="row">
					<p class="text-muted"><strong>Direcci&oacute;n: </strong> <?= $direccion; ?></p>
				</div>
				<div class="row">
					<p class="text-muted">

						<strong>Municipio: </strong><?= $municipio; ?>
					</p>
				</div>
				<div class="row">
					<p class="text-muted">

						<strong>Correo electr&oacute;nico: </strong><?= $correo; ?>
					</p>
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
								<h4 class="m-b-0 text-white">Tipo de proceso: <?= $tipoProceso; ?> <?= $empresaAliadaNombre; ?> </h4>
							</div>
							<BR>
							<div class="card-header bg-dark">
								<h4 class="m-b-0 text-white"><?= $ordenNumero; ?> <i class="fa fa-angle-double-right"></i> Estado(s) actual(es) <i class="fa fa-angle-double-right"></i> <?= paintActualState($this, $idPinta); ?></h4>
							</div>
							<div class="card-body">
								<h5>
									<b> <i class="fa fa-thermometer-full fa-2x"></i> Avance del
										proceso de atenci&oacute;n
									</b> <span class="pull-right">
										<?= calculoPorcentajeOrden($estadosDefinidos, $estadosEjecutados); ?> %
									</span>
								</h5>
								<br>
								<div class="progress ">
									<div class="progress-bar <?= colorPorcentajeOrden(calculoPorcentajeOrden($estadosDefinidos, $estadosEjecutados)); ?> wow animated progress-animated" style="width: <?= calculoPorcentajeOrden($estadosDefinidos, $estadosEjecutados); ?>%; height:20px;" role="progressbar">
										<span class="sr-only"><?= calculoPorcentajeOrden($estadosDefinidos, $estadosEjecutados); ?>% Completado</span>
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
								<div class="box <?= BG_BOX_INTERFACE; ?> text-center">
									<h4 class="font-light text-white">
										Tipo de orden: <small class="text-white"><?= $nombreTipo; ?></small>
									</h4>
								</div>
							</div>
						</div>
						<!-- Column -->
						<div class="col-lg-12 col-xlg-12 col-md-12">
							<div class="card">
								<div class="box <?= BG_BOX_INTERFACE; ?> text-center">
									<h4 class="font-light text-white">
										Ubicaci&oacute;n: <small class="text-white"><?= $nombreMiembros; ?></small>
									</h4>

								</div>
							</div>
						</div>
						<!-- Column -->
						<div class="col-lg-12 col-xlg-12 col-md-12">
							<div class="card">
								<div class="box <?= BG_BOX_INTERFACE; ?> text-center">
									<h4 class="font-light text-white">
										Primer subnivel: <small class="text-white"><?= $nomPrimerSubNiv; ?></small>
									</h4>

								</div>
							</div>
						</div>

						<!-- Column -->
						<div class="col-lg-12 col-xlg-12 col-md-12">
							<div class="card">
								<div class="box <?= BG_BOX_INTERFACE; ?> text-center">
									<h4 class="font-light text-white">
										Segundo subnivel: <small class="text-white"><?= $nomSegundoSubNiv; ?></small>
									</h4>

								</div>
							</div>
						</div>

						<!-- Column -->
						<div class="col-lg-12 col-xlg-12 col-md-12">
							<div class="card">
								<div class="box <?= BG_BOX_INTERFACE; ?> text-center">
									<h4 class="font-light text-white">
										Tercer subnivel: <small class="text-white"><?= $nomTerceroSubNiv; ?></small>
									</h4>

								</div>
							</div>
						</div>



					</div>
				<?php } ?>
				<?php

				if ($niveles == 2) {
				?>
					<div class="row">
						<div class="col-lg-12 col-xlg-12 col-md-12">
							<div class="card">
								<div class="box <?= BG_BOX_INTERFACE; ?> text-center">
									<h4 class="font-light text-white">
										Tipo de orden: <small class="text-white"><?= $nombreTipo; ?></small>
									</h4>
								</div>
							</div>
						</div>
						<!-- Column -->
						<div class="col-lg-12 col-xlg-12 col-md-12">
							<div class="card">
								<div class="box <?= BG_BOX_INTERFACE; ?> text-center">
									<h4 class="font-light text-white">
										Ubicaci&oacute;n: <small class="text-white"><?= $nombreMiembros; ?></small>
									</h4>

								</div>
							</div>
						</div>
						<!-- Column -->
						<div class="col-lg-12 col-xlg-12 col-md-12">
							<div class="card">
								<div class="box <?= BG_BOX_INTERFACE; ?> text-center">
									<h4 class="font-light text-white">
										Primer subnivel: <small class="text-white"><?= $nomPrimerSubNiv; ?></small>
									</h4>

								</div>
							</div>
						</div>

						<!-- Column -->
						<div class="col-lg-12 col-xlg-12 col-md-12">
							<div class="card">
								<div class="box <?= BG_BOX_INTERFACE; ?> text-center">
									<h4 class="font-light text-white">
										Segundo subnivel: <small class="text-white"><?= $nomSegundoSubNiv; ?></small>
									</h4>

								</div>
							</div>
						</div>

					</div>
				<?php } ?>
				<?php

				if ($niveles == 1) {
				?>
					<div class="row">
						<div class="col-lg-12 col-xlg-12 col-md-12">
							<div class="card">
								<div class="box <?= BG_BOX_INTERFACE; ?> text-center">
									<h4 class="font-light text-white">
										Tipo de orden: <small class="text-white"><?= $nombreTipo; ?></small>
									</h4>
								</div>
							</div>
						</div>
						<!-- Column -->
						<div class="col-lg-12 col-xlg-12 col-md-12">
							<div class="card">
								<div class="box <?= BG_BOX_INTERFACE; ?> text-center">
									<h4 class="font-light text-white">
										Ubicaci&oacute;n: <small class="text-white"><?= $nombreMiembros; ?></small>
									</h4>

								</div>
							</div>
						</div>
						<!-- Column -->
						<div class="col-lg-12 col-xlg-12 col-md-12">
							<div class="card">
								<div class="box <?= BG_BOX_INTERFACE; ?> text-center">
									<h4 class="font-light text-white">
										Primer subnivel: <small class="text-white"><?= $nomPrimerSubNiv; ?></small>
									</h4>

								</div>
							</div>
						</div>



					</div>

				<?php } ?>
				<div class="row">
					<div class="col-lg-12 col-xlg-12 col-md-12">
						<div class="card">
							<div class="box <?= BG_BOX_INTERFACE; ?> text-center">
								<h4 class="font-light text-white">
									Producto: <small class="text-white"><?= $codigo . " - " . $nombre; ?></small>
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
		<div class="card">
			<div class="card-body p-b-0">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs customtab2" role="tablist">
					<?php if ($listadoEstados != null) { ?>
						<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"><i class="fa fa-home"></i></span> <span class="hidden-xs-down">Seguimiento</span></a></li>
						<?php
					} else {
						if ($listadoSuspender != null) {
						?>
							<li class="nav-item"><a class="nav-link " data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"><i class="fa fa-home"></i> <i class="fa fa-hand-o-left "></i></span> <span class="hidden-xs-down">Retomar Seguimiento</span></a></li>
					<?php
						}
					}
					?>
					<li class="nav-item"><a class="nav-link <?php if ($listadoEstados != null) {
																if (count($listadoEstados) == 0) { ?>active <?php }
																									} ?>" data-toggle="tab" href="#history" role="tab"><span class="hidden-sm-up"><i class="fa fa-history"></i></span> <span class="hidden-xs-down">Hist&oacute;rico</span></a></li>
					<!--  <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#documents" role="tab"><span class="hidden-sm-up"><i class="fa fa-book"></i></span> <span class="hidden-xs-down">Documentos</span></a> </li> -->
					<?php if ($valida) { ?>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#elements" role="tab"><span class="hidden-sm-up"><i class="fa fa-american-sign-language-interpreting"></i></span> <span class="hidden-xs-down">Despiece</span></a></li>
					<?php } ?>
					<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#team" role="tab"><span class="hidden-sm-up"><i class="fa fa-users"></i></span> <span class="hidden-xs-down">Equipo</span></a></li>
					<?php
					if ($perfilDefinido != '') {
					?>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#bitacora" role="tab"><span class="hidden-sm-up"><i class="fa fa-book "></i></span> <span class="hidden-xs-down">Bitacora</span></a></li>
					<?php
					}
					?>
					<?php
					//if ($idResponsable == NEPS) {
					?>
					<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#cotizacion" role="tab"><span class="hidden-sm-up"><i class="fa fa-usd "></i></span> <span class="hidden-xs-down">Relacionar cotizaci&oacute;n</span></a></li>
					<?php
					//	}
					?>



				</ul>
				<!-- Tab panes -->
				<div class="tab-content">
					<?php if ($listadoEstados != null) { ?>
						<div class="tab-pane active" id="home" role="tabpanel">
							<!-- Contenido del tab -->
							<form class=" form-horizontal" role="form" action="<?= base_url() ?>OrdersAppOrder/saveTraceOrder" id="form_sample_3" method="post" autocomplete="off" enctype="multipart/form-data">
								<div class="p-20">
									<h3>Realizar seguUimiento.</h3>
									<p align="justify">Genere el seguimiento a la orden de acuerdo
										al estado y perfil de usuario.</p>
								</div>
								<div class="card">
									<div class="card-body">
										<div class="form-group ">
											<label class="col-md-12" for="estado">Estado *</label>
											<div class="col-md-12">
												<select class="form-control" id="estado" name="estado">
													<option value="">--- Seleccione una opci&oacute;n ---</option>
													<?php
													if ($listadoEstados != NULL) {
														foreach ($listadoEstados as $value) {

													?>
															<option value="<?= $value->ID_ESTADO; ?>"><?= $value->NOMBRE; ?></option>
															<?php
															echo "<script>console.log('codigo2: " . $value->NOMBRE  . "' );</script>";
															?>
													<?php
														}
													}
													?>
												</select>
												<div class="form-control-feedback"></div>
											</div>
										</div>
								
										<div class="form-group ">
											<label class="col-md-12" for="tipo">Observaci&oacute;n *</label>
											<div class="col-md-12">
												<select class="form-control" id="tipo" name="tipo">
													<option value="">--- Seleccione una opci&oacute;n ---</option>

												</select>
												<div class="form-control-feedback"></div>
											</div>
										</div>

										<div class="form-group tipoObs" style="display: none;">
											<label class="col-md-12" for="tipoObs">Clasificaci&oacute;n
												observaci&oacute;n *</label>
											<div class="col-md-12">
												<input type="text" class="form-control tipoObs" id="tipoObs" name="tipoObs" disabled="disabled">
												<div class="form-control-feedback"></div>
											</div>
										</div>
										<div class="form-group accion" style="display: none;">
											<label class="col-md-12" for="proceso">Accci&oacute;n sobre el
												proceso *</label>
											<div class="col-md-12">
												<input type="text" class="form-control accion" id="proceso" name="proceso" disabled="disabled">
												<div class="form-control-feedback"></div>
											</div>
										</div>
										<div class="form-group reproceso" style="display: none;">
											<label class="col-md-12" for="reproceso">Estado reproceso *</label>
											<div class="col-md-12">
												<select class="form-control reproceso" id="reproceso" name="reproceso" disabled="disabled">
													<option value="">--- Seleccione una opci&oacute;n ---</option>

												</select>
												<div class="form-control-feedback"></div>
											</div>
										</div>
										<div class="form-group despiece" style="display: none;">
											<label class="col-md-12" for="despiece">Desea realizar
												modificaci&oacute;n al despice *</label>
											<div class="col-md-12">
												<select class="form-control despiece" id="despiece" name="despiece" disabled="disabled">
													<option value="">--- Seleccione una opci&oacute;n ---</option>
													<?php

													foreach ($listaSiNo as $value) {

													?>
														<option value="<?= $value->ID; ?>"><?= $value->NOMBRE; ?></option>
													<?php
													}
													?>
												</select>
												<div class="form-control-feedback"></div>
											</div>
										</div>
										<div class="form-group adjunto" style="display: none;">
											<?php
											echo "<script>console.log('codigo2" . paintActualState($this, $idPinta)  . "codigo2' );</script>";
											if (paintActualState($this, $idPinta) == 'TOMAR MOLDE <BR>') {
												if ($nivel == 'TRANSFEMORAL ') {
											?>
													<a href="<?= base_url() . STOKEPRICE_FOLDER . 'FOT-07-35.xlsx'; ?>" target="_blank" class="btn  btn-info btn-rounded pull-left waves-effect waves-light m-r-10">
														<i class="fa fa-paperclip "></i> <span class="hidden-xs"> TM Protesis TRANSFEMORAL</span>
													</a>
												<?php
												}
												if ($nivel == 'TRANSTIBIAL') {
												?>
													<a href="<?= base_url() . STOKEPRICE_FOLDER . 'FO-07-36.xlsx'; ?>" target="_blank" class="btn  btn-info btn-rounded pull-left waves-effect waves-light m-r-10">
														<i class="fa fa-paperclip "></i> <span class="hidden-xs"> TM Protesis TRANSTIBIAL</span>
													</a>
												<?php
												}
												if ($nivel == 'TRANSHUMERAL') {
												?>
													<a href="<?= base_url() . STOKEPRICE_FOLDER . 'FOT-07-31.xlsx'; ?>" target="_blank" class="btn  btn-info btn-rounded pull-left waves-effect waves-light m-r-10">
														<i class="fa fa-paperclip "></i> <span class="hidden-xs"> TM Protesis TRANSHUMERAL</span>
													</a>
												<?php
												}
												if ($nivel == 'A TRAVÉS DE CADERA') {
												?>
													<a href="<?= base_url() . STOKEPRICE_FOLDER . 'FOT-07-32X.xlsx'; ?>" target="_blank" class="btn  btn-info btn-rounded pull-left waves-effect waves-light m-r-10">
														<i class="fa fa-paperclip "></i> <span class="hidden-xs"> TM Protesis A TRAVÉS DE CADERA</span>
													</a>
												<?php
												}
												if ($nivel == 'TRANSRADIAL ') {
												?>
													<a href="<?= base_url() . STOKEPRICE_FOLDER . 'FOT-07-32.xlsx'; ?>" target="_blank" class="btn  btn-info btn-rounded pull-left waves-effect waves-light m-r-10">
														<i class="fa fa-paperclip "></i> <span class="hidden-xs"> TM Protesis TRANSRADIAL</span>
													</a>
												<?php
												}
												if ($nivel == 'PIE - TOBILLO') {
												?>
													<a href="<?= base_url() . STOKEPRICE_FOLDER . 'FO-07-38.xlsx'; ?>" target="_blank" class="btn  btn-info btn-rounded pull-left waves-effect waves-light m-r-10">
														<i class="fa fa-paperclip "></i> <span class="hidden-xs"> TM Protesis PIE - TOBILLO</span>
													</a>
												<?php
												}
												if ($nivel == 'RODILLA, TOBILLO Y PIE' || $nivel == 'CADERA, RODILLA, TOBILLO Y PIE') {
												?>
													<a href="<?= base_url() . STOKEPRICE_FOLDER . 'FO-07-40.xlsx'; ?>" target="_blank" class="btn  btn-info btn-rounded pull-left waves-effect waves-light m-r-10">
														<i class="fa fa-paperclip "></i> <span class="hidden-xs"> TM Protesis RODILLA, TOBILLO Y PIE</span>
													</a>
												<?php
												}
												if ($nivel == 'PARCIAL DE MANO ') {
												?>
													<a href="<?= base_url() . STOKEPRICE_FOLDER . 'FO-07-45.xlsx'; ?>" target="_blank" class="btn  btn-info btn-rounded pull-left waves-effect waves-light m-r-10">
														<i class="fa fa-paperclip "></i> <span class="hidden-xs"> TM Protesis PARCIAL DE MANO</span>
													</a>
												<?php
												}
												if ($nivel == 'COLUMNA') {
												?>
													<a href="<?= base_url() . STOKEPRICE_FOLDER . 'FO-07-39.xlsx'; ?>" target="_blank" class="btn  btn-info btn-rounded pull-left waves-effect waves-light m-r-10">
														<i class="fa fa-paperclip "></i> <span class="hidden-xs"> TM Protesis COLUMNA</span>
													</a>
												<?php
												}
												if ($nivel == 'CADERA') {
												?>
													<a href="<?= base_url() . STOKEPRICE_FOLDER . 'FO-07-43.xlsx'; ?>" target="_blank" class="btn  btn-info btn-rounded pull-left waves-effect waves-light m-r-10">
														<i class="fa fa-paperclip "></i> <span class="hidden-xs"> TM Protesis CADERA</span>
													</a>
											<?php
												}
											}
											?>
											<label class="col-md-12" for="adjunto">Adjunto </label>
											<div class="col-md-12">
												<input type="file" class="form-control adjunto" id="adjunto" name="adjunto" disabled="disabled">
												<div class="form-control-feedback"></div>
											</div>
										</div>
										<!-- Campos adicionales -->
										<?php //TODO para campo1
										?>
										<div class="form-group campo1" style="display: none;">
											<label class="col-md-12" id="labelCampo1">Campo 1 *</label>
											<div class="col-md-12">
												<select class="form-control " id="listaCampo1" name="listaCampo1" disabled="disabled" style="display: none;">
													<option value="">--- Seleccione una opci&oacute;n ---</option>
												</select>
												<input type="text" class="form-control " id="campo1" name="campo1" disabled="disabled" style="display: none;" placeholder="Escriba aqu&iacute; un descripci&oacute;n corta">

												<input type="text" class="form-control datepicker" id="fecha1" name="fecha1" disabled="disabled" style="display: none;" placeholder="aaaa/mm/dd">

												<input type="number" class="form-control " id="numero1" name="numero1" disabled="disabled" min="0" style="display: none;" placeholder="Ej 1000">

												<div class="form-control-feedback"></div>
											</div>
										</div>

										<?php //TODO para campo2
										?>
										<div class="form-group campo2" style="display: none;">
											<label class="col-md-12" id="labelCampo2">Campo 2 *</label>
											<div class="col-md-12">
												<select class="form-control " id="listaCampo2" name="listaCampo2" disabled="disabled" style="display: none;">
													<option value="">--- Seleccione una opci&oacute;n ---</option>
												</select>
												<input type="text" class="form-control " id="campo2" name="campo2" disabled="disabled" style="display: none;" placeholder="Escriba aqu&iacute; un descripci&oacute;n corta">

												<input type="text" class="form-control datepicker" id="fecha2" name="fecha2" disabled="disabled" style="display: none;" placeholder="aaaa/mm/dd">

												<input type="number" class="form-control " id="numero2" name="numero2" disabled="disabled" min="0" style="display: none;" placeholder="Ej 1000">

												<div class="form-control-feedback"></div>
											</div>
										</div>

										<?php //TODO para campo3
										?>
										<div class="form-group campo3" style="display: none;">
											<label class="col-md-12" id="labelCampo3">Campo 3 *</label>
											<div class="col-md-12">
												<select class="form-control " id="listaCampo3" name="listaCampo3" disabled="disabled" style="display: none;">
													<option value="">--- Seleccione una opci&oacute;n ---</option>
												</select>
												<input type="text" class="form-control " id="campo3" name="campo3" disabled="disabled" style="display: none;" placeholder="Escriba aqu&iacute; un descripci&oacute;n corta">

												<input type="text" class="form-control datepicker" id="fecha3" name="fecha3" disabled="disabled" style="display: none;" placeholder="aaaa/mm/dd">

												<input type="number" class="form-control " id="numero3" name="numero3" disabled="disabled" min="0" style="display: none;" placeholder="Ej 1000">

												<div class="form-control-feedback"></div>
											</div>
										</div>

										<?php //TODO para campo4
										?>
										<div class="form-group campo4" style="display: none;">
											<label class="col-md-12" id="labelCampo4">Campo 4 *</label>
											<div class="col-md-12">
												<select class="form-control " id="listaCampo4" name="listaCampo4" disabled="disabled" style="display: none;">
													<option value="">--- Seleccione una opci&oacute;n ---</option>
												</select>
												<input type="text" class="form-control " id="campo4" name="campo4" disabled="disabled" style="display: none;" placeholder="Escriba aqu&iacute; un descripci&oacute;n corta">

												<input type="text" class="form-control datepicker" id="fecha4" name="fecha4" disabled="disabled" style="display: none;" placeholder="aaaa/mm/dd">

												<input type="number" class="form-control " id="numero4" name="numero4" disabled="disabled" min="0" style="display: none;" placeholder="Ej 1000">

												<div class="form-control-feedback"></div>
											</div>
										</div>

										<?php //TODO para campo5
										?>
										<div class="form-group campo5" style="display: none;">
											<label class="col-md-12" id="labelCampo5">Campo 5 *</label>
											<div class="col-md-12">
												<select class="form-control " id="listaCampo5" name="listaCampo5" disabled="disabled" style="display: none;">
													<option value="">--- Seleccione una opci&oacute;n ---</option>
												</select>
												<input type="text" class="form-control " id="campo5" name="campo5" disabled="disabled" style="display: none;" placeholder="Escriba aqu&iacute; un descripci&oacute;n corta">

												<input type="text" class="form-control datepicker" id="fecha5" name="fecha5" disabled="disabled" style="display: none;" placeholder="aaaa/mm/dd">

												<input type="number" class="form-control " id="numero5" name="numero5" disabled="disabled" min="0" style="display: none;" placeholder="Ej 1000">

												<div class="form-control-feedback"></div>
											</div>
										</div>

										<!-- Fin Campos adicionales -->

										<div class="form-group ">
											<label class="col-md-12" for="observacion">Justificaci&oacute;n
												de la observaci&oacute;n *</label>
											<div class="col-md-12">
												<textarea rows="5" class="form-control" cols="" id="observacion" name="observacion" placeholder="Realice la justificaci&oacute;n de la observaci&oacute;n de seguimiento"></textarea>
												<div class="form-control-feedback"></div>
											</div>
										</div>

										<button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>

										<input type="hidden" name="id" id="id" value="<?= $id; ?>"> <input type="hidden" name="idOrden" id="idOrden" value="<?= $idOrden; ?>">

									</div>
								</div>
							</form>
							<!-- Contenido del tab -->
						</div>
						<?php
					} else {
						if ($listadoSuspender != null) {
						?>
							<div class="tab-pane " id="home" role="tabpanel">
								<!-- Contenido del tab -->
								<form class=" form-horizontal" role="form" action="<?= base_url() ?>OrdersAppOrder/saveTraceOrder" id="form_sample_3" method="post" autocomplete="off" enctype="multipart/form-data">
									<div class="p-20">
										<h3>Realizar seguimiento.</h3>
										<p align="justify">Genere el seguimiento a la orden de acuerdo
											con el estado y perfil de usuario.</p>
									</div>
									<div class="card">
										<div class="card-body">
											<div class="form-group ">
												<label class="col-md-12" for="estado">Estado *</label>
												<div class="col-md-12">
													<select class="form-control" id="estado" name="estado">
														<?php
														if ($listadoSuspender != null) {
															foreach ($listadoSuspender as $value) {
														?>
																<option value="<?= $value->ID_ESTADO; ?>"><?= $value->NOMBRE; ?></option>
														<?php
															}
														}
														?>
													</select>
													<div class="form-control-feedback"></div>
												</div>
											</div>
											<div class="form-group ">
												<label class="col-md-12" for="tipo">Observaci&oacute;n *</label>
												<div class="col-md-12">
													<select class="form-control" id="tipo" name="tipo">
														<option value="<?= $idSuspend; ?>"><?= $nombreSuspend; ?></option>

													</select>
													<div class="form-control-feedback"></div>
												</div>
											</div>
											<div class="form-group tipoObs" style="display: none;">
												<label class="col-md-12" for="tipoObs">Clasificaci&oacute;n
													observaci&oacute;n *</label>
												<div class="col-md-12">
													<input type="text" class="form-control tipoObs" id="tipoObs" name="tipoObs" disabled="disabled">
													<div class="form-control-feedback"></div>
												</div>
											</div>
											<div class="form-group accion" style="display: none;">
												<label class="col-md-12" for="proceso">Acci&oacute;n sobre el
													proceso *</label>
												<div class="col-md-12">
													<input type="text" class="form-control accion" id="proceso" name="proceso" disabled="disabled">
													<div class="form-control-feedback"></div>
												</div>
											</div>
											<div class="form-group reproceso" style="display: none;">
												<label class="col-md-12" for="reproceso">Estado reproceso *</label>
												<div class="col-md-12">
													<select class="form-control reproceso" id="reproceso" name="reproceso" disabled="disabled">
														<option value="">--- Seleccione una opci&oacute;n ---</option>

													</select>
													<div class="form-control-feedback"></div>
												</div>
											</div>
											<div class="form-group adjunto" style="display: none;">
												<label class="col-md-12" for="adjunto">Adjunto *</label>
												<div class="col-md-12">
													<input type="file" class="form-control adjunto" id="adjunto" name="adjunto" disabled="disabled">
													<div class="form-control-feedback"></div>
												</div>
											</div>
											<div class="form-group ">
												<label class="col-md-12" for="observacion">Justificaci&oacute;n
													de la observaci&oacute;n *</label>
												<div class="col-md-12">
													<textarea rows="5" class="form-control" cols="" id="observacion" name="observacion" placeholder="Realice la justificaci&oacute;n de la observaci&oacute;n de seguimiento"></textarea>
													<div class="form-control-feedback"></div>
												</div>
											</div>

											<button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>

											<input type="hidden" name="id" id="id" value="<?= $id; ?>"> <input type="hidden" name="idOrden" id="idOrden" value="<?= $idOrden; ?>">

										</div>
									</div>
								</form>
								<!-- Contenido del tab -->
							</div>
					<?php
						}
					}
					?>
					<div class="tab-pane <?php if ($listadoEstados != null) {
												if (count($listadoEstados) == 0) { ?>active <?php }
																					} ?>" id="history" role="tabpanel">
						<!-- Contenido del tab -->
						<div class="p-20">
							<h3>Seguimiento de la evoluci&oacute;n de la orden.</h3>
							<p align="justify">Visualice el avance en los diferentes estados
								de las &oacute;rdenes dentro del proceso de
								rehabilitaci&oacute;n.</p>
							<ul class="list-unstyled">
								<?php
								if ($listadoHistoria != null) {
									foreach ($listadoHistoria as $value) {
								?>
										<li class="media"><i class="<?= $value->ICONO; ?> fa-4x"></i>

											<div class="media-body">
												<h3 class="mt-0 mb-1"><?= $value->ESTADO; ?> <small><?= $value->FOBS; ?></small>
												</h3>
												<b><?= $value->TIPO_OBSERVACION; ?></b>:
												<?php

												if ($value->ESTADO != 'COTIZAR') {
													echo "<br>" . $this->encryption->decrypt($value->OBSERVACION);
												} else {


													$idSolicitud = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "ID_SOLICITUD", "CONSECUTIVO", $value->ID_COTI);
													$idcotizacion = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "ID", "CONSECUTIVO", $value->ID_COTI);
													//echo "<br> idcotizacion: ".$idcotizacion.
													"<br>" . $this->encryption->decrypt($value->OBSERVACION);
													$tempo = $this->encryption->decrypt($value->AUTORIZACION);
													if ($tempo != '') {
														echo "<br><b> Autorizaci&oacute;n n&uacute;mero: " . $tempo . "</b>";
													}
												}
												?>
												<br><?= $value->NOMBRES . " " . $value->APELLIDOS; ?> -
												<small><?= $value->PERFIL; ?> </small>
												<?php
												if (!empty($autName)) {
													echo "<br><b>Autorización sobrecosto: </b>" . $autName;
												}
												?>
												<?php



												if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDACTESTOBSADC", "ID_ORDACTESTOBS", $value->ID_OBSERVACION) > 0) {
													if ($value->ESTADO != 'Seguimiento operaciones') {
												?>
														<!-- Ingreso campos adicionales encontrados para el estado -->
														<?php
														$campo = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC1", $value->ID_ESTADO);
														if ($campo != VALUE_STATE_NOT) {
															$valor = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("ORD_ORDACTESTOBSADC", "ADICIONAL1", "ID_ORDACTESTOBS", $value->ID_OBSERVACION));
															if ($campo == 52 || $campo == 54) {
																$valor = findListInformation($this, $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "LISTA_ADC1", $value->ID_ESTADO), $valor);
															}
														?>
															<br>
															<b><?= $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "NOMCAMPO_ADC1", $value->ID_ESTADO); ?></b>:
															<?= $valor; ?>
														<?php
														}
														?>

														<?php
														$campo = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC2", $value->ID_ESTADO);
														if ($campo != VALUE_STATE_NOT) {
															echo "<br><b>1: </b>" . $value->ID_ESTADO;
															$valor = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("ORD_ORDACTESTOBSADC", "ADICIONAL2", "ID_ORDACTESTOBS", $value->ID_OBSERVACION));
															if ($campo == 52 || $campo == 54) {
																$valor = findListInformation($this, $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "LISTA_ADC2", $value->ID_ESTADO), $valor);
															}
														?>
															<br>
															<b><?= $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "NOMCAMPO_ADC2", $value->ID_ESTADO); ?></b>:
															<?= $valor; ?>
														<?php
														}
														?>

														<?php
														$campo = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC3", $value->ID_ESTADO);
														if ($campo != VALUE_STATE_NOT) {
															$valor = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("ORD_ORDACTESTOBSADC", "ADICIONAL3", "ID_ORDACTESTOBS", $value->ID_OBSERVACION));
															if ($campo == 52 || $campo == 54) {
																$valor = findListInformation($this, $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "LISTA_ADC3", $value->ID_ESTADO), $valor);
															}
														?>
															<br>
															<b><?= $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "NOMCAMPO_ADC3", $value->ID_ESTADO); ?></b>:
															<?= $valor; ?>
														<?php
														}
														?>

														<?php
														$campo = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC4", $value->ID_ESTADO);
														if ($campo != VALUE_STATE_NOT) {
															$valor = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("ORD_ORDACTESTOBSADC", "ADICIONAL4", "ID_ORDACTESTOBS", $value->ID_OBSERVACION));
															if ($campo == 52 || $campo == 54) {
																$valor = findListInformation($this, $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "LISTA_ADC4", $value->ID_ESTADO), $valor);
															}
														?>
															<br>
															<b><?= $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "NOMCAMPO_ADC4", $value->ID_ESTADO); ?></b>:
															<?= $valor; ?>
														<?php
														}
														?>

														<?php
														$campo = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC5", $value->ID_ESTADO);
														if ($campo != VALUE_STATE_NOT) {
															$valor = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("ORD_ORDACTESTOBSADC", "ADICIONAL5", "ID_ORDACTESTOBS", $value->ID_OBSERVACION));
															if ($campo == 52 || $campo == 54) {
																$valor = findListInformation($this, $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "LISTA_ADC5", $value->ID_ESTADO), $valor);
															}
														?>
															<br>
															<b><?= $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "NOMCAMPO_ADC5", $value->ID_ESTADO); ?></b>:
															<?= $valor; ?>
														<?php
														}
														?>
											</div>
									<?php
													}
												}
									?>

									<?php if ($value->ADJUNTO != '') { ?>
										<a href="<?= base_url() . ORDERS_FOLDER . $this->encryption->decrypt($value->ADJUNTO) . ".pdf"; ?>" target="_blank"> <i class="fa fa-file-pdf-o fa-4x pull-right" style="color: red;"></i>
										</a>

									<?php }

										if ($value->ESTADO == 'COTIZAR') {
											//Cargo informaci�n de la solicitud de cotizaci&oacute;n para los archivos adjuntos
											$adjunto1 = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "ADJUNTO1", "ID", $idSolicitud));
											$adjunto2 = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "ADJUNTO2", "ID", $idSolicitud));
									?>
										<div class="row">
											<div class="col-sm-12">
												<?php $id = $idcotizacion ?>
												<a href="<?= base_url() ?>StokePriceAppStokePrice/viewRegister/<?= $this->encryption->encrypt($id); ?>" class="btn  btn-info btn-rounded pull-right waves-effect waves-light m-r-10">
													<span class="hidden-xs"> Ver Cotización</span>
												</a>

											</div>
											<div class="col-sm-12">
												<br>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<?php $id = $idcotizacion ?>
												<a href="<?= base_url() ?>OrdersAppOrder/printOrder1/<?= $this->encryption->encrypt($this->session->userdata('id')) . "/" . $this->encryption->encrypt($idEncOrden); ?>" class="btn  btn-info btn-rounded pull-right waves-effect waves-light m-r-10">
													<span class="hidden-xs"> Orden de Producción</span>
												</a>

											</div>
											<div class="col-sm-12">
												<br>
											</div>
										</div>

										<?php
											//echo $adjunto1." ".$adjunto2;
											if ($adjunto1 != '') {
										?>
											<a href="<?= base_url() . STOKEPRICE_FOLDER . $adjunto1; ?>" target="_blank">
												<i class="fa fa-file-pdf-o fa-4x pull-right" style="color: red;"></i> <span class="hidden-xs"> </span>
											</a>
										<?php
											}
										?>
										<?php
											if ($adjunto2 != '') {
										?>
											<a href="<?= base_url() . STOKEPRICE_FOLDER . $adjunto2; ?>" target="_blank">
												<i class="fa fa-file-pdf-o fa-4x pull-right" style="color: blue;"></i> <span class="hidden-xs"> </span>
											</a>

										<?php
											}
										?>


									<?php } else if ($value->ESTADO == 'ORDENAR') {
											//Cargo informaci�n de la solicitud de cotizaci&oacute;n para los archivos adjuntos
											//echo "<script>console.log('idSolicitud: " . $idSolicitud . "' );</script>";
											//echo "<script>console.log('ordenNumero: " . $ordenNumero . "' );</script>";
											$numeroordenNumero = preg_replace('/[^0-9]/', '', $ordenNumero);
											//echo "<script>console.log('numeroordenNumero: " . $numeroordenNumero . "' );</script>";

											$adjunto1 = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("ORD_ORDEN", "ADJUNTO1", "CONS", $numeroordenNumero));
											$adjunto2 = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("ORD_ORDEN", "ADJUNTO2", "CONS", $numeroordenNumero));
									?>

										<?php
											//echo $adjunto1." ".$adjunto2;
											if ($adjunto1 != '') {
										?>
											<a href="<?= base_url() . STOKEPRICE_FOLDER . $adjunto1; ?>" target="_blank">
												<i class="fa fa-file-pdf-o fa-4x pull-right" style="color: LightSeaGreen;"></i> <span class="hidden-xs"> </span>
											</a>
										<?php
											}
										?>
										<?php
											if ($adjunto2 != '') {
										?>
											<a href="<?= base_url() . STOKEPRICE_FOLDER . $adjunto2; ?>" target="_blank">
												<i class="fa fa-file-pdf-o fa-4x pull-right" style="color: SteelBlue;"></i> <span class="hidden-xs"> </span>
											</a>

										<?php
											}
										?>


									<?php }


									?>
										</li>
								<?php
									} // end foreach
								} // end if
								?>

							</ul>
						</div>
						<!-- Contenido del tab -->


					</div>
					<?php
					if ($perfilDefinido != '') {
					?>
						<div class="tab-pane " id="bitacora" role="tabpanel">
							<div class="p-20">
								<h3>Bitacora de seguimiento.</h3>
								<p align="justify">
									Seguimiento general del proceso de atenci&oacute;n del paciente.</p>
							</div>

							<div class="card">
								<div class="card-body">
									<div class="form-group ">
										<form class=" form-horizontal" role="form" action="<?= base_url() ?>OrdersAppOrder/saveBinnacle" id="form_bitacora" method="post" autocomplete="off">
											<div class="form-group reproceso">
												<label class="col-md-12" for="tipo">Tipificaci&oacute;n *</label>
												<div class="col-md-12">
													<select class="form-control" id="tipo" name="tipo">
														<option value="">--- Seleccione una opci&oacute;n ---</option>
														<?php foreach ($listaPadre->result() as $value) {

														?>
															<option value="<?= $value->ID; ?>"><?= $value->NOMBRE; ?></option>
														<?php
														} ?>

													</select>
													<div class="form-control-feedback"></div>
												</div>
											</div>

											<div class="form-group ">
												<label class="col-md-12" for="observacion">Justificaci&oacute;n
													de la observaci&oacute;n *</label>
												<div class="col-md-12">
													<textarea rows="5" class="form-control" cols="" id="observacion" name="observacion" placeholder="Realice la justificaci&oacute;n de la observaci&oacute;n de seguimiento"></textarea>
													<div class="form-control-feedback"></div>
												</div>
											</div>

											<button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>

											<input type="hidden" name="id" id="id" value="<?= $id; ?>"> <input type="hidden" name="idOrden" id="idOrden" value="<?= $idOrden; ?>">
										</form>
									</div>
								</div>
							</div>

						</div>
					<?php
					}
					?>


					<?php
					//if ($idResponsable == NEPS) {
					//Defino condici�n 
					$condicion = " AND TIPODOC='" . $idPaciente . "' and DOCUMENTO='" . $docPaciente . "'";

					$listaCotizaciones = $this->StokePriceModel->selectListStokePriceFromRequest($condicion, 2);


					?>
					<div class="tab-pane " id="cotizacion" role="tabpanel">
						<div class="p-20">
							<h3>Relacionar cotizaci&oacute;n.</h3>
							<p align="justify">
								Relacionar cotizaci&oacute;n a la orden del paciente. A continuaci&oacute;n, se listar&aacute; las cotizaciones relacionadas al paciente con la empresa <b><?= $empresaResponsable ?></b>, que tengan relaci&oacute;n con el producto, servicio o elemento ordenado y <span style="color: red;"> adicionalmente se encuentren autorizadas (Seguimiento de cotizaciones).</span></p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="table-responsive">
									<table id="myTable" class="display nowrap table table-hover table-striped table-bordered">
										<thead>
											<tr>

												<th>Cotizaci&oacute;n</th>
												<th>Fecha</th>
												<th>Valor</th>
												<th>Relacionada</th>

												<th>Acci&oacute;n</th>
											</tr>
										</thead>
										<tbody>
											<?php
											//	$idempresa = $this->StokePriceModel->getPatientInformationEmpresa($responsable);
											//	echo $value->IDEMPRESAADRIANA;
											if ($listaCotizaciones != null) {
												$i = 1;
												//$codigo
												foreach ($listaCotizaciones as $value) {
													//echo 'iips'.$ideps;	

													//if ($value->ID_EMPRESA == $ideps) {

													//Verifico si la cotizaci�n tiene relaci�n con el c�digo del producto, servicio o elemento de la orden
													if ($this->StokePriceModel->selectListFromStokePriceForCompare($value->ID, $codigo) > 0) {
														//Verifico que la cotizaci�n tenga el seguimiento y este aprobado (autorizado)
														if ($value->ID_SEGUIMIENTO == 46) {
															//Verifico si la cotizaci�n est� relacionada con la orden
															if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDEN", "ID_COTIZACION", $value->ID, "ID", $this->encryption->decrypt($idOrden)) > 0) {
																$bandera = ACTIVO_ESTADO;
															} else {
																$bandera = null;
															}
											?>
															<tr>

																<td align="right"><?= $value->CONSECUTIVO; ?></td>
																<td><?= $value->FECHA ?></td>
																<td align="right"><?php
																					if ($value->TIPODOC != '') {
																						echo "$ " . numberFormatEvolution($value->TOTAL - ($value->TOTAL * ($value->DESCUENTO / 100)));
																					} else {
																						echo "----";
																					}



																					?>

																</td>
																<td>

																	<span class="<?= validaEstadosGenerales($bandera, 'CLASE') ?>">
																		<?= validaEstadosGenerales($bandera, 'NOMBRE') ?>
																	</span>
																</td>

																<td>
																	<?php
																	if ($bandera != ACTIVO_ESTADO) {
																	?>
																		<a href="<?= base_url() . "OrdersAppOrder/stokePriceRelation/" . $id . "/" . $idOrden . "/" . $this->encryption->encrypt($value->ID); ?>" class="btn  btn-info btn-rounded pull-left waves-effect waves-light m-r-10">
																			<i class="fa fa-usd"></i>
																		</a>
																	<?php
																	}
																	?>

																</td>
															</tr>
											<?php
														}
													}
													//}
													$i++;
												} //end foreach
											} //end if
											?>
										</tbody>

									</table>
								</div>
							</div>
						</div>

					</div>
					<?php
					//}
					?>





					<?php if ($valida) { ?>
						<div class="tab-pane " id="elements" role="tabpanel">
							<div class="p-20">
								<h3>Despiece.</h3>
								<p align="justify">
									Visualice el despiece si lo tiene para la orden. Recuerde que
									los elementos que tengan el logo <i class="fa fa-free-code-camp"></i>
									a&uacute;n no se han definido completamente; por tal motivo el
									despiece puede estar incompleto.
								</p>
								<div class="table-responsive m-t-40">
									<table id="myTable" class="display nowrap table table-hover table-striped table-bordered">
										<thead>
											<tr>
												<th>C&oacute;digo</th>
												<th>Comod&iacute;n</th>

												<th width="40%">Nombre</th>
												<th>Unidad</th>
												<th>Cantidad</th>

											</tr>
										</thead>
										<tbody>
											<?php
											if ($listaLista != null) {
												$i = 1;
												foreach ($listaLista as $value) {

											?>
													<tr>
														<td>
															<?= $value->CODIGO; ?>
														</td>
														<td align="center"><span class="<?= validaComodin($value->COMODIN, 'CLASE') ?>">
																<?= validaComodin($value->COMODIN, 'NOMBRE') ?>
															</span></td>

														<td>
															<?= $value->NOMBRE; ?>
														</td>
														<td>
															<?= $value->VALOR; ?>
														</td>
														<td>
															<?= $value->CANTIDAD; ?>
														</td>



													</tr>
											<?php
													$i++;
												} // end foreach
											} // end if
											?>
										</tbody>

									</table>
								</div>
							</div>
							<!-- Contenido del tab -->

							<!-- Contenido del tab -->
						</div>
					<?php } ?>
					<div class="tab-pane " id="team" role="tabpanel">
						<div class="p-20">
							<h3>Equipo de trabajo.</h3>
							<p align="justify">Lista de funcionarios que han intervenido en
								el proceso del paciente.</p>
							<div class="table-responsive m-t-40">
								<table id="myTableTeam" class="display nowrap table table-hover table-striped table-bordered">
									<thead>
										<tr>
											<th>Cargo</th>
											<th>Profesional</th>

											<th>Estados</th>

										</tr>
									</thead>
									<tbody>
										<?php
										if ($listadoPersonas != null) {
											foreach ($listadoPersonas as $value) {
												// ECHO $value->PERFIL;
										?>
												<tr>
													<td><?= $value->PERFIL; ?></td>
													<td><?= $value->NOMBRES . " " . $value->APELLIDOS; ?></td>
													<td><?= $value->ESTADO; ?></td>
												</tr>
										<?php
											} // end foreach
										} // end if
										?>
									</tbody>

								</table>
							</div>
						</div>
						<!-- Contenido del tab -->

						<!-- Contenido del tab -->
					</div>
				</div>


			</div>

		</div>
		<a class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10">
			<i class="fa fa-arrow-left"></i> <span class="hidden-xs" onClick="history.go(-1);"> Retornar</span>
		</a> <br> <br> <br>
	</div>

	<!-- Column -->
</div>
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->

<!-- Timeline CSS -->