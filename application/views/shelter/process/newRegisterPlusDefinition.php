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
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <form class=" form-horizontal" role="form" 
                action="<?= base_url()?>ShelterAppShelter/saveBooking" 
                id="form_sample_3" 
                method="post"       
                autocomplete="off">
	                
	                <div class="row">
	                    <div class="col-sm-12">
	                        <div class="card">
	                            <div class="card-body">
	                            
	                                <h5 class="card-title"> Realizar reserva para acompa&ntilde;ante  </h5>
                            			 <div class="form-group">
                                        	<label class="col-md-12" for="reservaVisual">Reserva principal * </label>
                                            <div class="col-md-12">
                                            	<input class="form-control" type="text" name="reservaVisual" id="reservaVisual"  value="<?=$reserva;?>" readonly="readonly"/>
                                            </div>
                                         </div>
                                         <div class="form-group">
                                        	<label class="col-md-12" for="periodo">Periodo * </label>
                                            <div class="col-md-12">
                                            	<input class="form-control" type="text" name="periodo" id="periodo"  value="<?=$fecha;?>" readonly="readonly"/>
                                            </div>
                                         </div>
                                         <div class="form-group">
	                                        <label class="col-md-12" for="relacion">Habitaci&oacute;n - Cama * </label>
	                                        <div class="col-md-12">
	                                            <select class="form-control" id="relacion" name="relacion">
													<option value="">--- Seleccione una opci&oacute;n ---</option>
													<?php 
													
													
															$diferencia= intervaloTiempo(
																		defineFormatoFecha($fechaInicial, FORMAT_DATE) ,
																		defineFormatoFecha($fechaFinal, FORMAT_DATE),86400)+1;
															//echo $diferencia;
															if($listaHabitacion!=null){
                                                            	foreach ($listaHabitacion as $value) {
                                                            		if ($value->CANTIDAD >=$diferencia){
                                                            			
                                                            		
                                                            	              
                                                            ?>
                                                            <option value="<?= $value->ID;?>" ><?= $value->HABITACION." - ".$value->CAMA;?></option>
                                                            <?php 
                                                            		}
                                                            	}
                                                            }?>
                                                </select>
	                                        </div>
	                             		</div>
	                             		<div class="form-group">
	                                        <label class="col-md-12" for="tipo">Tipo usuario * </label>
	                                        <div class="col-md-12">
	                                            <select class="form-control" id="tipo" name="tipo">
													<option value="">--- Seleccione una opci&oacute;n ---</option>
													
													
													<?php 
                                                            if($listaTipoUsuario!=null){
                                                            	foreach ($listaTipoUsuario->result() as $value) {
                                                            		IF($value->ID=='2'){
                                                                               
                                                            ?>
                                                            <option value="<?= $value->ID;?>" selected="selected"><?= $value->NOMBRE;?></option>
                                                            <?php 
                                                            	}
                                                            	}
                                                            }?>
                                                </select>
	                                        </div>
	                             		</div>
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
                                            	<input class="form-control " type="text" name="nombres" id="nombres" placeholder="Ana"  />
                                            </div>
	                             		</div>
	                             		<div class="form-group">
	                                        <label class="col-md-12" for="apellidos">Apellidos * </label>
	                                        <div class="col-md-12">
                                            	<input class="form-control " type="text" name="apellidos" id="apellidos" placeholder="Beltr&aacute;n"  />
                                            </div>
	                             		</div>
	                             		<div class="form-group">
	                                        <label class="col-md-12" for="nacimiento">Fecha Nacimiento * </label>
	                                        <div class="col-md-12">
                                            	<input class="form-control " type="text" name="nacimiento" id="nacimiento"  placeholder="dd/mm/aaaa" min="01/01/1900" />
                                            </div>
	                             		</div>
	                             		
	                             		
	                            </div>
	                        </div>
	                    </div>
	                </div>
	               
	                
	                <!-- Botón de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                	
	                		<button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
	                		<input type="hidden" name="id" id="id" value="<?= $id;?>">
	                		<input type="hidden" name="reserva" id="reserva" value="<?= $reserva;?>">
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
                
            <!-- ============================================================== -->
        		<!-- BEGIN PAGE JQUERY ROUTINES -->
        		<!-- ============================================================== -->
        		
        		 <!-- Plugin JavaScript -->
			    <script src="<?= base_url()?>assets/node_modules/moment/moment.js"></script>
			    <!-- Date Picker Plugin JavaScript -->
			    <script src="<?= base_url()?>assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
			    
				<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.es.min.js"></script>
			    <!-- Date range Plugin JavaScript -->
			    <script src="<?= base_url()?>assets/node_modules/timepicker/bootstrap-timepicker.min.js"></script>
			    <script src="<?= base_url()?>assets/node_modules/bootstrap-daterangepicker/daterangepicker.js"></script>
        		<script>
        		 
        		 // Date Picker
        		   jQuery('#nacimiento').datepicker({
        		        autoclose: true,
        		        todayHighlight: true,
        		        format: 'dd/mm/yyyy',
        		        endDate: '0d',
        		        language: 'es'
        		    });
				    </script>
				     
		        <script>
			     $(document).ready(function() {
						$("#departamento").change(function() {
							$("#departamento option:selected").each(function() {
								departamento = $('#departamento').val();
		 					$.post("<?= base_url()?>/Integration/reloadCity", {
		 						departamento : departamento
		 					}, function(data) {
		 							$("#ciudad").html(data);
		 							});
							});
						})
					});
		        
				
			     /**Valida los campos de acuerdo al tipo*/
			     $(document).ready(function() {
						$("#tipoDoc").change(function() {
							tipoDoc = $('#tipoDoc').val();
							documento = $('#documento').val();
							tipo = $('#tipo').val();
		 					$.post("<?= base_url()?>/Integration/reloadInformationUserShelter", {
		 						tipoDoc : tipoDoc,
		 						documento : documento,
		 						tipo : tipo
		 					}, function(data) {
			 						$("#nombres").val('');
			 						$("#apellidos").val('');
			 						$("#nacimiento").val('');
			 						$("#entidad").val('');
			 						$("#ciudad").val('');
			 						$("#departamento").val('');
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
				 						$("#nacimiento").val(tempo[2]);
				 						$("#entidad").val(tempo[3]);
				 						$("#departamento").val(tempo[4]);
		 								$("#ciudad").html(tempo[5]);
		 								$("#ciudad").val(tempo[6]);
					 				}
			 						
		 					});
						});
					});

			     /**Valida los campos de acuerdo al documento*/
			     $(document).ready(function() {
						$("#documento").change(function() {
							tipoDoc = $('#tipoDoc').val();
							documento = $('#documento').val();
							tipo = $('#tipo').val();
		 					$.post("<?= base_url()?>/Integration/reloadInformationUserShelter", {
		 						tipoDoc : tipoDoc,
		 						documento : documento,
		 						tipo : tipo
		 					}, function(data) {
			 						$("#nombres").val('');
			 						$("#apellidos").val('');
			 						$("#nacimiento").val('');
			 						$("#entidad").val('');
			 						$("#ciudad").val('');
			 						$("#departamento").val('');
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
				 						$("#nacimiento").val(tempo[2]);
				 						$("#entidad").val(tempo[3]);
				 						$("#departamento").val(tempo[4]);
		 								$("#ciudad").html(tempo[5]);
		 								$("#ciudad").val(tempo[6]);
					 				}
			 						
		 					});
						});
					});
				
			        
				</script>
				<!-- ============================================================== -->
				<!-- END PAGE JQUERY ROUTINES -->
        		<!-- ============================================================== -->
        
