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
                <script type="text/javascript">

                $(document).ready(function() {
					$("#proceso").change(function() {
						$("#proceso option:selected").each(function() {
							proceso = $('#proceso').val();
							tipo = $('#tipo').val();
	 						$.post("<?= base_url()?>Integration/reloadTordProInformation", {
    	 						proceso : proceso,
    	 						tipo : tipo
    	 					}, function(data) {
        	 						$("#estado").html(data);
    	 					});
						});
					})
				});
				
                $(document).ready(function() {
					$("#tipo").change(function() {
						$("#tipo option:selected").each(function() {
							proceso = $('#proceso').val();
							tipo = $('#tipo').val();
	 						$.post("<?= base_url()?>Integration/reloadTordProInformation", {
    	 						proceso : proceso,
    	 						tipo : tipo
    	 					}, function(data) {
        	 						$("#estado").html(data);
    	 					});
						});
					})
				});
			 	</script>
			 	
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <form class=" form-horizontal" role="form" 
                action="<?= base_url()?><?= $pagina;?>" 
                id="form_sample_3" 
                method="post"       
                autocomplete="off">
	                <div class="row">
	                    <div class="col-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h4 class="card-title"><i class='fa fa-search fa-2x'></i> Filtrar b&uacute;squeda</h4>
	                                <h6 class="card-subtitle">Realice el filtro de proceso, tipo de orden y estado que desea validar</h6>
	                                
	                            </div>
	                            <div class="form-group " >
                               		<label class="col-md-12" for="proceso">Proceso*</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="proceso" name="proceso">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php 
                                            	foreach ($listaProceso->result() as $value) { 
                                            		
                                            ?>
                                             <option value="<?= $value->ID;?>" ><?= $value->NOMBRE;?></option> 
                                            <?php
                                            	}?>
                                        </select>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group " >
                               		<label class="col-md-12" for="tipo">Tipo de orden *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="tipo" name="tipo">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php 
                                            	foreach ($listaTipo->result() as $value) { 
                                            		
                                            ?>
                                             <option value="<?= $value->ID;?>" ><?= $value->NOMBRE;?></option> 
                                            <?php
                                            	}?>
                                        </select>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group " >
                               		<label class="col-md-12" for="estado">Estado*</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="estado" name="estado">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                           
                                        </select>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               
                               
	                        </div> <!-- End Card -->   
	                    </div> <!-- End Col -->
	                </div> <!-- End Row -->
	                <!-- Botón de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                		
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
                
            
