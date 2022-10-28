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
				<h4 class="card-title"><?= $board; ?></h4>
				<h6 class="card-subtitle"></h6>
				<div class="table-responsive">
					<!--<table id="demo-foo-addrow" class="table m-t-30 table-hover " data-page-size="20">
-->             
					<table id="demo-foo-addrow" 
					class="table  table-hover " 
					data-page-size="6000" 
					data-toggle="table" 
					--data-pagination="true" 
					data-search="true"
					data-sort-name="Name"
					data-sort-order="asc" 
					data-show-pagination-switch="true"
					data-filter-control="true" 
					data-show-export="true" 
					data-click-to-select="true" 
					data-toolbar="#toolbar"  
					class="table-responsive">
						<thead>
							<tr>
								<th>Acci&oacute;n</th>
								<th>C&oacute;digo</th>
								<th width="30%">Nombre</th>
								<th width="30%">Grupo</th>
								<th width="20%">Comod&iacute;n</th>
								<th>Estado</th>

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
										<td><?= $value->CODIGO; ?></td>
										<td>
											<?= $value->NOMBRE; ?>
										</td>
										<td>
											<?= $value->GRUPO; ?>
										</td>
										<td>
											<span class="<?= validaComodin($value->COMODIN, 'CLASE') ?>">
												<?= validaComodin($value->COMODIN, 'NOMBRE') ?>
											</span>

										</td>
										<td><span class="<?= validaEstadosGenerales($value->ESTADO, 'CLASE') ?>">
												<?= validaEstadosGenerales($value->ESTADO, 'NOMBRE') ?>
											</span> </td>

									</tr>
							<?php
									$i++;
								} //end foreach
							} //end if
							?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="5">
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

								<td colspan="3">
									<div class="text-right">
										<ul class="pagination"> </ul>
									</div>
								</td>
							</tr>
						</tfoot>
					</table>
					<script>
						var $table = $('#demo-foo-addrow')

						function refreshTable() {
							$table.bootstrapTable('refreshOptions', {
								paginationSuccessivelySize: +$('#paginationSuccessivelySize').val(),
								paginationPagesBySide: +$('#paginationPagesBySide').val(),
								paginationUseIntermediate: $('#paginationUseIntermediate').prop('checked')
							})
						}

						$(function() {
							$('.toolbar input').change(refreshTable)
						})
					</script>
				</div>
				<tfoot>
					<tr>
						<td colspan="5">
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

						<td colspan="3">
							<div class="text-right">
								<ul class="pagination"> </ul>
							</div>
						</td>
					</tr>
				</tfoot>
			</div>
		</div>

	</div>
</div>

<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->
