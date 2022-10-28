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
                action="<?= base_url()?>StokePriceConfigurationRatesForCompany/saveRegister" id="form_sample_3" method="post" autocomplete="off">
	                <div class="row">
	                    <div class="col-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h4 class="card-title">Definici&oacute;n de Empresas Vs Tarifas </h4>
	                                <h6 class="card-subtitle">Asocie una tarifa para una empresa, con el prop&oacute;sito de posteriormente hacer cotizaciones</h6>
	                                
	                            </div>
	                            <div class="form-group">
                               		<label class="col-md-12" for="empresa">Empresa *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="empresa" name="empresa" <?= $disabled;?>>
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php 
                                            if($listaGrupos!= null){
                                            	foreach ($listaGrupos as $value) { 
                                            	    if($value->ID_APB==$empresa){
                                            	        $selected="selected='selected'";
                                            	    }else{
                                            	        $selected="";
                                            	    }
                                            		    	
                                            ?>
                                             <option value="<?= $value->ID_APB;?>" <?=$selected ?> ><?= $value->NOM_APB;?></option> 
                                            <?php
                                            		}
                                            	}?>
                                        </select>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group">
                               		<label class="col-md-12" for="tarifa">Tarifa *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="tarifa" name="tarifa">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                        	<?php 
                                            if($listaTarifa!= null){
                                                foreach ($listaTarifa->result() as $value) { 
                                                    if($value->ID==$tarifa){
                                                        $selected="selected='selected'";
                                                    }else{
                                                        $selected="";
                                                    }
                                            ?>
                                             <option value="<?= $value->ID;?>" <?=$selected ?> ><?= $value->NOMBRE;?></option> 
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
	                <!-- Botón de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                		<a href="<?= base_url()?>StokePriceConfigurationRatesForCompany/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
                                                <i class="fa fa-arrow-left"></i>
                                                <span class="hidden-xs"> Retornar</span>
                                            </a>
                            <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
	                		<input type="hidden" name="id" id="id" value="<?= $id;?>">
                            <input type="hidden" name="valida" id="valida" value="<?= $valida;?>">
                            <input type="hidden" name="empresaID" id="empresaID" value="<?= $empresa;?>">
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
                
            
