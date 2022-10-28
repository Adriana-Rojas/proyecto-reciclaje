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
				
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <form class=" form-horizontal" role="form" 
                action="<?= base_url()?>ShelterAppShelter/saveModifyInformation" 
                id="form_sample_3" 
                method="post"       
				                autocomplete="off">
				
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title"> <i class="fa fa-user fa-2x"></i> Modificar informaci&oacute;n de hu&eacute;sped del hogar de paso</h5>
									
									
									<div class="form-group">
	                                        <label class="col-md-12" for="habitacion">Habitaci&oacute;n - cama * </label>
	                                        <div class="col-md-12">
                                            	<input class="form-control " type="text" name="habitacion" id="habitacion"    value="<?= $habitacion;?> - <?= $cama;?>" readonly="readonly"/>
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
                                                            		IF($value->ID!='2'){
                                                            		    if($value->ID==$idTipo){
                                                            		        $selected="selected='selected'";
                                                            		    }else{
                                                            		        $selected="";
                                                            		    }
                                                                               
                                                            ?>
                                                            <option value="<?= $value->ID;?>" <?= $selected;?>><?= $value->NOMBRE;?></option>
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
                                                            	    if($value->ID==$tipoDoc){
                                                            	       $selected="selected='selected'";    
                                                            	    }else{
                                                            	        $selected="";
                                                            	    }
                                                            		
                                                                               
                                                            ?>
                                                            <option value="<?= $value->ID;?>" <?= $selected;?>><?= $value->NOMBRE;?></option>
                                                            <?php 
                                                            	}
                                                            }?>
                                                </select>
	                                        </div>
	                             		</div>
	                             		<div class="form-group">
	                                        <label class="col-md-12" for="documento">Documento * </label>
	                                        <div class="col-md-12">
                                            	<input class="form-control " type="text" name="documento" id="documento"  placeholder="88888888"  value="<?= $documento;?>"/>
                                            </div>
	                             		</div>
	                             		<div class="form-group">
	                                        <label class="col-md-12" for="nombres">Nombres * </label>
	                                        <div class="col-md-12">
                                            	<input class="form-control " type="text" name="nombres" id="nombres" placeholder="Ana"  value="<?= $soloNombres;?>" <?= $disabled;?>  />
                                            </div>
	                             		</div>
	                             		<div class="form-group">
	                                        <label class="col-md-12" for="apellidos">Apellidos * </label>
	                                        <div class="col-md-12">
                                            	<input class="form-control " type="text" name="apellidos" id="apellidos" placeholder="Beltr&aacute;n" value="<?= $apellidos;?>"  <?=  $disabled;?> />
                                            </div>
	                             		</div>
	                             		<div class="form-group">
	                                        <label class="col-md-12" for="nacimiento">Fecha Nacimiento * </label>
	                                        <div class="col-md-12">
                                            	<input class="form-control " type="text" name="nacimiento" id="nacimiento"  placeholder="dd/mm/aaaa"  value="<?=defineFormatoFechaInverso( $nacimiento, true);?>" <?= $disabled; ?>/>
                                            </div>
	                             		</div>
	                             		<div class="form-group " >
                                        	<label class="col-md-12" for="departamento">Procedencia - Departamento * </label>
                                            <div class="col-md-12">
                                            	<select class="form-control" id="departamento" name="departamento">
                                                            <option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            <?php 
                                                            if($listaDepartamento!=null ){
                                                            	foreach ($listaDepartamento->result() as $value) {
                                                                            if($value->ID==$departamento){
                                                                                $selected="selected='selected'";
                                                                            }else{
                                                                                $selected="";
                                                                            }    
                                                            ?>
                                                            <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option>
                                                            <?php 
                                                            	}
                                                            }?>
                                                        </select>
                                                <div class="form-control-feedback" > </div>
                                            </div>
                                         </div>  
                                         
                                         <div class="form-group ">
                                        	<label class="col-md-12" for="ciudad">Procedencia - Ciudad (Municipio)* </label>
                                            <div class="col-md-12">
                                            	<select class="form-control" id="ciudad" name="ciudad">
                                                            <option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            <?php 
                                                            if($listaCiudad!=null ){
                                                                foreach ($listaCiudad->result() as $value) {
                                                                            if($value->ID==$procedencia){
                                                                                $selected="selected='selected'";
                                                                            }else{
                                                                                $selected="";
                                                                            }    
                                                            ?>
                                                            <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option>
                                                            <?php 
                                                            	}
                                                            }?>
                                                        </select>
                                                <div class="form-control-feedback" > </div>
                                            </div>
                                         </div> 
                                         <div class="form-group">
	                                        <label class="col-md-12" for="entidad">Entidad * </label>
	                                        <div class="col-md-12">
	                                            <select class="form-control" id="entidad" name="entidad">
													<option value="">--- Seleccione una opci&oacute;n ---</option>
													<?php 
                                                            if($listaEmpresas!=null){
                                                            	foreach ($listaEmpresas as $value) {
                                                            	    if($value->ID_APB==$entidad){
                                                            	        $selected="selected='selected'";
                                                            	    }else{
                                                            	        $selected="";
                                                            	    } 
                                                                               
                                                            ?>
                                                            <option value="<?= $value->ID_APB;?>" <?=$selected ?>><?= $value->NOM_APB;?></option>
                                                            <?php 
                                                            	}
                                                            }?>
                                                </select>
	                                        </div>
	                             		</div>
								</div>
							</div>
						</div>
					</div>
				
				
					<!-- Botón de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                	<a href="<?= base_url()?>ShelterAppShelter/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
                                                <i class="fa fa-arrow-left"></i>
                                                <span class="hidden-xs"> Retornar</span>
                                            </a>
	                		<button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
	                		<input type="hidden" name="id" id="id" value="<?= $id;?>">
	                		<input type="hidden" name="idUsuarioHp" id="idUsuarioHp" value="<?= $idUsuarioHp;?>">
	                		
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
				/**Valida los campos de acuerdo al tipo*/
			     $(document).ready(function() {
						$('#tipo').change( function(){
							if($("#tipo").val()=='1'){
								$("#nombres").prop('disabled', true);
								$("#apellidos").prop('disabled', true);
								$("#nacimiento").prop('disabled', true);
								$("#acompanante").val('');
							}else{
								$("#nombres").prop('disabled', false);
								$("#apellidos").prop('disabled', false);
								$("#nacimiento").prop('disabled', false);
								$("#acompanante").val('37');
								$("#acompanante").prop('disabled', true);
							}
					    });
					});

			        
				</script>
				<!-- ============================================================== -->
				<!-- END PAGE JQUERY ROUTINES -->
        		<!-- ============================================================== -->
