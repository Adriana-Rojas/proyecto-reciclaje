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
                <!-- JavaScript para pintar campos adicionales -->
                <!-- ============================================================== -->
                
    			<script src="<?= base_url()?>assets/dist/js/pages/mask.js"></script>
    			<!--alerts CSS -->
		    	<link href="<?= base_url()?>assets/node_modules/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
			    <!-- Sweet-Alert  -->
			    <script src="<?= base_url()?>assets/node_modules/sweetalert/sweetalert.min.js"></script>
			    <script src="<?= base_url()?>assets/node_modules/sweetalert/jquery.sweet-alert.custom.js"></script>
                <script type="text/javascript">
		                

		                $(document).ready(function() {
							$('#correo').change( function(){
								correo = $('#correo').val();
			 					$.post("<?= base_url()?>/Integration/reloadEmailUser", {
			 						correo : correo
			 					}, function(data) {
				 					 if (data>0 && data!=$('#correoTempo').val()){
					 					
				 						$(document).ready(function() {
				 	                        swal({
				 	                          title: "Correo electr<?= LETRA_MIN_O?>nico ya existe",
				 	                          text: "El correo electr<?= LETRA_MIN_O?>nico que ingreso ya est<?= LETRA_MIN_A?> asociado a un usuario, por favor ingrese otro.",
				 	                          type: "error",
				 	                          confirmButtonText: "Continuar",
				 	                          closeOnConfirm: true
				 	                        }
				 	                        );
				 	                    });
				 						
				 						$('#correo').focus();
				 						$('#correo').val($('#correoTempo').val());
					 				 }
				 					 
			 					   });
								});	
						    });
		                $(document).ready(function() {
							$('#valida').change( function(){
								if($("#valida").val()!=<?= CTE_VALOR_SI ?> ){
									$(".valida").hide();
							        $("#password").prop('disabled', true);
							        $("#nueva").prop('disabled', true);
							        $("#confirmacion").prop('disabled', true);
								}else{
									$(".valida").show();
							        $("#password").prop('disabled', false);
							        $("#nueva").prop('disabled', false);
							        $("#confirmacion").prop('disabled', false);
								}
						    });
						});
		                

		                
			            
			 	</script>
        		<!-- ============================================================== -->
                <!-- JavaScript para pintar campos adicionales -->
                <!-- ============================================================== -->
                
                
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <form class=" form-horizontal" role="form" 
                action="<?= base_url()?>SystemUserDefine/saveProfile" 
                id="form_sample_3" 
                method="post"       
                autocomplete="off">
	                <div class="row">
	                    <div class="col-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h4 class="card-title">Actualizaci&oacute;n de informaci&oacute;n personal </h4>
	                                <h6 class="card-subtitle">Funcionalidad para actualizar la informac&oacute;n del usuario actual</h6>
	                                
	                            </div>
	                            <div class="form-group">
                               		<label class="col-md-12" for="codigo">Nombre del usuario *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="codigo" name="codigo" 
	                                    	value="<?= $id ?>" readonly="readonly"
	                                        placeholder="Ej. pepe.perdomo">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group">
                               		<label class="col-md-12" for="nombre">Nombres *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="nombre" name="nombre" 
	                                    	value="<?= $nombre ?>"
	                                        placeholder="Ej. Pepe ">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group">
                               		<label class="col-md-12" for="apellido">Apellidos *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="apellido" name="apellido" 
	                                    	value="<?= $apellido ?>"
	                                        placeholder="Ej. Perdomo">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group">
                               		<label class="col-md-12" for="correo">Correo electr&oacute;nico *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="correo" name="correo" 
	                                    	value="<?= $correo ?>"
	                                        placeholder="Ej. correo@correo.com.co">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group">
                               		<label class="col-md-12" for="valida">Actualiza Clave *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="valida" name="valida">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaSiNo as $value) { 
                                                  	if($value->ID==$valorSINO){
                                                    	$selected="selected='selected'";
                                                    }else{
                                                    	$selected="";
                                                    }
                                            ?>
                                            <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option> 
                                            <?php
                                            }?>
                                        </select>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group valida" style="display:none;">
                               		<label class="col-md-12" for="password">Clave anterior *</label>
                                    <div class="col-md-12">
	                                    <input type="password" class="form-control" id="password" name="password" 
	                                    	placeholder="Ej. 12Qw7$85abc" disabled="disabled">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group valida" style="display:none;">
                               		<label class="col-md-12" for="nueva">Nueva clave *</label>
                                    <div class="col-md-12">
	                                    <input type="password" class="form-control" id="nueva" name="nueva" 
	                                    	placeholder="Ej. 12Qw7$85abc" disabled="disabled">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group valida" style="display:none;">
                               		<label class="col-md-12" for="confirmacion">Confirmaci&oacute;n nueva clave *</label>
                                    <div class="col-md-12">
	                                    <input type="password" class="form-control" id="confirmacion" name="confirmacion" 
	                                    	placeholder="Ej. 12Qw7$85abc" disabled="disabled">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               
	                        </div>   
	                    </div>
	                </div>
	                <!-- Botón de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                		<button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
	                		<input type="hidden" name="correoTempo" id="correoTempo" value="<?= $correo;?>">
                            
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
                
            
