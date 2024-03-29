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
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <form class=" form-horizontal" role="form" 
                action="<?= base_url()?>ShelterAppShelter/saveTraslateRoom" 
                id="form_sample_3" 
                method="post"       
				                autocomplete="off">
				
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title"> <i class="fa fa-suitcase fa-2x"></i> Trasladar estancia del hu&eacute;sped</h5>
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
										<label class="col-md-12" for="ingreso">Fecha  de Ingreso * </label>
										<div class="col-md-12">
											<input type="text" class="form-control" name="ingreso"
												id="ingreso" placeholder="dd/mm/aaaa" value="<?= defineFormatoFechaInverso($fecha,FORMAT_DATE);?>" readonly="readonly">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-12" for="egreso">Fecha actual de Egreso * </label>
										<div class="col-md-12">
											<input type="text" class="form-control" name="egreso"
												id="egreso" placeholder="dd/mm/aaaa" value="<?= defineFormatoFechaInverso($fechaFin,FORMAT_DATE);?>" readonly="readonly">
										</div>
									</div>
									<div class="form-group">
	                                        <label class="col-md-12" for="relacion">Habitaci&oacute;n - Cama * </label>
	                                        <div class="col-md-12">
	                                            <select class="form-control" id="relacion" name="relacion">
													<option value="">--- Seleccione una opci&oacute;n ---</option>
													<?php 
													
													
															$diferencia= intervaloTiempo(
																		defineFormatoFecha($fecha, FORMAT_DATE) ,
																		defineFormatoFecha($fechaFin, FORMAT_DATE),86400)+1;
															//echo $diferencia;
															if($listaHabitacion!=null){
                                                            	foreach ($listaHabitacion as $value) {
                                                            		if ($value->CANTIDAD >=$diferencia){
                                                            			
                                                            		
                                                            	              
                                                            ?>
                                                            <option value="<?= $value->ID;?>" ><?= $value->HABITACION." - ".$value->CAMA;?></option>
                                                            <?php 
                                                            		}
                                                            	}
                                                            }?>
                                                </select>
	                                        </div>
	                             		</div>
								</div>
							</div>
						</div>
					</div>
				
				
					<!-- Bot�n de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                	<a href="<?= base_url()?>ShelterAppShelter/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
                                                <i class="fa fa-arrow-left"></i>
                                                <span class="hidden-xs"> Retornar</span>
                                            </a>
	                		<button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
	                		<input type="hidden" name="id" id="id" value="<?= $id;?>">
	                		<input type="hidden" name="idHabCama" id="idHabCama" value="<?= $idHabCama;?>">
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
        		
		      
				<!-- ============================================================== -->
				<!-- END PAGE JQUERY ROUTINES -->
        		<!-- ============================================================== -->
        
