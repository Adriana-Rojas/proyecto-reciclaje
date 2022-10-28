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


if ($detLista!=null){
    $contadorArray=count($detLista);
	$i=0;
	foreach ($detLista as $value){
		$arrayValor[$i]=$value->VALOR;
		$arrayId[$i]=$value->ID;
		$i++;
	}
	$registros=$contadorArray;
}else{
    $contadorArray=1;
	$registros=1;
}

if($providers!=null){
    $providersArray=count($providers);
    if ($providersArray>0){
        $i=0;
        foreach ($providers as $value){
            $arrayProviders[$i]=$value->ID_PROVEEDOR;
            $i++;
        }
    }   
}


?>

        		<!-- ============================================================== -->
                <!-- JavaScript para pintar campos adicionales -->
                <!-- ============================================================== -->
                
                <script type="text/javascript">
		                $(document).ready(function() {
							$('#aplica').change( function(){
								if($("#aplica").val()!=<?= CTE_VALOR_SI ?> ){
									$(".aplica").hide();
							        $("#proveedor").prop('disabled', true);
								}else{
									$(".aplica").show();
							        $("#proveedor").prop('disabled', false);
								}
						    });
						});
		               
			            $(document).ready(function(){
			                /**
			                 * Funcion para añadir una nueva columna en la tabla
			                 */
			                $("#add").click(function(){
			                    // añadir nueva fila usando la funcion addTableRow
			                    var id =parseInt($('#registros').val())+1;
			                    $('#registros').val(id);
			                    $("#fila"+id).show(); 
			                    $("#valor"+id).prop('disabled', false);
			                    $("#nombre"+id).prop('disabled', false);
			                    if (id>1){
			                        $("#del").prop('disabled', false);
			                    }
			                });
			
			                $("#del").click(function(){
			                    var id =parseInt($('#registros').val());
			                    if (id>=2){
			                        $("#fila"+id).hide(); 
			                        $("#valor"+id).prop('disabled', false);
			                        $("#nombre"+id).prop('disabled', false);
			                        id =id-1;
			                        $('#registros').val(id);
			                    }else{
			                        $("#del").prop('disabled', true);
			                    }
			                });
			             });
			 	</script>
                
                <!-- ============================================================== -->
                <!-- FIn JavaScript para pintar campos adicionales -->
                <!-- ============================================================== -->
        	
        
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <form class=" form-horizontal" role="form" 
                action="<?= base_url()?>OrdersConfigurationGroupCharacteristics/saveRegister" 
                id="form_sample_3" 
                method="post"       
                autocomplete="off">
	                <div class="row">
	                    <div class="col-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h4 class="card-title">Definici&oacute;n de Grupos Vs Caracter&iacute;sticas </h4>
	                                <h6 class="card-subtitle">Solo se listar&aacute;n los grupos que no tienen elementos asociados</h6>
	                                
	                            </div>
	                            <div class="form-group">
                               		<label class="col-md-12" for="grupo">Grupo *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="grupo" name="grupo" 
	                                    	value="<?= $grupo ?>" readonly="readonly">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group">
                               		<label class="col-md-12" for="caracteristica">Caracter&iacute;stica *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="caracteristica" name="caracteristica" 
	                                    	value="<?= $caracteristica ?>" readonly="readonly">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group">
                               		<label class="col-md-12" for="aplica">Aplica para proveedores Espec&iacute;ficos *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="aplica" name="aplica">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaSiNo as $value) { 
                                                  	if($value->ID==$valorSINO){
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
                               <div class="form-group aplica" <?= $display;?> >
                               		<label class="col-md-12" for="proveedor[]">Proveedor *</label>
                                    <div class="col-md-12">
                                    	
    									<script src="<?= base_url()?>assets/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    									<script>
    										jQuery(document).ready(function() {
    											$(".select2").select2();
    										});
    								    </script>	
	                                    <select class="form-control  select2 select2-multiple" 
	                                    		style="width: 100%" id="proveedor" name="proveedor[]" multiple="multiple" <?= $disabled;?> >
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaProveedores->result() as $value) {
                                            		if(in_array($value->ID,$arrayProviders)){
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
	                               		<div class="clearfix" style="text-align:center;">
	                                    	
	                                        	<button class="btn btn-secondary btn-rounded waves-effect waves-light m-r-10 " type="button" id='add' name='add'>
	                                            	<i class="ace-icon fa fa-plus-square  bigger-110"></i>
	                                            		Adicionar
	                                            </button>
	                                            <button class="btn btn-secondary btn-rounded waves-effect waves-light m-r-10 " type="button" id='del' name='del' <?= $disabledDelete;?>>
	                                            	<i class="ace-icon fa fa-minus-square  bigger-110"></i>
	                                                Eliminar
	                                            </button>
	                                        
	                               		</div>
	                           </div>
	                           <div class="form-group">
	                           		<div class="clearfix" style="text-align:center;">
	                           			<center>
                                                <table id="dynamic-table" 
                                                    class="table m-t-30 table-hover " style="width: 50%; ">
                                                    <thead>
                                                        <tr>
                                                            <th width="50%">Valor</th>
                                                            <th width="50%">Nombre</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php for($i=1;$i<MAX_LIST;$i++){
                                                                $k=$i-1;
                                                                if($k<$contadorArray){
                                                                    $tempoValor=$arrayValor[$k];            
                                                                    $tempoId=$arrayId[$k];          
                                                                }else{
                                                                    $tempoValor='';
                                                                    $tempoId='';          
                                                                }
                                                        ?>

                                                        <tr id="fila<?= $i ?>"<?php 
                                                                if($i>$registros){
                                                                    $disabled="disabled='disabled'";
                                                                    echo "style=\"display:none;\""; 
                                                                }else{
                                                                    $disabled="";
                                                                    echo "";
                                                                }
                                                            ?>
                                                        >
                                                            <td>
                                                                <input type="hidden" name="id<?= $i ?>" id="id<?= $i ?>" value="<?= $tempoId;?>" >
                                                                valor relaci&oacute;n <?= $i ?>
                                                            </td>
                                                            <td>
                                                                <input type="text" id="valor<?= $i ?>" name="valor<?= $i ?>" value="<?= $tempoValor ?>" class="col-md-12 " <?= $disabled ?>/>
                                                            </td>
                                                            
                                                            
                                                        </tr>
                                                            <?php }?>
                                                    </tbody>
                                                </table>
                                            </center>
                                     </div>
	                           </div>
	                           
	                        </div>
	                    </div>
	                </div>
	                <!-- Botón de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                		<a href="<?= base_url()?>OrdersConfigurationGroupCharacteristics/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
                                                <i class="fa fa-arrow-left"></i>
                                                <span class="hidden-xs"> Retornar</span>
                                            </a>
                            <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
	                		<input type="hidden" name="id" id="id" value="<?= $id;?>">
                            <input type="hidden" name="valida" id="valida" value="<?= $valida;?>">
                            <input type="hidden" name="registros" id="registros" value="<?= $registros;?>">
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
                
            
