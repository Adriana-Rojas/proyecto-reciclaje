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
							$('#codigo').change( function(){
								codigo = $('#codigo').val();
			 					$.post("<?= base_url()?>/Integration/reloadCodeUser", {
			 						codigo : codigo
			 					}, function(data) {
				 					 if (data>0 && data!=$('#codigoTempo').val()){
					 					
				 						$(document).ready(function() {
				 	                        swal({
				 	                          title: "C<?= LETRA_MIN_O?>digo ya existe",
				 	                          text: "El c<?= LETRA_MIN_O?>digo que ingreso ya existe como usuario, debe ingresar otro.",
				 	                          type: "error",
				 	                          confirmButtonText: "Continuar",
				 	                          closeOnConfirm: true
				 	                        }
				 	                        );
				 	                    });
				 						$('#codigo').val($('#codigoTempo').val());
				 						$('#codigo').focus();
					 				 }
				 					 
			 					   });
								});	
						    });

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
							$('#pagina').change( function(){
								pagina = $('#pagina').val();
			 					$.post("<?= base_url()?>/Integration/reloadUserPage", {
			 						pagina : pagina
			 					}, function(data) {
				 					 if (data==0 ){
					 					
				 						$(document).ready(function() {
				 	                        swal({
				 	                          title: "P<?= LETRA_MIN_A?>gina no existe",
				 	                          text: "La p<?= LETRA_MIN_A?>gina que ha digitado no existe dentro de la configuraci<?= LETRA_MIN_O?>n de m<?= LETRA_MIN_O?>dulos, por favor ingrese otra.",
				 	                          type: "error",
				 	                          confirmButtonText: "Continuar",
				 	                          closeOnConfirm: true
				 	                        }
				 	                        );
				 	                    });
				 						
				 						$('#pagina').focus();
				 						$('#pagina').val('');
					 				 }
				 					 
			 					   });
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
                action="<?= base_url()?>SystemUserDefine/saveRegister" 
                id="form_sample_3" 
                method="post"       
                autocomplete="off">
	                <div class="row">
	                    <div class="col-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h4 class="card-title">Definici&oacute;n de usuarios </h4>
	                                <h6 class="card-subtitle"></h6>
	                                
	                            </div>
	                            <div class="form-group">
                               		<label class="col-md-12" for="codigo">Nombre del usuario *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="codigo" name="codigo" 
	                                    	value="<?= $id ?>" <?= $readOnly;?>
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
                               		<label class="col-md-12" for="perfil">Perfil de usuario *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="perfil" name="perfil">
                                                            <option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            <?php foreach ($listaPadre->result() as $value) { 
                                                                        if($value->ID==$tipo){
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
                               <div class="form-group">
                               		<label class="col-md-12" for="pagina">P&aacute;gina *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="pagina" name="pagina" 
	                                    	value="<?= $pagina ?>"
	                                        placeholder="Ej. MainApp/board">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
	                        </div>   
	                    </div>
	                </div>
	                <!-- Botón de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                		<a href="<?= base_url()?>SystemUserDefine/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
                                                <i class="fa fa-arrow-left"></i>
                                                <span class="hidden-xs"> Retornar</span>
                                            </a>
                            <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
	                		<input type="hidden" name="codigoTempo" id="codigoTempo" value="<?= $id;?>">
	                		<input type="hidden" name="correoTempo" id="correoTempo" value="<?= $correo;?>">
                            <input type="hidden" name="valida" id="valida" value="<?= $valida;?>">
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
                
            
