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
                action="<?= base_url()?>StokePriceConfigurationRates/saveRegister" id="form_sample_3" method="post" autocomplete="off">
	                <div class="row">
	                    <div class="col-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h4 class="card-title">Definici&oacute;n de M&aacute;rgenes de ganancia </h4>
	                                <h6 class="card-subtitle"></h6>
	                                
	                            </div>
	                            <div class="form-group">
                               		<label class="col-md-12" for="nombre">Nombre *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="nombre" name="nombre" 
	                                    	value="<?= $nombre ?>"
	                                        placeholder="Ej. Cirec institucional">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               
	                            <div class="form-group">
                               		<label class="col-md-12" for="elementos">Margen por elementos *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="elementos" name="elementos" >
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php 
                                            for($i=1;$i<100;$i++){
                                                if($i==$elementos){
                                                    $selected="selected='selected'";
                                                }else{
                                                    $selected="";
                                                }
                                            ?>
                                             <option value="<?= $i;?>" <?=$selected ?> ><?= $i;?> %</option> 
                                            <?php
                                            	}?>
                                        </select>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group">
                               		<label class="col-md-12" for="servicios">Margen por servicios *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="servicios" name="servicios" >
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php 
                                            for($i=1;$i<100;$i++){
                                                if($i==$servicios){
                                                    $selected="selected='selected'";
                                                }else{
                                                    $selected="";
                                                }
                                            ?>
                                             <option value="<?= $i;?>" <?=$selected ?> ><?= $i;?> %</option> 
                                            <?php
                                            	}?>
                                        </select>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group">
                               		<label class="col-md-12" for="productos">Margen por productos *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="productos" name="productos" >
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php 
                                            for($i=1;$i<100;$i++){
                                                if($i==$productos){
                                                    $selected="selected='selected'";
                                                }else{
                                                    $selected="";
                                                }
                                            ?>
                                             <option value="<?= $i;?>" <?=$selected ?> ><?= $i;?> %</option> 
                                            <?php
                                            	}?>
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
	                		<a href="<?= base_url()?>StokePriceConfigurationRates/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
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
                
            
