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
        
		        <!-- BEGIN PAGE JQUERY ROUTINES -->
		        
		       
		        <script type="text/javascript">
		        
			         $(document).ready(function() {
			            $('#tipo').change( function(){
				            
			                if($("#tipo").val()==<?= MAIN_MODULE?>){
			                	$(".tipoModulo").show();
			                    $("#tipoModulo").prop('disabled', false);
			                    if($("#tipoModulo").val()!=1 ){
			                        $(".pagina").hide();
			                        $("#pagina").prop('disabled', true);    
			                    }else{
			                        $(".pagina").show();
			                        $("#pagina").prop('disabled', false);
			                    }
			                    $(".modulo").hide();
			                    $("#modulo").prop('disabled', true);
			                    $(".clase").show();
			                    $("#clase").prop('disabled', false);
			                    
			                }else{
			                	$(".tipoModulo").hide();
			                    $("#tipoModulo").prop('disabled', true);
			                    $(".modulo").show();
			                    $("#modulo").prop('disabled', false);
			                    $(".clase").hide();
			                    $("#clase").prop('disabled', true);
			                    $(".pagina").show();
			                    $("#pagina").prop('disabled', false);
			                }
			            });
			        });
			        $(document).ready(function() {
			            $('#tipoModulo').change( function(){
			                if($("#tipo").val()==<?= MAIN_MODULE?> ){
			                    $(".tipoModulo").show();
			                    $("#tipoModulo").prop('disabled', false);
			                    if($("#tipoModulo").val()!=1 ){
			                        $(".pagina").hide();
			                        $("#pagina").prop('disabled', true);    
			                    }else{
			                        $(".pagina").show();
			                        $("#pagina").prop('disabled', false);
			                    }
			                    $(".modulo").hide();
			                    $("#modulo").prop('disabled', true);
			                    $(".clase").show();
			                    $("#clase").prop('disabled', false);
			                    
			                }else{
			                    $(".tipoModulo").hide();
			                    $("#tipoModulo").prop('disabled', true);
			                    $(".modulo").show();
			                    $("#modulo").prop('disabled', false);
			                    $(".clase").hide();
			                    $("#clase").prop('disabled', true);
			                    $(".pagina").show();
			                    $("#pagina").prop('disabled', false);
			                }
			            });
			        });
		        
		        
				</script>
				<!-- BEGIN PAGE JQUERY ROUTINES -->
        
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <form class=" form-horizontal" role="form" 
                action="<?= base_url()?>SystemModuleDefine/saveModule" 
                id="form_sample_3" 
                method="post"       
                autocomplete="off">
	                <div class="row">
	                    <div class="col-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h4 class="card-title">Definici&oacute;n de m&oacute;dulos del sistema de informaci&oacute;n </h4>
	                                <h6 class="card-subtitle"></h6>
	                                
	                            </div>
	                            <div class="form-group">
                               		<label class="col-md-12" for="nombre">Nombre del m&oacute;dulo *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="nombre" name="nombre" 
	                                    	value="<?= $nombre ?>"
	                                        placeholder="Ej. Crear orden">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               
                               <div class="form-group">
                               		<label class="col-md-12" for="tipo">Tipo *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="tipo" name="tipo" >
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
                               
                               <div class="form-group tipoModulo" <?= $displayTipoModulo ?>>
                               		<label class="col-md-12" for="tipoModulo">Tipo m&oacute;dulo *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="tipoModulo" name="tipoModulo" <?= $disabledTipoModulo ?>>
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                                         <?php foreach ($listaTipoModulo->result() as $value) { 
                                                                        if($value->ID==$tipoMod){
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
                               
                               <div class="form-group modulo" <?= $displayModulo ?>>
                               		<label class="col-md-12" for="modulo">M&oacute;dulo asociado *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="modulo" name="modulo" <?= $disabledModulo ?>>
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                                         <?php foreach ($listaModulo as $value) { 
                                                                        if($value->ID==$modulo){
                                                                            $selected="selected='selected'";
                                                                        }else{
                                                                            $selected="";
                                                                        }
                                                                        if($value->ID_MODULO != NULL){
                                                                        	//Pinto ruta
                                                                        	$tempo=$this->FunctionsGeneral->getFieldFromTableNotId(
                                                                        			"ADM_MODNOMBRE","NOMBRE","ID_MODULO",$value->ID_MODULO)." - ";
                                                                        }else{
                                                                        	$tempo="";
                                                                        }
                                                        ?>
                                            <option value="<?= $value->ID;?>" <?=$selected ?>><?= $tempo." ".$value->NOMBRE;?></option>
                                                        <?php
                                                        }?>
                                                    </select>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               
                               <div class="form-group pagina" <?= $displayPagina ?>>
                               		<label class="col-md-12" for="pagina">P&aacute;gina del m&oacute;dulo *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="pagina" name="pagina" <?= $disabledPagina ?>
	                                    	value="<?= $pagina ?>"
	                                        placeholder="Ej. /Page/board">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               
                               <div class="form-group clase" <?= $displayClase ?>>
                               		<label class="col-md-12" for="clase">&Iacute;cono del m&oacute;dulo *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="clase" name="clase"  <?= $disabledClase ?>
	                                    	value="<?= $clase ?>"
	                                        placeholder="Ej. fa fa-cogs">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
	                        </div>   
	                    </div>
	                </div>
	                <!-- Botón de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                		<a href="<?= base_url()?>SystemModuleDefine/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
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
                
            
