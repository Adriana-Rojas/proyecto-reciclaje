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
                <form class=" form-horizontal" role="form" action="<?= base_url()?><?= $pagina ?>" 
                id="form_sample_3" 
                method="post"       
                autocomplete="off">
	                <div class="row">
	                    <div class="col-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h4 class="card-title">Definici&oacute;n de observaciones por estado </h4>
	                                
	                            </div>
	                            <div class="form-group">
                               		<label class="col-md-12" for="estado">Estado *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="estado" name="estado">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaEstado->result() as $value) { 
                                                  	if($value->ID==$estado){
                                                    	$selected="selected='selected'";
                                                    }else{
                                                    	$selected="";
                                                    }
                                            ?>
                                            <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option> 
                                            <?php
                                            }?>
                                        </select>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
	                            <div class="form-group">
                               		<label class="col-md-12" for="nombre">Observaci&oacute;n *</label>
                                    <div class="col-md-12">
                                    	<textarea rows="3" cols="10" class="form-control" id="nombre" name="nombre" 
                                    			 placeholder="Ej. Proceso ejecutado correctamente"><?= $nombre ?></textarea>
	                                    
                                    </div>
                               </div>
                               
                               <div class="form-group">
                               		<label class="col-md-12" for="cierra">Cierra estado *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="cierra" name="cierra">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaSiNo as $value) { 
                                                  	if($value->ID==$cierra){
                                                    	$selected="selected='selected'";
                                                    }else{
                                                    	$selected="";
                                                    }
                                            ?>
                                            <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option> 
                                            <?php
                                            }?>
                                        </select>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               
                               <div class="form-group">
                               		<label class="col-md-12" for="tipo">Sentido del proceso *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="tipo" name="tipo">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaProceso as $value) { 
                                                  	if($value->ID==$tipo){
                                                    	$selected="selected='selected'";
                                                    }else{
                                                    	$selected="";
                                                    }
                                            ?>
                                            <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option> 
                                            <?php
                                            }?>
                                        </select>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               
                               <div class="form-group">
                               		<label class="col-md-12" for="motivo">Motivo de la observaci&oacute;n *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="motivo" name="motivo">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaMotivo as $value) { 
                                                  	if($value->ID==$motivo){
                                                    	$selected="selected='selected'";
                                                    }else{
                                                    	$selected="";
                                                    }
                                            ?>
                                            <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option> 
                                            <?php
                                            }?>
                                        </select>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               
	                           <div class="form-group">
                               		<label class="col-md-12" for="despiece">Modifica despiece *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="despiece" name="despiece">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaSiNo as $value) { 
                                                  	if($value->ID==$despiece){
                                                    	$selected="selected='selected'";
                                                    }else{
                                                    	$selected="";
                                                    }
                                            ?>
                                            <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option> 
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
	                		<a href="<?= base_url()?>OrdersConfigurationStateObservation/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
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
                
            
