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
                
                
                
                <!-- ============================================================== -->
                <!-- FIn JavaScript para pintar campos adicionales -->
                <!-- ============================================================== -->
        	
        
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <form class=" form-horizontal" role="form" 
                action="<?= base_url()?>SponsorshipsReportStatistics/report" 
                id="form_sample_3" 
                method="post"       
                autocomplete="off">
	                <div class="row">
	                    <div class="col-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h4 class="card-title">Selecci&oacute;n de par&aacute;metros </h4>
	                                <h6 class="card-subtitle">Seleccione el periodo para el cual desea ejecutar el reporte</h6>
	                            </div>
	                            <div class="form-group">
                               		<label class="col-md-12" for="mes">Mes  *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="mes" name="mes">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                        	<?= escribeMes(); ?>
                                        </select>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group">
                               		<label class="col-md-12" for="ano">A&ntilde;o  *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="ano" name="ano">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                        	<?= escribeAno(); ?>
                                        </select>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div> 
	                            <div class="form-group">
                               		<label class="col-md-12" for="tipo">Tipo de reporte  *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="tipo" name="tipo">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                        	<option value="1"> Para impresi&oacute;n</option>
                                        	<option value="2"> Permitir exportaci&oacute;n</option>
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
                
            
