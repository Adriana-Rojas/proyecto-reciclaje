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
                
                <script type="text/javascript">
		                $(document).ready(function() {
							$("#miembros").change(function() {
								$("#miembros option:selected").each(function() {
									miembros = $('#miembros').val();
									tipo = $('#tipo').val();
			 					$.post("<?= base_url()?>/Integration/reloadBodyPartsSection", {
			 						miembros : miembros,
			 						tipo : tipo
			 					}, function(data) {
				 						$("#nivel").html(data);
			 							});
								});
							});

							$("#tipo").change(function() {
								$("#tipo option:selected").each(function() {
									miembros = $('#miembros').val();
									tipo = $('#tipo').val();
			 					$.post("<?= base_url()?>/Integration/reloadBodyPartsSection", {
			 						miembros : miembros,
			 						tipo : tipo
			 					}, function(data) {
				 						$("#nivel").html(data);
			 							});
								});
							})
							
						});
			            </script>
                
                <!-- ============================================================== -->
                <!-- FIn JavaScript para pintar campos adicionales -->
                <!-- ============================================================== -->
        	
        
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <form class=" form-horizontal" role="form" 
                action="<?= base_url()?>OrdersConfigurationTreeDefinition/saveRegister" 
                id="form_sample_3" 
                method="post"       
                autocomplete="off">
	                <div class="row">
	                    <div class="col-12">
	                        <div class="card">
	                           <div class="card-body">
	                                <h4 class="card-title">Definici&oacute;n de n&iacute;veles para &aacute;rbol de &oacute;rdenes </h4>
	                                <h6 class="card-subtitle">Gestione los diferentes n&iacute;veles que podr&aacute; usar dentro de los &aacute;rbol de &oacute;rdenes </h6>
	                                
	                            </div>
	                           <div class="form-group">
                               		<label class="col-md-12" for="tipo">Tipo de orden *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="tipo" name="tipo">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php 
                                            	foreach ($listaTipo->result() as $value) { 
                                            		if($value->ID==$valorTipo){
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
                               		<label class="col-md-12" for="miembros">Ubicaci&oacute;n del cuerpo *</label>
                                    <div class="col-md-12">
                                    	<select class="form-control" id="miembros" name="miembros">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php 
                                            	foreach ($listaMiembros->result() as $value) { 
                                            		if($value->ID==$valorMiembros){
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
                               		<label class="col-md-12" for="nivel[]">Nivel del cuerpo *</label>
                                    <div class="col-md-12">
                                    	<script src="<?= base_url()?>assets/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    									<script>
    										jQuery(document).ready(function() {
    											$(".select2").select2();
    										});
    								    </script>
    								    
	                                    <select class="form-control select2 select2-multiple" id="nivel" name="nivel[]" multiple="multiple" style="width: 100%">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php 
                                            	if ($listaNivel!=null){
	                                            	foreach ($listaNivel->result() as $value) { 
	                                            		if($value->ID==$valorNivel){
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
                            </div>
	                    </div>
	                </div>
	                <!-- Botón de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                		<a href="<?= base_url()?>OrdersConfigurationTreeDefinition/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
                                                <i class="fa fa-arrow-left"></i>
                                                <span class="hidden-xs"> Retornar</span>
                                            </a>
                            <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
	                		<input type="hidden" name="id" id="id" value="<?= $id;?>">
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
                
            
