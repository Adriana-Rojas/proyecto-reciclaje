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
	                                <h4 class="card-title">Definici&oacute;n de funciones del sistema de informaci&oacute;n </h4>
	                                <h6 class="card-subtitle">Defina o actualice las funciones del sistema de informaci&oacute;n</h6>
	                            </div>
	                            <div class="row">
                               		<!-- Column -->
                                    <div class="col-md-3 col-lg-3 col-xlg-3">
                                    </div>
                                    
                                    <!-- Column -->
                                    <div class="col-md-6 col-lg-6 col-xlg-6">
                                        <div class="card">
                                            <div class="box bg-dark text-center">
                                                <h3 class="font-light text-white">M&oacute;dulo</h3>
                                                <h6 class="text-white"><?= $modulo;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xlg-3">
                                        
                                    </div>
                                    <!-- Column -->
                                   
                                </div>
                                <div class="form-group">
                               		<label class="col-md-12" for="nombre">Nombre funci&oacute;n *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="nombre" name="nombre" 
	                                    	value="<?= $nombre ?>"  placeholder="Ej. Crear">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               	</div>
                               	<div class="form-group">
                               		<label class="col-md-12" for="tipo">Tipo *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="tipo" name="tipo">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaTipo as $value) { 
                                                  	if($value->ID==$tipo){
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
                               <div class="form-group">
                               		<label class="col-md-12" for="ubicacion">Ubicaci&oacute;n *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="ubicacion" name="ubicacion" 
	                                    	value="<?= $ubicacion ?>"   placeholder="Ej. board">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               	</div>
                               	<div class="form-group">
                               		<label class="col-md-12" for="pagina">P&aacute;gina siguiente *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="pagina" name="pagina" 
	                                    	value="<?= $paginaSig ?>"   placeholder="Ej. ListDefine/inactiveList/">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               	</div>
                               	<div class="form-group">
                               		<label class="col-md-12" for="icono">&Iacute;cono * <small> <?php echo 'Ver link: <a href="https://fontawesome.com/v4/icons/" target = "blank">click </a> .';?></small></label>
										
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="icono" name="icono" 
	                                    	value="<?= $icono ?>"   placeholder="Ej. fa fa-pencil">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               	</div>
                               	<center>
	                               	<div class="table-responsive col-8" >
	                                    <table class="table table-bordered table-hover">
	                                        <thead class="table-active">
	                                            <tr align="center" >
	                                                <th width="50%">Rol</th>
	                                                <th width="35%">Ingreso habilitado</th>
	                                            </tr>
	                                        </thead>
	                                        <tbody>
	                                        	<?php 
	                                        	if ($listaPerfil!=null){
	                                        		foreach ($listaPerfil->result() as $value) { 
	                                        			//Verifico si esta en el la relaci�n de estados
	                                        			$rolPerfil=$this->FunctionsGeneral->getFieldFromTableNotIdFields(
	                                        					"ADM_ROLPERFIL",
	                                        					"ID",
	                                        					"ID_PERFIL",
	                                        					$value->ID,
	                                        					"ID_ROL",
	                                        					1);
	                                        			if($this->FunctionsGeneral->
	                                        					getQuantityFieldFromTable(
	                                        							"ADM_MODFUNROLPER",
	                                        							"ID_ROLPERFIL",
	                                        							$rolPerfil, 
	                                        							"ID_MODFUNCIONES",
	                                        							$id)>0
	                                        				){
	                                        				$temporal=CTE_VALOR_SI;
	                                        			}else{
	                                        				$temporal=CTE_VALOR_NO;
	                                        			}
	                                        			
	                                        			
	                                        			
	                                            ?>
	                                            
	                                           
	                                            <tr align="center">
	                                                <td><?= $value->NOMBRE  ?> 
	                                                	
	                                                </td>
	                                                
	                                                
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
	                <!-- Bot�n de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                		<a href="<?= base_url()?>SystemFunctionsDefine/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
                                                <i class="fa fa-arrow-left"></i>
                                                <span class="hidden-xs"> Retornar</span>
                                            </a>
                            <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
	                		<input type="hidden" name="id" id="id" value="<?= $id;?>">
	                		<input type="hidden" name="idModulo" id="idModulo" value="<?= $idModulo;?>">
                            <input type="hidden" name="valida" id="valida" value="<?= $valida;?>">
	                	</div>   
	                	<div class="col-sm-12">
	                	<br>
	                	</div> 
	                </div>
	                <!-- FIN Bot�n de envio de formulario -->
	            </form>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                
            
