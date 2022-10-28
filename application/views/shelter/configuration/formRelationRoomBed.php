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
        		<!-- BEGIN PAGE JQUERY ROUTINES -->
        		<!-- ============================================================== -->
        		
        		
		        
				<!-- ============================================================== -->
				<!-- END PAGE JQUERY ROUTINES -->
        		<!-- ============================================================== -->
        		
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <form class=" form-horizontal" role="form" 
                action="<?= base_url().$pagina?>" 
                id="form_sample_3" 
                method="post"       
                autocomplete="off">
	                <div class="row">
	                    <div class="col-sm-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h5 class="card-title"> Datos generales
                            <small class="font-gray">Identifique la relaci&oacute;n </small></h5>
	                                	
	                                    <div class="form-group " >
                                        	<label class="col-md-12" for="habitacion">Habitaci&oacute;n* </label>
                                            <div class="col-md-12">
                                            	<select class="form-control" id="habitacion" name="habitacion">
                                                            <option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            <?php 
                                                            if($listaHabitacion!=null){
                                                            	
                                                            	foreach ($listaHabitacion->result()  as $value) {
                                                                            if($value->ID==$habitacion){
                                                                                $selected="selected='selected'";
                                                                            }else{
                                                                                $selected="";
                                                                            }    
                                                            ?>
                                                            <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option>
                                                            <?php 
                                                            	}
                                                            }?>
                                                        </select>
                                                <div class="form-control-feedback" > </div>
                                            </div>
                                         </div>
                                         
                                         <div class="form-group " >
                                        	<label class="col-md-12" for="cama">Cama* </label>
                                            <div class="col-md-12">
                                            	<select class="form-control" id="cama" name="cama">
                                                            <option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            <?php 
                                                            if($listaCama!=null ){
                                                            	foreach ($listaCama->result() as $value) {
                                                                            if($value->ID==$cama){
                                                                                $selected="selected='selected'";
                                                                            }else{
                                                                                $selected="";
                                                                            }    
                                                            ?>
                                                            <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option>
                                                            <?php 
                                                            	}
                                                            }?>
                                                        </select>
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
	                	<a href="<?= base_url()?>BrigadesAppBrigade/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
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
                
            	
        
