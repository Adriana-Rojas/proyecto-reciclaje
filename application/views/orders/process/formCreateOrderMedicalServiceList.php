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
                <!-- Start JavaScript para pintar campos adicionales -->
                <!-- ============================================================== -->
                
    			<!-- ============================================================== -->
                <!-- End JavaScript para pintar campos adicionales -->
                <!-- ============================================================== -->
                
			 	
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <form class=" form-horizontal" role="form" action="<?= base_url()?>OrdersAppOrder/saveMedicalService" 
		                id="form_sample_3" 
		                method="post"       
		                autocomplete="off">
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                        	<?php 
                                foreach ($paciente as $value){
                                	
                                ?>
                            <div class="card-body">
                                <div class="user-btm-box">
                                	<!-- .row -->
                                    <div class="row text-center m-t-10">
                                        <div class="col-md-12">
                                        	<span class="<?= datosGeneroPersona($value->SEXO,'CLASE','fa-4x')?>">
                                                     	<?= datosGeneroPersona($value->SEXO,'NOMBRE','fa-4x') ?>
                                            </span>
                                            <br>
                                            <strong>Nombres completos</strong>
                                            <p><?= $value->PRI_NOM_PCTE," ",$value->SEG_NOM_PCTE," ",$value->PRI_APELL_PCTE," ",$value->SEG_APELL_PCTE;?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- .row -->
                                    <div class="row text-center m-t-10">
                                        <div class="col-md-6 b-r"><strong>Historia cl&iacute;nica</strong>
                                            <p><?= $value->ID_PCTE;?></p>
                                        </div>
                                        <div class="col-md-6"><strong>Documento de identidad</strong>
                                            <p><?= $value->TP_ID_PCTE," ",$value->NUM_ID_PCTE;?></p>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                    <hr>
                                    <!-- .row -->
                                    <div class="row text-center m-t-10">
                                        <div class="col-md-6 b-r"><strong>Edad</strong>
                                            <p><?=intervaloTiempo($value->FECH_NCTO_PCTE,cambiaHoraServer(2),31104000);
                                                	?> A&ntilde;os</p>
                                        </div>
                                        <div class="col-md-6"><strong>Responsable</strong>
                                            <p><?= $value->RESPONSABLE;?></p>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                    <hr>
                                    
                                    
                                    
                                </div>
                            </div>
                            <?php 
                                }?>
                        </div>
	                        <div class="card">
	                            <div class="card-body">
	                                <h5 class="card-title">Ruta del producto</h5>
	                                <?php if ($niveles==3){
		                            ?>   
		                            <div class="row">
	                               		<!-- Column -->
	                                    
	                                    
	                                   <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Tipo de orden: <small class="text-white"><?= $nombreTipo;?></small></h4>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <!-- Column -->
	                                    <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Ubicaci&oacute;n: <small class="text-white"><?= $nombreMiembros;?></small> </h4>
	                                                
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <!-- Column -->
	                                    <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Primer subnivel: <small class="text-white"><?= $nomPrimerSubNiv;?></small></h4>
	                                                
	                                            </div>
	                                        </div>
	                                    </div>
	                                    
	                                    <!-- Column -->
	                                    <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Segundo subnivel: <small class="text-white"><?= $nomSegundoSubNiv;?></small></h4>
	                                                
	                                            </div>
	                                        </div>
	                                    </div>
	                                    
	                                    <!-- Column -->
	                                    <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Tercer subnivel: <small class="text-white"><?= $nomTerceroSubNiv;?></small></h4>
	                                                
	                                            </div>
	                                        </div>
	                                    </div>
	                                    
	                                   
	                                   
	                                </div>
		                            <?php }?>
		                            <?php if ($niveles==2){
		                            ?>   
		                            <div class="row">
	                               		<div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Tipo de orden: <small class="text-white"><?= $nombreTipo;?></small></h4>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <!-- Column -->
	                                    <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Ubicaci&oacute;n: <small class="text-white"><?= $nombreMiembros;?></small> </h4>
	                                                
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <!-- Column -->
	                                    <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Primer subnivel: <small class="text-white"><?= $nomPrimerSubNiv;?></small></h4>
	                                                
	                                            </div>
	                                        </div>
	                                    </div>
	                                    
	                                    <!-- Column -->
	                                    <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Segundo subnivel: <small class="text-white"><?= $nomSegundoSubNiv;?></small></h4>
	                                                
	                                            </div>
	                                        </div>
	                                    </div>
	                                   
	                                </div>
		                            <?php }?> 
		                            <?php if ($niveles==1){
		                            ?>   
		                            <div class="row">
	                               		<div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Tipo de orden: <small class="text-white"><?= $nombreTipo;?></small></h4>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <!-- Column -->
	                                    <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Ubicaci&oacute;n: <small class="text-white"><?= $nombreMiembros;?></small> </h4>
	                                                
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <!-- Column -->
	                                    <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Primer subnivel: <small class="text-white"><?= $nomPrimerSubNiv;?></small></h4>
	                                                
	                                            </div>
	                                        </div>
	                                    </div>
	                                    
	                                  
	                                   
	                                </div>
		                            <?php }?> 
		                            <div class="row">
	                               		<div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Producto: <small class="text-white"><?= $codigo." - ".$nombre;?></small></h4>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Interconsultas a incluir</h5>
                                <div class="form-group " >
                               		<label class="col-md-12" for="codigo">Paquete de interconsultas definidas *</label>
                                    <div class="col-md-12">
                                    	<script src="<?= base_url()?>assets/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    									<script>
    										jQuery(document).ready(function() {
    											$(".select2").select2();
    										});
    								    </script>	
	                                    <select class="form-control  select2 select2-multiple" 
	                                    		style="width: 100%" id="codigo" name="codigo[]" multiple="multiple" <?= $disabled;?> >
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaServicios as $value) {
                                            ?>
                                            <option value="<?= $value->ID;?>"><?= $value->CODIGO." - ".$value->NOMBRE;?></option> 
                                            <?php
                                            }?>
                                        </select>
	                                    
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
	                           
	                           
                               <div class="form-group " >
                               		<label class="col-md-12" for="observacion">Observaci&oacute;n de formulaci&oacute;n </label>
                                    <div class="col-md-12">
	                                    <textarea rows="4" cols="100" class="form-control"  id="observacion" name="observacion"  placeholder="Describa si tiene alguna observaci&oacute;n relevante para ordenar el elemento o servicio"></textarea>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="row">
				                	<div class="col-sm-12">
				                		<a href="<?= base_url()?>OrdersAppOrder/createOrder/<?= $id;?>/<?= $this->encryption->encrypt('next');?>" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
			                                                <i class="fa fa-arrow-left"></i>
			                                                <span class="hidden-xs"> Retornar</span>
			                                            </a>
			                            <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
				                		<input type="hidden" name="id" id="id" value="<?= $id;?>">
				                		<input type="hidden" name="idOrden" id="idOrden" value="<?= $idOrden;?>">
				                	</div>   
				                	<div class="col-sm-12">
				                	</div> 
				                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Column -->
                </div>
	            </form>    
	            <!-- ============================================================== -->
	            <!-- End PAge Content -->
	            <!-- ============================================================== -->
                
            
