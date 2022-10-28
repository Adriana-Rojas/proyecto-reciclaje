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
                action="<?= base_url()?>ShelterAppShelter/saveCheckOut" 
                id="form_sample_3" 
                method="post"       
				                autocomplete="off">
				
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title"> <i class="fa fa-sign-out fa-2x"></i>Egreso del hogar de paso</h5>
									<div class="row">
										<div class="col-md-4 col-xs-6 b-r">
											<strong>Documento de identidad</strong> <br>
											<p class="text-muted"><?= $tipoDoc," ",$documento;?></p>
										</div>
				
										<div class="col-md-4 col-xs-6 b-r">
											<strong>Nombre Completo</strong> <br>
											<p class="text-muted">
				                                        <?= $nombre;?></p>
										</div>
				
										<div class="col-md-4 col-xs-6">
											<strong>Habitaci&oacute;n</strong> <br>
											<p class="text-muted">
				                                        	<?= $habitacion;?> - <?= $cama;?>
				                                         </p>
										</div>
									</div>
									<hr>
									
									<div class="form-group">
										<label class="col-md-12" for="dingreso">Fecha de ingreso * </label>
										<div class="col-md-12">
											<input type="text" class="form-control" name="dingreso"
												id="dingreso" placeholder="dd/mm/aaaa" value="<?= defineFormatoFechaInverso($fecha,FORMAT_DATE);?>" readonly="readonly">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-12" for="degreso">Fecha de egreso * </label>
										<div class="col-md-12">
											<input type="text" class="form-control" name="degreso"
												id="degreso" placeholder="<?= DATE_FORMAT_EVOLUTION;?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-12" for="hegreso">Hora de egreso * </label>
										<div class="col-md-12">
											<input type="text" class="form-control clockpicker"
												name="hegreso" id="hegreso">
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
			    <link href="<?= base_url()?>assets/node_modules/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
			    <script src="<?= base_url()?>assets/node_modules/clockpicker/dist/jquery-clockpicker.min.js"></script>
        		<script>
        		 
        		 // Date Picker
        		   jQuery('#degreso').datepicker({
        			   	startDate: '<?= defineFormatoFechaInverso($fecha,FORMAT_DATE);?>',
        			   	endDate: '<?= $fechaFin;?>',
        		        autoclose: true,
        		        todayHighlight: true,
        		        format: '<?= DATE_FORMAT_EVOLUTION;?>',
        		        
        		        language: 'es'
        		    });
        		   $('.clockpicker').clockpicker({
        		        donetext: 'Aplicar',
        		        autoclose: true,
        		        'default': 'now'
        		    }).find('input').change(function() {
        		        console.log(this.value);
        		    });
				    </script>
				     
		      
				<!-- ============================================================== -->
				<!-- END PAGE JQUERY ROUTINES -->
        		<!-- ============================================================== -->
        
