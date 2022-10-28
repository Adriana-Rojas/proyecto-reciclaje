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
                    			        	$("#botonAdicionar").on('click',function() {
												$('#myModal').modal({
                    					        	backdrop: 'static',
                    					            keyboard: false
                    				            });
												
											});
                        				});


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

						<table id="myTable" class="display nowrap table table-hover table-striped table-bordered">
							<thead>
								<tr>
									<th class="text-right">C&oacute;digo</th>
									<th class="text-right">Nombre</th>
									
									<th class="text-right">Cantidad</th>
									<th class="text-right">Valor unitario</th>
									<th class="text-right">Valor total</th>
									<th >Acci&oacute;n</th>
								</tr>
							</thead>
							<tbody>
    								<?php
            $valor = 0;
            if ($listaDetalle != null) {
                foreach ($listaDetalle as $value) {

                	$temporal=defineValueElementsMaterials($this,$value->CODIGO);
				
					
                	$producto= $temporal*$value->CANTIDAD;
                    $valor = $valor + ($producto);
                    
                    ?>
    								<tr>
									<td class="text-right"><?= $value->CODIGO;?></td>
									<td class="text-right"><?= $value->NOMBRE;?></td>
									<td class="text-right"><?= numberFormatEvolution($value->CANTIDAD);?></td>
									<td class="text-right"><?= numberFormatEvolution($temporal);?></td>
									<td class="text-right"><?= numberFormatEvolution($producto);?></td>
									<td >
										<div class="btn-group">
	                                        <button type="button" class="btn btn-info btn-rounded dropdown-toggle" data-toggle="dropdown" 
	                                                        		aria-haspopup="true" aria-expanded="false">
									                                       <i class="fa fa-bars"></i> 
	                                        </button>
	                                        <div class="dropdown-menu animated lightSpeedIn">
	                                        <?php
	                                            if($listaBoard!=null){
	                                                foreach ($listaBoard as $valueBoard) {
	                                                	//Verifico si es comodin
	                                                	$comodin=$this->FunctionsGeneral->getFieldFromTableNotId("ORD_ELEMENTO", "COMODIN","CODIGO", $value->CODIGO);
	                                                	if ($comodin==CTE_VALOR_SI && $valueBoard->PAGINA!='StokePriceAppStokePrice/modifyElementOfList/' || $comodin==CTE_VALOR_SI && $valueBoard->PAGINA=='StokePriceAppStokePrice/modifyElementOfList/'){                                  
											?>
								
	                                        <a class="dropdown-item" href="<?= base_url().$valueBoard->PAGINA.$id."/".$codigo."/".$this->encryption->encrypt($value->ID); ?>" >
	                                            <i class="<?= $valueBoard->ICONO ?>"></i> <?= $valueBoard->NOMBRE ?> 
	                                        </a>
	                                        <?php 
	                                        			}elseif ($comodin==CTE_VALOR_NO && $valueBoard->PAGINA!='StokePriceAppStokePrice/modifyElementOfList/'){
	                                        ?>
	                                        				<a class="dropdown-item" href="<?= base_url().$valueBoard->PAGINA.$id."/".$codigo."/".$this->encryption->encrypt($value->ID); ?>" >
																<i class="<?= $valueBoard->ICONO ?>"></i> <?= $valueBoard->NOMBRE ?> 
															</a>
															
	                                        <?php 
														}
											?>
	                                        <?php 
	                                                }
	                                            } ?>
		                                    </div>
                                        </div>
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
								<b class="text-danger">Costo neto despiece: $ <?= numberFormatEvolution($valor);?></b>
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
			<a href="<?= base_url()?>StokePriceAppStokePrice/defineElementsListOfProducts/<?= $id; ?>"
				class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10">
				<i class="fa fa-arrow-left"></i> <span class="hidden-xs"> Retornar</span>
			</a>
			<?php
                                                if ($botonesBoard!=null){
		                                                foreach ($botonesBoard as $value) {
		                                            ?>
		                                            <a href="#" class="btn btn-info btn-rounded" id="botonAdicionar"> 
		                                                <i  class="<?= $value->ICONO ?>"></i>
		                                                <span class="hidden-xs"> <?= $value->NOMBRE ?></span>
		                                            </a>
		                                            <?php 
		                                                }
                                                } ?>

            
			
		</div>
		<div class="col-sm-12">
			<br>
		</div>
	</div>


<!-- .modal -->
                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" id="myModal">
                		 <form class=" form-horizontal" role="form" action="<?= base_url()?>StokePriceAppStokePrice/modifyElementOfList" 
		                id="form_sample_3" 
		                method="post"       
		                autocomplete="off">
                		<div class="modal-dialog modal-lg">
                			<div class="modal-content">
                				<div class="modal-header">
                					<h4 class="modal-title" id="myLargeModalLabel">
                						<i class="fas fa-file-archive"></i>
                						Selecci&oacute;n del grupo de elementos
                					</h4>
                					<button type="button" class="close" data-dismiss="modal"
                						aria-hidden="true">
                						<i class="fa fa-times "></i>
                					</button>
                				</div>
                				<div class="modal-body" style="align: 'center'" id="arbol">
                					<div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                               		<label class="col-md-12" for="grupo">Grupo *</label>
                                                    <div class="col-md-12">
                	                                    <select class="form-control" id="grupo" name="grupo" required="required">
                                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            <?php foreach ($listaGrupo->result() as $value) { 
                                                            		
                                                            ?>
                                                            <option value="<?= $value->ID;?>" ><?= $value->NOMBRE;?></option> 
                                                            <?php
                                                            }?>
                                                        </select>
                	                                    <div class="form-control-feedback" > </div>
                                                    </div>
                                               </div>
                                               <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
	                							<input type="hidden" name="id" id="id" value="<?= $id;?>">
	                							<input type="hidden" name="codigo" id="codigo" value="<?= $codigo;?>">
	                							<input type="hidden" name="idElemento" id="idElemento" value="<?= $this->encryption->encrypt("NA");?>">

	                							
                                            </div>
                                        </div>
                				</div>
                				<!-- /.modal-content -->
                			</div>
                		</div>
                	</form>
                	<!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->



