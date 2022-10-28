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
defined('BASEPATH') OR exit('No direct script access allowed');

?>
        
        		<!-- ============================================================== -->
                <!-- Start JavaScript para pintar campos adicionales -->
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
                    			     </script>
    			<!-- ============================================================== -->
                <!-- End JavaScript para pintar campos adicionales -->
                <!-- ============================================================== -->
                
			 	
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                        	<?php 
                                foreach ($paciente as $value){
                                	
                                ?>
                            <div class="card-body">
                                <div class="user-btm-box">
                                	<!-- .row -->
                                    <div class="row text-center m-t-10">
                                        <div class="col-md-12">
                                        	<span class="<?= datosGeneroPersona($value->SEXO,'CLASE','fa-4x')?>">
                                                     	<?= datosGeneroPersona($value->SEXO,'NOMBRE','fa-4x') ?>
                                            </span>
                                            <br>
                                            <strong>Nombres completos</strong>
                                            <p><?= $value->PRI_NOM_PCTE," ",$value->SEG_NOM_PCTE," ",$value->PRI_APELL_PCTE," ",$value->SEG_APELL_PCTE;?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- .row -->
                                    <div class="row text-center m-t-10">
                                        <div class="col-md-6 b-r"><strong>Historia cl&iacute;nica</strong>
                                            <p><?= $value->ID_PCTE;?></p>
                                        </div>
                                        <div class="col-md-6"><strong>Documento de identidad</strong>
                                            <p><?= $value->TP_ID_PCTE," ",$value->NUM_ID_PCTE;?></p>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                    <hr>
                                    <!-- .row -->
                                    <div class="row text-center m-t-10">
                                        <div class="col-md-6 b-r"><strong>Edad</strong>
                                            <p><?=intervaloTiempo($value->FECH_NCTO_PCTE,cambiaHoraServer(2),31104000);
                                                	?> A&ntilde;os</p>
                                        </div>
                                        <div class="col-md-6"><strong>Responsable</strong>
                                            <p><?= $value->RESPONSABLE;?></p>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                    <hr>
                                    
                                    
                                    
                                </div>
                            </div>
                            <?php 
                                }?>
                        </div>
	                        <div class="card">
	                            <div class="card-body">
	                                <h5 class="card-title">Ruta del producto</h5>
	                                <?php if ($niveles==3){
		                            ?>   
		                            <div class="row">
	                               		<!-- Column -->
	                                    
	                                    
	                                   <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Tipo de orden: <small class="text-white"><?= $nombreTipo;?></small></h4>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <!-- Column -->
	                                    <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Ubicaci&oacute;n: <small class="text-white"><?= $nombreMiembros;?></small> </h4>
	                                                
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <!-- Column -->
	                                    <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Primer subnivel: <small class="text-white"><?= $nomPrimerSubNiv;?></small></h4>
	                                                
	                                            </div>
	                                        </div>
	                                    </div>
	                                    
	                                    <!-- Column -->
	                                    <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Segundo subnivel: <small class="text-white"><?= $nomSegundoSubNiv;?></small></h4>
	                                                
	                                            </div>
	                                        </div>
	                                    </div>
	                                    
	                                    <!-- Column -->
	                                    <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Tercer subnivel: <small class="text-white"><?= $nomTerceroSubNiv;?></small></h4>
	                                                
	                                            </div>
	                                        </div>
	                                    </div>
	                                    
	                                   
	                                   
	                                </div>
		                            <?php }?>
		                            <?php if ($niveles==2){
		                            ?>   
		                            <div class="row">
	                               		<div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Tipo de orden: <small class="text-white"><?= $nombreTipo;?></small></h4>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <!-- Column -->
	                                    <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Ubicaci&oacute;n: <small class="text-white"><?= $nombreMiembros;?></small> </h4>
	                                                
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <!-- Column -->
	                                    <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Primer subnivel: <small class="text-white"><?= $nomPrimerSubNiv;?></small></h4>
	                                                
	                                            </div>
	                                        </div>
	                                    </div>
	                                    
	                                    <!-- Column -->
	                                    <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Segundo subnivel: <small class="text-white"><?= $nomSegundoSubNiv;?></small></h4>
	                                                
	                                            </div>
	                                        </div>
	                                    </div>
	                                   
	                                </div>
		                            <?php }?> 
		                            <?php if ($niveles==1){
		                            ?>   
		                            <div class="row">
	                               		<div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Tipo de orden: <small class="text-white"><?= $nombreTipo;?></small></h4>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <!-- Column -->
	                                    <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Ubicaci&oacute;n: <small class="text-white"><?= $nombreMiembros;?></small> </h4>
	                                                
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <!-- Column -->
	                                    <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Primer subnivel: <small class="text-white"><?= $nomPrimerSubNiv;?></small></h4>
	                                                
	                                            </div>
	                                        </div>
	                                    </div>
	                                    
	                                  
	                                   
	                                </div>
		                            <?php }?> 
		                            <div class="row">
	                               		<div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Producto: <small class="text-white"><?= $codigo." - ".$nombre;?></small></h4>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Configuraci&oacute;n de despiece de elementos</h5>
								<h6 class="card-subtitle">Defina los elementos que har&aacute;n parte del despiece del producto</h6>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
											
                                            	<th>Acci&oacute;n</th>
                                                <th>Comod&iacute;n</th>
                                                <th>C&oacute;digo</th>
                                                <th width="40%">Nombre</th>
                                                <th>Unidad</th>
                                                <th>Cantidad</th>
												<!-- <th>Moneda</th> -->
                                                <th>Costo</th>
												<th>Trm</th>
                                            </tr>
                                        </thead>
                                        <tbody>
							
											<?php 

												$totalUSD = 0;
												$totalCOP = 0;
												$totalCosto = 0;

                                            	if($listaLista != null){
                                                	$i=1;
                                                    foreach ($listaLista as $value) {
                                                    	if($value->MONEDA == 1) {
															$totalCosto += calSumaDespieceOrden($this, $value->CANTIDAD, $value->CODIGO) * $valueTRM;
														} 
                                                    ?>
                                            <tr>
                                            	<td align="center">
                                                    <!--  
                                                    <button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button>
                                                    -->
                                                    <div class="btn-group">
                                                    	<button type="button" class="btn btn-info btn-rounded dropdown-toggle" data-toggle="dropdown" 
                                                        		aria-haspopup="true" aria-expanded="false">
								                                       <i class="fa fa-bars"></i> 
                                                    	</button>
                                                        	<div class="dropdown-menu animated lightSpeedIn">
                                                            	<?php
                                                                	if($listaBoard!=null){
															
                                                                    	foreach ($listaBoard as $valueBoard) {
                                                                    		if ($valueBoard->ID==118 || $valueBoard->ID==146 || $valueBoard->ID==155 || $valueBoard->ID==163){
                                                                    			if($value->COMODIN==CTE_VALOR_SI){
                                                                    				
                                                                    			
                                                                ?>
                                                                <a class="dropdown-item" href="<?= base_url().$valueBoard->PAGINA.$id."/".$idOrden."/".$this->encryption->encrypt($value->ID); ?>" >
                                                                    	<i class="<?= $valueBoard->ICONO ?>"></i> 
                                                                    	<?= $valueBoard->NOMBRE ?> 
                                                                </a>
																
                                                                <?php
                                                                    			}
                                                                    		}else if ($valueBoard->ID==119 || $valueBoard->ID==147 || $valueBoard->ID==156 || $valueBoard->ID==164){
                                                                    			if($value->COMODIN==CTE_VALOR_NO){
                                                                ?>
																					
                                                                <?php
                                                                    	 		} else{
                                                                    		}
																?>
																				<a class="dropdown-item" href="<?= base_url().$valueBoard->PAGINA.$id."/".$idOrden."/".$this->encryption->encrypt($value->ID); ?>" >
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
                                            	<td align="center">
                                                	<span class="<?= validaComodin($value->COMODIN,'CLASE')?>">
                                                                    <?= validaComodin($value->COMODIN,'NOMBRE') ?>
                                                    </span>    
                                                </td>
                                                <td>
                                                    <?= $value->CODIGO;?>
                                                </td>
                                                <td>
                                                	<?= $value->NOMBRE;?>
                                                </td>
                                                <td>
                                                	<?= $value->VALOR	;?>
                                                </td>
                                                <td>
                                                	<?= $value->CANTIDAD	;?>
                                                </td>
												<!-- <td> 
													<?php

														if($value->MONEDA == 1) {
															$cant = $value->CANTIDAD;
															$price = $value->PRICE;
															$priceCant = $price * $cant;
															$totalUSD += $priceCant;


															echo 'USD';
														$price = $this->FunctionsGeneral->getFieldFromTableNotId("COT_DESCRIPCION", "MATERIALES", "AUXILIAR", $value->CODIGO);
														$price = $this->FunctionsGeneral->getFieldFromTableNotId("COT_DESCRIPCION", "MATERIALES", "AUXILIAR", $value->CODIGO);
													} else if($moneda ==2){
															$cant = $value->CANTIDAD;
															$price = $value->PRICE;
															$priceCant = $price * $cant;
															$totalCOP += $priceCant;

															echo 'COP';
														} else {
															echo 'Formato por definir';
														}
													?>
												</td> -->
                                                <td>
													<?php

														
													$cant = $value->CANTIDAD;
													$price = $this->FunctionsGeneral->getFieldFromTableNotId("COT_DESCRIPCION", "MATERIALES", "AUXILIAR", $value->CODIGO);
													$priceCant = $price * $cant;

													echo $priceCant;
													?>
												</td>
                                                <td>
													<?=$valueTRM;?>
												</td> 
                                                
                                            </tr>
												
                                            <?php 
                                                            $i++;
                                                   }//end foreach
                                              }//end if
                                            ?>
                                        </tbody>
                                        
                                    </table>
                                    <!-- <table id="myTable" class="display nowrap table table-hover table-striped table-bordered">
										<thead>
											<tr align='center'>
											  <th>Total USD</th>
											  <th>Total COP</th>
											</tr>
										</thead>
										<tbody>
											<tr align='center'>
											  <td>$ <?=$totalCOP?></td>
											  <td>$ <?=$totalUSD?></td>
											</tr>
										</tbody>
									</table> -->
									<!-- <div class="card-body">
								        <h3>
											<b class="text-danger">Costo neto despiece: $ <?= numberFormatEvolution($totalCosto);?></b>
										</h3> 
									</div>  -->
									<?php
									$costoDespiece = 0;
									foreach($ValoresCalcCostoDespiece as $valueCostoDespiece) {
										$resultTRM = $this->StokePriceModel->selectDetailsTrmCotizacion($this->FunctionsGeneral->getFieldFromTableNotId('COT_DETALLECOTI','ID_COTIZACION', 'ID', $idDetalleCoti));
										$trm = $valueTRM;
										$costoDespiece += calSumaDespiece($valueTRM, $valueCostoDespiece->VALOR, $valueCostoDespiece->CANTIDAD);
										
									}
									?>
									<input type="hidden" id="totalCosto" value="<?=$totalCosto?>"><br>
									<input type="hidden" id="costoDespiece" value="<?=$costoDespiece?>"><br>
									<input type="hidden" name="idElemento" id="idElemento" value="<?=$elementsDelete?>"><br>
									<input type="hidden" name="router" id="router" value="<?=base_url()?>/OrdersAppOrder/deleteElementsOfProduct/<?=$id?>/<?=$idOrden?>/<?=$elementsDelete?>/">
                                </div>
							
                                <?php 
                                	if($this->session->userdata ( 'action' )=='order'){
                                		$pagina="OrdersAppOrder/createOrder/".$id."/".$this->encryption->encrypt('next');
                                	}else{
                                		$pagina="OrdersAppOrder/orderConsolidation/".$id."/".$idOrden;
                                	}
                                ?>
							
                                <a href="<?= base_url().$pagina?>" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
			                                                <i class="fa fa-arrow-left"></i>
			                                                <span class="hidden-xs"> Retornar</span>
			                                            </a> 
			                    <a href="#" class="btn  btn-info btn-rounded pull-right waves-effect waves-light m-r-10" id="botonAdicionar"> 
			                     <i class="fa fa-plus-square"></i>
			                     <span class="hidden-xs"> Adicionar elemento</span>
			                    </a> 
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
	            
	            
                <!-- .modal -->
                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" id="myModal">
                		 <form class=" form-horizontal" role="form" action="<?= base_url()?>OrdersAppOrder/moreElementsOfProduct" 
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
	                							<input type="hidden" name="idOrden" id="idOrden" value="<?= $idOrden;?>">
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
<link
	href="<?= base_url()?>assets/dist/css/style.css"
	rel="stylesheet" type="text/css">

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
$(document).ready(function(){
	var totalCosto = parseInt($('#totalCosto').val());
	var costoDespiece = parseInt($('#costoDespiece').val());
	var idElemento = $('#idElemento').val();	
	var id = $('#id').val();
	var idOrden = $('#idOrden').val();
	var router = $('#router').val();


	if(totalCosto > costoDespiece) {
		console.log("el costoTotal es mayor al costoDespiece");
		swal({
			icon: 'info',
			title: "IMPORTANTE",
			text: "El costo del despiece de la orden supera el costo del despiece de la cotización autorizada. \n¿Desea continuar?",
			
			buttons: {
				cancel: "No",
				confirm: "Si"
			}
		}).then(function(value) {
			if(value === null) {
				location.href= router;
			} else {
				swal({
					text: "Autorizado por: ",
					content: {
						element: "input",
						attributes: {
							placeholder: "Ingresa tu nombre"
						}
					},
					buttons: {
						confirm: "Enviar"
					}
				}).then(function(dataInput) {
					$.post("<?= base_url()?>/Integration/reloadSaveAutName", {
							idOrden: idOrden,
							name: dataInput
		 					}, function(data) {
		 						if(data.length > 0) {
									swal({
										text: "Dato almacenado correctamente",
										icon: 'success',
										buttons: {
											confirm: "Listo"
										}
									})
								}
		 					});
				})
			}
		})
																					
	} else {
		console.log("El costo de la orden se encuentre en un valor equilibrado al costo del despiece");
	}
})
</script>