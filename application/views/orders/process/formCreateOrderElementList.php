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
<!-- Start JavaScript para pintar campos adicionales -->
<!-- ============================================================== -->

<!-- Date Picker Plugin JavaScript -->
<script src="<?= base_url() ?>assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.es.min.js"></script>


<script>
	$(document).ready(function() {
		// Date Picker
		jQuery('.datepicker').datepicker({
			autoclose: true,
			todayHighlight: true,
			format: '<?= DATE_FORMAT_EVOLUTION; ?>',
			language: 'es'
		});
	});

	$(document).ready(function() {

		// Date Picker

		$("#disparaModal").on('click', function() {
			codigo = $('#codigo').val();
			opcion = 1;
			claseTipo = $('#claseTipo').val();
			$.post("<?= base_url() ?>/Integration/reloadCodeInformation", {
				codigo: codigo,
				opcion: opcion,
				claseTipo: claseTipo
			}, function(data) {
				tempo = data.split('|');
				$("#nombre").html(tempo[0]);
				$("#descripcion").html(tempo[1]);
				$("#despiece").html(tempo[2]);
			});
			$('#myModal').modal({
				backdrop: 'static',
				keyboard: false
			})
		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#proceso').change(function() {
			if ($("#proceso").val() == <?= NORMAL_PROCESS; ?>) {
				$("#convenio").prop('disabled', true);
				$(".convenio").hide();
			} else if ($("#proceso").val() == <?= BRIGADE_PROCESS; ?>) {
				$("#convenio").prop('disabled', true);
				$(".convenio").hide();
			} else if ($("#proceso").val() == <?= PARTNER_PROCESS; ?>) {
				$("#convenio").prop('disabled', false);
				$(".convenio").show();
			}
		});
	});


	$(document).ready(function() {
		$('#pais').change(function() {
			if ($("#pais").val() != <?= CTE_PAIS_DEFECTO ?>) {
				$(".pais").hide();
				$("#departamento").prop('disabled', true);
				$("#ciudad").prop('disabled', true);
			} else {
				$(".pais").show();
				$("#departamento").prop('disabled', false);
				$("#ciudad").prop('disabled', false);
			}
		});
	});
	$(document).ready(function() {
		$("#departamento").change(function() {
			$("#departamento option:selected").each(function() {
				departamento = $('#departamento').val();
				$.post("<?= base_url() ?>/Integration/reloadCity", {
					departamento: departamento
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
<form class=" form-horizontal" role="form" action="<?= base_url() ?>OrdersAppOrder/saveRegister" id="form_sample_3" method="post" autocomplete="off" enctype="multipart/form-data">
	<div class="row">
		<!-- Column -->
		<div class="col-lg-4 col-xlg-3 col-md-5">
			<div class="card">
				<?php
				foreach ($paciente as $value) {

					if ($idCotizacionPlano != '') {
						//Traigo los valores desde la cotización
						//Telefono del paciente
						$telefono = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "TELEFONO", "DOCUMENTO", $value->NUM_ID_PCTE));

						//Telefono 2 del paciente
						$telefono2 = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "FIJO", "DOCUMENTO", $value->NUM_ID_PCTE));

						//Dirección
						$direccion = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "DIRECCION", "DOCUMENTO", $value->NUM_ID_PCTE));

						//Municipio
						$idMunicipio = $this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "ID_MUNICIPIO", "DOCUMENTO", $value->NUM_ID_PCTE);

						//Departamento
						$idDepartamento = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MUNICIPIO", "ID_DEPARTAMENTO", "ID", $idMunicipio);

						//Empresa
						$idEmpresa = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "ID_EMPRESA", "ID", $idCotizacionPlano);

						//Codigo interno
						$interno = $this->FunctionsGeneral->getFieldFromTableNotId("COT_TARIFAEMPRESA", "ID_EMPRESA", "ID", $idEmpresa);

						//Empresa Nombre
						$empresaNombre = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_APB", "NOM_APB", "ID_APB", $interno);

						$disabledEmpresa = "disabled='disabled'";

						//Aliada
						$idSolicitud = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "ID_SOLICITUD", "ID", $idCotizacionPlano);
						$aliada = $this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "ID_ALIADA", "ID", $idSolicitud);
					} else {
						//Traigo los valores desde la admisión

						//Telefono del paciente
						$telefono = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "TEL_PCTE", "NUM_ID_PCTE", $value->NUM_ID_PCTE);

						//Telefono del paciente
						$telefono2 = "";

						//Municipio
						$idMunicipio = "";

						//Departamento
						$idDepartamento = "";

						//Obtengo dirección del paciente
						$direccion = $value->DIR_PCTE;

						//Empresa Nombre
						$empresaNombre = $value->RESPONSABLE;

						//Empresa
						$idEmpresa = $this->FunctionsGeneral->getFieldFromTableNotId("COT_TARIFAEMPRESA", "ID", "ID_EMPRESA", $value->ID_RESPONSABLE);

						$disabledEmpresa = "";

						$aliada = null;
					}

					if ($aliada != null) {
						$disabledAliada = "";
					} else {
						$disabledAliada = "disabled='disabled'";
					}


				?>
					<div class="card-body">
						<div class="user-btm-box">
							<!-- .row -->
							<div class="row text-center m-t-10">
								<div class="col-md-12">
									<span class="<?= datosGeneroPersona($value->SEXO, 'CLASE', 'fa-4x') ?>">
										<?= datosGeneroPersona($value->SEXO, 'NOMBRE', 'fa-4x') ?>
									</span>
									<br>
									<strong>Nombres completos</strong>
									<p><?= $value->PRI_NOM_PCTE, " ", $value->SEG_NOM_PCTE, " ", $value->PRI_APELL_PCTE, " ", $value->SEG_APELL_PCTE; ?></p>
								</div>
							</div>
							<hr>
							<!-- .row -->
							<div class="row text-center m-t-10">
								<div class="col-md-6 b-r"><strong>Historia cl&iacute;nica</strong>
									<p><?= $value->ID_PCTE; ?></p>
								</div>
								<div class="col-md-6"><strong>Documento de identidad</strong>
									<p><?= $value->TP_ID_PCTE, " ", $value->NUM_ID_PCTE; ?></p>
								</div>
							</div>
							<!-- /.row -->
							<hr>
							<!-- .row -->
							<div class="row text-center m-t-10">
								<div class="col-md-6 b-r"><strong>Edad</strong>
									<p><?= intervaloTiempo($value->FECH_NCTO_PCTE, cambiaHoraServer(2), 31104000);
										?> A&ntilde;os</p>
								</div>
								<div class="col-md-6"><strong>Responsable</strong>
									<p><?= $empresaNombre; ?></p>
								</div>
							</div>
							<!-- /.row -->
							<!-- .row -->
							<div class="row text-center m-t-10">
								<div class="col-md-12"><strong>Tipo de proceso</strong>
									<p><?= $tipoProceso; ?></p>
								</div>

							</div>
							<!-- /.row -->
							<hr>



						</div>
					</div>
				<?php
				} ?>
			</div>
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Ruta del producto o servicio</h5>
					<?php if ($niveles == 3) {
					?>
						<div class="row">

							<!-- Column -->


							<div class="col-lg-12 col-xlg-12 col-md-12">
								<div class="card">
									<div class="box <?= BG_BOX_INTERFACE; ?> text-center">
										<h4 class="font-light text-white">Tipo de orden: <small class="text-white"><?= $nombreTipo; ?></small></h4>
									</div>
								</div>
							</div>
							<!-- Column -->
							<div class="col-lg-12 col-xlg-12 col-md-12">
								<div class="card">
									<div class="box <?= BG_BOX_INTERFACE; ?> text-center">
										<h4 class="font-light text-white">Ubicaci&oacute;n: <small class="text-white"><?= $nombreMiembros; ?></small> </h4>

									</div>
								</div>
							</div>
							<!-- Column -->
							<div class="col-lg-12 col-xlg-12 col-md-12">
								<div class="card">
									<div class="box <?= BG_BOX_INTERFACE; ?> text-center">
										<h4 class="font-light text-white">Primer subnivel: <small class="text-white"><?= $nomPrimerSubNiv; ?></small></h4>

									</div>
								</div>
							</div>

							<!-- Column -->
							<div class="col-lg-12 col-xlg-12 col-md-12">
								<div class="card">
									<div class="box <?= BG_BOX_INTERFACE; ?> text-center">
										<h4 class="font-light text-white">Segundo subnivel: <small class="text-white"><?= $nomSegundoSubNiv; ?></small></h4>

									</div>
								</div>
							</div>

							<!-- Column -->
							<div class="col-lg-12 col-xlg-12 col-md-12">
								<div class="card">
									<div class="box <?= BG_BOX_INTERFACE; ?> text-center">
										<h4 class="font-light text-white">Tercer subnivel: <small class="text-white"><?= $nomTerceroSubNiv; ?></small></h4>

									</div>
								</div>
							</div>



						</div>
					<?php } ?>
					<?php if ($niveles == 2) {
					?>
						<div class="row">
							<div class="col-lg-12 col-xlg-12 col-md-12">
								<div class="card">
									<div class="box <?= BG_BOX_INTERFACE; ?> text-center">
										<h4 class="font-light text-white">Tipo de orden: <small class="text-white"><?= $nombreTipo; ?></small></h4>
									</div>
								</div>
							</div>
							<!-- Column -->
							<div class="col-lg-12 col-xlg-12 col-md-12">
								<div class="card">
									<div class="box <?= BG_BOX_INTERFACE; ?> text-center">
										<h4 class="font-light text-white">Ubicaci&oacute;n: <small class="text-white"><?= $nombreMiembros; ?></small> </h4>

									</div>
								</div>
							</div>
							<!-- Column -->
							<div class="col-lg-12 col-xlg-12 col-md-12">
								<div class="card">
									<div class="box <?= BG_BOX_INTERFACE; ?> text-center">
										<h4 class="font-light text-white">Primer subnivel: <small class="text-white"><?= $nomPrimerSubNiv; ?></small></h4>

									</div>
								</div>
							</div>

							<!-- Column -->
							<div class="col-lg-12 col-xlg-12 col-md-12">
								<div class="card">
									<div class="box <?= BG_BOX_INTERFACE; ?> text-center">
										<h4 class="font-light text-white">Segundo subnivel: <small class="text-white"><?= $nomSegundoSubNiv; ?></small></h4>

									</div>
								</div>
							</div>

						</div>
					<?php } ?>
					<?php if ($niveles == 1) {
					?>
						<div class="row">
							<div class="col-lg-12 col-xlg-12 col-md-12">
								<div class="card">
									<div class="box <?= BG_BOX_INTERFACE; ?> text-center">
										<h4 class="font-light text-white">Tipo de orden: <small class="text-white"><?= $nombreTipo; ?></small></h4>
									</div>
								</div>
							</div>
							<!-- Column -->
							<div class="col-lg-12 col-xlg-12 col-md-12">
								<div class="card">
									<div class="box <?= BG_BOX_INTERFACE; ?> text-center">
										<h4 class="font-light text-white">Ubicaci&oacute;n: <small class="text-white"><?= $nombreMiembros; ?></small> </h4>

									</div>
								</div>
							</div>
							<!-- Column -->
							<div class="col-lg-12 col-xlg-12 col-md-12">
								<div class="card">
									<div class="box <?= BG_BOX_INTERFACE; ?> text-center">
										<h4 class="font-light text-white">Primer subnivel: <small class="text-white"><?= $nomPrimerSubNiv; ?></small></h4>

									</div>
								</div>
							</div>



						</div>
					<?php } else { ?>
						<div class="row">
							<div class="col-lg-12 col-xlg-12 col-md-12">
								<div class="card">
									<div class="box <?= BG_BOX_INTERFACE; ?> text-center">
										<h4 class="font-light text-white">Tipo de orden: <small class="text-white"><?= $nombreTipo; ?></small></h4>
									</div>
								</div>
							</div>
							<!-- Column -->
							<div class="col-lg-12 col-xlg-12 col-md-12">
								<div class="card">
									<div class="box <?= BG_BOX_INTERFACE; ?> text-center">
										<h4 class="font-light text-white">Ubicaci&oacute;n: <small class="text-white"><?= $nombreMiembros; ?></small> </h4>

									</div>
								</div>
							</div>
							<!-- Column -->
							<div class="col-lg-12 col-xlg-12 col-md-12">
								<div class="card">
									<div class="box <?= BG_BOX_INTERFACE; ?> text-center">
										<h4 class="font-light text-white">Primer subnivel: <small class="text-white"><?= $nomPrimerSubNiv; ?></small></h4>

									</div>
								</div>
							</div>


						</div>
					<?php } ?>
				</div>




			</div>



		</div>
		<!-- Column -->
		<!-- Column -->

		<div class="col-lg-8 col-xlg-9 col-md-7">
			<?php
			if ($this->session->userdata('encOrden') == '') {
			?>
				<div class="card">
					<div class="card-body">
						<h5 class="card-title"><i class="fa fa-user" aria-hidden="true"></i> Datos de contacto del usuario </h5>
						<br>

						<div class="form-group">
							<label class="col-md-12" for="telefono">Tel&eacute;fono* </label>
							<div class="col-md-12">
								<input class="form-control " type="text" name="telefono" id="telefono" placeholder="Ej. 4565656" value="<?= $telefono; ?>" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-12" for="telefono2">Tel&eacute;fono opcional</label>
							<div class="col-md-12">
								<input class="form-control " type="text" name="telefono2" id="telefono2" placeholder="Ej. 4565656" value="<?= $telefono2; ?>" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-12" for="direccion">Direcci&oacute;n*</label>
							<div class="col-md-12">
								<input class="form-control " type="text" name="direccion" id="direccion" placeholder="Ej. Carrera 12 25 - 24 Apartamento 502" value="<?= $direccion; ?>" />
							</div>
						</div>



						<div class="form-group pais">
							<label class="col-md-12" for="departamento">Departamento* </label>
							<div class="col-md-12">
								<select class="form-control" id="departamento" name="departamento">
									<option value="">--- Seleccione una opci&oacute;n ---</option>
									<?php foreach ($listaDepartamento->result() as $value) {
										if ($value->ID == $idDepartamento) {
											$selected = "selected='selected'";
										} else {
											$selected = "";
										}
									?>
										<option value="<?= $value->ID; ?>" <?= $selected ?>><?= $value->NOMBRE; ?></option>
									<?php
									} ?>
								</select>
								<div class="form-control-feedback"> </div>
							</div>
						</div>
						<div class="form-group pais">
							<label class="col-md-12" for="ciudad">Ciudad (Municipio)* </label>
							<div class="col-md-12">
								<select class="form-control" id="ciudad" name="ciudad">
									<option value="">--- Seleccione una opci&oacute;n ---</option>
									<?php foreach ($listaCiudad->result() as $value) {
										if ($value->ID == $idMunicipio) {
											$selected = "selected='selected'";
										} else {
											$selected = "";
										}
										if ($value->ID_DEPARTAMENTO == $idDepartamento) {
									?>
											<option value="<?= $value->ID; ?>" <?= $selected ?>><?= $value->NOMBRE; ?></option>
									<?php
										}
									} ?>
								</select>
								<div class="form-control-feedback"> </div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-12" for="empresa">Entidad (EPS) * </label>
							<input type="hidden" name="idEmpresa" id="idEmpresa" value="<?= $idEmpresa; ?>">
							<div class="col-md-12">
								<select class="form-control" id="empresa" name="empresa" <?= $disabledEmpresa; ?>>
									<option value="">--- Seleccione una opci&oacute;n ---</option>
									<?php
									if ($listaEmpresa != null) {
										foreach ($listaEmpresa as $value) {
											if ($value->ID == $idEmpresa) {
												$selected = "selected='selected'";
											} else {
												$selected = '';
											}
											$empresa = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_APB", "NOM_APB", "ID_APB", $value->ID_EMPRESA);
									?>
											<option value="<?= $value->ID; ?>" <?= $selected; ?>><?= $empresa . " - " . $value->TARIFA; ?></option>
									<?php
										}
									}
									?>
								</select>
								<?php
								//}
								?>
							</div>
						</div>
						<?php
						if ($validador == null) {

						?>
							<div class="form-group">
								<label class="col-md-12" for="proceso">Proceso * </label>
								<div class="col-md-12">
									<select class="form-control" id="proceso" name="proceso">
										<option value="">--- Seleccione una opci&oacute;n ---</option>
										<?php
										if ($listaProcesos != null) {
											foreach ($listaProcesos as $value) {

												if ($value->ID == $this->session->userdata('proceso')) {
													$selected = "selected='selected'";
												} else {
													$selected = '';
												}
										?>
												<option value="<?= $value->ID; ?>" <?= $selected ?>><?= $value->NOMBRE; ?></option>
										<?php
											}
										}
										?>

									</select>

								</div>
							</div>

							<div class="form-group convenio">
								<label class="col-md-12" for="convenio">Convenio (Empresa aliada)
									* </label>
								<div class="col-md-12">
									<select class="form-control" id="convenio" name="convenio" <?= $disabledAliada; ?>>
										<option value="">--- Seleccione una opci&oacute;n ---</option>

										<?php
										if ($listaAliada != null) {
											foreach ($listaAliada as $value) {
												$empresa = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_APB", "NOM_APB", "ID_APB", $value->EMPRESA);
												if ($value->ID == $aliada) {
													$selected = "selected = 'selected'";
												} else {
													$selected = "";
												}
										?>
												<option value="<?= $value->ID; ?>" <?= $selected ?>><?= $empresa; ?></option>
										<?php
											}
										}
										?>
									</select>
								</div>
							</div>

						<?php
						}

						?>
					</div>
				</div>
			<?php
			}
			?>
			<div class="card">
				<div class="card-body">
					<h5 class="card-title"> <i class="fa fa-user-md" aria-hidden="true"></i> Ordenar elementos o servicios</h5>
					<br>
					<div class="clearfix" style="text-align:center;">
						<center>
							<?php
							if ($adjunto1 != '') {
							?>
								<a href="<?= base_url() . STOKEPRICE_FOLDER . $adjunto1; ?>" target="_blank" class="btn  btn-info btn-rounded pull-left waves-effect waves-light m-r-10">
									<i class="fa fa-paperclip "></i> <span class="hidden-xs"> Resumen de historia cl&iacute;nica</span>
								</a>
							<?php
							}
							?>
							<?php
							if ($adjunto2 != '') {
							?>
								<a href="<?= base_url() . STOKEPRICE_FOLDER . $adjunto2; ?>" target="_blank" class="btn  btn-info btn-rounded pull-left waves-effect waves-light m-r-10">
									<i class="fa fa-paperclip "></i> <span class="hidden-xs"> Orden m&eacute;dica</span>
								</a>

							<?php
							}
							?>
						</center>
					</div>
					<br>
					<div class="form-group ">
						<label class="col-md-12" for="codigo">C&oacute;digo * <span class="pull-right"><i class="fa fa-search-plus fa-2x" style="color: red;" id="disparaModal"></i></span></label>
						<div class="col-md-12">
							<select class="form-control" id="codigo" name="codigo">
								<option value="">--- Seleccione una opci&oacute;n ---</option>
								<?php foreach ($listaElementosServicios as $value) {
									if ($value->ID == $elemento) {
										$selected = "selected='selected'";
									} else {
										$selected = "";
									}
								?>
									<option value="<?= $value->ID; ?>" <?= $selected ?>><?= $value->NOMBRE; ?></option>
								<?php
								} ?>
							</select>

							<div class="form-control-feedback"> </div>
						</div>
					</div>

					<div class="form-group ">
						<label class="col-md-12" for="cantidad">Cantidad *</label>
						<div class="col-md-12">
							<input type="number" class="form-control" id="cantidad" name="cantidad" max="<?= $maximo ?>" min="1" value="<?php
																																		if ($elemento != null) {
																																			echo $cantidad;
																																		} else {
																																			echo '';
																																		}

																																		?>">
							<div class="form-control-feedback"> </div>
						</div>
					</div>
					<div class="form-group ">
						<label class="col-md-12" for="cie10">Diagn&oacute;stico CIE10 *</label>
						<div class="col-md-12">
							<select class="form-control" id="cie10" name="cie10">
								<option value="">--- Seleccione una opci&oacute;n ---</option>
								<?php foreach ($listaDiagnostico->result() as $value) {
									if ($value->ID == $cie10) {
										$selected = "selected='selected'";
									} else {
										$selected = "";
									}
								?>
									<option value="<?= $value->ID; ?>" <?= $selected ?>><?= $value->DIACOD . " - " . $value->NOMBRE; ?></option>
								<?php
								} ?>
							</select>
							<div class="form-control-feedback"> </div>
						</div>
					</div>
					<div class="form-group ">
						<label class="col-md-12" for="diagnostico">Diagn&oacute;stico m&eacute;dico *</label>
						<div class="col-md-12">
							<textarea rows="4" cols="100" class="form-control" id="diagnostico" name="diagnostico" placeholder="Describa brevemente el diagn&oacute;stico m&eacute;dico para la formulaci&oacute;n del producto o servicio"></textarea>
							<div class="form-control-feedback"> </div>
						</div>
					</div>
					<div class="form-group ">
						<label class="col-md-12" for="causa">Causa de la enfermedad *</label>
						<div class="col-md-12">
							<select class="form-control" id="causa" name="causa">
								<option value="">--- Seleccione una opci&oacute;n ---</option>
								<?php foreach ($listaCausas->result() as $value) {
									if ($value->ID == $causa) {
										$selected = "selected='selected'";
									} else {
										$selected = "";
									}
								?>
									<option value="<?= $value->ID; ?>" <?= $selected ?>><?= $value->NOMBRE; ?></option>
								<?php
								} ?>
							</select>
							<div class="form-control-feedback"> </div>
						</div>
					</div>
					<?php
					if ($listaApoyo != null) {
					?>
						<div class="form-group ">
							<label class="col-md-12" for="apoyo">Personal de apoyo *</label>
							<div class="col-md-12">
								<select class="form-control" id="apoyo" name="apoyo">
									<option value="">--- Seleccione una opci&oacute;n ---</option>
									<option value="-1">Ninguno</option>
									<?php foreach ($listaApoyo as $value) {
										if ($value->ID == $apoyo) {
											$selected = "selected='selected'";
										} else {
											$selected = "";
										}
									?>
										<option value="<?= $value->ID; ?>" <?= $selected ?>><?= $value->NOMBRES . " " . $value->APELLIDOS; ?></option>
									<?php
									} ?>
								</select>
								<div class="form-control-feedback"> </div>
							</div>
						</div>
					<?php
					}
					?>
					<div class="form-group ">
						<label class="col-md-12" for="predecesora">Orden predecesora </label>
						<div class="col-md-12">
							<?php
							if ($listadoAnteriores != null) {
								$disabled = "disabled='disabled'";
							} else {
								$disabled = "";
							} ?>
							<select class="form-control" id="predecesora" name="predecesora" <?= $disabled ?>>
								<option value="">--- Seleccione una opci&oacute;n ---</option>
								<?php foreach ($listadoAnteriores as $value) {
									if ($value->ID == $anterior) {
										$selected = "selected='selected'";
									} else {
										$selected = "";
									}
								?>
									<option value="<?= $value->ID; ?>" <?= $selected ?>><?= $value->PREFIJO . " - " . $value->CONS; ?></option>
								<?php
								} ?>
							</select>
							<div class="form-control-feedback"> </div>
						</div>
					</div>
					<div class="form-group ">
						<label class="col-md-12" for="observacion">Observaci&oacute;n de formulaci&oacute;n </label>
						<div class="col-md-12">
							<textarea rows="4" cols="100" class="form-control" id="observacion" name="observacion" placeholder="Describa si tiene alguna observaci&oacute;n relevante para ordenar el elemento o servicio"></textarea>
							<div class="form-control-feedback"> </div>
						</div>
					</div>
				</div>
			</div>

			<div class="card">
				<div class="card-body">
					<h5 class="card-title"> <i class="fa fa-sticky-note-o" aria-hidden="true"></i> Datos espec&iacute;ficos de la orden</h5>
					<?php
					if ($campo1 != VALUE_STATE_NOT) {

					?>
						<div class="form-group campo1">
							<label class="col-md-12" id="labelCampo1"><?=
																		$this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "NOMCAMPO_ADC1", ORDER_STATE) ?>
								<?php if ($campo1 == 52 || $campo1 == 51 || $campo1 == 57 || $campo1 == 58) { ?> * <?php  } ?>


							</label>
							<div class="col-md-12">
								<?php
								if ($campo1 == 52 || $campo1 == 54) {

									$valoresLista = listAditionalInformation($this, $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "LISTA_ADC1", ORDER_STATE), 1);


								?>
									<select class="form-control " id="campo1" name="campo1" <?php if ($campo1 == 52) { ?> required="required" <?php  } ?>>
										<option value="">--- Seleccione una opci&oacute;n ---</option>
										<?= $valoresLista; ?>
									</select>
								<?php
								}
								?>


								<?php
								if ($campo1 == 51 || $campo1 == 53) {

								?>
									<input type="text" class="form-control " id="campo1" name="campo1" placeholder="Escriba aqu&iacute; un descripci&oacute;n corta" <?php if ($campo1 == 51) { ?> required="required" <?php  } ?>>
								<?php
								}
								?>



								<?php
								if ($campo1 == 57 || $campo1 == 59) {

								?>
									<input type="text" class="form-control datepicker" id="campo1" name="campo1" placeholder="aaaa/mm/dd" <?php if ($campo1 == 57) { ?> required="required" <?php  } ?>>

								<?php
								}
								?>
								<?php
								if ($campo1 == 58 || $campo1 == 60) {

								?>
									<input type="number" class="form-control " id="campo1" name="campo1" min="0" placeholder="Ej 1000" <?php if ($campo1 == 58) { ?> required="required" <?php  } ?>>
								<?php
								}
								?>
								<div class="form-control-feedback"></div>
							</div>
						</div>
					<?php
					}
					?>

					<?php
					if ($campo2 != VALUE_STATE_NOT) {

					?>
						<div class="form-group campo2">
							<label class="col-md-12" id="labelcampo2"><?=
																		$this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "NOMCAMPO_ADC2", ORDER_STATE) ?>
								<?php if ($campo2 == 52 || $campo2 == 51 || $campo2 == 57 || $campo2 == 58) { ?> * <?php  } ?>


							</label>
							<div class="col-md-12">
								<?php
								if ($campo2 == 52 || $campo2 == 54) {

									$valoresLista = listAditionalInformation($this, $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "LISTA_ADC2", ORDER_STATE), 1);


								?>
									<select class="form-control " id="campo2" name="campo2" <?php if ($campo2 == 52) { ?> required="required" <?php  } ?>>
										<option value="">--- Seleccione una opci&oacute;n ---</option>
										<?= $valoresLista; ?>
									</select>
								<?php
								}
								?>


								<?php
								if ($campo2 == 51 || $campo2 == 53) {

								?>
									<input type="text" class="form-control " id="campo2" name="campo2" placeholder="Escriba aqu&iacute; un descripci&oacute;n corta" <?php if ($campo2 == 51) { ?> required="required" <?php  } ?>>
								<?php
								}
								?>



								<?php
								if ($campo2 == 57 || $campo2 == 59) {

								?>
									<input type="text" class="form-control datepicker" id="campo2" name="campo2" placeholder="aaaa/mm/dd" <?php if ($campo2 == 57) { ?> required="required" <?php  } ?>>

								<?php
								}
								?>
								<?php
								if ($campo2 == 58 || $campo2 == 60) {

								?>
									<input type="number" class="form-control " id="campo2" name="campo2" min="0" placeholder="Ej 1000" <?php if ($campo2 == 58) { ?> required="required" <?php  } ?>>
								<?php
								}
								?>

								<div class="form-control-feedback"></div>
							</div>
						</div>
					<?php
					}
					?>

					<?php
					if ($campo3 != VALUE_STATE_NOT) {

					?>
						<div class="form-group campo3">
							<label class="col-md-12" id="labelcampo3"><?=
																		$this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "NOMCAMPO_ADC3", ORDER_STATE) ?>
								<?php if ($campo3 == 52 || $campo3 == 51 || $campo3 == 57 || $campo3 == 58) { ?> * <?php  } ?>


							</label>
							<div class="col-md-12">
								<?php
								if ($campo3 == 52 || $campo3 == 54) {

									$valoresLista = listAditionalInformation($this, $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "LISTA_ADC3", ORDER_STATE), 1);


								?>
									<select class="form-control " id="campo3" name="campo3" <?php if ($campo3 == 52) { ?> required="required" <?php  } ?>>
										<option value="">--- Seleccione una opci&oacute;n ---</option>
										<?= $valoresLista; ?>
									</select>
								<?php
								}
								?>


								<?php
								if ($campo3 == 51 || $campo3 == 53) {

								?>
									<input type="text" class="form-control " id="campo3" name="campo3" placeholder="Escriba aqu&iacute; un descripci&oacute;n corta" <?php if ($campo3 == 51) { ?> required="required" <?php  } ?>>
								<?php
								}
								?>



								<?php
								if ($campo3 == 57 || $campo3 == 59) {

								?>
									<input type="text" class="form-control datepicker" id="campo3" name="campo3" placeholder="aaaa/mm/dd" <?php if ($campo3 == 57) { ?> required="required" <?php  } ?>>

								<?php
								}
								?>


								<?php
								if ($campo3 == 58 || $campo3 == 60) {

								?>
									<input type="number" class="form-control " id="campo3" name="campo3" min="0" placeholder="Ej 1000" <?php if ($campo3 == 58) { ?> required="required" <?php  } ?>>
								<?php
								}
								?>






								<div class="form-control-feedback"></div>
							</div>
						</div>
					<?php
					}
					?>
					<?php
					if ($campo4 != VALUE_STATE_NOT) {

					?>
						<div class="form-group campo4">
							<label class="col-md-12" id="labelcampo4"><?=
																		$this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "NOMCAMPO_ADC4", ORDER_STATE) ?>
								<?php if ($campo4 == 52 || $campo4 == 51 || $campo4 == 57 || $campo4 == 58) { ?> * <?php  } ?>


							</label>
							<div class="col-md-12">
								<?php
								if ($campo4 == 52 || $campo4 == 54) {

									$valoresLista = listAditionalInformation($this, $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "LISTA_ADC4", ORDER_STATE), 1);


								?>
									<select class="form-control " id="campo4" name="campo4" <?php if ($campo4 == 52) { ?> required="required" <?php  } ?>>
										<option value="">--- Seleccione una opci&oacute;n ---</option>
										<?= $valoresLista; ?>
									</select>
								<?php
								}
								?>


								<?php
								if ($campo4 == 51 || $campo4 == 53) {

								?>
									<input type="text" class="form-control " id="campo4" name="campo4" placeholder="Escriba aqu&iacute; un descripci&oacute;n corta" <?php if ($campo4 == 51) { ?> required="required" <?php  } ?>>
								<?php
								}
								?>



								<?php
								if ($campo4 == 57 || $campo4 == 59) {

								?>
									<input type="text" class="form-control datepicker" id="campo4" name="campo4" placeholder="aaaa/mm/dd" <?php if ($campo4 == 57) { ?> required="required" <?php  } ?>>

								<?php
								}
								?>


								<?php
								if ($campo4 == 58 || $campo4 == 60) {

								?>
									<input type="number" class="form-control " id="campo4" name="campo4" min="0" placeholder="Ej 1000" <?php if ($campo4 == 58) { ?> required="required" <?php  } ?>>
								<?php
								}
								?>






								<div class="form-control-feedback"></div>
							</div>
						</div>
					<?php
					}
					?>
					<?php
					if ($campo5 != VALUE_STATE_NOT) {

					?>
						<div class="form-group campo5">
							<label class="col-md-12" id="labelcampo5"><?=
																		$this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "NOMCAMPO_ADC5", ORDER_STATE) ?>
								<?php if ($campo5 == 52 || $campo5 == 51 || $campo5 == 57 || $campo5 == 58) { ?> * <?php  } ?>


							</label>
							<div class="col-md-12">
								<?php
								if ($campo5 == 52 || $campo5 == 54) {

									$valoresLista = listAditionalInformation($this, $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "LISTA_ADC5", ORDER_STATE), 1);


								?>
									<select class="form-control " id="campo5" name="campo5" <?php if ($campo5 == 52) { ?> required="required" <?php  } ?>>
										<option value="">--- Seleccione una opci&oacute;n ---</option>
										<?= $valoresLista; ?>
									</select>
								<?php
								}
								?>


								<?php
								if ($campo5 == 51 || $campo5 == 53) {

								?>
									<input type="text" class="form-control " id="campo5" name="campo5" placeholder="Escriba aqu&iacute; un descripci&oacute;n corta" <?php if ($campo5 == 51) { ?> required="required" <?php  } ?>>
								<?php
								}
								?>



								<?php
								if ($campo5 == 57 || $campo5 == 59) {

								?>
									<input type="text" class="form-control datepicker" id="campo5" name="campo5" placeholder="aaaa/mm/dd" <?php if ($campo5 == 57) { ?> required="required" <?php  } ?>>

								<?php
								}
								?>


								<?php
								if ($campo5 == 58 || $campo5 == 60) {

								?>
									<input type="number" class="form-control " id="campo5" name="campo5" min="0" placeholder="Ej 1000" <?php if ($campo5 == 58) { ?> required="required" <?php  } ?>>
								<?php
								}
								?>
								<div class="form-control-feedback"></div>
							</div>
						</div>
					<?php
					}
					?>

				</div>

			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title">
								<i class="fa fa-file-pdf-o   fa-2x"></i> Formato Toma De Medida </small>
							</h5>
							<br>
							<div class="clearfix" style="text-align:center;">
								<center>
									<?php
									if ($nombreTipo == 'SILLAS' || $nombreTipo == 'AYUDAS MOVILIDAD' || $nombreTipo == 'HOME CARE' || $nombreTipo == 'COJINES' || $nombreTipo == 'AYUDAS DE MOVILIDAD IVA') {
									?>
										<a href="<?= base_url() . STOKEPRICE_FOLDER . 'FO-18-14.xlsx'; ?>" target="_blank" class="btn  btn-info btn-rounded pull-left waves-effect waves-light m-r-10">
											<i class="fa fa-paperclip "></i> <span class="hidden-xs"> Toma de Medidas Movilidad</span>
										</a>
									<?php
									}
									?>
									<?php
									if ($nombreTipo == 'PROTESIS' ||
										$nombreTipo == 'CAMBIOS DE SOCKET' ||
										$nombreTipo == 'COMPONENTES PRÓTESIS MMII' ||
										$nombreTipo == 'COMPONENTES PRÓTESIS MMSS' ||
										$nombreTipo == 'ORTOPROTESIS') {
										if ($tipoMiembro == 'Miembros superiores') {
									?>
											<a href="<?= base_url() . STOKEPRICE_FOLDER . 'FO-18-10.xlsx'; ?>" target="_blank" class="btn  btn-info btn-rounded pull-left waves-effect waves-light m-r-10">
												<i class="fa fa-paperclip "></i> <span class="hidden-xs"> Prótesis Miembro Superior</span>
											</a>
										<?php
										}

										if ($tipoMiembro == 'Miembros Inferiores') {
										?>
											<a href="<?= base_url() . STOKEPRICE_FOLDER . 'FO-18-9.xlsx'; ?>" target="_blank" class="btn  btn-info btn-rounded pull-left waves-effect waves-light m-r-10">
												<i class="fa fa-paperclip "></i> <span class="hidden-xs"> Prótesis Miembro Inferior</span>
											</a>
									<?php
										}
									}

									?>
									<?php
									//if ($adjunto2 != '') {
									?>
									<!--<a href="<?= base_url() . STOKEPRICE_FOLDER . $adjunto2; ?>" target="_blank" class="btn  btn-info btn-rounded pull-left waves-effect waves-light m-r-10">
											<i class="fa fa-paperclip "></i> <span class="hidden-xs"> Orden m&eacute;dica</span>
										</a>-->

									<?php
									//	}
									?>
								</center>
							</div>
							<br>
							<div class="form-group ">
								<label class="col-md-12" for="adjunto1">Información Clínica Antropométrica </label>
								<div class="col-md-12">
									<input type="file" class="form-control " id="adjunto1" name="adjunto1">
									<div class="form-control-feedback"></div>
								</div>
							</div>
							<div class="form-group ">
								<div class="col-md-12">
									<input type="file" class="form-control " id="adjunto2" name="adjunto2">
									<div class="form-control-feedback"></div>
								</div>
							</div>



						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<?php
					if ($idCotizacion != null) {
					?>
						<a href="<?= base_url() ?>OrdersAppOrder/newOrderFromRequest/<?= $idCotizacion; ?>/<?= $id; ?>" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10">

						<?php
					} else {
						?>
							<a href="<?= base_url() ?>OrdersAppOrder/createOrder/<?= $id; ?>" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10">
							<?php
						}
							?>
							<i class="fa fa-arrow-left"></i>
							<span class="hidden-xs"> Retornarr</span>
							</a>
							<button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
							<input type="hidden" name="id" id="id" value="<?= $id; ?>">
							<input type="hidden" name="idArbol" id="idArbol" value="<?= $idArbol; ?>">
							<input type="hidden" name="tipoOrden" id="tipoOrden" value="<?= $tipoOrden; ?>">
							<input type="hidden" name="idCotizacion" id="idCotizacion" value="<?= $idCotizacion; ?>">
							<input type="hidden" name="claseTipo" id="claseTipo" value="<?= $claseTipo; ?>">
				</div>
				<div class="col-sm-12">
				</div>
			</div>
			<br>

		</div>


		<!-- Column -->
	</div>
</form>
<!-- .modal -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" id="myModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myLargeModalLabel">Detalle de la informaci&oacute;n del producto o servicio seleccionado</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times "></i></button>
			</div>
			<div class="modal-body" style="align:'center'">
				<div class="col-lg-12 col-md-12 col-sm-312 col-xs-12">
					<div class="ribbon-wrapper card">
						<div class="ribbon ribbon-bookmark  ribbon-default" id="nombre">Descripci&oacute;n del producto</div>
						<h3>Descripci&oacute;n del producto</h3>
						<p class="ribbon-content" id="descripcion">El sistema de informaci&oacute;n est&aacute; cargando la informaci&oacute;n del producto, Por favor espere.</p>
						<div class="table-responsive m-t-40" id="despiece">
						</div>
					</div>

				</div>
			</div>
			<div class="modal-footer" style="color: white;">
				<button type="button" class="btn  btn-rounded waves-effect text-left" data-dismiss="modal">Cerrar</button>

			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->