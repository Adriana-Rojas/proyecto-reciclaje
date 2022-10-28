<?php
error_reporting(0);
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
defined('BASEPATH') or exit('No direct script access allowed');

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
									if ($caracteristicasBk!=null){
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
<form class=" form-horizontal" role="form" action="<?= base_url()?>StokePriceAppStokePrice/saveElementOfProduct" 
		                id="form_sample_3" 
		                method="post"       
		                autocomplete="off">
<div class="row">
	<!-- Column -->
	<div class="col-md-12 col-xs-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-1 col-xs-6 b-r"></div>
					<div class="col-md-2 col-xs-6 b-r">
						<strong>Cotizaci&oacute;n n&uacute;mero</strong> <br>
						<p class="text-muted"><?= $consecutivo;?></p>
					</div>
					<div class="col-md-2 col-xs-6 b-r">
						<strong>Documento de identidad</strong> <br>
						<p class="text-muted"><?= $tipoDocumento," ",$documento;?></p>
					</div>

					<div class="col-md-2 col-xs-6 b-r">
						<strong>Nombre Completo</strong> <br>
						<p class="text-muted">
								<?= $paciente;?></p>
					</div>
					<div class="col-md-2 col-xs-6 b-r">
						<strong>Responsable</strong> <br>
						<p class="text-muted"><?= $empresaCoti;?></p>
					</div>
					<div class="col-md-2 col-xs-6 b-r">
						<strong>Fecha de cotizaci&oacute;n</strong> <br>
						<p class="text-muted"><?= $fecha;?></p>
					</div>
					<div class="col-md-1 col-xs-6 b-r"></div>
				</div>
			</div>
		</div>
	</div>

	<!-- Column -->
</div>
<div class="row">
	<div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Configuraci&oacute;n de despiece de elementos</h5>
								<h6 class="card-subtitle">Seleccione el proveedor del elemento <?= $validador ?></h6>

								<?php 
								if ($validador=='edit'){

								?>
                                <div class="form-group " >
                               		<label class="col-md-12" for="proveedor">Elemento actual *</label>
                                    <div class="col-md-12">
	                                    <?= $nombreElemento; ?>
                                    </div>
                               </div>
                               <?php
                               	}
                               if ($validador=='add'){

								?>
                                <div class="form-group " >
                               		<label class="col-md-12" for="proveedor">Grupo actual *</label>
                                    <div class="col-md-12">
	                                    <?= $nombreGrupo; ?>
                                    </div>
                               </div>
                               <?php
                               	}
                               ?>

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
                               	if($caracteristicas!=null){
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
                                <?php

                                if ($validador=='edit'){

                                ?>
                                 <div class="form-group " >
                               		<label class="col-md-12" for="cantidad">Cantidad *</label>
                                    <div class="col-md-12">
	                                    <input type="number" class="form-control" id="cantidad" name="cantidad" max="<?= $cantidad ?>" min="1"
	                                    	value="<?= $cantidad ?>"
	                                        placeholder="Ej. 1" >
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <?php

                                }

                                ?>
                                
                                <?php

                                if ($validador=='add'){

                                ?>
                                 <div class="form-group " >
                               		<label class="col-md-12" for="cantidad">Cantidad *</label>
                                    <div class="col-md-12">
	                                    <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" placeholder="Ej. 1" >
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <?php

                                }

                                ?>
                                
                            </div>
                        </div>
                    </div>
</div>


<div class="row">
		<div class="col-sm-12">
			<a href="<?= base_url()?>StokePriceAppStokePrice/elementListConfigure/<?= $id; ?>/<?= $codigo; ?>"
				class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10">
				<i class="fa fa-arrow-left"></i> <span class="hidden-xs"> Retornar</span>
			</a>
			<button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
	                			<input type="hidden" name="idDespiece" id="idDespiece" value="<?= $idDespiece;?>">
	                			<input type="hidden" name="id" id="id" value="<?= $id;?>">
	                			<input type="hidden" name="codigo" id="codigo" value="<?= $codigo;?>">
	                			<input type="hidden" name="grupo" id="grupo" value="<?= $grupo;?>">
		</div>
		<div class="col-sm-12">
			<br>
		</div>
	</div>

</form>
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->



