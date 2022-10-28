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

<link href="https://unpkg.com/bootstrap-table@1.20.2/dist/bootstrap-table.min.css" rel="stylesheet">
<script src="https://unpkg.com/bootstrap-table@1.20.2/dist/bootstrap-table.min.js"></script>

<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Administraci&oacute;n de listas para la aplicaci&oacute;n</h4>
				<h6 class="card-subtitle"></h6>
				<div class="table-responsive">
					<table id="demo-foo-addrow" 
					class="footable" 
					data-page-size="20" 
					data-page-list="[5,20,15]"
					data-toggle="table" 
					data-sort-order="asc"
					data-pagination="true" 
					data-toggle="table" 
					data-search="true" 
					data-filter-control="true" 
					data-show-export="true" 
					data-click-to-select="true" 
					data-toolbar="#toolbar" 
					class="table-responsive">
						<thead>
							<tr>
								<th>ID</th>
								<th>Nombre</th>
								<th>Estado</th>
								<th>Acci&oacute;n</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($listaLista != null) {
								$i = 1;
								foreach ($listaLista->result() as $value) {
							?>
									<tr>
										<td><?= $i; ?></td>
										<td>
											<?= $value->NOMBRE; ?>
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
						<tfoot>
							<tr>
								<td colspan="2">
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


								</td>

								<td colspan="2">
									<div class="text-right">
										<ul class="pagination"> </ul>
									</div>
								</td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>

	</div>
</div>
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->
