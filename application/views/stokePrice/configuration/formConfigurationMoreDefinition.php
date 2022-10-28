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
                <link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/html5-editor/bootstrap-wysihtml5.css" />
                <!-- wysuhtml5 Plugin JavaScript -->
                    <script src="<?= base_url()?>/assets/node_modules/html5-editor/wysihtml5-0.3.0.js"></script>
                    <script src="<?= base_url()?>/assets/node_modules/html5-editor/bootstrap-wysihtml5.js"></script>
                    <script>
                    $(document).ready(function() {
                		$('.textarea_editor').wysihtml5();
                	});
                    </script>
                
                <!-- ============================================================== -->
                <!-- FIn JavaScript para pintar campos adicionales -->
                <!-- ============================================================== -->
        	
        
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <form class=" form-horizontal" role="form" 
                action="<?= base_url()?>StokePriceConfigurationMoreDefinition/saveRegister" id="form_sample_3" method="post" autocomplete="off">
	                <div class="row">
	                    <div class="col-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h4 class="card-title">Definici&oacute;n de observaciones </h4>
	                                <h6 class="card-subtitle">Detalle las observaciones personalizadas que pueden ser usadas como complemento dentro de una cotizaci&oacute;n</h6>
	                                
	                            </div>
	                            <div class="form-group">
                               		<label class="col-md-12" for="nombre">Nombre *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="nombre" name="nombre" 
	                                    	value="<?= $nombre ?>"
	                                        placeholder="<?= $placeHolder;?>">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group">
                               		<label class="col-md-12" for="descripcion">Descripci&oacute;n *</label>
                                    <div class="col-md-12">
	                                    <textarea class="textarea_editor form-control" rows="5" id="descripcion" name="descripcion"  placeholder="Detalle de la cotizaci&oacute;n"><?= $descripcion;?></textarea>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               
                              	</div>
                            </div>
	                    </div>
	                </div>
	                <!-- Botón de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                		<a href="<?= base_url()?>StokePriceConfigurationMoreDefinition/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
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
                
            
