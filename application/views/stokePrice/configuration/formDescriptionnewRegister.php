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
				<!--alerts CSS -->
		    	<link href="<?= base_url()?>assets/node_modules/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
			    <!-- Sweet-Alert  -->
			    <script src="<?= base_url()?>assets/node_modules/sweetalert/sweetalert.min.js"></script>
			    <script src="<?= base_url()?>assets/node_modules/sweetalert/jquery.sweet-alert.custom.js"></script>
			    
				<script type="text/javascript">

                        $(document).ready(function() {
                            $('#origen').change( function(){

                                if($("#origen").val()==<?= CTE_PAIS_DEFECTO ?> ){
                                    $("#labelMateriales").html('Costos de materiales Dado en pesos (COP) *');
                                    $("#materiales").prop('placeholder', "300000");
                                }else{
                                   $("#labelMateriales").html('Costos de materiales Dado en d&oacute;lares (USD) *');
                                   $("#materiales").prop('placeholder', "1000");
                                }
                            });
                        });

		                $(document).ready(function() {
							$('#codigo').change( function(){
                                codigo = $('#codigo').val();
			 					$.post("<?= base_url()?>Integration/reloadInformationForStokePrice", {
			 						codigo : codigo
			 						}, function(data) {
			 							var element = data.split('|');
			 							if (element[0]=='*'){
			 								$(document).ready(function() {
			 									swal({
	    				 	                          title: "C<?= LETRA_MIN_O?>digo ya existe",
	    				 	                          text: "El c<?= LETRA_MIN_O?>digo que ingreso ya existe como elemento, producto o servicio para cotizaciones, por favor vuelva a ingresar un dato e intente nuevamente.",
	    				 	                          type: "error",
	    				 	                          confirmButtonText: "Continuar",
	    				 	                          closeOnConfirm: true
	    				 	                        }
	    				 	                        );
    				 	                    });
    				 						$('#codigo').val('');
    				 						$('#codigo').focus();
    				 						$('#nombre').val('');
    					 					$('#tipoNombre').val('');
    					 				 }else if (element[0]=='-'){
			 								$(document).ready(function() {
			 									swal({
	    				 	                          title: "C<?= LETRA_MIN_O?>digo no existe",
	    				 	                          text: "El c<?= LETRA_MIN_O?>digo que ingreso no existe como elemento, producto o servicio, por favor vuelva a ingresar un dato e intente nuevamente.",
	    				 	                          type: "error",
	    				 	                          confirmButtonText: "Continuar",
	    				 	                          closeOnConfirm: true
	    				 	                        }
	    				 	                        );
    				 	                    });
    				 						$('#codigo').val('');
    				 						$('#codigo').focus();

    				 						$('#nombre').val('');
    					 					$('#tipoNombre').val('');
    					 				 }else{
    					 					
    					 					$('#nombre').val(element[3]);
    					 					$('#auxiliar').val(codigo);
    					 					$('#tipoNombre').val(element[1]);
    					 					$('#id').val(element[2]);
    					 					$('#tipo').val(element[0]);
    					 					$('#descripcion').val(element[4]);
    					 					$('#proveedor').val(element[5]);
    					 					if($("#tipo").val()=='-1' ){
    											$(".completo").hide();
										        $(".completo").prop('disabled', true);
											}else{
												$(".completo").show();
												$(".completo").prop('disabled', false);
											}
        					 			}

                                        if (element[6]=='1'){
                                            $('#proveedor').prop('disabled', true);
                                            $("#proveedor").hide();
                                            $(".proveedor").hide();
                                        }else{
                                            $('#proveedor').prop('disabled', false);
                                            $("#proveedor").show();
                                            $(".proveedor").show();
                                        }
				 				});
				 				
			 				});	
						});

                        

		                
			            
			 	</script>
			 	
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <form class=" form-horizontal" role="form" 
                action="<?= base_url()?>StokePriceConfigurationDescription/saveRegister" id="form_sample_3" method="post" autocomplete="off" enctype="multipart/form-data">
	                <div class="row">
	                    <div class="col-sm-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h5 class="card-title"> Datos generales
                                	<small class="font-gray">IdentifiqueE los datos relacionados al producto, elemento o servicio</small></h5>
    	                         	<div class="form-group " >
                                    	<label class="col-md-12" for="codigo">C&oacute;digo *</label>
                                        <div class="col-md-12">
            	                        	<input type="number" class="form-control" id="codigo" name="codigo" value="<?= $codigo;?>" placeholder="123456" <?= $readOnly;?>>
            	                            <div class="form-control-feedback" > </div>
                                        </div>
                                    </div>
                                    <div class="form-group " >
                                    	<label class="col-md-12" for="auxiliar">C&oacute;digo auxiliar</label>
                                        <div class="col-md-12">
            	                        	<input type="number" class="form-control" id="auxiliar" name="auxiliar" value="<?= $auxiliar;?>" placeholder="123456" >
            	                            <div class="form-control-feedback" > </div>
                                        </div>
                                    </div>
                                    <div class="form-group " >
                                    	<label class="col-md-12" for="nombre">Nombre *</label>
                                        <div class="col-md-12">
            	                        	<input type="text" class="form-control" id="nombre" name="nombre" value="<?= $nombre;?>" placeholder="Pr&oacute;tesis" readonly="readonly" >
            	                            <div class="form-control-feedback" > </div>
                                        </div>
                                    </div>
                                    <div class="form-group " >
                                    	<label class="col-md-12" for="tipoNombre">Tipo *</label>
                                        <div class="col-md-12">
            	                        	<input type="text" class="form-control" id="tipoNombre" name="tipoNombre" value="<?= $tipoOrden;?>" placeholder="Pr&oacute;tesis" readonly="readonly" >
            	                            <div class="form-control-feedback" > </div>
                                        </div>
                                    </div>
                                    <?php 
                                        if( $valida==0){
                                    ?>
                                    <div class="form-group completo proveedor" <?= $display;?> >
					                	<label class="col-md-12" for="proveedor">Proveedor * </label>
					                    	<div class="col-md-12">
						                    	<select class="form-control completo" id="proveedor" name="proveedor" <?= $disabled; ?>>
					                            	<option value="">--- Seleccione una opci&oacute;n ---</option>
					                                <?php 
					                                if($listaProveedores!=NULL){
					                                    foreach ($listaProveedores->result() as $value) { 
						                                      if($proveedor==$value->ID){
						                                          $selected="selected='selected'";
						                                      }else{
						                                          $selected=null;
						                                      }
						                                  ?>
							                        <option value="<?= $value->ID;?>" <?= $selected; ?> ><?= $value->NOMBRE;?></option> 
							                        <?php
							                        }
					                                }?>                    
    					                        </select>
    						                    <div class="form-control-feedback" > </div>
					                		</div>
					                </div>
                                    <?php
                                        }
                                    ?>
					                <div class="form-group completo" <?= $display;?> >
					                	<label class="col-md-12" for="origen">Origen *</label>
					                    	<div class="col-md-12">
						                    	<select class="form-control completo" id="origen" name="origen" >
					                            	<option value="">--- Seleccione una opci&oacute;n ---</option>
					                                <?php 
					                                if($listaPais!=NULL){
					                                    foreach ($listaPais->result() as $value) { 
						                                      if($pais==$value->ID){
						                                          $selected="selected='selected'";
						                                      }else{
						                                          $selected=null;
						                                      }
						                                  ?>
							                        <option value="<?= $value->ID;?>" <?= $selected; ?> ><?= $value->NOMBRE;?></option> 
							                        <?php
							                        }
					                                }?>                    
    					                        </select>
    						                    <div class="form-control-feedback" > </div>
					                		</div>
					                </div>
                                    <div class="form-group ">
                						<label class="col-md-12" for="descripcion">Descripci&oacute;n  * </label>
                						<div class="col-md-12">
                							<textarea rows="4" cols="100" class="form-control" id="descripcion" name="descripcion" placeholder="Detalle del producto o elemento"><?= $descripcion;?></textarea>
                							<div class="form-control-feedback"></div>
                						</div>
                					</div>
                					<!-- Costos -->
                					<div class="form-group completo" <?= $display;?> >
                                    	<label class="col-md-12" for="materiales" id="labelMateriales" style="color: red;"><?= $leyenda; ?></small></label>
                                        <div class="col-md-12">
            	                        	<input type="number" class="form-control completo" id="materiales" name="materiales" value="<?= $materiales;?>" placeholder="300000" <?= $disabled; ?>>
            	                            <div class="form-control-feedback" > </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group " >
                                    	<label class="col-md-12" for="mano">Costos de mano de obra <small>Dado en pesos (COP)</small> *</label>
                                        <div class="col-md-12">
            	                        	<input type="number" class="form-control " id="mano" name="mano" value="<?= $mano;?>" placeholder="100000" >
            	                            <div class="form-control-feedback" > </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group "  >
                                    	<label class="col-md-12" for="adicionales">Costos adicionales <small>Dado en pesos (COP)</small> *</label>
                                        <div class="col-md-12">
            	                        	<input type="number" class="form-control " id="adicionales" name="adicionales" value="<?= $adicionales;?>" placeholder="70000" >
            	                            <div class="form-control-feedback" > </div>
                                        </div>
                                    </div>
                                    <!-- Fin Costos -->
                                    
                                    <div class="form-group completo" <?= $display;?> >
                                    	<label class="col-md-12" for="tiempo">Tiempo de entrega <small>Dado en d&iacute;as</small> *</label>
                                        <div class="col-md-12">
            	                        	<input type="number" class="form-control completo" id="tiempo" name="tiempo" value="<?= $tentrega;?>" placeholder="30 d&iacute;as" <?= $disabled; ?>>
            	                            <div class="form-control-feedback" > </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group completo" <?= $display;?> >
                                    	<label class="col-md-12" for="garantia">Garantia <small>Dado en meses</small> *</label>
                                        <div class="col-md-12">
            	                        	<input type="number" class="form-control completo" id="garantia" name="garantia" value="<?= $garantia;?>" placeholder="12 meses" <?= $disabled; ?>>
            	                            <div class="form-control-feedback" > </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group completo" <?= $display;?> >
                                    	<label class="col-md-12" for="imagen">Imagen <small> Formato PNG 400*500 (max)</small></label>
                                        <div class="col-md-12">
            	                        	<input type="file" class="form-control completo" id="imagen" name="imagen" >
            	                            <div class="form-control-feedback" > </div>
                                        </div>
                                    </div>
                                    
                                    
                					
                					
	                        	</div>
	                    	</div>
	                	</div>
	                </div>
	                
	                <!-- Bot�n de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                	<a href="<?= base_url()?>StokePriceConfigurationDescription/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
                                                <i class="fa fa-arrow-left"></i>
                                                <span class="hidden-xs"> Retornar</span>
                                            </a>
	                		<button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
	                		<input type="hidden" name="tipo" id="tipo" value="<?= $tipo;?>">
	                		<input type="hidden" name="id" id="id" value="<?= $id;?>">
	                	</div>   
	                	<div class="col-sm-12">
	                	<br>
	                	</div> 
	                </div>
	                <!-- FIN Bot�n de envio de formulario -->
	            </form>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                
            <!-- ============================================================== -->
        		<!-- BEGIN PAGE JQUERY ROUTINES -->
        		<!-- ============================================================== -->
        		
        		
				<!-- ============================================================== -->
				<!-- END PAGE JQUERY ROUTINES -->
        		<!-- ============================================================== -->
        
