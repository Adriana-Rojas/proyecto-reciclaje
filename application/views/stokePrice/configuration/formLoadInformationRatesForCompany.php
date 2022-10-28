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
                action="<?= base_url()?>StokePriceConfigurationRatesForCompany/saveLoad" id="form_sample_3" method="post" autocomplete="off" enctype="multipart/form-data">
	                <div class="row">
	                    <div class="col-sm-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h5 class="card-title"> Cargue de m&aacute;rgenes relacionadas a las Empresas
                                	<small class="font-gray">Cargue el archivo con la informaci&oacute;n requerida. A continuaci&oacute;n, se lista la estructura que debe cargar.</small></h5>
                                	
                                	<div class="table-responsive">
                                    <table id="myTable" class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Campo</th>
                                                <th > Descripci&oacute;n</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	
                                            <tr>
                                                <td>Empresa</td>
                                                <td>C&oacute;digo de la empresa que se desea asociar para posteriormente poder cotizar.</td>
                                            </tr>
                                            <tr>
                                                <td>Margen</td>
                                                <td>Margen definida dentro del sistema de informaci&oacute;n EVOLUTION.</td>
                                            </tr>
                                            
                                            
                                        </tbody>
                                    </table>
                                </div>
    	                         	
    	                         	
    	                         	
    	                         	<div class="form-group " >
                                    	<label class="col-md-12" for="adjunto">Archivo que cargar <small class="font-gray">Tenga en cuenta que los campos antes descritos deben ser definidos a manera de columna dentro del archivo que se cargar&aacute; dentro de la aplicaci&oacute;n.</small> *</label>
                                        <div class="col-md-12">
            	                        	<input type="file" class="form-control" id="adjunto" name="adjunto">
            	                            <div class="form-control-feedback" > </div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                					
                					
	                        	</div>
	                    	</div>
	                	</div>
	                </div>
	                
	                <!-- Botón de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                	<a href="<?= base_url()?>StokePriceConfigurationDescription/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
                                                <i class="fa fa-arrow-left"></i>
                                                <span class="hidden-xs"> Retornar</span>
                                            </a>
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
                
            <!-- ============================================================== -->
        		<!-- BEGIN PAGE JQUERY ROUTINES -->
        		<!-- ============================================================== -->
        		
        		
				<!-- ============================================================== -->
				<!-- END PAGE JQUERY ROUTINES -->
        		<!-- ============================================================== -->
        
