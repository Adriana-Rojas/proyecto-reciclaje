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
 ******************** BOGOT� COLOMBIA 2018 ******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');

?>
<!-- ============================================================== -->
<!-- JavaScript para pintar campos adicionales -->
<!-- ============================================================== -->
<script>
	$(document).ready(function() {
		$("#disparaModal").on('click', function() {
			$.post("<?= base_url() ?>/Integration/reloadTree", {
				variable: '<?= $route; ?>',
				proceso: '<?= CTE_VALOR_SI; ?>'
			}, function(data) {
				$("#arbol").html(data);
			});
			$('#myModal').modal({
				backdrop: 'static',
				keyboard: false
			})
		});
	});
</script>
<!-- ============================================================== -->
<!-- End JavaScript para pintar campos adicionales -->
<!-- ============================================================== -->
<!-- ============================================================================================================================ -->
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<!-- .row -->
<div class="row">
	<div class="col-md-12 col-xs-12">
		<div class="card">
			<div class="card-body">
				<?php
				foreach ($paciente as $value) {
					$historia = $value->ID_PCTE;

					//Datos
					$datos = selectPatienInformationFromOrder($this->session->userdata('encOrden'), $this);
					$responsable = $datos[0];

					if ($this->session->userdata('action') == 'order') {


				?>

						<div class="row">
							<div class="col-md-2 col-xs-6 b-r"> <strong>Tipo de proceso</strong>
								<br>
								<p class="text-muted"><?= $tipoProceso; ?></p>
							</div>
							<div class="col-md-2 col-xs-6 b-r"> <strong>Documento de identidad</strong>
								<br>
								<p class="text-muted"><?= $value->TP_ID_PCTE, " ", $value->NUM_ID_PCTE; ?></p>
							</div>

							<div class="col-md-2 col-xs-6 b-r"> <strong>Nombre Completo</strong>
								<br>
								<p class="text-muted">
									<span class="<?= datosGeneroPersona($value->SEXO, 'CLASE', 'fa-1x') ?>">
										<?= datosGeneroPersona($value->SEXO, 'NOMBRE', 'fa-1x') ?>
									</span>
									<?= $value->PRI_NOM_PCTE, " ", $value->SEG_NOM_PCTE, " ", $value->PRI_APELL_PCTE, " ", $value->SEG_APELL_PCTE; ?>
								</p>
							</div>
							<div class="col-md-2 col-xs-6 b-r"> <strong>Historia</strong>
								<br>
								<p class="text-muted"><?= $value->ID_PCTE; ?></p>
							</div>

							<div class="col-md-2 col-xs-6 b-r"> <strong>Responsable</strong>
								<br>
								<p class="text-muted"><?= $responsable; ?></p>
							</div>
							<div class="col-md-2 col-xs-6"> <strong>Edad</strong>
								<br>
								<p class="text-muted">
									<?= intervaloTiempo($value->FECH_NCTO_PCTE, cambiaHoraServer(2), 31104000);
									?> A&ntilde;os
								</p>
							</div>

						</div>
					<?php
					} else {
					?>
						<div class="row">
							<div class="col-md-2 col-xs-6 b-r"> <strong>Documento de identidad</strong>
								<br>
								<p class="text-muted"><?= $value->TP_ID_PCTE, " ", $value->NUM_ID_PCTE; ?></p>
							</div>

							<div class="col-md-3 col-xs-6 b-r"> <strong>Nombre Completo</strong>
								<br>
								<p class="text-muted">
									<span class="<?= datosGeneroPersona($value->SEXO, 'CLASE', 'fa-1x') ?>">
										<?= datosGeneroPersona($value->SEXO, 'NOMBRE', 'fa-1x') ?>
									</span>
									<?= $value->PRI_NOM_PCTE, " ", $value->SEG_NOM_PCTE, " ", $value->PRI_APELL_PCTE, " ", $value->SEG_APELL_PCTE; ?>
								</p>
							</div>
							<div class="col-md-2 col-xs-6 b-r"> <strong>Historia</strong>
								<br>
								<p class="text-muted"><?= $value->ID_PCTE; ?></p>
							</div>
							<!--
            <div class="col-md-3 col-xs-6 b-r"> <strong>Responsable</strong>
                <br>
                <p class="text-muted"><?= $responsable; ?></p>
            </div>F
            -->
							<div class="col-md-2 col-xs-6"> <strong>Edad</strong>
								<br>
								<p class="text-muted">
									<?= intervaloTiempo($value->FECH_NCTO_PCTE, cambiaHoraServer(2), 31104000);
									?> A&ntilde;os
								</p>
							</div>
							<!--
			<div class="col-md-2 col-xs-6"> <strong>Tel&eacute;fono</strong>
                <br>
                <p class="text-muted">
                	<?= $this->encryption->decrypt(
							$this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "TELEFONO", "DOCUMENTO", $value->NUM_ID_PCTE)
						);



					?> 
                 </p>
            </div>
			<div class="col-md-2 col-xs-6"> <strong>Direccion</strong>
                <br>
               
                	  <p class="text-muted"><?= $value->DIR_PCTE ?></p>
                
            </div>


            <div class="col-md-2 col-xs-6"> <strong>Correo</strong>
                <br>
                <p class="text-muted">
            
                    <?= $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "CORREO", "DOCUMENTO", $value->NUM_ID_PCTE)) ?>
                </p>
            </div>

            <div class="col-md-2 col-xs-6"> <strong>Ciudad</strong>
                <br>
                <p class="text-muted">
                    <?php $ciudad = $this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "ID_MUNICIPIO", "DOCUMENTO", $value->NUM_ID_PCTE);



						$this->session->set_userdata('id', $this->FunctionsGeneral->getFieldFromTable("ADM_MUNICIPIO", "NOMBRE", $ciudad));



						// Cargo la lista de ciudades
						$listaCiudad = $this->FunctionsGeneral->getFieldFromTable("ADM_MUNICIPIO", "NOMBRE", $ciudad);

						echo $listaCiudad;


					?> 
                 </p>
            </div>

-->

						</div>
				<?php
					}
				} ?>

				<hr>


			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<h4 class="card-title"><i class='fa fa-list-alt fa-1x'></i> &Oacute;rdenes generadas</h4>
				<h6 class="card-subtitle"></h6>
				<div class="table-responsive m-t-40">
					<?php
					if ($this->session->userdata('action') == 'order') {

					?>
						<!--  Tabla para el proceso de generar ordenes -->
						<table id="myTable" class="display nowrap table table-hover table-striped table-bordered">
							<thead>
								<tr>
									<th>Acci&oacute;n</th>
									<th>Orden</th>
									<th>C&oacute;digo</th>
									<th width="40%">Nombre</th>
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
												<!--  
                            <button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button>
                            -->
												<div class="btn-group">
													<button type="button" class="btn btn-info btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														<i class="fa fa-bars"></i>
													</button>
													<div class="dropdown-menu animated lightSpeedIn">
														<?php
														$validador = 0;

														if ($listaBoard != null) {
															foreach ($listaBoard as $valueBoard) {

																//Valido si tiene despiece esa orden en caso que no lo tenga no listo la opci�n
																if ($this->FunctionsGeneral->getQuantityFieldFromTable(
																	"ORD_ORDACTDES",
																	"ID_ORDEN",
																	$value->ID
																) > 0) {
																	$temporal = true;
																} else {
																	$temporal = false;
																}

																if ($valueBoard->ID == '114' || $valueBoard->ID == '144' || $valueBoard->ID == '150') {
																	if ($temporal) {

																		$validador += $this->OrdersModel->getQuantityElementsOrder($value->ID);
														?>
																		<a class="dropdown-item" href="<?= base_url() . $valueBoard->PAGINA . $id . "/" . $this->encryption->encrypt($value->ID); ?>">
																			<i class="<?= $valueBoard->ICONO ?>"></i>
																			<?= $valueBoard->NOMBRE ?>
																		</a>

																		<?php
																	}
																} else if ($valueBoard->ID == '115' || $valueBoard->ID == '145' || $valueBoard->ID == '151') {
																	//Valido si aplica paquete de interconsultas solo protesis
																	//y el proceso es normal
																	if ($value->PREFIJO == 'PRO' && $this->session->userdata('proceso') == NORMAL_PROCESS) {
																		//Valido si no esta incluido como orden alterna si no esta incluido se puede agregar la opci�n
																		if ($this->FunctionsGeneral->getQuantityFieldFromTable(
																			"ORD_ORDEN",
																			"ID_ORDENANT",
																			$value->ID,
																			"ESTADO",
																			ACTIVO_ESTADO,
																			"ID_ENCORDEN",
																			$this->FunctionsGeneral->getFieldFromTable("ORD_ORDEN", "ID_ENCORDEN", $value->ID)
																		) == 0) {

																		?>
																			<a class="dropdown-item" href="<?= base_url() . $valueBoard->PAGINA . $id . "/" . $this->encryption->encrypt($value->ID); ?>">
																				<i class="<?= $valueBoard->ICONO ?>"></i>
																				<?= $valueBoard->NOMBRE ?>
																			</a>
																	<?php
																		}
																	}
																} else {
																	?>
																	<a class="dropdown-item" href="<?= base_url() . $valueBoard->PAGINA . $id . "/" . $this->encryption->encrypt($value->ID); ?>">
																		<i class="<?= $valueBoard->ICONO ?>"></i>
																		<?= $valueBoard->NOMBRE ?>
																	</a>
														<?php
																}
															}
														}
														?>
													</div>


												</div>
											</td>
											<td><?= $value->PREFIJO, " - ", $value->CONS; ?></td>
											<td><?= $value->CODIGO ?></td>
											<td>
												<?= $value->NOMBRE; ?>
											</td>
											<td>
												<?= $value->CANTIDAD; ?>
											</td>
										</tr>
								<?php
										$i++;
									} //end foreach
								} //end if
								?>
							</tbody>
						</table>
					<?php
					} else {
					?>
						<!--  Tabla para el seguimiento de ordenes -->
						<table id="myTable" class="display mtable m-t-30 table-hover">
							<thead>
								<tr>
									<th>Acci&oacute;n</th>
									<th>N° orden</th>
									<th>Proceso</th>
									<th>N° cotizaci&oacute;n</th>
									<!--<th>C&oacute;digo</th>-->
									<th>Elemento</th>
									<th>Estado actual</th>
									<th>Fecha</th>
									<th>Dias en proceso</th>
									<th>Definición de tiempo</th>
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
												<!--  
                            <button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button>
                            -->
												<div class="btn-group">
													<button type="button" class="btn btn-info btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														<i class="fa fa-bars"></i>
													</button>
													<div class="dropdown-menu animated lightSpeedIn">

														<?php
														$validador = 0;
														if ($listaBoard != null) {
															foreach ($listaBoard as $valueBoard) {
																//if($this->OrdersModel->getQuantityElementsOrder($value->ID)>0  && $valueBoard->ID==162){
																if ($valueBoard->ID == 162) {

														?>

																	<a class="dropdown-item" href="<?= base_url() . "OrdersAppOrder/createOrder/" . $this->encryption->encrypt($value->HISTORIA) . "/" . $this->encryption->encrypt("order") . "/" . $this->encryption->encrypt($value->ID_ENCORDEN); ?>">
																		<i class="<?= $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ESTADOS", "ICONO", "ID", ORDER_STATE); ?>"></i>
																		Finalizar orden
																	</a>

																	<!-- <a class="dropdown-item" href="<?= base_url() . $valueBoard->PAGINA . $id . "/" . $this->encryption->encrypt($value->ID); ?>" >
                                            <i class="<?= $valueBoard->ICONO ?>"></i> 
                                            <?= $valueBoard->NOMBRE; ?> 
                                        </a> -->


																<?php

																	//}else if( $valueBoard->ID!=162 && $this->OrdersModel->getQuantityElementsOrder($value->ID)<=0  ){			                                                      
																} else if ($valueBoard->ID != 162) {
																?>
																	<a class="dropdown-item" href="<?= base_url() . $valueBoard->PAGINA . $id . "/" . $this->encryption->encrypt($value->ID); ?>">
																		<i class="fa fa fa-tachometer"></i>
																		<?= $valueBoard->NOMBRE ?>
																	</a>

														<?php

																}
															}
														}
														?>
													</div>
												</div>
											</td>
											<td><?= $value->PREFIJO, " - ", $value->CONS; ?></td>
											<td><?= $value->PROCESO; ?></td>
											<td><?= $value->CONSECUTIVO ?></td>
											<!--<td><?= $value->CODIGO; ?></td>-->
											<td><?= $value->NOMBRE; ?></td>

											<td><?php

												$finalizado = 'FINALIZADO';
												$nom = paintActualState($this, $value->ID);
												//echo "<script>console.log('value->ID: " . $value->ID . "' );</script>";
												//var_dump($nom);
												if ($nom != "") {
													echo $nom;
												} else {
													echo $finalizado;
												}
												?>
											</td>
											<td><?= formatDate($value->FECHA); ?></td>

											<?php
											$fecha1 = date("Y/m/d H:i");
											$fecha2 = $value->FECHA;
											//Muestra la información días en estado 
											echo TracingTrafficLight($fecha1, $fecha2, $nom, $value->PREFIJO);
											echo TracingTrafficLightMessage($fecha1, $fecha2, $value->PREFIJO);
											?>

										</tr>
								<?php
										$i++;
									} //end foreach
								} //end if
								?>
							</tbody>
						</table>
					<?php
					}
					?>
				</div>
				<?php
				if ($this->session->userdata('action') == 'order') {

				?>

					<button type="button" id="disparaModal" class="btn btn-info btn-rounded" data-whatever="@mdo">
						<i class="fa fa-plus-square"></i> Nueva orden
					</button>
				<?php
				}
				?>
				<?php
				if ($botonesBoard != null) {
					foreach ($botonesBoard as $value) {
						if ($validador <= 30) {
				?>
							<a href="<?= base_url() . $value->PAGINA . $id; ?>" class="btn btn-info btn-rounded">
								<i class="<?= $value->ICONO ?>"></i>
								<span class="hidden-xs"> <?= $value->NOMBRE ?></span>
								<?php
								echo "jj";
								?>
							</a>

						<?php
						} else {
						?>

							<small style="color: red;"><i class="fa fa-exclamation-triangle"></i> NO se ha consolidado el despiece de alguna de las &oacute;rdenes; por tal raz&oacute;n no se podr&aacute; consolidar la formulaci&oacute;n que est&aacute; realizando.</small>


					<?php

						}
					}
				} else { ?>
					<a href="<?= base_url() . $mainPage ?>" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10">
						<i class="fa fa-arrow-left"></i>
						<span class="hidden-xs"> Retornar</span>
					</a>
				<?php

				} ?>
			</div>

		</div>
	</div>
</div>
<!-- /.row -->
<!-- .modal -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" id="myModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myLargeModalLabel">Selecci&oacute;n de la ruta para el producto o servicio</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times "></i></button>
			</div>
			<div class="modal-body" style="align:'center'" id="arbol">
				<div class="col-lg-12 col-md-12 col-sm-312 col-xs-12">
					<div class="ribbon-wrapper card">
						<div class="ribbon ribbon-bookmark  ribbon-default">Cargando &aacute;rbol</div>
						<p class="ribbon-content">El sistema de informaci&oacute;n est&aacute; cargando la estructura del &aacute;rbol de productos y servicios, Por favor espere.</p>
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