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
                action="<?= base_url()?>SponsorshipsAppFundManagement/saveReclassifyFunds" 
                id="form_sample_3" 
                method="post"       
                autocomplete="off">
	                <div class="row">
	                    <div class="col-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h4 class="card-title">Actualizaci&oacute;n de los valores de los fondos </h4>
	                                <h6 class="card-subtitle">Adicione o retire dinero de un fondo, de acuerdo a la necesidad expresa</h6>
	                                
	                            </div>
	                            <div class="form-group " >
                               		<label class="col-md-12" for="nombre">Fondo a afectar *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="nombre" name="nombre"  value="<?= $nombre;?>" disabled="disabled">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               
	                           
	                            <div class="form-group">
                               		<label class="col-md-12" for="destino">Fondo destino *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="destino" name="destino">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php 
                                            if(count($listaLista)>0){
                                            	foreach ($listaLista as $value) { 
                                            		
                                            ?>
                                             <option value="<?= $value->ID;?>" ><?= $value->NOMBRE;?></option> 
                                            <?php
                                            	}
                                            }?>
                                        </select>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               
                              <div class="form-group " >
                               		<label class="col-md-12" for="valor">Valor *</label>
                                    <div class="col-md-12">
	                                    <input type="number" class="form-control" id="valor" name="valor"   min="1">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
	                           
	                        </div>
	                    </div>
	                </div>
	                <!-- Botón de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                		<a href="<?= base_url()?>SponsorshipsAppFundManagement/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
                                                <i class="fa fa-arrow-left"></i>
                                                <span class="hidden-xs"> Retornar</span>
                                            </a>
                            <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
	                		<input type="hidden" name="fondo" id="fondo" value="<?= $id;?>">
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
                
            
