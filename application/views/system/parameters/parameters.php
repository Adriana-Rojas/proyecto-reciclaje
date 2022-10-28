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
					$('#pais').change( function(){
						if($("#pais").val()!=<?= CTE_PAIS_DEFECTO ?> ){
							$(".pais").hide();
					        $("#departamento").prop('disabled', true);
							$("#ciudad").prop('disabled', true);
						}else{
							$(".pais").show();
					        $("#departamento").prop('disabled', false);
							$("#ciudad").prop('disabled', false);
						}
				    });
				});
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
				<!-- BEGIN PAGE JQUERY ROUTINES -->
        
        
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <form class=" form-horizontal" role="form" 
                action="<?= base_url()?>SystemParameters/saveParameters" 
                id="form_sample_3" 
                method="post"       
                autocomplete="off">
	                <div class="row">
	                    <div class="col-sm-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h5 class="card-title"> Par&aacute;metros generales
                            <small class="font-gray">Identifique los datos generales de la empresa</small></h5>
	                                	<div class="form-group">
	                                        <label class="col-md-12" for="tipoDocumento">Tipo de documento * </label>
	                                        
	                                        <div class="col-md-12">
	                                            <select class="form-control" id="tipoDocumento" name="tipoDocumento">
                                                            <option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            <?php foreach ($listaTipoDocumento as $value) { 
                                                                        if($value->ID==$tipoDocumento){
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
                                        	<label class="col-md-12" for="documento">Documento *</label>
                                            <div class="col-md-12">
                                            	<input type="text" class="form-control" id="documento" name="documento" 
                                                                value="<?= $documento ?>"
                                                                placeholder="Documento de identificaci&oacute;n">
                                                <div class="form-control-feedback" > </div>
                                            </div>
                                         </div>
	                                    <div class="form-group">
                                        	<label class="col-md-12" for="nombre">Raz&oacute;n social * </label>
                                            <div class="col-md-12">
                                            	<input type="text" class="form-control" id="nombre" name="nombre" 
                                                                value="<?= $nombre ?>"
                                                                placeholder="Raz&oacute;n social de la empresa o entidad">
                                                <div class="form-control-feedback" > </div>
                                            </div>
                                         </div>
                                         <div class="form-group">
                                        	<label class="col-md-12" for="direccion">Direcci&oacute;n * </label>
                                            <div class="col-md-12">
                                            	<input type="text" class="form-control" id="direccion" name="direccion" 
                                                                value="<?= $direccion ?>"
                                                                placeholder=" Ej. Carrera 1 # 2 - 3. ">
                                                <div class="form-control-feedback" > </div>
                                            </div>
                                         </div>
                                         
										 <div class="form-group">
                                        	<label class="col-md-12" for="pais">Pa&iacute;s * </label>
                                            <div class="col-md-12">
                                            	<select class="form-control" id="pais" name="pais">
                                                            <option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            <?php foreach ($listaPais->result() as $value) {
                                                                        if($value->ID==$pais){
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
                                         
                                         <div class="form-group pais" <?= $display?>>
                                        	<label class="col-md-12" for="departamento">Departamento </label>
                                            <div class="col-md-12">
                                            	<select class="form-control" id="departamento" name="departamento">
                                                            <option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            <?php foreach ($listaDepartamento->result() as $value) {
                                                                            if($value->ID==$departamento){
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
                                         
                                         <div class="form-group pais" <?= $display?>>
                                        	<label class="col-md-12" for="ciudad">Ciudad (Municipio) </label>
                                            <div class="col-md-12">
                                            	<select class="form-control" id="ciudad" name="ciudad">
                                                            <option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            <?php foreach ($listaCiudad->result() as $value) {
                                                                        if($value->ID==$ciudad){
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
                                        	<label class="col-md-12" for="telefono">Tel&eacute;fono contacto * </label>
                                            <div class="col-md-12">
                                            	<input type="text" class="form-control" id="telefono" name="telefono" 
                                                                value="<?= $telefono ?>"
                                                                placeholder=" Ej. (111) 1 11 11 11.	 ">
                                                <div class="form-control-feedback" > </div>
                                            </div>
                                         </div>
                                         
                                         <div class="form-group">
                                        	<label class="col-md-12" for="correo">Correo electr&oacute;nico* </label>
                                            <div class="col-md-12">
                                            	<input type="email" class="form-control" id="correo" name="correo" 
                                                                value="<?= $correo ?>"
                                                                placeholder=" Ej. correo@ejemplo.com.	 ">
                                                <div class="form-control-feedback" > </div>
                                            </div>
                                         </div>
                                          
	                                    
	                                    <!--  <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>  -->
	                                
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="col-sm-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h5 class="card-title"> Par&aacute;metros contrase&ntilde;a
                            			<small class="font-gray">Datos generales de seguridad para las contrase&ntilde;as de acceso </small>
                            		</h5>
                            			<div class="form-group">
                                        	<label class="col-md-12" for="longitud">Longitud clave * </label>
                                            <div class="col-md-12">
                                            	<input type="number" class="form-control" id="longitud" name="longitud" 
                                                                value="<?= $longitud ?>"
                                                                placeholder=" Ingrese la longitud m&iacute;nima de la clave de usuario dentro del sistema.	 ">
                                                <div class="form-control-feedback" > </div>
                                            </div>
                                         </div>
                                         <div class="form-group">
                                        	<label class="col-md-12" for="duracion">Duraci&oacute;n de la clave * </label>
                                            <div class="col-md-12">
                                            	<input type="number" class="form-control" id="duracion" name="duracion" 
                                                                value="<?= $duracion ?>"
                                                                placeholder=" Duraci&oacute;n m&aacute;xima de la clave de la clave de usuario.	 ">
                                                <div class="form-control-feedback" > </div>
                                            </div>
                                         </div>
                                         <div class="form-group">
                                        	<label class="col-md-12" for="historico">Hist&oacute;rico de la clave * </label>
                                            <div class="col-md-12">
                                            	<input type="number" class="form-control" id="historico" name="historico" 
                                                                value="<?= $historico ?>"
                                                                placeholder=" Ingrese la cantidad de hist&oacute;rico  de la clave de usuario dentro del sistema.	 ">
                                                <div class="form-control-feedback" > </div>
                                            </div>
                                         </div>
                            
	                                	<div class="form-group">
	                                        <label class="col-md-12" for="mayusculas">May&uacute;sculas requeridas * </label>
	                                        
	                                        <div class="col-md-12">
	                                            <select class="form-control" id="mayusculas" name="mayusculas">
                                                            <option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            <?php foreach ($listaSiNo as $value) { 
                                                                        if($value->ID==$mayusculas){
                                                                            $selected="selected='selected'";
                                                                        }else{
                                                                            $selected="";
                                                                        }
                                                            ?>
                                                            <option value="<?= $value->ID;?>"  <?=$selected ?>><?= $value->NOMBRE;?></option>
                                                            <?php
                                                            }?>
                                                        </select>
	                                        </div>
	                                    </div>
	                                    <div class="form-group">
	                                        <label class="col-md-12" for="numeros">N&uacute;meros requeridos * </label>
	                                        <div class="col-md-12">
	                                            <select class="form-control" id="numeros" name="numeros">
                                                            <option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            <?php foreach ($listaSiNo as $value) { 
                                                                        if($value->ID==$numeros){
                                                                            $selected="selected='selected'";
                                                                        }else{
                                                                            $selected="";
                                                                        }
                                                            ?>
                                                            <option value="<?= $value->ID;?>"  <?=$selected ?>><?= $value->NOMBRE;?></option>
                                                            <?php
                                                            }?>
                                                        </select>
	                                        </div>
	                                    </div>
	                                    <div class="form-group">
	                                        <label class="col-md-12" for="especiales">Caracteres especiales requeridos * </label>
	                                        <div class="col-md-12">
	                                            <select class="form-control" id="especiales" name="especiales">
                                                            <option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            <?php foreach ($listaSiNo as $value) { 
                                                                        if($value->ID==$especiales){
                                                                            $selected="selected='selected'";
                                                                        }else{
                                                                            $selected="";
                                                                        }
                                                            ?>
                                                            <option value="<?= $value->ID;?>"  <?=$selected ?>><?= $value->NOMBRE;?></option>
                                                            <?php
                                                            }?>
                                                        </select>
	                                        </div>
	                                    </div>
	                                
	                            </div>
	                        </div>
	                    </div>
	                </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"> Codificaci&oacute;n Sistema Gesti&oacute;n de Calidad
                                        <small class="font-gray">Defina el c&oacute;digo de los diferentes formatos </small>
                                    </h5>
                                        <div class="form-group">
                                            <label class="col-md-12" for="cotizaciones">C&oacute;digo cotizaciones * </label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" id="cotizaciones" name="cotizaciones" 
                                                                value="<?= $cotizaciones ?>"
                                                                placeholder=" ABC-2014 Versi&oacute;n 1.   ">
                                                <div class="form-control-feedback" > </div>
                                            </div>
                                         </div>
                                        <div class="form-group">
                                            <label class="col-md-12" for="ordenes">C&oacute;digo &oacute;rdenes* </label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" id="ordenes" name="ordenes" 
                                                                value="<?= $ordenes ?>"
                                                                placeholder=" ABC-2014 Versi&oacute;n 1.   ">
                                                <div class="form-control-feedback" > </div>
                                            </div>
                                         </div>
                            
                                        
                                    
                                </div>
                            </div>
                        </div>
                    </div>


	                <!-- Botón de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                		<button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
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
                
            
