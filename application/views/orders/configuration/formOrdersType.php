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
							$('#clase').change( function(){
								if($("#clase").val()==3 ){
									//$("#niveles").val('20');
									$("#niveles").hide();
                                    $("#niveles").prop('disabled', true);
                                     $("#niveles").prop('readonly', true);
                                    $("#forNiveles").hide();
								}else{
									$("#niveles").val('');
									$("#niveles").show();
                                    $("#forNiveles").show();
                                    $("#niveles").prop('disabled', false);
                                     $("#niveles").prop('readonly', false);
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
                action="<?= base_url()?>OrdersConfigurationOrdersType/saveRegister" 
                id="form_sample_3" 
                method="post"       
                autocomplete="off">
	                <div class="row">
	                    <div class="col-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h4 class="card-title">Definici&oacute;n de tipos de &oacute;rdenes</h4>
	                                <h6 class="card-subtitle"></h6>
	                                
	                            </div>
	                            <div class="form-group">
                               		<label class="col-md-12" for="nombre">Nombre *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="nombre" name="nombre" 
	                                    	value="<?= $nombre ?>"
	                                        placeholder="Ej. Pr&oacute;tesis">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group">
	                           		<label class="col-md-12" for="prioridad">Prioridad * </label>
	                                <div class="col-md-12">
	                                	<select class="form-control" id="prioridad" name="prioridad">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaprioridad->result() as $value) { 
                                                                        if($value->ID==$prioridad){
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
	                           		<label class="col-md-12" for="clase">Clase * </label>
	                                <div class="col-md-12">
	                                	<select class="form-control" id="clase" name="clase">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaclase->result() as $value) { 
                                                                        if($value->ID==$clase){
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
	                           		<label class="col-md-12" for="impresion">Impresi&oacute;n * </label>
	                                <div class="col-md-12">
	                                	<select class="form-control" id="impresion" name="impresion">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaimpresion->result() as $value) { 
                                                                        if($value->ID==$impresion){
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
	                           		<label class="col-md-12" for="validado">Valida en * </label>
	                                <div class="col-md-12">
	                                	<select class="form-control" id="validado" name="validado">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listavalida->result() as $value) { 
                                                                        if($value->ID==$validado){
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
	                           		<label class="col-md-12" for="clasificacion">Clasificaci&oacute;n * </label>
	                                <div class="col-md-12">
	                                	<select class="form-control" id="clasificacion" name="clasificacion">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaclasificacion as $value) { 
                                                                        if($value->ID==$clasificacion){
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
	                                        <label class="col-md-12" for="iva">Porcentaje de iva * <small>En caso de no aplicar indique el n&uacute;mero 0</small></label>
	                                        <div class="col-md-12">
	                                            <select class="form-control" id="iva" name="iva">
                                                            <option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            <?php foreach ($listaIva as $value) { 
                                                                        if($value->ID==$iva){
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
                               		<label class="col-md-12"  for="niveles" id="forNiveles" <?php  if($niveles==0){ echo "style=\"display: none;\"";}?> >Cantidad de niveles *</label>
                                    <div class="col-md-12">
	                                    <input type="number" class="form-control" id="niveles" name="niveles" <?php  if($niveles==0){ echo $readOnly;}?>
	                                    	value="<?= $niveles ?>" max=4 min=1
	                                        placeholder="Ej. 2">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group">
                               		<label class="col-md-12" for="prefijo">Prefijo *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="prefijo" name="prefijo" 
	                                    	value="<?= $prefijo ?>"
	                                        placeholder="Ej. ORD" <?= $readOnly ?> >
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group">
                               		<label class="col-md-12" for="maximo">Cantidad M&aacute;xima *</label>
                                    <div class="col-md-12">
	                                    <input type="number" class="form-control" id="maximo" name="maximo" 
	                                    	value="<?= $maximo ?>" min=1
	                                        placeholder="Ej. 2" >
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
	                        </div> <!-- End Card -->   
	                    </div> <!-- End Col -->
	                </div> <!-- End Row -->
	                <!-- Bot�n de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                		<a href="<?= base_url()?><?= $mainPage ?>" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
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
                
            
