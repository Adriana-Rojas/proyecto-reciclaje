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
								tipo = $('#tipoOrden').val();
			 					$.post("<?= base_url()?>Integration/reloadCodeProduct", {
			 						codigo : codigo
			 						}, function(data) { 
    				 					 if (data.length > 0){
                                            $('#nombre').val(data);
    				 						/* $(document).ready(function() {
    				 	                        swal({
    				 	                          title: "C<?= LETRA_MIN_O?>digo ya existe",
    				 	                          text: "El c<?= LETRA_MIN_O?>digo que ingreso ya existe dentro de la configuraci<?= LETRA_MIN_O?>n del <?= LETRA_MIN_A?>rbol, debe ingresar otro.",
    				 	                          type: "error",
    				 	                          confirmButtonText: "Continuar",
    				 	                          closeOnConfirm: true
    				 	                        }
    				 	                        );
    				 	                    });
    				 						$('#codigo').val($('#codigoTempo').val());
    				 						$('#codigo').focus(); */
    					 				 }
				 				});
				 				//Valido informacion para traer datos desde esalud
			 					/* $.post("<?= base_url()?>/Integration/reloadCodeProductsServicesEsalud", {
			 						codigo : codigo,
			 						tipo : tipo
			 						}, function(data) {
				 					 if (data==''){
					 					$(document).ready(function() {
				 	                        swal({
				 	                          title: "C<?= LETRA_MIN_O?>digo no existe ",
				 	                          text: "El c<?= LETRA_MIN_O?>digo que ingreso no existe dentro de la informaci<?= LETRA_MIN_O?>n del sistema Esalud. Debe ingresar otro",
				 	                          type: "error",
				 	                          confirmButtonText: "Continuar",
				 	                          closeOnConfirm: true
				 	                        }
				 	                        );
				 	                    });
				 						$('#codigo').val($('#codigoTempo').val());
				 						$('#codigo').focus();
					 				 }else{
					 					$('#nombre').val(data);
						 			 }
				 				}); */
			 				});	
						});

		                <?php 
	                    if ($tipoOrden==INTERCONSULTAS){
	                    ?>
	                    $(document).ready(function() {
							$('#paquete').change( function(){
								if($("#paquete").val()==<?= CTE_VALOR_NO ?> ){
									$(".paquete").hide();
							        $("#cantidad").prop('disabled', true);
								}else{
									$(".paquete").show();
									$("#cantidad").prop('disabled', false);
								}
						    });
						});
						<?php 
						}?>
			            
			 	</script>
			 	
			 	
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <form class=" form-horizontal" role="form" 
                action="<?= base_url()?>OrdersConfigurationProductsDefinition/saveRegister" 
                id="form_sample_3" 
                method="post"       
                autocomplete="off">
	                <div class="row">
	                    <div class="col-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h4 class="card-title">Configuraci&oacute;n de productos y servicios</h4>
	                                <h6 class="card-subtitle">Administre los diferentes productos y servicios que est&aacute;n disponibles dentro del sistema de informaci&oacute;n</h6>
	                                
	                                </div>
	                            <?php if ($niveles==3){
	                            ?>   
	                            <div class="row">
                               		<!-- Column -->
                                    
                                    <div class="col-md-1 col-lg-1 col-xlg-1">
                                        
                                    </div>
                                    
                                    <!-- Column -->
                                   <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Tipo de orden</h3>
                                                <h6 class="text-white"><?= $nombreTipo;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Ubicaci&oacute;n </h3>
                                                <h6 class="text-white"><?= $nombreMiembros;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Primer subnivel</h3>
                                                <h6 class="text-white"><?= $nomPrimerSubNiv;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Segundo subnivel</h3>
                                                <h6 class="text-white"><?= $nomSegundoSubNiv;?></h7>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Tercer subnivel</h3>
                                                <h6 class="text-white"><?= $nomTerceroSubNiv;?></h7>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-1 col-lg-1 col-xlg-1">
                                        
                                    </div>
                                    <!-- Column -->
                                   
                                </div>
	                            <?php }?>
	                            <?php if ($niveles==2){
	                            ?>   
	                            <div class="row">
                               		<!-- Column -->
                                    
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        
                                    </div>
                                    
                                    <!-- Column -->
                                   <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Tipo de orden</h3>
                                                <h6 class="text-white"><?= $nombreTipo;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Ubicaci&oacute;n </h3>
                                                <h6 class="text-white"><?= $nombreMiembros;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Primer subnivel</h3>
                                                <h6 class="text-white"><?= $nomPrimerSubNiv;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Segundo subnivel</h3>
                                                <h6 class="text-white"><?= $nomSegundoSubNiv;?></h7>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        
                                    </div>
                                    <!-- Column -->
                                   
                                </div>
	                            <?php }?> 
	                            <?php if ($niveles==1){
	                            ?>   
	                            <div class="row">
                               		<!-- Column -->
                                    
                                    <div class="col-md-3 col-lg-3 col-xlg-3">
                                        
                                    </div>
                                    
                                    <!-- Column -->
                                   <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Tipo de orden</h3>
                                                <h6 class="text-white"><?= $nombreTipo;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white"><?php if ($idValida==1){?>Ubicaci&oacute;n<?php }else{?>Tipo<?php }?>   </h3>
                                                <h6 class="text-white"><?= $nombreMiembros;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Primer subnivel</h3>
                                                <h6 class="text-white"><?= $nomPrimerSubNiv;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-md-3 col-lg-3 col-xlg-3">
                                        
                                    </div>
                                    <!-- Column -->
                                   
                                </div>
	                            <?php }?> 
	                           
	                           <div class="form-group " >
                               		<label class="col-md-12" for="codigo">C&oacute;digo *</label>
                                    <div class="col-md-12">
                                    	<input type="text" class="form-control" id="codigo" name="codigo" 
                                    	               <?php if ($tipoOrden!=INTERCONSULTAS) {
                                    	                   ?>data-mask="9999999" <?php }else{?>data-mask="9999999"<?php }?> 
                                    	               value="<?= $codigo ?>" <?php if ($tipoOrden!=INTERCONSULTAS) {
                                    	                   ?> placeholder="Ej. 9999999" <?php }else{?> placeholder="Ej. 9999999"<?php }?> >
	                                    
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
	                           
	                           <div class="form-group " >
                               		<label class="col-md-12" for="nombre">Nombre *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="nombre" name="nombre" 
	                                    	value="<?= $nombre ?>"
	                                        placeholder="Ej. Pr&oacute;tesis de Miembro inferior tipo Est&aacute;ndar" >
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
	                           <div class="form-group " >
                               		<label class="col-md-12" for="descripcion">Descripci&oacute;n *</label>
                                    <div class="col-md-12">
                                    	<textarea rows="4" cols="10" class="form-control" id="descripcion" name="descripcion" placeholder="Ej. El elemento consiste en ..."><?= $descripcion ?></textarea>
                                    	<div class="form-control-feedback" > </div>
                                    </div>
                               </div>
	                           
                               
                               <div class="form-group " >
                               		<label class="col-md-12" for="tiempo">Tiempo <small> Relaci&oacute;n de tiempo de complejidad en la elaboraci&oacute;n del producto o prestaci&oacute;n  del servicio</small> *</label>
                                    <div class="col-md-12">
                                    	<select class="form-control" id="tiempo" name="tiempo" >
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaTiempo->result() as $value) { 
                                                  	if($value->ID==$tiempo){
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
                               <?php 
                               if ($tipoOrden==INTERCONSULTAS){
                               ?>
                               <div class="form-group " >
                               		<label class="col-md-12" for="paquete">Paquete de interconsultas <small> Relaci&oacute;n si el servicio est&aacute; incluida dentro del paquete de interconsultas</small> *</label>
                                    <div class="col-md-12">
                                    	<select class="form-control" id="paquete" name="paquete" >
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaSiNo as $value) { 
                                                  	if($value->ID==$paquete){
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
                               <div class="form-group paquete" <?= $displayPaquete;?> >
                               		<label class="col-md-12" for="cantidad">Cantidad *</label>
                                    <div class="col-md-12">
	                                    <input type="number" class="form-control" id="cantidad" name="cantidad" 
	                                    	value="<?= $cantidad ?>"
	                                        placeholder="Ej. 1" <?= $disabledPaquete;?>>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <?php 
                               }?>
                               
	                        </div> <!-- End Card -->   
	                    </div> <!-- End Col -->
	                </div> <!-- End Row -->
	                <!-- Bot�n de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                		<a href="<?= base_url()?><?= $mainPage ?>" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
                                                <i class="fa fa-arrow-left"></i>
                                                <span class="hidden-xs"> Retornar</span>
                                            </a>
                            <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
	                		<input type="hidden" name="valida" id="valida" value="<?= $valida;?>">
	                		<input type="hidden" name="codigoTempo" id="codigoTempo" value="<?= $codigo;?>">
	                		<input type="hidden" name="idArbol" id="idArbol" value="<?= $idArbol;?>">
	                		<input type="hidden" name="id" id="id" value="<?= $id;?>">
	                		<input type="hidden" name="tipoOrden" id="tipoOrden" value="<?= $tipoOrden;?>">
	                		
	                	</div>   
	                	<div class="col-sm-12">
	                	<br>
	                	</div> 
	                </div>
	                
                   </div>
                   <!-- /.modal -->
	               
	               <!-- FIN Bot�n de envio de formulario -->
	            </form>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                
            
