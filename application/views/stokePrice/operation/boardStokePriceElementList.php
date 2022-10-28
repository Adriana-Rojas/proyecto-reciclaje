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
                    			        	$("#botonAdicionar").on('click',function() {
												$('#myModal').modal({
                    					        	backdrop: 'static',
                    					            keyboard: false
                    				            });
												
											});
                        				});

			     /**Valida los campos de acuerdo al tipo*/
			     
			     
			     $(document).ready(function() {
						$('#tipo').change( function(){
							if($("#tipo").val()==0){
								$("#adjunto").prop('disabled', false);	
								$("#numero").prop('disabled', false);	
								$(".adjunto").show();	
							}else {
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
					<div class="col-md-1 col-xs-6 b-r"></div>
					<div class="col-md-2 col-xs-6 b-r">
						<strong>Cotizaci&oacute;n n&uacute;mero</strong> <br>
						<p class="text-muted"><?= $consecutivo;?></p>
					</div>
					<div class="col-md-2 col-xs-6 b-r">
						<strong>Documento de identidad</strong> <br>
						<p class="text-muted"><?= $tipoDocumento," ",$documento;?></p>
					</div>

					<div class="col-md-2 col-xs-6 b-r">
						<strong>Nombre Completo</strong> <br>
						<p class="text-muted">
								<?= $paciente;?></p>
					</div>
					<div class="col-md-2 col-xs-6 b-r">
						<strong>Responsable</strong> <br>
						<p class="text-muted"><?= $empresaCoti;?></p>
					</div>
					<div class="col-md-2 col-xs-6 b-r">
						<strong>Fecha de cotizaci&oacute;n</strong> <br>
						<p class="text-muted"><?= $fecha;?></p>
					</div>
					<div class="col-md-1 col-xs-6 b-r"></div>
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
					<div class="col-lg-12 col-xlg-12 col-md-12">
						<div class="card">
						<div class="table-responsive m-t-40" style="clear: both;">
							<table id="myTable" class="display nowrap table table-hover table-striped table-bordered">
								<thead>
									<tr>
										<th >Acci&oacute;n</th>
										<th class="text-right">C&oacute;digo</th>
										<th class="text-right" width="10%">Nombre</th>
										<!-- <th class="text-right">Tipo</th> -->
										<th class="text-right">Cant</th>
										<th class="text-right">Val unitario</th>
										<th class="text-right">Descuentos</th>
										<th class="text-right">IVA (%)</th>
										<th class="text-right">Val IVA</th>
										<th class="text-right">Unit total</th>
										<th class="text-right">Val total</th>
										
									</tr>
								</thead>
								
								<tbody>
										<?php
				
				if ($listaDetalle != null) {
					$valor = 0;
					$totalDescuento=0;
					$totalIvaFinal=0;
					$totalNeto=0;
					$subtotalNeto=0;
					$subtotalDescuento=0;
					$subtotalIva=0;
					
					
					foreach ($listaDetalle as $value) {

						
						
						//valores unitarios
						$valUnitario=defineValorUnitario($value->VALOR,$value->CANTIDAD,$costosAdicionales/$totalProductos);
						$totalNeto +=$valUnitario;
						$subtotalNeto +=$valUnitario*$value->CANTIDAD;
						//echo $subtotalNeto."<br>";
						//Valor del descuento
						$valDescuento=$valUnitario* $descuento;
						$totalDescuento=$totalDescuento+$valDescuento;
						$subtotalDescuento +=$valDescuento*$value->CANTIDAD;
						
						//$iva = defineIvaValue($value->ID_TIPO,$value->CODIGO,$this);
						$iva = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_DETLISTA", "VALOR", "ID", $value->IVA) / 100;

						$valorBruto=($valUnitario-$valDescuento);
						$totalIva= ($valorBruto)*$iva;
						$subtotalIva +=$totalIva*$value->CANTIDAD;
						$totalIvaFinal +=$totalIva;
						$unitarioTotal=$valorBruto+$totalIva;
						$valorTotal=($valorBruto+$totalIva)*$value->CANTIDAD;

						$valor = $valor + ($valorTotal);
					
						
						?>
										<tr>
										<td >
											<?php 
												$cantidad=$this->FunctionsGeneral->getQuantityFieldFromTable("COT_DESPIECE", "ID_DETALLECOTI", $value->ID_ELEMENTO_COTIZACION);
												if($cantidad>0){
											?>
											<div class="btn-group">
												<button type="button" class="btn btn-info btn-rounded dropdown-toggle" data-toggle="dropdown" 
																		aria-haspopup="true" aria-expanded="false">
																			<i class="fa fa-bars"></i> 
												</button>
												<div class="dropdown-menu animated lightSpeedIn">
												<?php
													if($listaBoard!=null){
														foreach ($listaBoard as $valueBoard) {
															//Valido si el elemento tiene despiece configurado
															

																						
												?>
												<a class="dropdown-item" id="botonAdicionar" href="<?= base_url().$valueBoard->PAGINA.$id."/".$this->encryption->encrypt($value->ID); ?>" >
													<i class="<?= $valueBoard->ICONO ?>"> </i> <?= $valueBoard->NOMBRE ?> 
												</a>
												<?php
															
														}
													} ?>
												</div>
											</div>
											<?php
												} ?>
										</td>
										<td class="text-right"><?= $value->CODIGO;?></td>
										<td class="text-right"><?= $value->NOMBRE;?></td>
										<!--<td class="text-right"><?= $value->TIPO;?></td> -->
										<td class="text-right"><?= numberFormatEvolution($value->CANTIDAD);?></td>
										<td class="text-right"><?= numberFormatEvolution($valUnitario);?></td>
										<td class="text-right"><?= numberFormatEvolution($valDescuento);?></td>
										
										<td class="text-right"><?= numberFormatEvolution($iva*100) ;?> %	</td>
										<td class="text-right"><?= numberFormatEvolution($totalIva);?></td>
										<td class="text-right"><?= numberFormatEvolution($unitarioTotal);?></td>
										<td class="text-right"><?= numberFormatEvolution($valorTotal);?></td>

										
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
									<b>Sub total cotizaci&oacute;n:</b> $ <?= numberFormatEvolution($subtotalNeto);?>
									</h3>
								<h3>
									<b> (-) Descuento:</b> $ <?= numberFormatEvolution($subtotalDescuento);?>
									</h3>
								<h3>
									<h3>
									<b> (+) IVA:</b> $ <?= numberFormatEvolution($subtotalIva);?>
									</h3>
								<h3>
									<b class="text-danger">Total cotizaci&oacute;n: $ <?= numberFormatEvolution($valor);?></b>
								</h3>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
			</div>
		</div>
	</div>
	
</div>

<div class="row">
		<div class="col-sm-12">
			<a href="<?= base_url()?>StokePriceAppStokePrice/viewRegister/<?= $id; ?>"
				class="btn  btn-info btn-rounded pull-right waves-effect waves-light m-r-10">
				 <span class="hidden-xs"> Finalizar cotizaci&oacute;n</span>
			</a>
			
		</div>
		<div class="col-sm-12">
			<br>
		</div>
	</div>




