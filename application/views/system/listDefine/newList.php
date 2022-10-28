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

$contadorArray=count($detLista);
if ($contadorArray>0){
	$i=0;
	foreach ($detLista as $value){
		$arrayValor[$i]=$value->VALOR;
		$arrayNombre[$i]=$value->NOMBRE;
		$arrayId[$i]=$value->ID;
		$i++;
	}
	$registros=$contadorArray;
}else{
	$registros=1;
}



?>

        		<!-- ============================================================== -->
                <!-- JavaScript para pintar campos adicionales -->
                <!-- ============================================================== -->
                
                <script type="text/javascript">
		                 $(document).ready(function(){
			                /**
			                 * Funcion para a�adir una nueva columna en la tabla
			                 */
			                $("#add").click(function(){
			                    // a�adir nueva fila usando la funcion addTableRow
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
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <form class=" form-horizontal" role="form" 
                action="<?= base_url()?>SystemListDefine/saveList" 
                id="form_sample_3" 
                method="post"       
                autocomplete="off">
	                <div class="row">
	                    <div class="col-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h4 class="card-title">Definici&oacute;n de listas </h4>
	                                <h6 class="card-subtitle">Listas de valores dentro de la aplicaci&oacute;n</h6>
	                                
	                            </div>
	                            <div class="form-group">
                               		<label class="col-md-12" for="nombre">Nombre*</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="nombre" name="nombre" 
	                                    	value="<?= $nombre ?>"
	                                        placeholder="Ej. Encabezado de la lista" <?= $readOnly ?>>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
	                           
	                           <div class="form-group">
	                               		<div class="clearfix" style="text-align:center;">
	                                    	
	                                        	<button class="btn btn-secondary btn-rounded waves-effect waves-light m-r-10 " type="button" id='add' name='add'>
	                                            	<i class="ace-icon fa fa-plus-square  bigger-110"></i>
	                                            		Adicionar
	                                            </button>
	                                            <button class="btn btn-secondary btn-rounded waves-effect waves-light m-r-10 " type="button" id='del' name='del' <?= $disabled;?>>
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
                                                            <th width="33%">Identificador</th>
                                                            <th width="33%">Valor</th>
                                                            <th width="33%">Nombre</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php for($i=1;$i<MAX_LIST;$i++){
                                                                $k=$i-1;
                                                                if($k<$contadorArray){
                                                                    $tempoValor=$arrayValor[$k];            
                                                                    $tempoId=$arrayId[$k];   
                                                                    $tempoNombre=$arrayNombre[$k];   
                                                                }else{
                                                                    $tempoValor='';
                                                                    $tempoId=''; 
                                                                    $tempoNombre='';
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
                                                                <input type="text" id="valor<?= $i ?>" name="valor<?= $i ?>" value="<?= $tempoValor ?>" class="form-control" placeholder="Ej. V" <?= $disabled ?>/>
                                                            </td>
                                                            <td>
                                                                <input type="text" id="nombre<?= $i ?>" name="nombre<?= $i ?>" value="<?= $tempoNombre ?>" class="form-control"  placeholder="Ej. Verdadero" <?= $disabled ?>/>
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
	                <!-- Bot�n de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                		<a href="<?= base_url()?><?= $mainPage;?>" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
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
	                <!-- FIN Bot�n de envio de formulario -->
	            </form>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                
            
