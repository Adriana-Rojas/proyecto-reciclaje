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
<!-- BEGIN PAGE JQUERY ROUTINES -->
<!-- ============================================================== -->


<script>
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>


<!-- ============================================================== -->
<!-- END PAGE JQUERY ROUTINES -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<form class=" form-horizontal" role="form" action="<?= base_url() . $pagina ?>" id="form_sample_3" method="post" autocomplete="off">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title"> Datos generales
						<small class="font-gray">Identifique la ubicaci&oacute;n de la empresa aliada</small>
					</h5>

					<div class="form-group ">
						<label class="col-md-12" for="empresa">Empresa aliada* </label>
						<div class="col-md-12">
							<select class="form-control" id="empresa" name="empresa" data-live-search="true">
								<option value="">--- Seleccione una opci&oacute;n ---</option>
								<?php
								if ($listaEmpresas != null) {

									foreach ($listaEmpresas as $value) {
										if ($value->ID_APB == $empresa) {
											$selected = "selected='selected'";
										} else {
											$selected = "";
										}
								?>
										<option value="<?= $value->ID_APB; ?>" <?= $selected ?>><?= $value->NOM_APB; ?></option>
								<?php
									}
								} ?>
							</select>
							<script>
								$('select').selectpicker();
							</script>
							<div class="form-control-feedback"> </div>
						</div>
					</div>
					<div class="form-group ">
						<label class="col-md-12" for="departamento">Departamento* </label>
						<div class="col-md-12">
							<select class="form-control" id="departamento" name="departamento">
								<option value="">--- Seleccione una opci&oacute;n ---</option>
								<?php
								if ($listaDepartamento != null) {
									foreach ($listaDepartamento->result() as $value) {
										if ($value->ID == $departamento) {
											$selected = "selected='selected'";
										} else {
											$selected = "";
										}
								?>
										<option value="<?= $value->ID; ?>" <?= $selected ?>><?= $value->NOMBRE; ?></option>
								<?php
									}
								} ?>
							</select>
							<div class="form-control-feedback"> </div>
						</div>
					</div>

					<div class="form-group ">
						<label class="col-md-12" for="ciudad">Ciudad (Municipio)* </label>
						<div class="col-md-12">
							<select class="form-control" id="ciudad" name="ciudad">
								<option value="">--- Seleccione una opci&oacute;n ---</option>
								<?php
								if ($listaCiudad != null) {
									foreach ($listaCiudad as $value) {
										if ($value->ID == $ciudad) {
											$selected = "selected='selected'";
										} else {
											$selected = "";
										}
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
						<label class="col-md-12" for="correo">Correo electr&oacute;nico </label>
						<div class="col-md-12">
							<input class="form-control " type="email" name="correo" id="correo" placeholder="correo@correo.com.co" value="<?= $correo; ?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="telefono">Tel&eacute;fono </label>
						<div class="col-md-12">
							<input class="form-control " type="text" name="telefono" id="telefono" placeholder="Ej. 4565656" value="<?= $telefono; ?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="direccion">Dirección </label>
						<div class="col-md-12">
							<input class="form-control " type="text" name="direccion" id="direccion" placeholder="Ej. Calle 16e #03-09 sur" value="<?= $direccion; ?>" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>



	<!-- Bot�n de envio de formulario -->
	<div class="row">
		<div class="col-sm-12">
			<a href="<?= base_url() ?>SystemPartnerCompany/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10">
				<i class="fa fa-arrow-left"></i>
				<span class="hidden-xs"> Retornar</span>
			</a>
			<button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
			<input type="hidden" name="id" id="id" value="<?= $id; ?>">
			<input type="hidden" name="valida" id="valida" value="<?= $valida; ?>">
		</div>
		<div class="col-sm-12">
			<br>
		</div>
	</div>
	<!-- FIN Bot�n de envio de formulario -->


</form>
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->
