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
                action="<?= base_url()?>ShelterAppShelter/saveMaintenance" 
                id="form_sample_3" 
                method="post"       
                autocomplete="off">
	                
	                <div class="row">
	                    <div class="col-sm-12">
	                        <div class="card">
	                            <div class="card-body">
	                            <div class="row">
                               		<!-- Column -->
                                    
                                    <div class="col-md-3 col-lg-3 col-xlg-3">
                                        
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-3 col-lg-3 col-xlg-3">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?>  text-center">
                                                <h3 class="font-light text-white">Habitaci&oacute;n</h3>
                                                <h6 class="text-white"><?= $habitacion;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-3 col-lg-3 col-xlg-3">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Cama</h3>
                                                <h6 class="text-white"><?= $cama;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Column -->
                                    
                                    <div class="col-md-3 col-lg-3 col-xlg-3">
                                        
                                    </div>
                                    <!-- Column -->
                                   
                                </div>
	                                <h5 class="card-title"> Definici&oacute;n de la fecha de mantenimiento:   </h5>
                            			 <div class="form-group">
                                        	<label class="col-md-12" for="periodo">Periodo * </label>
                                            <div class="col-md-12">
                                            	<input class="form-control input-limit-datepicker" type="text" name="periodo" id="periodo" />
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
				    
				    $('.input-limit-datepicker').daterangepicker({
				        minDate: '<?= cambiaHoraServer(2);?>',
				        buttonClasses: ['btn', 'btn-sm'],
				        locale: {
				            "format": "<?= strtoupper( DATE_FORMAT_EVOLUTION);?>",
				            "separator": " - ",
				            "applyLabel": "Aplicar",
				            "cancelLabel": "Cancelar",
				            "fromLabel": "Desde",
				            "toLabel": "Hasta",
				            "customRangeLabel": "Custom",
				            "daysOfWeek": [
				                "Do",
				                "Lu",
				                "Ma",
				                "Mi",
				                "Ju",
				                "Vi",
				                "Sa"
				            ],
				            "monthNames": [
				                "Enero",
				                "Febrero",
				                "Marzo",
				                "Abril",
				                "Mayo",
				                "Junio",
				                "Julio",
				                "Agosto",
				                "Septiembre",
				                "Octubre",
				                "Noviembre",
				                "Diciembre"
				            ],
				            "firstDay": 1
				        },
				        applyClass: 'btn-info btn-rounded',
				        cancelClass: 'btn-inverse btn-rounded'
				    });
				    $('#periodo').val('');
				    </script>
				     
		      
				<!-- ============================================================== -->
				<!-- END PAGE JQUERY ROUTINES -->
        		<!-- ============================================================== -->
        
