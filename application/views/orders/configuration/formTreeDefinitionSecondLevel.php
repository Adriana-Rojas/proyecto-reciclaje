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
                action="<?= base_url()?>OrdersConfigurationTreeDefinition/<?= $enlace?>" 
                id="form_sample_3" 
                method="post"       
                autocomplete="off">
	                <div class="row">
	                    <div class="col-12">
	                        <div class="card">
	                           <div class="card-body">
	                                <h4 class="card-title">Definici&oacute;n de segundo nivel para &aacute;rbol de &oacute;rdenes </h4>
	                                <h6 class="card-subtitle">Se tendr&aacute; por configurar <?= $cantidadNiveles;?> sub niveles</h6>
	                                
	                            </div>
	                            <?php 
	                            if ($enlace=='secondLevel'){
	                            ?>
	                            <div class="row">
                               		<!-- Column -->
                                    
                                    <div class="col-md-3 col-lg-3 col-xlg-3">
                                        
                                    </div>
                                    
                                    <!-- Column -->
                                   <div class="col-md-3 col-lg-3 col-xlg-3">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Tipo de orden</h3>
                                                <h6 class="text-white"><?= $nombreTipo;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-3 col-lg-3 col-xlg-3">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Ubicaci&oacute;n del cuerpo</h3>
                                                <h6 class="text-white"><?= $nombreMiembros;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    
                                    <div class="col-md-3 col-lg-3 col-xlg-3">
                                        
                                    </div>
                                    <!-- Column -->
                                   
                                </div>
                                <?php 
	                            }else if ($enlace=='thirdLevel'){
	                            ?>
                                <div class="row">
                               		<!-- Column -->
                                    
                                    <div class="col-md-3 col-lg-3 col-xlg-3">
                                        
                                    </div>
                                    
                                    <!-- Column -->
                                   <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Tipo de orden</h3>
                                                <h6 class="text-white"><?= $nombreTipo;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Ubicaci&oacute;n </h3>
                                                <h6 class="text-white"><?= $nombreMiembros;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Primer subnivel</h3>
                                                <h6 class="text-white"><?= $nomPrimerSubNiv;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xlg-3">
                                        
                                    </div>
                                    <!-- Column -->
                                   
                                </div>
                                
	                            <?php 
	                            }else if ($enlace=='fourthLevel'){
	                            ?>
                                <div class="row">
                               		<!-- Column -->
                                    
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        
                                    </div>
                                    
                                    <!-- Column -->
                                   <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Tipo de orden</h3>
                                                <h6 class="text-white"><?= $nombreTipo;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Ubicaci&oacute;n </h3>
                                                <h6 class="text-white"><?= $nombreMiembros;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Primer subnivel</h3>
                                                <h6 class="text-white"><?= $nomPrimerSubNiv;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Segundo subnivel</h3>
                                                <h6 class="text-white"><?= $nomSegundoSubNiv;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        
                                    </div>
                                    <!-- Column -->
                                   
                                </div>
                                <?php 
	                            }
	                            ?>
                                
                                
	                             
	                            <div class="form-group">
                               		<label class="col-md-12" for="subnivel">Subnivel *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="subnivel" name="subnivel">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaSubnivel as $value) { 
                                                  	if($value->ID==$valorSubnivel){
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
	                		<a href="<?= base_url()?>OrdersConfigurationTreeDefinition/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
                                                <i class="fa fa-arrow-left"></i>
                                                <span class="hidden-xs"> Retornar</span>
                                            </a>
                            <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
	                		<input type="hidden" name="id" id="id" value="<?= $id;?>">
	                		<input type="hidden" name="tipo" id="tipo" value="<?= $valorTipo;?>">
	                		<input type="hidden" name="miembros" id="miembros" value="<?= $valorMiembros;?>">
                            <input type="hidden" name="secuencia" id="secuencia" value="<?= $secuencia;?>">
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
                
            
