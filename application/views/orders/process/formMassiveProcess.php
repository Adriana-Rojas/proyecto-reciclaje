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
                	
	             // Traigo la informaci<?= LETRA_MIN_O?>n de tipo de observaci<?= LETRA_MIN_O?>n
	                $(document).ready(function() {
						$("#tipo").change(function() {
							$("#tipo option:selected").each(function() {
								tipo = $('#tipo').val();
		 					$.post("<?= base_url()?>Integration/reloadObservationStateInformation", {
		 						tipo : tipo
		 					}, function(data) {
		 						var tempo = data.split('|');
		 						//Acci<?= LETRA_MIN_O?>n sobre el estado
			 					if (tempo[0] == <?= CTE_VALOR_SI?>){
		 							$(".accion").val('Cierra');
									$(".accion").show();
			 					 }else{
			 						$(".accion").val('Contin<?= LETRA_MIN_U?>a abierto');
									$(".accion").show();
			 					 } 
			 					//Tipo de observaci�n
			 					if (tempo[1] == <?= CTE_VALOR_PROCESO?>){
		 							$(".tipoObs").val('Proceso Normal');
									$(".tipoObs").show();
									$(".reproceso").hide();
									$("#reproceso").prop('disabled', true);
			 					 }else{
			 						$(".tipoObs").val('Reproceso');
									$(".tipoObs").show();
									$(".reproceso").show();
									$("#reproceso").prop('disabled', false);
									
			 					 } 
			 					 
		 						});
							});
						})
					});  	

	                function validar(check,cantidad) { 
	                    //Compruebo si la casilla está marcada 
	                     if (check.checked==true){ 
	                        cantidad.value++; 
	                     }else { 
	                        //si la casilla no estaba marcada, resto uno al contador de grupo 
	                        cantidad.value--; 
	                     }
	                }
		        </script>
<!-- ============================================================== -->
                <!-- End JavaScript para pintar campos adicionales -->
                <!-- ============================================================== -->
                
			 	
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <form class=" form-horizontal" role="form" action="<?= base_url()?>OrdersAppOrder/saveMassiveTrace" 
		                id="form_sample_3" 
		                method="post"       
		                autocomplete="off">
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        
	                        <div class="card">
	                            <div class="card-body">
	                                <h5 class="card-title">Ruta de las &oacute;rdenes</h5>
	                                <div class="row">
	                               		<!-- Column -->
	                                    
	                                   <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Proceso: <small class="text-white"><?= $nombreProceso;?></small></h4>
	                                            </div>
	                                        </div>
	                                    </div>
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
	                                                <h4 class="font-light text-white">Estado: <small class="text-white"><?= $nombreEstado;?></small></h4>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <!-- Column -->
	                                 </div>
	                            </div>
	                        </div>
	                        <div class="card">
                				<div class="card-body">
                					<h5 class="card-title">Seguimiento a realizar</h5>
                					<div class="form-group ">
                						<label class="col-md-12" for="tipo">Observaci&oacute;n
                							definidas *</label>
                						<div class="col-md-12">
                							<select class="form-control" style="width: 100%" id="tipo"
                								name="tipo">
                								<option value="">--- Seleccione una opci&oacute;n ---</option>
                								 <?php 
                								 foreach ($listaObservacion as $value) { 
                                                 ?>
                                                 <option value="<?= $value->ID;?>" ><?= $value->NOMBRE;?></option> 
                                                <?php
                                                	}?>
                							</select>
                
                							<div class="form-control-feedback"></div>
                						</div>
                					</div>
                					<div class="form-group tipoObs" style="display: none;">
                						<label class="col-md-12" for="tipoObs">Clasificaci&oacute;n
                							observaci&oacute;n *</label>
                						<div class="col-md-12">
                							<input type="text" class="form-control tipoObs" id="tipoObs"
                								name="tipoObs" disabled="disabled">
                							<div class="form-control-feedback"></div>
                						</div>
                					</div>
                					<div class="form-group accion" style="display: none;">
                						<label class="col-md-12" for="proceso">Accci&oacute;n sobre el
                							proceso *</label>
                						<div class="col-md-12">
                							<input type="text" class="form-control accion" id="proceso"
                								name="proceso" disabled="disabled">
                							<div class="form-control-feedback"></div>
                						</div>
                					</div>
                					<div class="form-group reproceso" style="display: none;">
                						<label class="col-md-12" for="reproceso">Estado reproceso *</label>
                						<div class="col-md-12">
                							<select class="form-control reproceso" id="reproceso"
                								name="reproceso" disabled="disabled">
                								<option value="">--- Seleccione una opci&oacute;n ---</option>
                
                							</select>
                							<div class="form-control-feedback"></div>
                						</div>
                					</div>
                					<div class="form-group " >
                						<label class="col-md-12" for="cantidad">&Oacute;rdenes seleccionadas *</label>
                						<div class="col-md-12">
                							<input type="text" class="form-control " id="cantidad" value="0" name="cantidad" readOnly="readOnly">
                							<div class="form-control-feedback"></div>
                						</div>
                					</div>
                					<div class="form-group ">
                						<label class="col-md-12" for="observacion">Justificaci&oacute;n de la observaci&oacute;n </label>
                						<div class="col-md-12">
                							<textarea rows="4" cols="100" class="form-control"
                								id="observacion" name="observacion"
                								placeholder="Detalle la observaci&oacute;n de seguimiento para las &oacute;rdenes"></textarea>
                							<div class="form-control-feedback"></div>
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
                                <h5 class="card-title"><i class='fa fa-table fa-2x'></i> Listado de &oacute;rdenes</h5>
                                <div class="table-responsive">
                                    <table id="demo-foo-addrow" class="table m-t-30 table-hover " data-page-size="20">
                                        <thead>
                                            <tr>
                                                <th>Sel</th>
                                                <th >Orden</th>
                                                <th >Historia</th>
                                                <th width="30%">Paciente</th>
                                                <th width="30%">Producto / Servicio </th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
											
                                        if ($listaLista != null) {
                                                $i=1;
                                                foreach ($listaLista as $value) {
                                            ?>
                                            <tr>
                                                <td><input type="checkbox" name="valor<?= $value->ID ;?>" 
                                                                        id="valor<?= $value->ID ;?>" 
                                                                        onclick="validar(valor<?= $value->ID ;?>,cantidad)"></td>
                                                <td><?= $value->PREFIJO." - ".$value->CONS ;?></td>
                                                <td><?php 
                                                        //Encuentro el n�mero de historia
                                                        $historia=$this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud(
                                                        "T_ADMISIONES",
                                                        "ID_PCTE_ADM",
                                                        "ID_AMSION",
                                                        $value->HISTORIA);
                                                        echo $historia;?></td>
                                                <td><?=
                                                        $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud(
                                                            "T_PACIENTES",
                                                            "PRI_NOM_PCTE",
                                                            "ID_PCTE",
                                                            $historia)," ",$this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud(
                                                                "T_PACIENTES",
                                                                "SEG_NOM_PCTE",
                                                                "ID_PCTE",
                                                                $historia)," ",$this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud(
                                                                    "T_PACIENTES",
                                                                    "PRI_APELL_PCTE",
                                                                    "ID_PCTE",
                                                                    $historia)," ",$this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud(
                                                                        "T_PACIENTES",
                                                                        "PRI_APELL_PCTE",
                                                                        "ID_PCTE",
                                                                        $historia)?></td>
                                                <td>
                                                <?php 
                                                    //Busco dentro del �rbol de productos y servicios
                                                    $actividad= $this->FunctionsGeneral->getFieldFromTableNotId ( "ORD_ARBOLCODIGO", "NOMBRE", "ID", $value->ACTIVIDAD );
                                                    if($actividad==''){
                                                        echo  $this->FunctionsGeneral->getFieldFromTableNotId ( "ORD_ELEMENTO", "CODIGO", "ID", $value->ACTIVIDAD )." - ".
                                                              $this->FunctionsGeneral->getFieldFromTableNotId ( "ORD_ELEMENTO", "NOMBRE", "ID", $value->ACTIVIDAD );
                                                    }else{
                                                        echo $this->FunctionsGeneral->getFieldFromTableNotId ( "ORD_ARBOLCODIGO", "CODIGO", "ID", $value->ACTIVIDAD )." ".$actividad;
                                                    }
                                                ?>
                                                </td>
                                                
                                            </tr>
                                            <?php 
                                                $i++;
                                                }//end foreach
                                            }//end if
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3">
                                               </td>
                                               <td colspan="3">
                                                    <div class="text-right">
                                                        <ul class="pagination"> </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Column -->
                </div>
                <div class="row">
				                	<div class="col-sm-12">
				                		<a href="<?= base_url()?>/<?= $mainPage;?>" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
			                                                <i class="fa fa-arrow-left"></i>
			                                                <span class="hidden-xs"> Retornar</span>
			                                            </a>
			                            <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
				                		<input type="hidden" name="estado" id="estado" value="<?= $estado;?>">
				                		<input type="hidden" name="proceso" id="proceso" value="<?= $proceso;?>">
				                	</div>   
				                	<div class="col-sm-12">
				                	</div> 
				                </div>
	            </form>    
	            <!-- ============================================================== -->
	            <!-- End PAge Content -->
	            <!-- ============================================================== -->
                
            
