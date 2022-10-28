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
				<!--alerts CSS -->
		    	<link href="<?= base_url()?>assets/node_modules/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
			    <!-- Sweet-Alert  -->
			    <script src="<?= base_url()?>assets/node_modules/sweetalert/sweetalert.min.js"></script>
			    <script src="<?= base_url()?>assets/node_modules/sweetalert/jquery.sweet-alert.custom.js"></script>
			    
				
			 	
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <form class=" form-horizontal" role="form" 
                action="<?= base_url()?>StokePriceConfigurationNeps/saveRegister" id="form_sample_3" method="post" autocomplete="off" enctype="multipart/form-data">
	                <div class="row">
	                    <div class="col-sm-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h5 class="card-title"> Datos generales
                                	<small class="font-gray">Identifique los datos relacionados al producto, elemento o servicio para Nueva EPS</small></h5>
    	                         	<div class="form-group " >
                                    	<label class="col-md-12" for="codigo">C&oacute;digo *</label>
                                        <div class="col-md-12">
            	                        	<input type="number" class="form-control" id="codigo" name="codigo" value="<?= $codigo;?>" placeholder="123456" <?= $readOnly; ?> >
            	                            <div class="form-control-feedback" > </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group " >
                                    	<label class="col-md-12" for="nombre">Nombre *</label>
                                        <div class="col-md-12">
            	                        	<input type="text" class="form-control" id="nombre" name="nombre" value="<?= $nombre;?>" placeholder="Pr&oacute;tesis Miembro Inferior"  >
            	                            <div class="form-control-feedback" > </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group "  >
                                    	<label class="col-md-12" for="monto">Tarifa m&aacute;xima de venta <small>Dado en pesos (COP)</small> *</label>
                                        <div class="col-md-12">
            	                        	<input type="number" class="form-control " id="monto" name="monto" value="<?= $monto;?>" placeholder="70000" >
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
	                	<a href="<?= base_url()?>StokePriceConfigurationNeps/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
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
                
            <!-- ============================================================== -->
        		<!-- BEGIN PAGE JQUERY ROUTINES -->
        		<!-- ============================================================== -->
        		
        		
				<!-- ============================================================== -->
				<!-- END PAGE JQUERY ROUTINES -->
        		<!-- ============================================================== -->
        
