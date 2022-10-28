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
							$('#comodin').change( function(){
								if($("#comodin").val()==<?= CTE_VALOR_SI ?> ){
									$(".comodin").hide();
							        $("#id").prop('disabled', true);
							        $("#proveedor").prop('disabled', true);
							        $("#venta").prop('disabled', true);
							        $("#nombre").prop('disabled', true);
								}else{
									$(".comodin").show();
									$("#id").prop('disabled', false);
									$("#nombre").prop('disabled', false);
							        $("#proveedor").prop('disabled', false);
							        $("#venta").prop('disabled', false);
								}
						    });
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
	                                <h4 class="card-title"><i class='fa fa-search fa-2x'></i> Buscar paciente</h4>
	                                <h6 class="card-subtitle">Realice la b&uacute;squeda del paciente a trav&eacute;s del n&uacute;mero de historia cl&iacute;nica, nombres o documento de identificaci&oacute;n</h6>
	                                
	                            </div>
	                            <div class="form-group " >
                               		<label class="col-md-12" for="historia">Historia cl&iacute;nica *</label>
                                    <div class="col-md-12">
	                                    <input type="number" class="form-control" id="historia" name="historia" placeholder="Ej. 1234" >
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group " >
                               		<label class="col-md-12" for="documento">Documento de identificaci&oacute;n *</label>
                                    <div class="col-md-12">
	                                    <input type="number" class="form-control" id="documento" name="documento" placeholder="Ej. 1234" >
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group " >
                               		<label class="col-md-12" for="nombre">Nombre del paciente *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej. Jaime" >
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group " >
                               		<label class="col-md-12" for="apellido">Apellido del paciente *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ej. Montero" >
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
                
            
