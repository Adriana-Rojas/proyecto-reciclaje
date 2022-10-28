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
	/**Valida los campos de acuerdo al tipo*/


	$(document).ready(function() {
		$('#tipo').change(function() {
			if ($("#tipo").val() == 0) {
				$("#adjunto").prop('disabled', false);
				$("#numero").prop('disabled', false);
				$(".adjunto").show();
			} else {
				$("#adjunto").prop('disabled', true);
				$("#numero").prop('disabled', true);
				$(".adjunto").hide();
			}
		});



	});
</script>
<!-- ============================================================== -->
<!-- END PAGE JQUERY ROUTINES -->
<!-- ============================================================== -->


<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->

<!-- Row -->
<div class="row">
	<!-- Column -->
	<div class="col-md-12 col-xs-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<!--<div class="col-md-1 col-xs-6 b-r"></div>-->
					<div class="col-md-2 col-xs-6 b-r">
						<strong>Cotizaci&oacute;n n&uacute;mero</strong> <br>
						<p class="text-muted"><?= $consecutivo; ?></p>
					</div>
					<div class="col-md-2 col-xs-6 b-r">
						<strong>Documento de identidad</strong> <br>
						<p class="text-muted"><?= $tipoDocumento, " ", $documento; ?></p>
					</div>

					<div class="col-md-2 col-xs-6 b-r">
						<strong>Nombre Completo</strong> <br>
						<p class="text-muted">
							<?= $paciente; ?></p>
					</div>
					<div class="col-md-2 col-xs-6 b-r">
						<strong>Responsable</strong> <br>
						<p class="text-muted"><?= $empresaCoti; ?></p>
					</div>
					<div class="col-md-2 col-xs-6 b-r">
						<strong>Fecha de cotizaci&oacute;n</strong> <br>
						<p class="text-muted"><?= $fecha; ?></p>
					</div>
					<div class="col-md-2 col-xs-6 b-r">
						<strong>Autorizaci&oacute;n</strong> <br>
						<p class="text-muted">
							<?php
							if ($listadoHistoria != null) {
								foreach ($listadoHistoria as $value) {
									//var_dump($value);

							?>
									<?= $this->encryption->decrypt($value->AUTORIZACION); ?>

							<?php

								} // end foreach
							} // end if

							?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Column -->
</div>


<div class="row">
	<!-- Column -->
	<div class="col-lg-12 col-xlg-12 col-md-12">
		<div class="card">
			<div class="card-body">
				<h3>
					&nbsp;<b> <i class="fa fa-bar-chart"></i> Detalle de la
						cotizaci&oacute;n
					</b>
				</h3>
				<div class="row">
					<div class="table-responsive m-t-40" style="clear: both;">

						<table class="table table-hover">
							<thead>
								<tr>
									<th class="text-right">C&oacute;digo</th>
									<th class="text-right">Nombre</th>
									<th class="text-right">Tipo</th>
									<th class="text-right">Cantidad</th>
									<th class="text-right">Margen</th>
									<th class="text-right">Costos Materiales</th>
									<th class="text-right">Costos Mano Obra</th>
									<th class="text-right">Costos Adicionales</th>

									<th class="text-right">Valor unitario</th>
									<th class="text-right">Valor total</th>
									<th class="text-right">Detalles</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$valor = 0;
								$bandera = 0;
								$totalDescuento = 0;
								$totalIvaFinal = 0;
								$totalNeto = 0;
								$subtotalNeto = 0;
								$subtotalDescuento = 0;
								$subtotalIva = 0;
								if ($listaDetalle != null) {
									foreach ($listaDetalle as $value) {



										$valUnitario = defineValorUnitario($value->VALOR, $value->CANTIDAD, $costoAdicional / $totalProducto);
										$totalNeto += $valUnitario;
										$subtotalNeto += $valUnitario * $value->CANTIDAD;

										$valDescuento = $valUnitario * $descuento;
										$totalDescuento = $totalDescuento + $valDescuento;
										$subtotalDescuento += $valDescuento * $value->CANTIDAD;

										$valorBruto = $valUnitario - $valDescuento;
										//Verifico si tiene IVA
										$iva = defineIvaValue($value->ID_TIPO, $value->CODIGO, $this);
										$totalIva = ($valorBruto) * $iva;
										$subtotalIva += $totalIva * $value->CANTIDAD;
										$totalIvaFinal += $totalIva;

										$valorTotal = ($valorBruto + $totalIva) * $value->CANTIDAD;
										$valor = $valor + ($valorTotal);



								?>
										<tr>
											<td class="text-right"><?= $value->CODIGO; ?></td>
											<td class="text-right"><?= $value->NOMBRE; ?></td>
											<td class="text-right"><?= $value->TIPO; ?></td>
											<td class="text-right"><?= numberFormatEvolution($value->CANTIDAD); ?></td>
											<td class="text-right"><?= numberFormatEvolution($value->MARGEN); ?></td>
											<td class="text-right"><?= numberFormatEvolution($value->MATERIALES); ?></td>
											<td class="text-right"><?= numberFormatEvolution($value->MANOOBRA); ?></td>
											<td class="text-right"><?= numberFormatEvolution($value->ASOCIADOS); ?></td>
											<td class="text-right"><?= numberFormatEvolution($value->VALOR); ?></td>
											<td class="text-right"><?= numberFormatEvolution($value->CANTIDAD * $value->VALOR); ?></td>
											<td class="text-right">
												<a href="<?= base_url() . 'StokePriceAppStokePrice/detailsDespiece/' . $this->encryption->encrypt($value->ID_ELEMENTO_COTIZACION) . '/' . $idCotizacion ?>" class="btn btn-info btn-rounded" data-toggle="dropdown aria-haspopup=" true" aria-expanded="false">
													<i class="fa fa-search"></i>
												</a>
											</td>

										</tr>
								<?php
									}
								}
								?>
							</tbody>
						</table>

					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<div class="pull-right m-t-30 text-right">
							<h3>
								<b>Sub total cotizaci&oacute;n :</b> $ <?= numberFormatEvolution($subtotalNeto); ?>
							</h3>
							<h3>
								<b> (-) Descuento:</b> $ <?= numberFormatEvolution($subtotalDescuento); ?>
							</h3>
							<h3>
								<h3>
									<b> (+) IVA:</b> $ <?= numberFormatEvolution($subtotalIva); ?>
								</h3>
								<h3>
									<b class="text-danger">Total cotizaci&oacute;n: $ <?= numberFormatEvolution($valor); ?></b>
								</h3>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Column -->
	<div class="col-lg-12 col-xlg-12 col-md-12">
		<div class="card">
			<div class="card-body p-b-0">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs customtab2" role="tablist">
					<li class="nav-item" style="<?= $hide ?>"><a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"><i class="fa fa-home"></i></span> <span class="hidden-xs-down">Seguimiento</span></a>
					</li>
					<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#history" role="tab"><span class="hidden-sm-up"><i class="fa fa-history"></i></span> <span class="hidden-xs-down">Hist&oacute;rico</span></a>
					</li>
					<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#modify" role="tab"><span class="hidden-sm-up"><i class="fa fa-commenting-o"></i></span> <span class="hidden-xs-down">Historial de cambios</span></a>
					</li>

					<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#documents" role="tab"><span class="hidden-sm-up"><i class="fa fa-folder-open"></i></span> <span class="hidden-xs-down">Documentos soporte</span></a>
					</li>

				</ul>
				<!-- Tab panes -->
				<div class="tab-content">
					<div class="tab-pane active" id="home" role="tabpanel" style="<?= $hide ?>">
						<!-- Contenido del tab -->
						<form class=" form-horizontal" role="form" Action="<?= base_url() ?>StokePriceAppStokePrice/saveTrace" Id="form_sample_3" method="post" autocomplete="off" enctype="multipart/form-data">
							<div class="p-20">
								<h3>Realizar seguimiento.</h3>
								<p align="justify">Genere el seguimiento a la cotizaci&oacute;n
									.</p>
							</div>
							<div class="card">
								<div class="card-body">

									<div class="form-group ">
										<label class="col-md-12" for="tipo">Tipificaci&oacute;n de
											seguimiento *</label>
										<div class="col-md-12">
											<select class="form-control" id="tipo" name="tipo">

												<option value="">--- Seleccione una opci&oacute;n ---</option>
												<?php
												if ($listaSeguimiento != null) {
													foreach ($listaSeguimiento as $value) {
														if ($value->ID != -1) {
												?>
															<option value="<?= $value->ID; ?>"><?= $value->NOMBRE; ?></option>
												<?php
														}
													}
												}
												?>
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

									<div class="form-group adjunto" style="display: none;">
										<label class="col-md-12" for="numero">N&uacute;mero de autorizaci&oacute;n * </label>
										<div class="col-md-12">
											<input class="form-control " type="text" name="numero" id="numero" placeholder="Ej. AUT-0894840-2018" />
										</div>
									</div>
									<div class="form-group adjunto" style="display: none;">
										<label class="col-md-12" for="adjunto">Soporte de Autorizaci&oacute;n </label>
										<div class="col-md-12">
											<input type="file" class="form-control " id="adjunto" name="adjunto" disabled="disabled">
											<div class="form-control-feedback"></div>
										</div>
									</div>

									<button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>

									<input type="hidden" name="id" id="id" value="<?= $idCotizacion; ?>">

								</div>
							</div>
						</form>
						<!-- Contenido del tab -->
					</div>
					<div class="tab-pane" id="history" role="tabpanel">
						<!-- Contenido del tab -->
						<div class="p-20">
							<h3>Seguimiento de la cotizaci&oacute;n .</h3>
							<p align="justify">Visualice el avance frente al seguimiento
								realizado a la cotizaci&oacute;n.</p>
							<ul class="list-unstyled">
								<?php
								if ($listadoHistoria != null) {
									foreach ($listadoHistoria as $value) {
								?>
										<li class="media"><i class="fa fa-check fa-4x"></i>

											<div class="media-body">
												<h3 class="mt-0 mb-1"><?= $value->TIPO; ?> </h3>
												<?= $this->encryption->decrypt($value->OBSERVACION); ?>
												<br><?= $value->NOMBRES . " " . $value->APELLIDOS; ?> -
												<small><?= $value->PERFIL; ?></small><br /> <small> <i class="fa fa-clock-o"></i> <?= $value->FECHA; ?></small>
												<p>Autorizaci&oacute;n: <?= $this->encryption->decrypt($value->AUTORIZACION); ?></p>
											</div>
										</li>
								<?php
									} // end foreach
								} // end if
								?>
							</ul>
						</div>
						<!-- Contenido del tab -->


					</div>

					<div class="tab-pane" id="modify" role="tabpanel">
						<!-- Contenido del tab -->
						<div class="p-20">
							<h3>Historial de cambios en la cotizaci&oacute;n .</h3>
							<p align="justify">Visualice los cambios realizados a la cotizaci&oacute;n
								realizado a la cotizaci&oacute;n.</p>
							<ul class="list-unstyled">
								<?php
								if ($listadoBitacora != null) {

									foreach ($listadoBitacora as $value) {

								?>
										<li class="media"><i class="fa fa-check fa-4x"></i>

											<div class="media-body">

												<?= $value->OBSERVACION; ?>
												<br><?= $value->NOMBRES . " " . $value->APELLIDOS; ?> -
												<small><?= $value->PERFIL; ?></small><br /> <small> <i class="fa fa-clock-o"></i> <?= $value->FECHA; ?>
													<br>Costos adicionales: <?= "$ " . number_format($costoAdicional, 2, ",", "."); ?>
													<br><?php if ($descripcionCostos != null) {
															echo "Descripci&oacute;n de costos adicionales: " . $descripcionCostos;
														} else {
															echo "Descripci&oacute;n de costos adicionales: No realiz&oacute; descripciones";
														} ?></small>
											</div>
										</li>
								<?php
									} // end foreach
								} // end if
								?>
							</ul>
						</div>
						<!-- Contenido del tab -->


					</div>

					<div class="tab-pane" id="documents" role="tabpanel">
						<!-- Contenido del tab -->
						<div class="p-20">
							<div class="clearfix" style="text-align:center;">
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
							</div>
						</div>
						<!-- Contenido del tab -->


					</div>

				</div>


			</div>

		</div>

		<a href="<?= base_url(); ?>/StokePriceAppStokePrice/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10">
			<i class="fa fa-arrow-left"></i> <span class="hidden-xs"> Retornar</span>
		</a>

	</div>

	<!-- Column -->
</div>


<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->