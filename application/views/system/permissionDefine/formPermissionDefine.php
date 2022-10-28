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
	                                <h4 class="card-title">Definici&oacute;n de permisos</h4>
	                                <h6 class="card-subtitle">Identifique los diferentes permisos que se tiene definidos para el m&oacute;dulo seleccionado</h6>
	                            </div>
	                            <div class="row">
                               		<!-- Column -->
                                    
                                    <div class="col-md-3 col-lg-3 col-xlg-3">
                                        
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box bg-dark text-center">
                                                <h3 class="font-light text-white">M&oacute;dulo principal</h3>
                                                <h6 class="text-white"><?= $principal;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                     <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box bg-dark  text-center">
                                                <h3 class="font-light text-white">M&oacute;dulo</h3>
                                                <h6 class="text-white"><?= $nombre;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box bg-dark text-center">
                                                <h3 class="font-light text-white">Tipo</h3>
                                                <h6 class="text-white"><?= $tipo;?></h6>
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
                                                <th width="80%">Perfiles</th>
                                                <th >Aplica</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php 
                                            if ($listaPerfil!=null){
                                                foreach ($listaPerfil->result() as $value) { 
                                                    //Verifico si esta en el la relaci�n de estados
                                                    //Verifico si el perfil tiene el permiso dado
                                                    $rolPerfil=$this->FunctionsGeneral->getFieldFromTable("ADM_ROLPERFIL",
                                                            "ID_PERFIL",
                                                            $value->ID,
                                                            "ID_ROL",
                                                            1);
                                                    
                                                    if($this->FunctionsGeneral->getQuantityFieldFromTable(
                                                            "ADM_MODROLPER","ID_MODULO",$idModulo,"ID_ROLPERFIL",$rolPerfil)==0){
                                                        $permiso=CTE_VALOR_NO;
                                                    }else{
                                                        $permiso=CTE_VALOR_SI;
                                                    }
                                            ?>
                                            
                                           
                                            <tr align="center">
                                                <td><?= $value->NOMBRE  ?> 
                                                	
                                                </td>
                                                
                                                
                                                <td>
                                                	
                                                	<select class="form-control" id="perfil<?= $value->ID;?>" name="perfil<?= $value->ID;?>" >
			                                        	<?php 
			                                            	foreach ($listaSiNo as $opcion2) {
			                                            		if($opcion2->ID==$permiso){
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
	                		<a href="<?= base_url()?><?= $mainPage?>" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
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
	                <!-- FIN Bot�n de envio de formulario -->
	            </form>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                
            
