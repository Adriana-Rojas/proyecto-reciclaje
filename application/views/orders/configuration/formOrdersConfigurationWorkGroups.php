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
	                                <h4 class="card-title">Grupo interdisciplinario </h4>
	                                <h6 class="card-subtitle">Identifique el grupo interdisciplinario que tendr&aacute; las ordenes del tipo seleccionado</h6>
	                            </div>
	                            <div class="row">
                               		<!-- Column -->
                                    
                                    <div class="col-md-3 col-lg-3 col-xlg-3">
                                        
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-6 col-lg-6 col-xlg-6">
                                        <div class="card">
                                            <div class="box bg-dark text-center">
                                                <h3 class="font-light text-white">Tipo de orden</h3>
                                                <h6 class="text-white"><?= $nombreTipo;?></h6>
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
                                                <th width="70%">Rol</th>
                                                <th width="30%">Opci&oacute;n</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php 
	                                        	if ($listaPerfil!=null){
	                                        		foreach ($listaPerfil->result() as $value) { 
	                                        			//Verifico si esta en el la relación de estados
	                                        			//Defino el rol perfil
	                                        			$rolPerfil=$this->FunctionsGeneral->getFieldFromTableNotIdFields(
	                                        					"ADM_ROLPERFIL",
	                                        					"ID",
	                                        					"ID_PERFIL",
	                                        					$value->ID,
	                                        					"ID_ROL",
	                                        					1);
	                                        			//Verifico el id del grupo de trabajo 
	                                        			$idGrupo=$this->FunctionsGeneral->getFieldFromTableNotId("ORD_DEFEQUIPO","ID","ID_TIPOORDEN",$id);
	                                        			if ($idGrupo!=''){
	                                        				$idGrupoDetalle=$this->FunctionsGeneral->getFieldFromTableNotIdFields(
	                                        						"ORD_DETDEFEQUIPO","ID","ID_INFROL",$rolPerfil,"ID_DEFEQUIPO",$idGrupo);
	                                        				
	                                        				if($idGrupoDetalle!=''){
	                                        					//Existe relación debo ahora verificar si está en obligatorio
	                                        					$obligatorio=$this->FunctionsGeneral->getFieldFromTable("ORD_DETDEFEQUIPO","OBLIGATORIO",$idGrupoDetalle);
	                                        					if ($obligatorio==CTE_VALOR_SI){
	                                        						$temporal=GRUPO_OBLIGATORIO;
	                                        					}else {
	                                        						$temporal=GRUPO_ASOCIADO;
	                                        					}
	                                        							
	                                        				}else{
	                                        					$temporal=GRUPO_NO_REQUERIDO;
	                                        				}	
	                                        			}else{
	                                        				$temporal=GRUPO_NO_REQUERIDO;
	                                        			}
	                                        			
	                                        			
	                                        			
	                                        			
	                                            ?>
                                            
                                           
                                            <tr align="center">
                                                <td><?= $value->NOMBRE  ?></td>
                                                 <td>
	                                                	
	                                                	<select class="form-control" id="perfil<?= $value->ID;?>" name="perfil<?= $value->ID;?>">
				                                        	<?php 
				                                            	foreach ($listaSiNo as $opcion2) {
				                                            		if($opcion2->ID==$temporal){
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
	                		<a href="<?= base_url().$mainPage?>" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
                                                <i class="fa fa-arrow-left"></i>
                                                <span class="hidden-xs"> Retornar</span>
                                            </a>
                            <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
	                		<input type="hidden" name="idTipoOrden" id="idTipoOrden" value="<?= $idTipoOrden;?>">
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
                
            
