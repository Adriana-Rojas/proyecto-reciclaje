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
?>




<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->

<form class=" form-horizontal" role="form" action="<?= base_url() ?>OrdersAppOrder/orderFromRequest" id="form_sample_3" method="post" autocomplete="off">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Selecci&oacute;n de par&aacute;metros </h4>
					<h6 class="card-subtitle">Seleccione el periodo para el cual desea validar las cotizaciones</h6>
				</div>
				<div class="form-group">
					<label class="col-md-12" for="periodo">Periodo *</label>
					<div class="col-md-12">
						<input class="form-control input-limit-datepicker" type="text" name="periodo" id="periodo" />
						<div class="form-control-feedback"> </div>
					</div>
				</div>




			</div>
		</div>
	</div>
	<!-- Bot�n de envio de formulario -->
	<div class="row">
		<div class="col-sm-12">

			<button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
			<input type="hidden" name="informe" id="informe" value="1">
		</div>
		<div class="col-sm-12">
			<br>
		</div>
	</div>
	<!-- FIN Bot�n de envio de formulario -->
</form>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title"><i class="fa fa-newspaper-o fa-2x"></i> Listado de Cotizaci&oacute;n generadas dentro del periodo <?= $fechaInicial; ?> - <?= $fechaFinal; ?></h4>
				<h6 class="card-subtitle " style="color: red;"> <i class='fa fa-exclamation-triangle'></i> Recuerde que s&oacute;lo se traen pacientes que tengan una admisi&oacute;n activa. Adicionalmente, se listar&aacute;n solo las cotizaciones que se encuentran autorizadas y no han sido ordenadas <i class='fa fa-exclamation-triangle'></i> </h6>

				<div class="table-responsive">
					<table id="myTable" class="display nowrap table table-hover table-striped table-bordered">
						<thead>
							<tr>
								<th>Acci&oacute;n</th>
								<th>Cotizaci&oacute;n</th>
								<th>Documento</th>
								<th>Nombres y apellidos</th>
								<th>Entidad</th>
								<th>Fecha</th>
								<th>Producto / Servicio / Elemento</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($listaLista != null) {
								$i = 1;
								foreach ($listaLista as $value) {

									//Verifico si hay ordenes activas para el id de la cotizaci�n
									$band = false;
									if ($value->ID != '') {
										$condicion = " AND ORD_ORDEN.ACTIVIDAD=" . $value->CODIGO;
										$listaCotizaciones = $this->OrdersModel->selectListOrdersFromStokePrice($value->ID, $condicion);
										//$listaCotizaciones=null;
										$hc = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "ID_PCTE", "TP_ID_PCTE", $value->TIPODOC, "NUM_ID_PCTE", $value->DOCUMENTO);
										$hc = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_ADMISIONES", "ID_AMSION", "ID_PCTE_ADM", $hc, "ACTIVO_ADM", 1);

										if ($listaCotizaciones == null) {
											$band = true;
										}
									}




									if ($value->ID != '' && $value->ID_SEGUIMIENTO == 46 && $band) {
									//	echo "<script>console.log('band: " . $band . "' );</script>";
							?>
										<tr>
											<td>
												<!--  
                                                    <button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button>
                                                    -->
												<?php

												if ($hc != '') {
													//obtengo datos adicionales para hacer el env�o
													$idArbol = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOLPRODUCTOS", "ID_ARBOLVALORES", "CODIGO", $value->AUXILIAR);
													$tipoOrden = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOLPRODUCTOS", "ID_TIPOORDEN", "CODIGO", $value->AUXILIAR);

												?>
													<div class="btn-group">
														<button type="button" class="btn btn-info btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															<i class="fa fa-bars"></i>
														</button>
														<div class="dropdown-menu animated lightSpeedIn">
															<?php
															if ($listaBoard != null) {
																foreach ($listaBoard as $valueBoard) {



															?>
																	<a class="dropdown-item" href="<?= base_url() . "/OrdersAppOrder/selectedFromRequest/" . $this->encryption->encrypt($hc) . "/" . $this->encryption->encrypt($value->ID) . "/" .
																										$this->encryption->encrypt($idArbol) . "/" .
																										$this->encryption->encrypt($tipoOrden) . "/" .
																										$this->encryption->encrypt($value->AUXILIAR); ?>">

																		<i class="<?= $valueBoard->ICONO ?>"></i>
																		<?= $valueBoard->NOMBRE ?>
																	</a>


															<?php

																}
															}
															?>


														</div>
													</div>
												<?php
												} else {
													echo "<small style=\"color: red;\"><i class=\"fa fa-exclamation\" aria-hidden=\"true\"></i> Inactivo - SERVINTE</small>";
												}
												?>
											</td>
											<td align="right"><?= $value->CONSECUTIVO; ?></td>
											<td><?PHP
												if ($value->TIPODOC != '') {
													echo $value->TIPODOC . " " . $value->DOCUMENTO;
												} else {
													$idUsuario = $this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "ID_USUARIO", "ID", $value->SOLICITUD);
													$tipoDoc = $this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "TIPODOC", "ID", $idUsuario);
													$documento = $this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "DOCUMENTO", "ID", $idUsuario);
													$tipoDoc = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_DETLISTA", "VALOR", "ID", $tipoDoc);
													echo $tipoDoc . " " . $documento;
												}


												?></td>

											<td><?PHP
												if ($value->TIPODOC != '') {
													echo $this->encryption->decrypt($value->NOMBRES) . " " . $this->encryption->decrypt($value->APELLIDOS);;
												} else {
													$idUsuario = $this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "ID_USUARIO", "ID", $value->SOLICITUD);
													$nombres = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "NOMBRES", "ID", $idUsuario));
													$apellidos = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "APELLIDOS", "ID", $idUsuario));

													echo $nombres . " " . $apellidos;
												}


												?></td>
											<td>

												<?php

												if ($value->ID_EMPRESA != '') {
													echo $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_APB", "NOM_APB", "ID_APB", $value->ID_EMPRESA);
												} else {
													$empresa = $this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "ID_EMPRESA", "ID", $value->SOLICITUD);
													$empresa = $this->FunctionsGeneral->getFieldFromTableNotId("COT_TARIFAEMPRESA", "ID_EMPRESA", "ID", $empresa);
													echo $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_APB", "NOM_APB", "ID_APB", $empresa);
												}


												?></td>



											<td><?= $value->FECHA ?></td>

											<td><?= $value->AUXILIAR . " " . $value->DESCRIPCION ?></td>


										</tr>
							<?php
										$i++;
									}
								} //end foreach

							} //end if
							?>
						</tbody>

					</table>
				</div>
				<?php
				if ($botonesBoard != null) {
					foreach ($botonesBoard as $value) {

				?>
						<a href="<?= base_url() . $value->PAGINA; ?>" class="btn btn-info btn-rounded">
							<i class="<?= $value->ICONO ?>"></i>
							<span class="hidden-xs"> <?= $value->NOMBRE ?></span>
						</a>
				<?php

					}
				} ?>
			</div>
		</div>

	</div>
</div>
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- BEGIN PAGE JQUERY ROUTINES -->
<!-- ============================================================== -->

<!-- Plugin JavaScript -->
<script src="<?= base_url() ?>assets/node_modules/moment/moment.js"></script>
<!-- Date Picker Plugin JavaScript -->
<script src="<?= base_url() ?>assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.es.min.js"></script>
<!-- Date range Plugin JavaScript -->
<script src="<?= base_url() ?>assets/node_modules/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?= base_url() ?>assets/node_modules/bootstrap-daterangepicker/daterangepicker.js"></script>
<script>
	$('.input-limit-datepicker').daterangepicker({
		maxDate: '<?= $fecha; ?>',
		buttonClasses: ['btn', 'btn-sm'],
		locale: {
			"format": "YYYY/MM/DD",
			"separator": " - ",
			"applyLabel": "Aplicar",
			"cancelLabel": "Cancelar",
			"fromLabel": "Desde",
			"toLabel": "Hasta",
			"customRangeLabel": "Custom",
			"daysOfWeek": [
				"Do",
				"Lu",
				"Ma",
				"Mi",
				"Ju",
				"Vi",
				"Sa"
			],
			"monthNames": [
				"Enero",
				"Febrero",
				"Marzo",
				"Abril",
				"Mayo",
				"Junio",
				"Julio",
				"Agosto",
				"Septiembre",
				"Octubre",
				"Noviembre",
				"Diciembre"
			],
			"firstDay": 1
		},
		applyClass: 'btn-info btn-rounded',
		cancelClass: 'btn-inverse btn-rounded'
	});
	$('#periodo').val('');
</script>


<!-- ============================================================== -->
<!-- END PAGE JQUERY ROUTINES -->
<!-- ============================================================== -->