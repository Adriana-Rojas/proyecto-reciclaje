<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						P�gina Web.
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2018 *******************************
 */
defined('BASEPATH') OR exit('No direct script access allowed');

?>
        
        		<!-- ============================================================== -->
                <!-- Start JavaScript para pintar campos adicionales -->
                <!-- ============================================================== -->
                <script type="text/javascript">
		                $(document).ready(function() {
								$("#proveedor").change(function() {
									$("#proveedor option:selected").each(function() {
										proveedor = $('#proveedor').val();
										grupo = $('#grupo').val();
										var caracteristica='';
										<?php 
										$j=1;
										if ($caracteristicas!=null){
											foreach ($caracteristicas as $value){
											?>
										caracteristica += $('#caracteristica<?=$j;?>').val()+"A";
											<?php 
												$j++;
											}
										}?>
										
				 					$.post("<?= base_url()?>/Integration/reloadCharacteristicsGroupElementsDefineElement", {
				 						
				 						proveedor : proveedor,
					 					grupo: grupo,
					 					caracteristica: caracteristica
				 					}, function(data) {
				 							$("#elemento").html('');
					 						$("#elemento").html(data);
				 						});
									});
							});
						});
		                <?php 
						$j=1;
						$caracteristicasBk=$caracteristicas;
						if ($caracteristicas!=null){
							foreach ($caracteristicas as $value){
						?>
								
		                $(document).ready(function() {
							$("#caracteristica<?=$j;?>").change(function() {
								
								$("#caracteristica<?=$j;?> option:selected").each(function() {
									proveedor = $('#proveedor').val();
									grupo = $('#grupo').val();
									var caracteristica='';
									<?php 
									$k=1;
									if ($caracteristicasBk!=null ){
										foreach ($caracteristicasBk as $v){
									?>
									caracteristica += $('#caracteristica<?=$k;?>').val()+"A";
									<?php 
											$k++;
										}
									}?>
								$.post("<?= base_url()?>/Integration/reloadCharacteristicsGroupElementsDefineElement", {
			 						
			 						proveedor : proveedor,
				 					grupo: grupo,
				 					caracteristica: caracteristica
			 					}, function(data) {
			 							$("#elemento").html('');
			 							$("#elemento").html(data);
			 						});
								});
							});
						});
		                <?php 
								$j++;
							}
						}?>
						
		        </script>
		                      
    			<!-- ============================================================== -->
                <!-- End JavaScript para pintar campos adicionales -->
                <!-- ============================================================== -->
                
			 	
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <form class=" form-horizontal" role="form" action="<?= base_url()?>OrdersAppOrder/saveElementOfProduct/" 
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
                                    <!-- .row -->
                                    <div class="row text-center m-t-10">
                                        <div class="col-md-12"><strong>Tipo de proceso</strong>
                                            <p><?= $tipoProceso; ?></p>
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
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Configuraci&oacute;n de despiece de elementos</h5>
								<h6 class="card-subtitle">Seleccione el proveedor del elemento</h6>
                                
                                <div class="form-group " >
                               		<label class="col-md-12" for="proveedor">Proveedor *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="proveedor" name="proveedor">
                                                            <option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            <?php foreach ($listaProveedores as $value) {
				                                            
				                                            ?>
				                                            <option value="<?= $value->ID;?>" ><?= $value->NOMBRE;?></option> 
				                                            <?php
				                                            }?>
                                                        </select>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               
                               <h7 class="card-subtitle">Caracter&iacute;sticas</h7>
                               <?php 
                               		$j=1;
                               	if($caracteristicasBk!=null ){
                               		foreach ($caracteristicas as $value){
                               			$valoresCaracteristicas=$this->OrdersModel->getListValueGroupCharacteristics($value->ID_PARGRUELEM);
                               		
                               ?>
                               <div class="form-group " >
                               		<label class="col-md-12" for="caracteristica<?= $j;?>"><?= $value->NOMBRE;?> *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="caracteristica<?= $j;?>" name="caracteristica<?= $j;?>">
	                                    	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                        	<?php 
                                            foreach ($valoresCaracteristicas as $valor){
                                            ?>
                                            <option value="<?= $valor->ID;?>" ><?= $valor->VALOR;?></option> 
                                            <?php
                                            }
                                            ?>
                                        </select>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <?php 
                               			$j++;
                               		}
                               	}
                               ?>
                               <h7 class="card-subtitle">Selecci&oacute;n del elemento seg&uacute;n filtros realizados y su cantidad</h7>
                               
                               <div class="form-group " >
                               		<label class="col-md-12" for="elemento">Elemento *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="elemento" name="elemento">
                                                            <option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            
                                                        </select>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                                
                                 <div class="form-group " >
                               		<label class="col-md-12" for="cantidad">Cantidad *</label>
                                    <div class="col-md-12">
	                                    <input type="number" class="form-control" id="cantidad" name="cantidad"  min="1"
	                                    	value=""
	                                        placeholder="Ej. 1" >
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               
                                <a href="<?= base_url()?>OrdersAppOrder/elementsOfProduct/<?= $id;?>/<?= $idOrden;?>" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
			                     <i class="fa fa-arrow-left"></i>
			                     <span class="hidden-xs"> Retornar</span>
			                    </a> 
                                <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
	                			
	                			<input type="hidden" name="id" id="id" value="<?=$id;?>">
	                			<input type="hidden" name="idOrden" id="idOrden" value="<?= $idOrden;?>">
	                			<input type="hidden" name="grupo" id="grupo" value="<?= $grupo;?>">
                                
                            </div>
                        </div>
                    </div>
                    
                    <!-- Column -->
                </div>
	            </form>    
	            <!-- ============================================================== -->
	            <!-- End PAge Content -->
	            <!-- ============================================================== -->
                
            
