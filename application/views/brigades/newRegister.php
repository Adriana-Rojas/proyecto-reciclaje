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
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <form class=" form-horizontal" role="form" 
                action="<?= base_url()?>BrigadesAppBrigade/saveRegister" 
                id="form_sample_3" 
                method="post"       
                autocomplete="off">
	                <div class="row">
	                    <div class="col-sm-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h5 class="card-title"> Datos generales
                            <small class="font-gray">Identifique la ubicaci&oacute;n de la brigada</small></h5>
	                                	
	                                    
                                         
                                         <div class="form-group " >
                                        	<label class="col-md-12" for="departamento">Departamento*</label>
                                            <div class="col-md-12">
                                            	<select class="form-control" id="departamento" name="departamento">
                                                            <option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            <?php 
                                                            if($listaDepartamento!=null){
                                                            	foreach ($listaDepartamento->result() as $value) {
                                                                            if($value->ID==$departamento){
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
                                         
                                         <div class="form-group ">
                                        	<label class="col-md-12" for="ciudad">Ciudad (Municipio)* </label>
                                            <div class="col-md-12">
                                            	<select class="form-control" id="ciudad" name="ciudad">
                                                            <option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            <?php 
                                                            if($listaCiudad!=null){
	                                                            foreach ($listaCiudad as $value) {
	                                                                        if($value->ID==$ciudad){
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
                                       		<label class="col-md-12" for="monto">Monto asignado a la brigada *</label>
                                            <div class="col-md-12">
        	                                    <input type="number" class="form-control" id="monto" name="monto" 
        	                                    	value="<?= $monto ?>"
        	                                        placeholder="Ej. 25000000" >
        	                                    <div class="form-control-feedback" > </div>
                                            </div>
                                       </div>
	                                
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <?php 
	                foreach ($fases->result() as $fase){
	                
	                ?>
	                <div class="row">
	                    <div class="col-sm-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h5 class="card-title"> Fase: <?= $fase->NOMBRE;?>  </h5>
                            			                                        
                                         <div class="form-group">
                                        	<label class="col-md-12" for="fase_<?= $fase->ID;?>">Periodo * </label>
                                            <div class="col-md-12">
                                            	<?php 
                                            	if($idEncBrig>0){
                                            		//Obtengo el campo respectivo
                                            	    $opcion=true;
                                            	    $valor=$this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "FECHA", "ID",$this->FunctionsGeneral->
                                            				getFieldFromTableNotIdFields("BRI_BRIGADA",
                                            				"FECHAINI",
                                            				"ID_ENCBRIG",
                                            				$idEncBrig,
                                            				"ID_FASEBRIG",
                                            				$fase->ID), $opcion)." - ".
                                            				$this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "FECHA", "ID",$this->FunctionsGeneral->
                                            				getFieldFromTableNotIdFields("BRI_BRIGADA",
                                            						"FECHAFIN",
                                            						"ID_ENCBRIG",
                                            						$idEncBrig,
                                            						"ID_FASEBRIG",
                                            				    $fase->ID), $opcion)
                                            				;
                                            				
                                            				
                                            	}else{
                                            		$valor=null;
                                            	}
                                            	
                                            	?>
                                            	<input class="form-control input-limit-datepicker" type="text" name="fase_<?= $fase->ID;?>" id="fase_<?= $fase->ID;?>" value='<?= $valor;?>'  />
                                            </div>
                                         </div>
                                         <div class="form-group">
	                                        <label class="col-md-12" for="convenio_<?= $fase->ID;?>">Convenio* </label>
	                                        <div class="col-md-12">
	                                            <select class="form-control" id="convenio_<?= $fase->ID;?>" name="convenio_<?= $fase->ID;?>">
                                                            <option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            <?php 
                                                            if($idEncBrig>0){
                                                            	//Obtengo el campo respectivo
                                                            	$campo=$this->FunctionsGeneral->
                                                            			getFieldFromTableNotIdFields("BRI_BRIGADA",
                                                            					"ID_CONVENIOBRIG",
                                                            					"ID_ENCBRIG",
                                                            					$idEncBrig, 
                                                            					"ID_FASEBRIG",
                                                            					$fase->ID);
                                                            }else{
                                                            	$campo=null;
                                                            }
                                                            foreach ($listaConvenio->result() as $value) { 
                                                                        if($value->ID==$campo){
                                                                            $selected="selected='selected'";
                                                                        }else{
                                                                            $selected="";
                                                                        }
                                                            ?>
                                                            <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option>
                                                            <?php
                                                            }?>
                                                        </select>
	                                        </div>
	                             		</div>
	                             		<div class="form-group">
	                                        <label class="col-md-12" for="tsocial_<?= $fase->ID;?>">Trabajadora social* </label>
	                                        <div class="col-md-12">
	                                            <select class="form-control" id="tsocial_<?= $fase->ID;?>" name="tsocial_<?= $fase->ID;?>">
                                                            <option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            <?php 
                                                            if($idEncBrig>0){
                                                            	//Obtengo el campo respectivo
                                                            	$campo=$this->FunctionsGeneral->
                                                            	getFieldFromTableNotIdFields("BRI_BRIGADA",
                                                            			"TSOCIAL",
                                                            			"ID_ENCBRIG",
                                                            			$idEncBrig,
                                                            			"ID_FASEBRIG",
                                                            			$fase->ID);
                                                            }else{
                                                            	$campo=null;
                                                            }
                                                            
                                                            foreach ($listaTsocial as $value) { 
                                                                        if($value->ID==$campo){
                                                                            $selected="selected='selected'";
                                                                        }else{
                                                                            $selected="";
                                                                        }
                                                            ?>
                                                            <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option>
                                                            <?php
                                                            }?>
                                                        </select>
	                                        </div>
	                             		</div>
	                             		<div class="form-group">
	                                        <label class="col-md-12" for="protesista_<?= $fase->ID;?>">T&eacute;cnico protesista* </label>
	                                        <div class="col-md-12">
	                                            <select class="form-control" id="protesista_<?= $fase->ID;?>" name="protesista_<?= $fase->ID;?>">
                                                            <option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            <?php 
                                                            if($idEncBrig>0){
                                                            	//Obtengo el campo respectivo
                                                            	$campo=$this->FunctionsGeneral->
                                                            	getFieldFromTableNotIdFields("BRI_BRIGADA",
                                                            			"TECNICO",
                                                            			"ID_ENCBRIG",
                                                            			$idEncBrig,
                                                            			"ID_FASEBRIG",
                                                            			$fase->ID);
                                                            }else{
                                                            	$campo=null;
                                                            }
                                                            
                                                            foreach ($listaProtesista as $value) { 
                                                                        if($value->ID==$campo){
                                                                            $selected="selected='selected'";
                                                                        }else{
                                                                            $selected="";
                                                                        }
                                                            ?>
                                                            <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option>
                                                            <?php
                                                            }?>
                                                        </select>
	                                        </div>
	                             		</div>
	                             		<div class="form-group">
	                                        <label class="col-md-12" for="medico_<?= $fase->ID;?>">M&eacute;dico </label>
	                                        <div class="col-md-12">
	                                            <select class="form-control" id="medico_<?= $fase->ID;?>" name="medico_<?= $fase->ID;?>">
                                                            <option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            <?php 
                                                            if($idEncBrig>0){
                                                            	//Obtengo el campo respectivo
                                                            	$campo=$this->FunctionsGeneral->
                                                            	getFieldFromTableNotIdFields("BRI_BRIGADA",
                                                            			"MEDICO",
                                                            			"ID_ENCBRIG",
                                                            			$idEncBrig,
                                                            			"ID_FASEBRIG",
                                                            			$fase->ID);
                                                            }else{
                                                            	$campo=null;
                                                            }
                                                            
                                                            foreach ($listaMedico as $value) { 
                                                                        if($value->ID==$campo){
                                                                            $selected="selected='selected'";
                                                                        }else{
                                                                            $selected="";
                                                                        }
                                                            ?>
                                                            <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option>
                                                            <?php
                                                            }?>
                                                        </select>
	                                        </div>
	                             		</div>
	                             		<div class="form-group">
	                                        <label class="col-md-12" for="fisio_<?= $fase->ID;?>">Fisioterapeuta </label>
	                                        <div class="col-md-12">
	                                            <select class="form-control" id="fisio_<?= $fase->ID;?>" name="fisio_<?= $fase->ID;?>">
                                                            <option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            <?php 
                                                            if($idEncBrig>0){
                                                            	//Obtengo el campo respectivo
                                                            	$campo=$this->FunctionsGeneral->
                                                            	getFieldFromTableNotIdFields("BRI_BRIGADA",
                                                            			"FISIO",
                                                            			"ID_ENCBRIG",
                                                            			$idEncBrig,
                                                            			"ID_FASEBRIG",
                                                            			$fase->ID);
                                                            }else{
                                                            	$campo=null;
                                                            }
                                                            
                                                            foreach ($listaFisio as $value) { 
                                                                        if($value->ID==$campo){
                                                                            $selected="selected='selected'";
                                                                        }else{
                                                                            $selected="";
                                                                        }
                                                            ?>
                                                            <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option>
                                                            <?php
                                                            }?>
                                                        </select>
	                                        </div>
	                             		</div>
	                             		<div class="form-group">
	                                        <label class="col-md-12" for="tocu_<?= $fase->ID;?>">Terapeuta ocupacional </label>
	                                        <div class="col-md-12">
	                                            <select class="form-control" id="tocu_<?= $fase->ID;?>" name="tocu_<?= $fase->ID;?>">
                                                            <option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            <?php 
                                                            if($idEncBrig>0){
                                                            	//Obtengo el campo respectivo
                                                            	$campo=$this->FunctionsGeneral->
                                                            	getFieldFromTableNotIdFields("BRI_BRIGADA",
                                                            			"TOCU",
                                                            			"ID_ENCBRIG",
                                                            			$idEncBrig,
                                                            			"ID_FASEBRIG",
                                                            			$fase->ID);
                                                            }else{
                                                            	$campo=null;
                                                            }
                                                            
                                                            foreach ($listaOcupacional as $value) { 
                                                                        if($value->ID==$campo){
                                                                            $selected="selected='selected'";
                                                                        }else{
                                                                            $selected="";
                                                                        }
                                                            ?>
                                                            <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option>
                                                            <?php
                                                            }?>
                                                        </select>
	                                        </div>
	                             		</div>
	                             		<div class="form-group">
	                                        <label class="col-md-12" for="ortesista_<?= $fase->ID;?>">T&eacute;cnico ortesista </label>
	                                        <div class="col-md-12">
	                                            <select class="form-control" id="ortesista_<?= $fase->ID;?>" name="ortesista_<?= $fase->ID;?>">
                                                            <option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            <?php 
                                                            if($idEncBrig>0){
                                                            	//Obtengo el campo respectivo
                                                            	$campo=$this->FunctionsGeneral->
                                                            	getFieldFromTableNotIdFields("BRI_BRIGADA",
                                                            			"TORTE",
                                                            			"ID_ENCBRIG",
                                                            			$idEncBrig,
                                                            			"ID_FASEBRIG",
                                                            			$fase->ID);
                                                            }else{
                                                            	$campo=null;
                                                            }
                                                            
                                                            foreach ($listaOrtesista as $value) { 
                                                                        if($value->ID==$campo){
                                                                            $selected="selected='selected'";
                                                                        }else{
                                                                            $selected="";
                                                                        }
                                                            ?>
                                                            <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option>
                                                            <?php
                                                            }?>
                                                        </select>
	                                        </div>
	                             		</div>
	                             		<div class="form-group">
	                                        <label class="col-md-12" for="facilitador_<?= $fase->ID;?>">Facilitador </label>
	                                        <div class="col-md-12">
	                                            <select class="form-control" id="facilitador_<?= $fase->ID;?>" name="facilitador_<?= $fase->ID;?>">
                                                            <option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            <?php
	                										if($idEncBrig>0){
                                                            	//Obtengo el campo respectivo
                                                            	$campo=$this->FunctionsGeneral->
                                                            			getFieldFromTableNotIdFields("BRI_BRIGADA",
                                                            					"FACILITADOR",
                                                            					"ID_ENCBRIG",
                                                            					$idEncBrig, 
                                                            					"ID_FASEBRIG",
                                                            					$fase->ID);
                                                            }else{
                                                            	$campo=null;
                                                            }
                                                            foreach ($listaFacilitador as $value) { 
                                                                        if($value->ID==$campo){
                                                                            $selected="selected='selected'";
                                                                        }else{
                                                                            $selected="";
                                                                        }
                                                            ?>
                                                            <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option>
                                                            <?php
                                                            }?>
                                                        </select>
	                                        </div>
	                             		</div>
	                             		<div class="form-group">
	                                        <label class="col-md-12" for="invitado_<?= $fase->ID;?>">Invitado </label>
	                                        <div class="col-md-12">
	                                            <select class="form-control" id="invitado_<?= $fase->ID;?>" name="invitado_<?= $fase->ID;?>">
                                                            <option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            <?php 
                                                            if($idEncBrig>0){
                                                            	//Obtengo el campo respectivo
                                                            	$campo=$this->FunctionsGeneral->
                                                            	getFieldFromTableNotIdFields("BRI_BRIGADA",
                                                            			"INVITADO",
                                                            			"ID_ENCBRIG",
                                                            			$idEncBrig,
                                                            			"ID_FASEBRIG",
                                                            			$fase->ID);
                                                            }else{
                                                            	$campo=null;
                                                            }
                                                            
                                                            foreach ($listaInvitado as $value) { 
                                                                        if($value->ID==$campo){
                                                                            $selected="selected='selected'";
                                                                        }else{
                                                                            $selected="";
                                                                        }
                                                            ?>
                                                            <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option>
                                                            <?php
                                                            }?>
                                                        </select>
	                                        </div>
	                             		</div>
	                                
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <?php 
	                }
	                ?>
	                
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
                
            <!-- ============================================================== -->
        		<!-- BEGIN PAGE JQUERY ROUTINES -->
        		<!-- ============================================================== -->
        		
        		 <!-- Plugin JavaScript -->
			    <script src="<?= base_url()?>assets/node_modules/moment/moment.js"></script>
			    <!-- Date Picker Plugin JavaScript -->
			    <script src="<?= base_url()?>assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
			    
				<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.es.min.js"></script>
			    <!-- Date range Plugin JavaScript -->
			    <script src="<?= base_url()?>assets/node_modules/timepicker/bootstrap-timepicker.min.js"></script>
			    <script src="<?= base_url()?>assets/node_modules/bootstrap-daterangepicker/daterangepicker.js"></script>
        		<script>
				    
				    $('.input-limit-datepicker').daterangepicker({
				        minDate: '<?= cambiaHoraServer(2);?>',
				        buttonClasses: ['btn', 'btn-sm'],
				        locale: {
				            "format": "<?= strtoupper( DATE_FORMAT_EVOLUTION);?>",
				            "separator": " - ",
				            "applyLabel": "Aplicar",
				            "cancelLabel": "Cancelar",
				            "fromLabel": "Desde",
				            "toLabel": "Hasta",
				            "customRangeLabel": "Custom",
				            "daysOfWeek": [
				                "Do",
				                "Lu",
				                "Ma",
				                "Mi",
				                "Ju",
				                "Vi",
				                "Sa"
				            ],
				            "monthNames": [
				                "Enero",
				                "Febrero",
				                "Marzo",
				                "Abril",
				                "Mayo",
				                "Junio",
				                "Julio",
				                "Agosto",
				                "Septiembre",
				                "Octubre",
				                "Noviembre",
				                "Diciembre"
				            ],
				            "firstDay": 1
				        },
				        applyClass: 'btn-info btn-rounded',
				        cancelClass: 'btn-inverse btn-rounded'
				    });
				    <?php 
			                foreach ($fases->result() as $fase){
			                
			                ?>
				    	$('#fase_<?= $fase->ID;?>').val('');
				    <?php }?>
				    </script>
				     
		        <script >
			     $(document).ready(function() {
						$("#departamento").change(function() {
							$("#departamento option:selected").each(function() {
								departamento = $('#departamento').val();
		 					$.post("<?= base_url()?>/Integration/reloadCity", {
		 						departamento : departamento
		 					}, function(data) {
		 							$("#ciudad").html(data);
		 							});
							});
						})
					});
		        
				</script>
				<!-- ============================================================== -->
				<!-- END PAGE JQUERY ROUTINES -->
        		<!-- ============================================================== -->
        
