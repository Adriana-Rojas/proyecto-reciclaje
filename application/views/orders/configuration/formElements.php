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
                <!--alerts CSS -->
		    	<link href="<?= base_url()?>assets/node_modules/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
			    
                <!-- Sweet-Alert  -->
			    <script src="<?= base_url()?>assets/node_modules/sweetalert/sweetalert.min.js"></script>
			    <script src="<?= base_url()?>assets/node_modules/sweetalert/jquery.sweet-alert.custom.js"></script>
                
    			<script src="<?= base_url()?>assets/dist/js/pages/mask.js"></script>
                <script type="text/javascript">
		                $(document).ready(function() {
							$('#comodin').change( function(){
								if($("#comodin").val()==<?= CTE_VALOR_SI ?> ){
									$(".comodin").hide();
							        $("#id").prop('disabled', true);
							        $("#proveedor").prop('disabled', false);
							        $("#nombre").prop('disabled', false);
							        $("#aplica").prop('disabled', false);
							        $("#costo").prop('disabled', false);
							        $(".comodin").prop('disabled', true);

							        
								}else{
									$(".comodin").show();
									$("#id").prop('disabled', false);
									$("#nombre").prop('disabled', false);
							        $("#proveedor").prop('disabled', false);
							        $("#aplica").prop('disabled', false);
							        $("#costo").prop('disabled', false);
							        $(".comodin").prop('disabled', false);
							        //Activo campos seg�n corresponda
							    	grupo = $('#grupo').val();
				 					$.post("<?= base_url()?>/Integration/reloadCharacteristicsGroupElements", {
				 						grupo : grupo
				 					}, function(data) {
				 						var cuenta = data.split('!');
					 					
				 						if(cuenta[0]==0){
					 						//NO hay nada
					 						for (i=0;i<<?= $maxCaracteristicas?>;i++){
					 							j=i+1;
					 							campo='#caracteristica'+j;
					 							div='#div_'+j;
					 							$(div).hide();
				 								$(campo).prop('disabled', true);
					 						}
					 					}else{
						 					//Hay elementos
						 					var element = cuenta[1].split('|');
					 						 for (i=0;i<=cuenta[0];i++){
						 						 k=i;
					 							var valores = element[i].split('&');
					 							//alert(valores[0]);
						 						j=i+1;
						 						tempo='#label_'+j;
						 						campo='#caracteristica'+j;
					 							$(tempo).html(valores[0]);
					 							$(campo).html('');
					 							$(campo).html(valores[2]);
					 							div='#div_'+j;
					 							if (valores[0]!=''){
					 								$(div).show();
					 								$(campo).prop('disabled', false);
						 						}else{
						 							$(div).hide();
					 								$(campo).prop('disabled', true);
							 					}
					 						 }
											 //alert(k);
					 						 for (i=k;i<=<?= $maxCaracteristicas?>;i++){
					 							j=i+1;
						 						tempo='#label_'+j;
						 						campo='#caracteristica'+j;
					 							$(tempo).html(valores[0]);
					 							$(campo).html('');
					 							$(campo).html(valores[2]);
					 							div='#div_'+j;
					 							$(div).hide();
				 								$(campo).prop('disabled', true);
						 					 }
				 						 }
				 					 	});
								}
						    });
						});
						// Script para pintar la informaci�n de los campos
						$(document).ready(function() {
							$("#grupo").change(function() {
								$("#grupo option:selected").each(function() {
									grupo = $('#grupo').val();
			 					$.post("<?= base_url()?>/Integration/reloadCharacteristicsGroupElements", {
			 						grupo : grupo
			 					}, function(data) {
				 					var cuenta = data.split('!');
				 					
			 						if(cuenta[0]==0){
				 						//NO hay nada
				 						for (i=0;i<<?= $maxCaracteristicas?>;i++){
				 							j=i+1;
				 							campo='#caracteristica'+j;
				 							div='#div_'+j;
				 							$(div).hide();
			 								$(campo).prop('disabled', true);
				 						}
				 					}else{
					 					//Hay elementos
					 					var element = cuenta[1].split('|');
				 						 for (i=0;i<=cuenta[0];i++){
					 						 k=i;
				 							var valores = element[i].split('&');
				 							//alert(valores[0]);
					 						j=i+1;
					 						tempo='#label_'+j;
					 						campo='#caracteristica'+j;
				 							$(tempo).html(valores[0]);
				 							$(campo).html('');
				 							$(campo).html(valores[2]);
				 							div='#div_'+j;
				 							if (valores[0]!=''){
				 								$(div).show();
				 								$(campo).prop('disabled', false);
					 						}else{
					 							$(div).hide();
				 								$(campo).prop('disabled', true);
						 					}
				 						 }
										 //alert(k);
				 						 for (i=k;i<=<?= $maxCaracteristicas?>;i++){
				 							j=i+1;
					 						tempo='#label_'+j;
					 						campo='#caracteristica'+j;
				 							$(tempo).html(valores[0]);
				 							$(campo).html('');
				 							$(campo).html(valores[2]);
				 							div='#div_'+j;
				 							$(div).hide();
			 								$(campo).prop('disabled', true);
					 					 }
			 						 }
			 					 	});
								});
							});
						});
		        </script>
		        
		        <script type="text/javascript">
		                $(document).ready(function() {
							$('#id').change( function(){
								codigo = $('#id').val();
			 					$.post("<?= base_url()?>/Integration/reloadCodeElement", {
			 						codigo : codigo
			 						}, function(data) {
				 					 if (data>0 && data!=$('#codigoTempo').val()){
					 					$(document).ready(function() {
				 	                        swal({
				 	                          title: "C<?= LETRA_MIN_O?>digo ya existe",
				 	                          text: "El c<?= LETRA_MIN_O?>digo que ingreso ya existe dentro del maestro de elementos. Debe ingresar otro.",
				 	                          type: "error",
				 	                          confirmButtonText: "Continuar",
				 	                          closeOnConfirm: true
				 	                        }
				 	                        );
				 	                    });
				 						$('#id').val($('#codigoTempo').val());
				 						$('#id').focus();
					 				 }
				 				});

				 				// Valido ahora que exista en Esalud
			 					$.post("<?= base_url()?>/Integration/reloadCodeElementEsalud", {
			 						codigo : codigo
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
				 						$('#id').val($('#codigoTempo').val());
				 						$('#id').focus();
					 				 }else{
					 					$('#nombre').val(data);
						 			 }
				 				});
							});	
						});
			 	</script>
			 	
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <form class=" form-horizontal" role="form" 
                action="<?= base_url()?>OrdersConfigurationElements/saveRegister" 
                id="form_sample_3" 
                method="post"       
                autocomplete="off">
	                <div class="row">
	                    <div class="col-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h4 class="card-title">Configuraci&oacute;n de elementos</h4>
	                                <h6 class="card-subtitle"></h6>
	                                
	                            </div>
	                            <div class="form-group">
                               		<label class="col-md-12" for="grupo">Grupo *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="grupo" name="grupo">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaGrupo->result() as $value) { 
                                            		if($value->ID==$grupo){
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
                               		<label class="col-md-12" for="comodin">Comod&iacute;n *</label>
                                    <div class="col-md-12">
                                    	<?php 
                                    		if ($valorSINO==CTE_VALOR_SI){
                                    	?>
                                    		<input type="hidden" name="comodin" id="comodin" value="<?= $valorSINO;?>">
                                    		<select class="form-control" <?=$comodinValidation ?>>
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
                                    	<?php
                                    		}else{
                                    	?>
                                    		<select class="form-control" id="comodin" name="comodin" <?=$comodinValidation ?>>
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
                                    	<?php
                                    		}
                                    	
                                    	?>
                                    
	                                    
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               
                               <div class="form-group comodin" >
                               		<label class="col-md-12" for="id">C&oacute;digo *</label>
                                    <div class="col-md-12">
                                    	<?php 
                                    		if ($valorSINO==CTE_VALOR_SI){
                                    	?>
                                    		<input type="hidden" name="codigo" id="codigo" value="<?= $codigo;?>">
                                    		<input type="text" class="form-control" value="<?= $codigo ?>" placeholder="Ej. 9999999" <?=$codigoValidation; ?>>	
                                    	<?php
                                    		}else{
                                    	?>
                                    		<input type="text" class="form-control" id="id" name="id" data-mask="9999999"
	                                    	value="<?= $codigo ?>"
	                                        placeholder="Ej. 9999999" <?=$codigoValidation; ?>>
                                    	<?php
                                    		}
                                    	
                                    	?>
	                                    
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               
                                
	                            <div class="form-group">
                               		<label class="col-md-12" for="nombre">Nombre *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="nombre" name="nombre" 
	                                    	value="<?= $nombre ?>"
	                                        placeholder="Ej. Articulaci&oacute;n de cadera">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               
                               <div class="form-group">
                               		<label class="col-md-12" for="proveedor">Proveedor *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="proveedor" name="proveedor">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaProveedores->result() as $value) {
                                            		if($value->ID==$providers){
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
                               		<label class="col-md-12" for="aplica">Costo En d&oacute;lares *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="aplica" name="aplica">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php 
                                                foreach ($listaSiNo as $value) { 
	                                               if($value->ID==$valorDolares){
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
                               		<label class="col-md-12" for="costo">Costo *</label>
                                    <div class="col-md-12">
	                                    <input type="number" class="form-control" id="costo" name="costo" min="0" max="999999999"
	                                    	value="<?=$costoDolares?>"
	                                        placeholder="Ej. 950000">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               

                               
                               <?php 
                               for ($i=0;$i<$maxCaracteristicas;$i++){
                               		$j=$i+1;	
                               		if ($validador=='newRegister'){
                               			
                               			
                               ?>
                               <div class="form-group" id="<?= "div_".$j;?>" >
                               		<label class="col-md-12" for="caracteristica<?= $j;?>" id="<?= "label_".$j;?>">Caracter&iacute;stica  <?= $j;?> *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="caracteristica<?= $j;?>" name="caracteristica<?= $j;?>" >
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaSiNo as $value) { 
                                                  	if($value->ID==$venta){
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
                               		}else{
                               			if($caracteristicas!=null){
                               			//Traigo las caracteristicas
                               			if($i<count($caracteristicas)){
                               				$valoresCaracteristicas=$this->OrdersModel->getListValueGroupCharacteristics($caracteristicas[$i]->ID_PARGRUELEM);
                               			
                               				
                               	?>
                               		<div class="form-group" id="<?= "div_".$j;?>">
                               		<label class="col-md-12" for="caracteristica<?= $j;?>" id="<?= "label_".$j;?>">  <?= $caracteristicas[$i]->NOMBRE;?> *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="caracteristica<?= $j;?>" name="caracteristica<?= $j;?>" >
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php 
                                            
                                            foreach ($valoresCaracteristicas as $valor){
                                            	//Verifico el valor del campo
                                            	if ($this->FunctionsGeneral-> getQuantityFieldFromTable("ORD_ELEPARELEM","ID_ELEMENTO",$id, "ID_VALPARGRUELEM",$valor->ID)){
                                            		$selected="selected='selected'";
                                            	}else{
                                            		$selected="";
                                            	}
                                            ?>
                                            <option value="<?= $valor->ID;?>" <?= $selected;?>><?= $valor->VALOR;?></option> 
                                            <?php
                                            }
                                            ?>
                                        </select>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               	 <?php
                               			}else{
                               				
                               			?>
                               	<div class="form-group" id="<?= "div_".$j;?>" style="display: none;" >
	                               	<label class="col-md-12" for="caracteristica<?= $j;?>" id="<?= "label_".$j;?>">  *</label>
	                               	<div class="col-md-12">
	                               	<select class="form-control" id="caracteristica<?= $j;?>" name="caracteristica<?= $j;?>" disabled="disabled">
	                               		<option value="">--- Seleccione una opci&oacute;n ---</option>
	                               	</select>
	                                <div class="form-control-feedback" > </div>
	                               	</div>
                               </div>
                               <?php
                               			}

                               		}
                               	}
                               }
                               ?>
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
	                		<input type="hidden" name="maxCaracteristicas" id="maxCaracteristicas" value="<?= $maxCaracteristicas;?>">
	                		<input type="hidden" name="codigoTempo" id="codigoTempo" value="<?= $codigo;?>">
	                		
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
                
            
