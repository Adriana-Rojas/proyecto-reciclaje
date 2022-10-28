<?php
error_reporting(0);

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


<!-- This page CSS -->



<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- Inicio totales generales -->
<!-- ============================================================== -->

<!-- Librerias para gr�ficos -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<h1>
	<i class=""></i>Tablero general de control
</h1>
<div class="row">
	<?php
	$colors = arrayColor();
	if ($procesos != null) {
		$i = 0;
		$total = 0;
		foreach ($procesos as $value) {

	?>
			<!-- Column -->
			<div class="col-lg-3 col-md-6">
				<div class="card">
					<div class="card-body">
						<div class="row p-t-10 p-b-10">
							<!-- Column -->
							<div class="col p-r-0">
								<h1 class="font-light" style="color: <?= $colors[$i] ?>;"><?php

																							$datos = $this->OrdersModel->selectQuantityOrderByProcess($value->ID);
																							if ($datos != null) {
																								$t = 0;
																								foreach ($datos as $dato) {
																									$t = $t + $dato->CANTIDAD;
																								}
																								$total = $total + $t;
																								echo $t;
																							} else {
																								echo 0;
																							}
																							?></h1>
								<h5 style="color: <?= $colors[$i] ?>;"><?= $value->NOMBRE; ?></h5>
							</div>
							<!-- Column -->
							<div class="col text-right align-self-center">
								<i class="<?= $value->ICONO; ?>  fa-4x" style="color: <?= $colors[$i] ?>;"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

	<?php
			$i++;
		}
	}
	?>

	<!-- Column -->
	<div class="col-lg-3 col-md-6">
		<div class="card">
			<div class="card-body">
				<div class="row p-t-10 p-b-10">
					<!-- Column -->
					<div class="col p-r-0">
						<h1 class="font-light" style="color: navy;"><?= $total; ?></h1>
						<h5 style="color: navy;">&Oacute;rdenes activas</h5>
					</div>
					<!-- Column -->
					<div class="col text-right align-self-center">
						<i class="fa fa-users fa-4x" style="color: navy;"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ============================================================== -->
<!-- Fin totales generales -->
<!-- ============================================================== -->

<?php
if ($graficas) {
?>
	<!-- ============================================================== -->
	<!-- Inicio Gr�ficas situaci�n actual -->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-lg-6">
			<div class="card">
				<div class="card-body">
					<div class="d-flex m-b-40 align-items-center no-block">
						<h5 class="card-title ">&Oacute;rdenes abiertas</h5>

					</div>
					<div id="myfirstchart" style="height: 340px;"></div>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="card">
				<div class="card-body">
					<div class="d-flex m-b-40 align-items-center no-block">
						<h5 class="card-title ">Hist&oacute;rico de &oacute;rdenes</h5>

					</div>
					<div id="mysecondchart" style="height: 340px;"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- Fin Gr�ficas situaci�n actual -->
	<!-- ============================================================== -->
<?php
}
?>
<?php
if ($ordenes != null) {
?>

	<!-- ============================================================== -->
	<!-- Review -->
	<!-- ============================================================== -->
	<div class="row">
		<!-- Column -->
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table id="myTable" class="table m-t-30 table-hover ">
							<thead>
								<tr>
									<th>Acci&oacute;n</th>
									<th>N&uacute;mero de orden</th>
									<th>Documento</th>
									<th>Nombres y Apellidos</th>
									<th>Cliente</th>
									<th>Ciudad de Atencion</th>

									<th width="18%">Elemento</th>
									<th>Estado actual</th>
									<th><i class="	fa fa-calendar"></i> Fecha inicio estado</th>
									<th><i class="fa fa-calendar"></i> Dias en estado</th>

								</tr>
							</thead>
							<tbody>
								<?php
								$i = 0;
								foreach ($ordenes as $value) {
									if ($i <= MAX_NOTIFICACIONES_BOARD) {

										$id = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_ADMISIONES", "ID_PCTE_ADM", "ID_AMSION", $value->HISTORIA);
										echo "<script>console.log('value->HISTORIA id: " . $id . "' );</script>";

										$paciente = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "PRI_NOM_PCTE", "ID_PCTE", $id) . " " . $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "SEG_NOM_PCTE", "ID_PCTE", $id) . " " . $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "PRI_APELL_PCTE", "ID_PCTE", $id) . " " . $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "SEG_APELL_PCTE", "ID_PCTE", $id);

										$cedula = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "NUM_ID_PCTE", "ID_PCTE", $id);
										//Orden encabezado
										$idEncOrden = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ORDEN", "ID_ENCORDEN", "ID", $value->ID);
										$datos = selectPatienInformationFromOrder($idEncOrden, $this);
										$responsable = $datos[0];
										$telefono = $datos[1];
										$telefono2 = $datos[2];
										$direccion = $datos[3];
										$municipio = $datos[4];


								?>
										<tr>

											<td class="text-center"><a href="<?= base_url() ?>OrdersAppOrder/tracerProcess/<?= $this->encryption->encrypt($value->HISTORIA); ?>/<?= $this->encryption->encrypt($value->ID); ?>" class="btn  btn-info btn-rounded pull-left waves-effect waves-light m-r-10">
													<i class="fa fa fa-tachometer"></i> <span class="hidden-xs">
														Seguimiento</span>
												</a></td>
											<td><?= $value->PREFIJO; ?> - <?= $value->CONS; ?></td>
											<td><?= $cedula; ?></td>
											<td><?= $paciente; ?></td>
											<td><?= $responsable; ?></td>

											<td><?= $municipio; ?></td>


											<td><?= $value->NOMBRE; ?></td>
											<td><i class="<?= $value->ICONO; ?>"></i> <?= $value->ESTADO; ?></td>

											<td class="text-center">
												<?php
												if ($value->FECHA_ESTADO != null) {
													$dateFormat = date("Y/m/d H:i", strtotime($value->FECHA_ESTADO));
													echo $dateFormat;
												} else {
													echo $value->FECHA_ESTADO;
												}


												?>

											</td>

											<?php
											//Recogemos los valores de estados parametrizados
											$estadoId = $value->ID_ESTADO;
											$aMax = $value->ALTA_MAXIMO;
											$aMin = $value->ALTA_MINIMO;
											$mMax = $value->MEDIA_MAXIMO;
											$mMin = $value->MEDIA_MINIMO;
											$bMax = $value->BAJA_MAXIMO;
											$bMin = $value->BAJA_MINIMO;
											$aColor = $value->ALTA_COLOR;
											$mColor = $value->MEDIA_COLOR;
											$bColor = $value->BAJA_COLOR;
											//recogemos las fechas actual y estado
											$fechaActual = date("Y/m/d H:i");
											$fechaEstado = $value->FECHA_ESTADO;
											//obtener días
											//$dia = calcDaysTrafficLight($fecha1, $fecha2);
											//evaluamos valores según los estados asignados para dashboard
											echo trafficLight($fechaActual, $fechaEstado, $estadoId, $dia, $aMin, $aMax, $mMin, $mMax, $bMin, $bMax, $aColor, $mColor, $bColor);

											?>

										</tr>
								<?php
										$i++;
									}
								}
								?>
							</tbody>

						</table>
					</div>
				</div>
			</div>
			<!-- Column -->
		</div>
		<!-- ============================================================== -->
		<!-- End Review -->
		<!-- ============================================================== -->

	<?php
}
	?>

	<!-- ============================================================== -->
	<!-- End PAge Content -->
	<!-- ============================================================== -->

	<?php
	if ($graficas) {
	?>
		<script>
			new Morris.Bar({
				// ID of the element in which to draw the chart.
				element: 'myfirstchart',
				// Chart data records -- each entry in this array corresponds to a point on
				// the chart.
				data: [{
						tipo: '<?= $tipo1 ?>',
						value: <?= $valor1 ?>
					},
					{
						tipo: '<?= $tipo2 ?>',
						value: <?= $valor2 ?>
					},
					<?php if ($tipo3 != '') { ?> {
							tipo: '<?= $tipo3 ?>',
							value: <?= $valor3 ?>
						},
					<?php } ?>
					<?php if ($tipo4 != '') { ?> {
							tipo: '<?= $tipo4 ?>',
							value: <?= $valor4 ?>
						},
					<?php } ?>
					<?php if ($tipo5 != '') { ?> {
							tipo: '<?= $tipo5 ?>',
							value: <?= $valor5 ?>
						},
					<?php } ?>
				],
				// The name of the data record attribute that contains x-values.
				xkey: 'tipo',
				// A list of names of data record attributes that contain y-values.
				ykeys: ['value'],
				// Labels for the ykeys -- will be displayed when you hover over the
				// chart.
				labels: ['Value']
			});

			var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
			new Morris.Line({
				// ID of the element in which to draw the chart.
				element: 'mysecondchart',
				data: [
					<?= $historico; ?>
				],
				xkey: 'month',
				ykeys: [<?= $historicoLetras; ?>],
				labels: ['<?= $tipo1 ?>', '<?= $tipo2 ?>', <?php if ($tipo3 != '') { ?> '<?= $tipo3 ?>', <?php } ?> <?php if ($tipo4 != '') { ?> '<?= $tipo4 ?>', <?php } ?> <?php if ($tipo5 != '') { ?> '<?= $tipo5 ?>', <?php } ?>]
			});
		</script>
	<?php
	}
	?>
