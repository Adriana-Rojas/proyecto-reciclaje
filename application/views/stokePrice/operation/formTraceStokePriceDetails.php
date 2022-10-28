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

<!-- ============================================================== -->
<!-- END PAGE JQUERY ROUTINES -->
<!-- ============================================================== -->


<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->





<div class="row">
	<!-- Column -->
	<div class="col-lg-12 col-xlg-12 col-md-12">
		<div class="card">
            <div class="table-responsive m-t-40" style="clear: both; padding: 35px">
				<table id="myTable" class="display nowrap table table-hover table-striped table-bordered">
					
					<thead>
								<tr>
									<th class="text-right">Comod&iacute;n</th>
									<th class="text-right">C&oacute;digo</th>
									<th class="text-right">Nombre</th>
									<th class="text-right">Cantidad</th>
									<th class="text-right">Unidad</th>
								</tr>
							</thead>
					</thead>
					<?php
						$costoDespiece = 0;
						$trmGroup = 0;
						$trm = 0;
						if($listaDetalleElemento != null):
							foreach ($listaDetalleElemento as $valueDetalleElemento):
								
								$resultTRM = $this->StokePriceModel->selectDetailsTrmCotizacion($this->encryption->decrypt($idCotizacion));
								
								foreach($valueDetalleElemento as $key => $valueDetalleTRM) {
									if($key == "VALOR") {
										$trmGroup = $valueDetalleTRM;
									}
								}

								foreach($resultTRM as $key => $valueTRM) {
									$trm = $valueTRM->VALOR;
								}
								
								if(count($resultTRM) > 0){
									$costoDespiece += calSumaDespiece($trm, $trmGroup, $valueDetalleElemento->CANTIDAD);
								}else {
									echo "TRM no disponible";
								}
					?>
					<tbody>
						<tr>
							<td>
                                
                               
								<span class="<?= validaComodin($valueDetalleElemento->COMODIN,'CLASE')?>">
                                    <?= validaComodin($valueDetalleElemento->COMODIN,'NOMBRE') ?>
                                </span>
							</td>
							<td><?=$valueDetalleElemento->CODIGO?></td>
							<td><?=$valueDetalleElemento->NOMBRE?></td>
							<td><?=$valueDetalleElemento->CANTIDAD?></td>
							<td><?=$valueDetalleElemento->VALOR?></td>
							
						</tr>
					</tbody>
					<?php 
					 endforeach;
					endif;
					?>
				</table>
            </div>
			<?php 
			?>
			<div class="row" style="padding: 25px">
					<div class="col-md-12">
						<div class="pull-right m-t-30 text-right">
							<h3>
								<b>Valor de la TRM:</b> $ <?= numberFormatEvolution($trm);?>
        					</h3>
							<h3>
								<b class="text-danger">Costo Neto despiece: $ <?= numberFormatEvolution($costoDespiece);?></b>
							</h3>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
		</div>
	</div>
	<!-- Column -->
	<div class="col-lg-12 col-xlg-12 col-md-12">
		
                
		<a href="<?= base_url();?>StokePriceAppStokePrice/trace/<?=$idCotizacion?>"
			class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10">
			<i class="fa fa-arrow-left"></i> <span class="hidden-xs"> Retornar</span>
		</a> <br> <br> <br>
	</div>

	<!-- Column -->
</div>


<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->



