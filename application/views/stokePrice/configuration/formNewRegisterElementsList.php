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
							$('#codigo').change( function(){
								codigo = $('#codigo').val();
			 					$.post("<?= base_url()?>Integration/reloadInformationForStokePriceCloseList", {
			 						codigo : codigo
			 						}, function(data) {
			 							var element = data.split('|');
			 							if (element[0]=='*'){
			 								$(document).ready(function() {
			 									swal({
	    				 	                          title: "C<?= LETRA_MIN_O?>digo no existe",
	    				 	                          text: "El c<?= LETRA_MIN_O?>digo que ingreso no existe como elemento, producto o servicio para cotizaciones, por favor vuelva a ingresar un dato e intente nuevamente. En caso de ser el que desea ingresar; aseg<?= LETRA_MIN_U?>rese de que este se encuentre creado dentro del maestro de Detalle para cotizaciones",
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

                                        
				 				});
				 				
			 				});	
						});
						console.log('codigo'.codigo);
                        

		                
			            
			 	</script>
			 	
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <form class=" form-horizontal" role="form" 
                action="<?= base_url()?>StokePriceConfigurationListCompanyElements/saveRegister" id="form_sample_3" method="post" autocomplete="off" enctype="multipart/form-data">
	                <div class="row">
	                    <div class="col-sm-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h5 class="card-title"> Datos generales
                                	<small class="font-gray">Identifique los datos relacionados al producto, elemento o servicio para <?= $empresa; ?></small></h5>
    	                         	<div class="form-group " >
                                    	<label class="col-md-12" for="codigo">C&oacute;digo *</label>
                                        <div class="col-md-12">
            	                        	<input type="number" class="form-control" id="codigo" name="codigo" value="<?= $codigo;?>" placeholder="123456" <?= $readOnly;?>>
            	                            <div class="form-control-feedback" > </div>
                                        </div>
                                    </div>
                                    <?php
                                    if ($codigoEmpresa==CTE_VALOR_SI){
                                    ?>
                                    <div class="form-group " >
                                    	<label class="col-md-12" for="auxiliar">C&oacute;digo propio *</label>
                                        <div class="col-md-12">
            	                        	<select class="form-control completo" id="auxiliar" name="auxiliar" >
                                                    <option value="">--- Seleccione una opci&oacute;n ---</option>
                                                    <?php 
                                                    if($listaCodigos!=NULL){
                                                        foreach ($listaCodigos->result() as $value) { 
                                                              if($proveedor==$value->CODIGO){
                                                                  $selected="selected='selected'";
                                                              }else{
                                                                  $selected=null;
                                                              }
                                                          ?>
                                                    <option value="<?= $value->CODIGO;?>" <?= $selected; ?> ><?= $value->CODIGO." - ".$value->NOMBRE;?></option> 
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
                                    if ($cerrada==CTE_VALOR_SI){
                                    ?>
                                    <div class="form-group "  >
                                    	<label class="col-md-12" for="precio">Tarifa de venta <small>Dado en pesos (COP)</small> *</label>
                                        <div class="col-md-12">
            	                        	<input type="number" class="form-control " id="precio" name="precio" value="<?= $precio;?>" placeholder="70000" >
            	                            <div class="form-control-feedback" > </div>
                                        </div>
                                    </div>
                                     <?php
                                    }
                                    ?>
                                    
                                    
                                    
                					
                					
	                        	</div>
	                    	</div>
	                	</div>
	                </div>
	                
	                <!-- Bot�n de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                	<a href="<?= base_url()?>StokePriceConfigurationListCompanyElements/board/<?= $idEmpresa;?>" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
                                                <i class="fa fa-arrow-left"></i>
                                                <span class="hidden-xs"> Retornar</span>
                                            </a>
	                		<button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
	                		<input type="hidden" name="tipo" id="tipo" value="<?= $tipo;?>">
	                		<input type="hidden" name="id" id="id" value="<?= $id;?>">
                            <input type="hidden" name="valida" id="valida" value="<?= $valida;?>">
                            <input type="hidden" name="idEmpresa" id="idEmpresa" value="<?= $idEmpresa;?>">
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
        
