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


if ($detLista != null) {
	$i = 0;
	$contadorArray = count($detLista);
	foreach ($detLista as $value) {
		$arrayNombre[$i] = $value->NOMBRE;
		$arrayId[$i] = $value->ID;
		$i++;
	}
	$registros = $contadorArray;
} else {
	$registros = 1;
	$contadorArray = 0;
}

?>

<!-- ============================================================== -->
<!-- JavaScript para pintar campos adicionales -->
<!-- ============================================================== -->

<script type="text/javascript">
	$(document).ready(function() {
		$('#aplica').change(function() {
			if ($("#aplica").val() != <?= CTE_VALOR_SI ?>) {
				$(".aplica").hide();
				$("#proveedor").prop('disabled', true);
			} else {
				$(".aplica").show();
				$("#proveedor").prop('disabled', false);
			}
		});
	});
	$(document).ready(function() {
		$("#grupo").change(function() {
			$("#grupo option:selected").each(function() {
				grupo = $('#grupo').val();
				$.post("<?= base_url() ?>/Integration/reloadCharacteristics", {
					grupo: grupo
				}, function(data) {
					$("#caracteristica").html(data);
				});
			});
		})
	});
	$(document).ready(function() {
		/**
		 * Funcion para a�adir una nueva columna en la tabla
		 */
		$("#add").click(function() {
			// a�adir nueva fila usando la funcion addTableRow
			var id = parseInt($('#registros').val()) + 1;
			$('#registros').val(id);
			$("#fila" + id).show();
			$("#valor" + id).prop('disabled', false);
			$("#nombre" + id).prop('disabled', false);
			if (id > 1) {
				$("#del").prop('disabled', false);
			}
		});

		$("#del").click(function() {
			var id = parseInt($('#registros').val());
			if (id >= 2) {
				$("#fila" + id).hide();
				$("#valor" + id).prop('disabled', false);
				$("#nombre" + id).prop('disabled', false);
				id = id - 1;
				$('#registros').val(id);
			} else {
				$("#del").prop('disabled', true);
			}
		});

	});
</script>

<!-- ============================================================== -->
<!-- FIn JavaScript para pintar campos adicionales -->
<!-- ============================================================== -->


<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<form class=" form-horizontal" role="form" action="<?= base_url() ?>OrdersConfigurationLevelDefinition/saveRegister" id="form_sample_3" method="post" autocomplete="off">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Definici&oacute;n de n&iacute;veles para &aacute;rbol de &oacute;rdenes </h4>
					<h6 class="card-subtitle">Gestione los diferentes n&iacute;veles que podr&aacute; usar dentro de los &aacute;rbol de &oacute;rdenes </h6>

				</div>
				<div class="form-group">
					<label class="col-md-12" for="nombre">Nombre *</label>
					<div class="col-md-12">
						<input type="text" class="form-control" id="nombre" name="nombre" value="<?= $nombre ?>" placeholder="Ej. Lateralidad">
						<div class="form-control-feedback"> </div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-12" for="miembros">Miembros *</label>
					<div class="col-md-12">
						<select class="form-control" id="miembros" name="miembros">
							<option value="">--- Seleccione una opci&oacute;n ---</option>
							<?php
							foreach ($listaMiembros->result() as $value) {
								if ($value->ID == $valorMiembros) {
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
				<div class="form-group">
					<label class="col-md-12" for="valorValida">Valida en *</label>
					<div class="col-md-12">
						<select class="form-control" id="valorValida" name="valorValida">
							<option value="">--- Seleccione una opci&oacute;n ---</option>
							<?php foreach ($listaValida->result()  as $value) {
								if ($value->ID == $valorValida) {
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

				<div class="form-group">
					<label class="col-md-12" for="subnivel">Sub Nivel relacionado*</label>
					<div class="col-md-12">
						<select class="form-control" id="subnivel" name="subnivel">
							<option value="">--- Seleccione una opci&oacute;n ---</option>
							<?php foreach ($listaSubnivel as $value) {
								if ($value->ID == $valorSubnivel) {
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

				<div class="form-group">
					<div class="clearfix" style="text-align:center;">

						<button class="btn btn-secondary btn-rounded waves-effect waves-light m-r-10 " type="button" id='add' name='add'>
							<i class="ace-icon fa fa-plus-square  bigger-110"></i>
							Adicionar
						</button>
						<button class="btn btn-secondary btn-rounded waves-effect waves-light m-r-10 " type="button" id='del' name='del' disabled="disabled">
							<i class="ace-icon fa fa-minus-square  bigger-110"></i>
							Eliminar
						</button>

					</div>
				</div>
				<div class="form-group">
					<div class="clearfix" style="text-align:center;">
						<center>
							<table id="dynamic-table" class="table m-t-30 table-hover " style="width: 50%; ">
								<thead>
									<tr>
										<th width="50%">Valor</th>
										<th width="50%">Nombre</th>
									</tr>
								</thead>
								<tbody>
									<?php for ($i = 1; $i < MAX_LIST; $i++) {
										$k = $i - 1;
										if ($k < $contadorArray) {
											$tempoNombre = $arrayNombre[$k];
											$tempoId = $arrayId[$k];
										} else {
											$tempoNombre = '';
											$tempoId = '';
										}
									?>

										<tr id="fila<?= $i ?>" <?php
																if ($i > $registros) {
																	$disabled = "disabled='disabled'";
																	echo "style=\"display:none;\"";
																} else {
																	$disabled = "";
																	echo "";
																}
																?>>
											<td>
												<input type="hidden" name="id<?= $i ?>" id="id<?= $i ?>" value="<?= $tempoId; ?>">
												valor relaci&oacute;n <?= $i ?>
											</td>
											<td>
												<input type="text" id="valor<?= $i ?>" name="valor<?= $i ?>" value="<?= $tempoNombre ?>" class="col-md-12 " <?= $disabled ?> />
											</td>


										</tr>
									<?php } ?>
								</tbody>
							</table>
						</center>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- Bot�n de envio de formulario -->
	<div class="row">
		<div class="col-sm-12">
			<a href="<?= base_url() ?>OrdersConfigurationLevelDefinition/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10">
				<i class="fa fa-arrow-left"></i>
				<span class="hidden-xs"> Retornar</span>
			</a>
			<button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
			<input type="hidden" name="id" id="id" value="<?= $id; ?>">
			<input type="hidden" name="valida" id="valida" value="<?= $valida; ?>">
			<input type="hidden" name="registros" id="registros" value="<?= $registros; ?>">
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