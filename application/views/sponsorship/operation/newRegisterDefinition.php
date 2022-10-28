<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electrónico:          	jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:						Página Web.
 *************************************************************************
 *************************************************************************
 ******************** BOGOTÁ COLOMBIA 2018 *******************************
 */
defined('BASEPATH') OR exit('No direct script access allowed');



?>
				<!--alerts CSS -->
		    	<link href="<?= base_url()?>assets/node_modules/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
			    <!-- Sweet-Alert  -->
			    <script src="<?= base_url()?>assets/node_modules/sweetalert/sweetalert.min.js"></script>
			    <script src="<?= base_url()?>assets/node_modules/sweetalert/jquery.sweet-alert.custom.js"></script>
			    
			    
			    <!-- ============================================================== -->
        		<!-- BEGIN PAGE JQUERY ROUTINES -->
        		<!-- ============================================================== -->
        		
        		
				     
		        <script>
			    
			     /**Valida los campos de acuerdo al tipo*/
			     $(document).ready(function() {
						$("#tipoDoc").change(function() {
							tipoDoc = $('#tipoDoc').val();
							documento = $('#documento').val();
		 					$.post("<?= base_url()?>/Integration/reloadInformationUserSponsorship", {
		 						tipoDoc : tipoDoc,
		 						documento : documento
		 					}, function(data) {
			 						$("#nombres").val('');
			 						$("#apellidos").val('');
		 							var tempo = data.split('|');
			 						if (tempo=='' && $('#tipo').val()==1){
			 							$(document).ready(function() {
				 	                        swal({
				 	                          title: "No existe paciente con la informaci<?= LETRA_MIN_O?>n ingresada",
				 	                          text: "El tipo de documento y documento que ha ingresado no tienen relacionado un paciente dentro del sistema Esalud. Intente nuevamente",
				 	                          type: "error",
				 	                          confirmButtonText: "Continuar",
				 	                          closeOnConfirm: true
				 	                        }
				 	                        );
				 	                    });
			 							$('#tipoDoc').val('');
										$('#documento').val('');
				 					}else{
				 						$("#nombres").val(tempo[0]);
				 						$("#apellidos").val(tempo[1]);
					 				}
			 						
		 					});
						});
					});

			     /**Valida los campos de acuerdo al documento*/
			     $(document).ready(function() {
						$("#documento").change(function() {
							tipoDoc = $('#tipoDoc').val();
							documento = $('#documento').val();
		 					$.post("<?= base_url()?>/Integration/reloadInformationUserSponsorship", {
		 						tipoDoc : tipoDoc,
		 						documento : documento
		 					}, function(data) {
			 						$("#nombres").val('');
			 						$("#apellidos").val('');
		 							var tempo = data.split('|');
			 						if (tempo=='' ){
			 							$(document).ready(function() {
				 	                        swal({
				 	                          title: "No existe usuario con la informaci<?= LETRA_MIN_O?>n ingresada",
				 	                          text: "El tipo de documento y documento que ha ingresado no tienen relacionado un paciente dentro del sistema Esalud. Intente nuevamente",
				 	                          type: "error",
				 	                          confirmButtonText: "Continuar",
				 	                          closeOnConfirm: true
				 	                        }
				 	                        );
				 	                    });
			 							$('#tipoDoc').val('');
										$('#documento').val('');
				 					}else{
				 						$("#nombres").val(tempo[0]);
				 						$("#apellidos").val(tempo[1]);
					 				}
			 						
		 					});
						});
					});
				/**Valida los campos de acuerdo al tipo*/
			     $(document).ready(function() {
						$('#tipo').change( function(){
							if($("#tipo").val()=='1'){
								$(".cotizacion").prop('disabled', false);
								$(".cotizacion").show();
								$(".descripcion").prop('disabled', true);
								$(".descripcion").hide();
								$("#valor").prop('readonly', true);
								
								tipoDoc = $('#tipoDoc').val();
								documento = $('#documento').val();
			 					$.post("<?= base_url()?>/Integration/reloadInformationStokePriceForSponsorShip", {
			 						tipoDoc : tipoDoc,
			 						documento : documento
			 					}, function(data) {
				 						if (data=='**'){
				 							$(document).ready(function() {
					 	                        swal({
					 	                          title: "No existen cotizaciones",
					 	                          text: "El tipo de documento y documento que ha ingresado no tienen relacionado un paciente que tenga cotizaciones activas. Intente nuevamente",
					 	                          type: "error",
					 	                          confirmButtonText: "Continuar",
					 	                          closeOnConfirm: true
					 	                        }
					 	                        );
					 	                    });
				 							
					 					}else{
						 					//alert(data);
						 					$("#cotizacion").html(data);
						 				}
				 				});
							}else if($("#tipo").val()=='2' || $("#tipo").val()=='3' ){
								$(".descripcion").prop('disabled', false);
								$(".descripcion").show();
								$(".cotizacion").prop('disabled', true);
								$(".cotizacion").hide();
								$("#valor").prop('readonly', false);
							}
					    });
					});

			     $(document).ready(function() {
						$('#cotizacion').change( function(){
							cotizacion = $('#cotizacion').val();
		 					$.post("<?= base_url()?>/Integration/reloadInformationStokePriceForSponsorShipDefineValue", {
		 						cotizacion : cotizacion
		 					}, function(data) {
			 					
		 						$("#valor").val(data);
		 						$("#total").val(data);
			 				});
					    });
					});
					
			     $(document).ready(function() {
						$('#valor').change( function(){
							var total = $("#valor").val();
							var patrocinado = $("#patrocinado").val();
							if( patrocinado>total){
								$(document).ready(function() {
		 	                        swal({
		 	                          title: "Error en el valor del patrocinio",
		 	                          text: "Valide la informaci<?= LETRA_MIN_O?>n del total general y la relacianda con cada uno de los fondos",
		 	                          type: "error",
		 	                          confirmButtonText: "Validar",
		 	                          closeOnConfirm: true
		 	                        }
		 	                        );
		 	                    });
								$("#valor").val('');
								$("#total").val('');
							}else{
								//Relaciono el valor a pagar
								var pagar = parseInt(total) - parseInt(patrocinado);
								$("#pagar").val(pagar);	
								$("#total").val(total);			
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
                <form class=" form-horizontal" role="form" 
                action="<?= base_url()?>SponsorshipsAppSponsorships/saveRegister" 
                id="form_sample_3" 
                method="post"       
                autocomplete="off">
	                
	                <div class="row">
	                    <div class="col-sm-12">
	                        <div class="card">
	                            <div class="card-body">
	                            
	                                <h5 class="card-title"> Crear patrocinio informaci&oacute;n general </h5>
                            			 <div class="form-group">
	                                        <label class="col-md-12" for="tipoDoc">Tipo de documento * </label>
	                                        <div class="col-md-12">
	                                            <select class="form-control" id="tipoDoc" name="tipoDoc">
													<option value="">--- Seleccione una opci&oacute;n ---</option>
													<?php 
                                                            if($listaTipoDocumento!=null){
                                                            	foreach ($listaTipoDocumento as $value) {
                                                            		
                                                                               
                                                            ?>
                                                            <option value="<?= $value->ID;?>" ><?= $value->NOMBRE;?></option>
                                                            <?php 
                                                            	}
                                                            }?>
                                                </select>
	                                        </div>
	                             		</div>
	                             		<div class="form-group">
	                                        <label class="col-md-12" for="documento">Documento * </label>
	                                        <div class="col-md-12">
                                            	<input class="form-control " type="text" name="documento" id="documento"  placeholder="88888888" />
                                            </div>
	                             		</div>
	                             		<div class="form-group">
	                                        <label class="col-md-12" for="nombres">Nombres * </label>
	                                        <div class="col-md-12">
                                            	<input class="form-control " type="text" name="nombres" id="nombres" placeholder="Ana"  disabled="disabled" />
                                            </div>
	                             		</div>
	                             		<div class="form-group">
	                                        <label class="col-md-12" for="apellidos">Apellidos * </label>
	                                        <div class="col-md-12">
                                            	<input class="form-control " type="text" name="apellidos" id="apellidos" placeholder="Beltr&aacute;n"  disabled="disabled" />
                                            </div>
	                             		</div>
	                             		<div class="form-group">
	                                        <label class="col-md-12" for="tipo">Tipo de patrocinio * </label>
	                                        <div class="col-md-12">
	                                            <select class="form-control" id="tipo" name="tipo">
													<option value="">--- Seleccione una opci&oacute;n ---</option>
													<?php 
                                                            if($listaTipo!=null ){
                                                                foreach ($listaTipo->result() as $value) {
                                                            		
                                                                               
                                                            ?>
                                                            <option value="<?= $value->ID;?>" ><?= $value->NOMBRE;?></option>
                                                            <?php 
                                                            	}
                                                            }?>
                                                </select>
	                                        </div>
	                             		</div>
	                             		<div class="form-group cotizacion" style="display: none;">
	                                        <label class="col-md-12" for="cotizacion">Cotizaci&oacute;n * </label>
	                                        <div class="col-md-12">
	                                            <select class="form-control cotizacion" id="cotizacion" name="cotizacion" disabled="disabled">
													<option value="">--- Seleccione una opci&oacute;n ---</option>
                                                </select>
	                                        </div>
	                             		</div>
	                             		<div class="form-group descripcion" style="display: none;">
                    						<label class="col-md-12" for="descripcion">Descripci&oacute;n del patrocinio </label>
                    						<div class="col-md-12">
                    							<textarea rows="4" cols="100" class="form-control descripcion"
                    								id="descripcion" name="descripcion"
                    								placeholder="Detalle la descripci&oacute;n  del patrocinio "  disabled="disabled"></textarea>
                    							<div class="form-control-feedback"></div>
                    						</div>
                    					</div>
                						<div class="form-group">
	                                        <label class="col-md-12" for="valor">Valor general * </label>
	                                        <div class="col-md-12">
                                            	<input class="form-control " type="number" name="valor" id="valor" placeholder="Ej 15000"  readonly="readonly"/>
                                            </div>
	                             		</div>
                					</div>
	                            </div>
	                        </div>
	                    </div>
	                    
	                    <div class="row">
    	                    <div class="col-sm-12">
    	                        <div class="card">
    	                            <div class="card-body">
    	                            	<h5 class="card-title"> Selecci&oacute;n de fondos a afectar </h5>
                                		<div class="table-responsive">
                                    	<table id="myTable" class="display nowrap table table-hover table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th width="30%">Nombre</th>
                                                    <th width="30%">Saldo actual</th>
                                                    <th width="30%">Valor</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            	<?php 
                                            	   $tempo=$listaFondos;
                                            	   if($listaFondos!=null){
                                                                $i=1;
                                                                foreach ($listaFondos as $value) {
                                                        ?>
                                                <tr>
                                                    <td><?= $i;?></td>
                                                    <td>
                                                        <?= $value->NOMBRE;?>
                                                    </td>
                                                    <td><?= numberFormatEvolution($value->VALOR); ?></td>
                                                    <td>
                                                     	<input class="form-control " type="number" name="valor<?= $value->ID;?>" id="valor<?= $value->ID;?>" placeholder="Ej 15000"  width="25%"/>
                                                     	<script>
                                                     	 	$(document).ready(function() {
																$('#valor<?= $value->ID;?>').change( function(){
																	var total = $("#total").val();
																	var valor = 0;
														            var tempo=0;
														            //Todos los valores de los fondos
																	<?php 
																	foreach ($tempo as $v) {
																	?>
																	if($("#valor<?= $v->ID;?>").val()==''){
																		tempo=0;
																	}else{
																		tempo=$("#valor<?= $v->ID;?>").val();
																	}
																	valor = parseInt(valor)+ parseInt(tempo);
																	<?php 
																	}
																	?>

														            var resultado =  parseInt(valor);
														            if( resultado>total){
																		$(document).ready(function() {
    											 	                        swal({
    											 	                          title: "Error en el valor del patrocinio",
    											 	                          text: "El valor a pratrocinar es superior al valor total definido",
    											 	                          type: "error",
    											 	                          confirmButtonText: "Continuar",
    											 	                          closeOnConfirm: true
    											 	                        }
    											 	                        );
    											 	                    });
																		var valor = tempo=0;
															         	$("#valor<?= $value->ID;?>").val(tempo);
															            //Devuelvo el valor correcto
															            
															         	//Todos los valores de los fondos
															         	$("#patrocinado").val(tempo);
																		<?php 
																		foreach ($tempo as $v) {
																		?>
																		if($("#valor<?= $v->ID;?>").val()==''){
																			tempo=0;
																		}else{
																			tempo=$("#valor<?= $v->ID;?>").val();
																		}
																		valor = parseInt(valor)+ parseInt(tempo);
																		<?php 
																		}
																		?>
																		$("#patrocinado").val(valor);
																		var pagar = parseInt(total) - parseInt(valor);
																		$("#pagar").val(pagar);	

																		
																	}else{
																		//Relaciono el valor a pagar
																		$("#patrocinado").val(resultado);	
																		var pagar = parseInt(total) - parseInt(resultado);
																		$("#pagar").val(pagar);				
																	}
					    										});
															});
														</script>   
                                                    </td>
                                                </tr>
                                                <?php 
                                                                $i++;
                                                                 
                                                                }//end foreach
                                                        }//end if
                                                ?>
                                            </tbody>
                                        </table>
                                </div>
    	                            </div>
    	                        </div>
    	                    </div>
	                    </div>
	                    <div class="row">
    	                    <div class="col-sm-12">
    	                        <div class="card">
    	                            <div class="card-body">
    	                            	<h5 class="card-title"> Detalle final del patrocinio </h5>
    	                            	<div class="form-group">
	                                        <label class="col-md-12" for="total">Total general (cotizado) * </label>
	                                        <div class="col-md-12">
                                            	<input class="form-control " type="number" name="total" id="total"  readonly="readonly" value="0"/>
                                            </div>
	                             		</div>
	                             		<div class="form-group">
	                                        <label class="col-md-12" for="patrocinado">Total patrocinado * </label>
	                                        <div class="col-md-12">
                                            	<input class="form-control " type="number" name="patrocinado" id="patrocinado"   readonly="readonly" value="0"/>
                                            </div>
	                             		</div>
	                             		<div class="form-group">
	                                        <label class="col-md-12" for="pagar">Total a pagar * </label>
	                                        <div class="col-md-12">
                                            	<input class="form-control " type="number" name="pagar" id="pagar"   readonly="readonly" value="0"/>
                                            </div>
	                             		</div>
	                             		
                                		<div class="form-group " >
                    						<label class="col-md-12" for="observacion">Descripci&oacute;n del patrocinio </label>
                    						<div class="col-md-12">
                    							<textarea rows="4" cols="100" class="form-control "
                    								id="observacion" name="observacion" placeholder="Detalle la observaci&oacute;n  del patrocinio "  ></textarea>
                    							<div class="form-control-feedback"></div>
                    						</div>
                    					</div>
                						
    	                            </div>
    	                        </div>
    	                    </div>
	               		</div>
	               
	                
	                <!-- Botón de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                	<a href="<?= base_url()?>SponsorshipsAppSponsorships/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
                                                <i class="fa fa-arrow-left"></i>
                                                <span class="hidden-xs"> Retornar</span>
                                            </a>
	                		<button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
	                		
	                	</div>   
	                	<div class="col-sm-12">
	                	<br>
	                	</div> 
	                </div>
	                <!-- FIN Botón de envio de formulario -->
	            </form>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                
            
        
