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
                <form class=" form-horizontal" role="form" action="<?= base_url()?>PollReportStatistics/report"  id="form_sample_3" method="post"  autocomplete="off">
	                <div class="row">
	                    <div class="col-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h4 class="card-title">Selecci&oacute;n de par&aacute;metros </h4>
	                                <h6 class="card-subtitle"></h6>
	                            </div>
	                            <div class="form-group">
                               		<label class="col-md-12" for="encuesta">Encuesta  *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="encuesta" name="encuesta">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php 
                                            if ($encuestas!=null){
                                                foreach ($encuestas as $value) { 
                                            ?>
                                            <option value="<?= $value->ID;?>" ><?= $value->NOMBRE;?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               
	                            <div class="form-group">
                               		<label class="col-md-12" for="periodo">Periodo  *</label>
                                    <div class="col-md-12">
	                                    <input class="form-control input-limit-datepicker" type="text" name="periodo" id="periodo"  />
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
                            <input type="hidden" name="informe" id="informe" value="1">
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
				        maxDate: '<?=$fecha;?>',
				        buttonClasses: ['btn', 'btn-sm'],
				        locale: {
				        	"format": "YYYY/MM/DD",
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
