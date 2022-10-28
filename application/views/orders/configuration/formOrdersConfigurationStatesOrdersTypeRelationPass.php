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
                <script type="text/javascript">
                <?php 
                    	if ($listaPerfil!=null){
                    		foreach ($listaPerfil->result() as $value) {
                ?>
					$(document).ready(function() {
						$("#opcion<?= $value->ID;?>").change(function() {
							if ($("#opcion<?= $value->ID;?>").val()=='19'){
								$("#correo<?= $value->ID;?>").prop('disabled', true);	
								
							}else{
								$("#correo<?= $value->ID;?>").prop('disabled', false);
							}
						})
					});
                <?php
                    		}
                    	}
			    ?>
			 	</script>
                               
                
                <!-- ============================================================== -->
                <!-- FIn JavaScript para pintar campos adicionales -->
                <!-- ============================================================== -->
        	
       
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <form class=" form-horizontal" role="form" action="<?= base_url()?><?= $pagina ?>" 
                id="form_sample_3" 
                method="post"       
                autocomplete="off">
	                <div class="row">
	                    <div class="col-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h4 class="card-title">Permisos por estado </h4>
	                                <h6 class="card-subtitle">Identifique el rol que puede hacer seguimiento sobre el estado de la orden</h6>
	                            </div>
	                            <div class="row">
                               		<!-- Column -->
                                    
                                    <div class="col-md-3 col-lg-3 col-xlg-3">
                                        
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?>  text-center">
                                                <h3 class="font-light text-white">Proceso</h3>
                                                <h6 class="text-white"><?= $proceso;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Tipo de orden</h3>
                                                <h6 class="text-white"><?= $tipo;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Estado</h3>
                                                <h6 class="text-white"><?= $estado;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    
                                    <div class="col-md-3 col-lg-3 col-xlg-3">
                                        
                                    </div>
                                    <!-- Column -->
                                   
                                </div>
                               	<center>
                               	<div class="table-responsive col-8" >
                                    <table class="table table-bordered table-hover">
                                        <thead class="table-active">
                                            <tr align="center" >
                                                <th width="50%">Rol</th>
                                                <th width="35%">Acci&oacute;n</th>
                                                <th width="15%">Envio correo electr&oacute;nico</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php 
                                        	if ($listaPerfil!=null){
                                        		foreach ($listaPerfil->result() as $value) { 
                                        			//Verifico si esta en el la relación de estados
                                        			//Verifico si el estado es inicial y por tal razón no puede ser proceso normal
                                        			$tempoId=$this->FunctionsGeneral->getFieldFromTable("ORD_TORDPROEST","ID_ESTADO",$value->ID);
                                        			$tipoEstado=$this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS","TIPOESTADO",$tempoId);
                                        			if($this->FunctionsGeneral->getQuantityFieldFromTable(
                                        					"ORD_TORDPROESTPER","ID_TORDPROEST",$idTordProEst,"ID_PERFIL",$value->ID)==0){
                                        					$temporal=CTE_NOSEGUIMIENTO;
                                        					$correo=CTE_VALOR_NO;
                                        					$disabled="disabled";
                                        			}else{
                                        				$temporal=$this->FunctionsGeneral->getFieldFromTableNotIdFields(
                                        						"ORD_TORDPROESTPER","PERMISO","ID_TORDPROEST",$idTordProEst, "ID_PERFIL",$value->ID);;
                                        				$correo=$this->FunctionsGeneral->getFieldFromTableNotIdFields(
                                        						"ORD_TORDPROESTPER","CORREO","ID_TORDPROEST",$idTordProEst, "ID_PERFIL",$value->ID);;
                                        				$disabled="";
                                        			}
                                        			
                                        			
                                            ?>
                                            
                                           
                                            <tr align="center">
                                                <td><?= $value->NOMBRE  ?> 
                                                	<input type="hidden" name="perfil<?= $value->ID;?>" id="perfil<?= $value->ID;?>" value="<?= $value->ID;?>">
                                                </td>
                                                <td>
                                                	<select class="form-control" id="opcion<?= $value->ID;?>" name="opcion<?= $value->ID;?>">
			                                        	<?php 
			                                            	foreach ($listaOpcion as $opcion) {
			                                            		if($opcion->ID==$temporal){
			                                                    	$selected="selected='selected'";
			                                                    }else{
			                                                    	$selected="";
			                                                    }
			                                            ?>
			                                            <option value="<?= $opcion->ID;?>" <?=$selected ?>><?= $opcion->NOMBRE;?></option> 
			                                            <?php
			                                            }?>
			                                        </select>
                                                </td>
                                                
                                                <td>
                                                	
                                                	<select class="form-control" id="correo<?= $value->ID;?>" name="correo<?= $value->ID;?>" <?= $disabled;?>>
			                                        	<?php 
			                                            	foreach ($listaSiNo as $opcion2) {
			                                            		if($opcion2->ID==$correo){
			                                                    	$selected="selected='selected'";
			                                                    }else{
			                                                    	$selected="";
			                                                    }
			                                            ?>
			                                            <option value="<?= $opcion2->ID;?>" <?=$selected ?>><?= $opcion2->NOMBRE;?></option> 
			                                            <?php
			                                            }?>
			                                        </select>
                                                	 
                                                </td>
                                            </tr>
                                           
                                            <?php
                                        		}
                                            }?>
                                        </tbody>
                                    </table>
                                </div>
                                </center>
	                        </div>
	                    </div>
	                    
	                    
	                </div>
	                <!-- Botón de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                		<a href="<?= base_url()?>OrdersConfigurationStatesOrdersType/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
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
                
            
