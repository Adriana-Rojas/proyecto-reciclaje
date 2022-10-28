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
		                $(document).ready(function() {
							$('#tipo').change( function(){
								if($("#tipo").val()!=2 ){
									$("#reproceso").val(<?= CTE_VALOR_NO?>);
									$("#bloque").val(<?= CTE_VALOR_NO?>);
								}else{
									$("#reproceso").val('');
									$("#bloque").val('');
								}
						    });
						});

		                $(document).ready(function() {
							$('#reproceso').change( function(){
								if($("#tipo").val()!=2 ){
									$("#reproceso").val(<?= CTE_VALOR_NO?>);
									$("#bloque").val(<?= CTE_VALOR_NO?>);
								}
						    });
						});
		               
		                $(document).ready(function() {
							$('#bloque').change( function(){
								if($("#tipo").val()!=2 ){
									$("#reproceso").val(<?= CTE_VALOR_NO?>);
									$("#bloque").val(<?= CTE_VALOR_NO?>);
								}
						    });
						});

		                $(document).ready(function() {
							$('#campoAdc1').change( function(){
								if($("#campoAdc1").val()!=<?= VALUE_STATE_NOT?> ){
									$(".nombreCampo1").prop('disabled', false);
									$(".nombreCampo1").show();
								}else{
									$(".nombreCampo1").prop('disabled', true);
									$(".nombreCampo1").hide();
								}

								if($("#campoAdc1").val()==52 || $("#campoAdc1").val()==54){
									$(".listaAdc1").prop('disabled', false);
									$(".listaAdc1").show();
								}else{
									$(".listaAdc1").prop('disabled', true);
									$(".listaAdc1").hide();
								}
						    });
						});

		                $(document).ready(function() {
							$('#campoAdc2').change( function(){
								if($("#campoAdc2").val()!=<?= VALUE_STATE_NOT?> ){
									$(".nombreCampo2").prop('disabled', false);
									$(".nombreCampo2").show();
								}else{
									$(".nombreCampo2").prop('disabled', true);
									$(".nombreCampo2").hide();
								}
								if($("#campoAdc2").val()==52 || $("#campoAdc2").val()==54){
									$(".listaAdc2").prop('disabled', false);
									$(".listaAdc2").show();
								}else{
									$(".listaAdc2").prop('disabled', true);
									$(".listaAdc2").hide();
								}
						    });
						});

		                $(document).ready(function() {
							$('#campoAdc3').change( function(){
								if($("#campoAdc3").val()!=<?= VALUE_STATE_NOT?> ){
									$(".nombreCampo3").prop('disabled', false);
									$(".nombreCampo3").show();
								}else{
									$(".nombreCampo3").prop('disabled', true);
									$(".nombreCampo3").hide();
								}
								if($("#campoAdc3").val()==52 || $("#campoAdc3").val()==54){
									$(".listaAdc3").prop('disabled', false);
									$(".listaAdc3").show();
								}else{
									$(".listaAdc3").prop('disabled', true);
									$(".listaAdc3").hide();
								}
						    });
						});

		                $(document).ready(function() {
							$('#campoAdc4').change( function(){
								if($("#campoAdc4").val()!=<?= VALUE_STATE_NOT?> ){
									$(".nombreCampo4").prop('disabled', false);
									$(".nombreCampo4").show();
								}else{
									$(".nombreCampo4").prop('disabled', true);
									$(".nombreCampo4").hide();
								}

								if($("#campoAdc4").val()==52 || $("#campoAdc4").val()==54){
									$(".listaAdc4").prop('disabled', false);
									$(".listaAdc4").show();
								}else{
									$(".listaAdc4").prop('disabled', true);
									$(".listaAdc4").hide();
								}
						    });
						});

		                $(document).ready(function() {
							$('#campoAdc5').change( function(){
								if($("#campoAdc5").val()!=<?= VALUE_STATE_NOT?> ){
									$(".nombreCampo5").prop('disabled', false);
									$(".nombreCampo5").show();
								}else{
									$(".nombreCampo5").prop('disabled', true);
									$(".nombreCampo5").hide();
								}

								if($("#campoAdc5").val()==52 || $("#campoAdc5").val()==54){
									$(".listaAdc5").prop('disabled', false);
									$(".listaAdc5").show();
								}else{
									$(".listaAdc5").prop('disabled', true);
									$(".listaAdc5").hide();
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
                action="<?= base_url()?><?= $pagina ?>" 
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
                               		<label class="col-md-12" for="nombre">Nombre *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="nombre" name="nombre" 
	                                    	value="<?= $nombre ?>"
	                                        placeholder="Ej. Ordenar" >
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group">
							   		<label class="col-md-12" for="icono">&Iacute;cono * <small> <?php echo 'Ver link: <a href="https://fontawesome.com/v4/icons/"  target = "blank">click </a> .';?></small></label>
									<div class="col-md-12">
	                                    <input type="text" class="form-control" id="icono" name="icono" 
	                                    	value="<?= $icono ?>"
	                                        placeholder="fa fa-home" >
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               
	                            <div class="form-group">
                               		<label class="col-md-12" for="tipo">Tipo *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="tipo" name="tipo">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaTipo->result() as $value) { 
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
                               <!-- 
                               <div class="form-group">
                               		<label class="col-md-12" for="nivel">Nivel *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="nivel" name="nivel">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                        	
	                                        </select>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                                -->
                               <div class="form-group">
                               		<label class="col-md-12" for="grupo">Grupo *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="grupo" name="grupo">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaGrupo->result() as $value) { 
                                                  	if($value->ID==$grupo){
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
                               		<label class="col-md-12" for="adjunto">Permite adjuntar documentos *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="adjunto" name="adjunto">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaSiNo as $value) { 
                                                  	if($value->ID==$adjunto){
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
                               		<label class="col-md-12" for="bloque">Permite cambios en bloque *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="bloque" name="bloque">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaSiNo as $value) { 
                                                  	if($value->ID==$bloque){
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
                               		<label class="col-md-12" for="reproceso">Permite reproceso *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="reproceso" name="reproceso">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaSiNo as $value) { 
                                                  	if($value->ID==$reproceso){
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
                               		<label class="col-md-12" for="campoAdc1">Campo Adicional 1 *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="campoAdc1" name="campoAdc1">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaAdicional as $value) { 
                                                    if($value->ID==$campoAdc1){
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
                               
                               <div class="form-group nombreCampo1" <?= $displayNombreAdc1; ?>>
                               		<label class="col-md-12" for="nombreAdc1">Nombre para el campo 1</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control nombreCampo1" id="nombreAdc1" name="nombreAdc1" 
	                                    	value="<?= $nombreAdc1 ?>"
	                                        placeholder="Fecha estimada de cierre" <?= $disabledNombreAdc1; ?>>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               
                               <div class="form-group listaAdc1" <?= $displayListaAdc1; ?>>
                               		<label class="col-md-12" for="listaAdc1">Lista Adicional 1 *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control listaAdc1" id="listaAdc1" name="listaAdc1" <?= $disabledListaAdc1; ?>>
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaComplemento as $value) { 
                                                if($value->ID==$listaAdc1){
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
                               		<label class="col-md-12" for="campoAdc2">Campo Adicional 2 *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="campoAdc2" name="campoAdc2">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaAdicional as $value) { 
                                                    if($value->ID==$campoAdc2){
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
                               
                               <div class="form-group nombreCampo2" <?= $displayNombreAdc2; ?>>
                               		<label class="col-md-12" for="nombreAdc1">Nombre para el campo 2</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control nombreCampo2" id="nombreAdc2" name="nombreAdc2" 
	                                    	value="<?= $nombreAdc2 ?>"
	                                        placeholder="Fecha estimada de cierre"  <?= $disabledNombreAdc2; ?>>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               
                               <div class="form-group listaAdc2" <?= $displayListaAdc2; ?>>
                               		<label class="col-md-12" for="listaAdc2">Lista Adicional 2 *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control listaAdc2" id="listaAdc2" name="listaAdc2" <?= $disabledListaAdc2; ?>>
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaComplemento as $value) { 
                                                if($value->ID==$listaAdc2){
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
                               		<label class="col-md-12" for="campoAdc3">Campo Adicional 3 *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="campoAdc3" name="campoAdc3">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaAdicional as $value) { 
                                                    if($value->ID==$campoAdc3){
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
                               
                               <div class="form-group nombreCampo3" <?= $displayNombreAdc3; ?>>
                               		<label class="col-md-12" for="nombreAdc3">Nombre para el campo 3</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control nombreCampo3" id="nombreAdc3" name="nombreAdc3" 
	                                    	value="<?= $nombreAdc3 ?>"
	                                        placeholder="Fecha estimada de cierre" <?= $disabledNombreAdc3; ?>>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               
                                                            
                               <div class="form-group listaAdc3" <?= $displayListaAdc3; ?>>
                               		<label class="col-md-12" for="listaAdc3">Lista Adicional 3 *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control listaAdc3" id="listaAdc3" name="listaAdc3" <?= $disabledListaAdc3; ?>>
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaComplemento as $value) { 
                                                if($value->ID==$listaAdc3){
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
                               		<label class="col-md-12" for="campoAdc4">Campo Adicional 4 *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="campoAdc4" name="campoAdc4">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaAdicional as $value) { 
                                                    if($value->ID==$campoAdc4){
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
                               
                               <div class="form-group nombreCampo4" <?= $displayNombreAdc4; ?>>
                               		<label class="col-md-12" for="nombreAdc1">Nombre para el campo 4</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control nombreCampo4" id="nombreAdc4" name="nombreAdc4" 
	                                    	value="<?= $nombreAdc4 ?>"
	                                        placeholder="Fecha estimada de cierre" <?= $disabledNombreAdc4; ?>>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               
                               <div class="form-group listaAdc4" <?= $displayListaAdc4; ?>>
                               		<label class="col-md-12" for="listaAdc4">Lista Adicional 4 *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control listaAdc4" id="listaAdc4" name="listaAdc4" <?= $disabledListaAdc4; ?>>
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaComplemento as $value) { 
                                                if($value->ID==$listaAdc4){
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
                               		<label class="col-md-12" for="campoAdc5">Campo Adicional 5 *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="campoAdc5" name="campoAdc5">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaAdicional as $value) { 
                                                    if($value->ID==$campoAdc5){
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
                               
                               <div class="form-group nombreCampo5" <?= $displayNombreAdc5; ?>>
                               		<label class="col-md-12" for="nombreAdc5">Nombre para el campo 5</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control nombreCampo5" id="nombreAdc5" name="nombreAdc5" 
	                                    	value="<?= $nombreAdc5 ?>"
	                                        placeholder="Fecha estimada de cierre" <?= $disabledNombreAdc5; ?>>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               
                               <div class="form-group listaAdc5" <?= $displayListaAdc5; ?>>
                               		<label class="col-md-12" for="listaAdc5">Lista Adicional 5 *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control listaAdc5" id="listaAdc5" name="listaAdc5" <?= $disabledListaAdc5; ?>>
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaComplemento as $value) { 
                                                if($value->ID==$listaAdc5){
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
                               
	                        </div>
	                    </div>
	                </div>
	                <!-- Bot�n de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                		<a href="<?= base_url()?>OrdersConfigurationStates/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
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
                
            
