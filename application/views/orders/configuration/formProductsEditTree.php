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
                
    			<script src="<?= base_url()?>assets/dist/js/pages/mask.js"></script>
    			<!--alerts CSS -->
		    	<link href="<?= base_url()?>assets/node_modules/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
			    <!-- Sweet-Alert  -->
			    <script src="<?= base_url()?>assets/node_modules/sweetalert/sweetalert.min.js"></script>
			    <script src="<?= base_url()?>assets/node_modules/sweetalert/jquery.sweet-alert.custom.js"></script>
                
			 	
			 	
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                
	                <div class="row">
	                    <div class="col-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h4 class="card-title">Configuraci&oacute;n de productos y servicios</h4>
	                                <h6 class="card-subtitle">Administre los diferentes productos y servicios que est&aacute;n disponibles dentro del sistema de informaci&oacute;n</h6>
	                                
	                                </div>
	                            <?php if ($niveles==3){
	                            ?>   
	                            <div class="row">
                               		<!-- Column -->
                                    
                                    <div class="col-md-1 col-lg-1 col-xlg-1">
                                        
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
                                                <h6 class="text-white"><?= $nomSegundoSubNiv;?></h7>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Tercer subnivel</h3>
                                                <h6 class="text-white"><?= $nomTerceroSubNiv;?></h7>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-1 col-lg-1 col-xlg-1">
                                        
                                    </div>
                                    <!-- Column -->
                                   
                                </div>
	                            <?php }?>
	                            <?php if ($niveles==2){
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
                                                <h6 class="text-white"><?= $nomSegundoSubNiv;?></h7>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        
                                    </div>
                                    <!-- Column -->
                                   
                                </div>
	                            <?php }?> 
	                            <?php if ($niveles==1){
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
                                                <h3 class="font-light text-white"><?php if ($idValida==1){?>Ubicaci&oacute;n<?php }else{?>Tipo<?php }?>   </h3>
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
	                            <?php }?> 
	                           
	                           <div class="form-group " >
                               		<label class="col-md-12" for="codigo">C&oacute;digo *</label>
                                    <div class="col-md-12">
                                    	<input type="text" class="form-control" readonly="readonly" value="<?= $codigo ?>" >
	                                    
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
	                           
	                           <div class="form-group " >
                               		<label class="col-md-12" for="nombre">Nombre *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="nombre" name="nombre" 
	                                    	value="<?= $nombre ?>"
	                                        readonly="readonly" >
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
	                           <div class="form-group " >
                               		<label class="col-md-12" for="descripcion">Nueva ubicaci&oacute;n *</label>
                                    <?= $arbol;?>
                               </div>
	                           
                                
                               
	                        </div> <!-- End Card -->   
	                    </div> <!-- End Col -->
	                </div> <!-- End Row -->
	                
	                
                   </div>
                   <!-- /.modal -->
	        
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                
            
