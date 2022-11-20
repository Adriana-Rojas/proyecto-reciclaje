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
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Listado de Usuarios</h4>
				<h6 class="card-subtitle"></h6>
				<div class="table-responsive">
					<table id="myTable" class="display nowrap table table-hover table-striped table-bordered">
						<thead>
							<tr>
								<th>ID</th>
								<th width="40%">Nombres y Apellidos</th>
								<th>Perfil</th>
								<th>whatsapp</th>
								<th>Estado</th>
								<th>Acci&oacute;n</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($listaLista != null) {
								$i = 1;
								foreach ($listaLista as $value) {
							?>
									<tr>
										<td><?= $value->ID; ?></td>
										<td>
											<?= $value->NOMBRES . " " . $value->APELLIDOS; ?>
										</td>
										<td>
											<?= $value->PERFIL; ?>
										</td>
										<td>
											<a href="https://api.whatsapp.com/send/?phone=57<?PHP echo $value->TELEFONO ?>&text=Hola&type=phone_number&app_absent=0" target="_blank">
												<img src="<?= base_url() ?>assets/images/logo-wasap.png" width="50" height="50">
											</a>
											<?PHP

											echo $value->TELEFONO;
											?>
										</td>
										<td><span class="<?= validaEstadosGenerales($value->ESTADO, 'CLASE') ?>">
												<?= validaEstadosGenerales($value->ESTADO, 'NOMBRE') ?>
											</span> </td>
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
													if ($listaBoard != null) {
														foreach ($listaBoard as $valueBoard) {

													?>
															<a class="dropdown-item" href="<?= base_url() . $valueBoard->PAGINA . $this->encryption->encrypt($value->ID); ?>">
																<i class="<?= $valueBoard->ICONO ?>"></i>
																<?= $valueBoard->NOMBRE ?>
															</a>
													<?php
														}
													} ?>
												</div>
											</div>
										</td>
									</tr>
							<?php
									$i++;
								} //end foreach
							} //end if
							?>
						</tbody>

					</table>
				</div>
			</div>


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
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->
