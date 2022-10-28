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
					<div class="table-responsive m-t-40" style="clear: both;">

						<table id="myTable"
							class="display nowrap table table-hover table-striped table-bordered">
							<thead>
								<tr>
									<th class="text-right">C&oacute;digo</th>
									<th class="text-right">Nombre</th>
									<th class="text-right">Tipo</th>
									<th>Acci&oacute;n</th>
									<!--
									<th class="text-right">Cantidad</th>
									<th class="text-right">Valor unitario</th>
									<th class="text-right">Valor total</th>
									 -->
								</tr>
							</thead>
							<tbody>
    								<?php
            $valor = 0;
            if ($listaDetalle != null) {
                foreach ($listaDetalle as $value) {
                	//Valido si el elemento ya fue ordenado
                	$codigoOrdenes=$this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_DESCRIPCION", "CODIGO", "ID", $value->ID);
                	$valorOrdenes= $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_ORDEN", "ID", "ACTIVIDAD", $codigoOrdenes,"ID_COTIZACION",$id);
                	//echo $valorOrdenes;
                	if ($valorOrdenes=='' || $valorOrdenes==null){
	                    $valor = $valor + ($value->CANTIDAD * $value->VALOR);
	                    $idArbol=$this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOLPRODUCTOS", "ID_ARBOLVALORES", "CODIGO", $value->CODIGO);
	                    $tipoOrden=$this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOLPRODUCTOS", "ID_TIPOORDEN", "CODIGO", $value->CODIGO);
                    
                    ?>
    								<tr>
									<td class="text-right"><?= $value->CODIGO;?></td>
									<td class="text-right"><?= $value->NOMBRE;?></td>
									<td class="text-right"><?= $value->TIPO;?></td>
									<td>

										<div class="btn-group">
											<button type="button"
												class="btn btn-info btn-rounded dropdown-toggle"
												data-toggle="dropdown" aria-haspopup="true"
												aria-expanded="false">
												<i class="fa fa-bars"></i>
											</button>
											<div class="dropdown-menu animated lightSpeedIn">
												<a class="dropdown-item"
													href="<?=base_url() . "/OrdersAppOrder/selectedFromRequest/" . $this->encryption->encrypt($hc) . "/" . $this->encryption->encrypt($id). "/" . 
																	$this->encryption->encrypt($idArbol). "/" . 
																	$this->encryption->encrypt($tipoOrden). "/" .
																	$this->encryption->encrypt($value->CODIGO);?>">
													<i class="fa fa-check-square-o" aria-hidden="true"></i>
													Seleccionar
												</a>


											</div>
										</div>
									</td>
									<!-- 
									<td class="text-right"><?= numberFormatEvolution($value->CANTIDAD);?></td>
									<td class="text-right"><?= numberFormatEvolution($value->VALOR);?></td>
									<td class="text-right"><?= numberFormatEvolution($value->CANTIDAD* $value->VALOR);?></td>
 -->
								</tr>
    								<?php
    				}
                }
            }
            ?>
    							</tbody>
						</table>
					</div>
				</div>
				
				<!-- 
				<div class="row">
					<div class="col-md-12">
						<div class="pull-right m-t-30 text-right">
							<h3>
								<b>Sub total cotizaci&oacute;n :</b> $ <?= numberFormatEvolution($valor);?>
        						</h3>
							<h3>
								<b>Descuento:</b> $ <?= numberFormatEvolution($valor* $descuento);?>
        						</h3>
							<h3>
								<b class="text-danger">Total cotizaci&oacute;n: $ <?= numberFormatEvolution($valor - ($valor* $descuento));?></b>
							</h3>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				 -->

				<div class="row">
					<div class="col-sm-12">
						<a href="<?= base_url()?>OrdersAppOrder/orderFromRequest/"
							class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10">
							<i class="fa fa-arrow-left"></i> <span class="hidden-xs">
								Retornar</span>
						</a>

					</div>
					<div class="col-sm-12"></div>
				</div>
			</div>
		</div>
	</div>

</div>


<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->



