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
defined('BASEPATH') or exit('No direct script access allowed');
$registros = 1;
?>
<!--alerts CSS -->
<link
	href="<?= base_url()?>assets/node_modules/sweetalert/sweetalert.css"
	rel="stylesheet" type="text/css">
<!-- Sweet-Alert  -->
<script
	src="<?= base_url()?>assets/node_modules/sweetalert/sweetalert.min.js"></script>
<script
	src="<?= base_url()?>assets/node_modules/sweetalert/jquery.sweet-alert.custom.js"></script>


<!-- ============================================================== -->
<!-- BEGIN PAGE JQUERY ROUTINES -->
<!-- ============================================================== -->



<script>
			    
			     /**Valida los campos de acuerdo al tipo*/
			     
			     
			     $(document).ready(function() {
							$('#proceso').change( function(){
								if($("#proceso").val()==<?= NORMAL_PROCESS; ?>){
									$("#convenio").prop('disabled', true);	
									$(".convenio").hide();	
								}else if($("#proceso").val()==<?= BRIGADE_PROCESS; ?>){
									$("#convenio").prop('disabled', true);
									$(".convenio").hide();		
								}else if($("#proceso").val()==<?= PARTNER_PROCESS; ?>){
									$("#convenio").prop('disabled', false);	
									$(".convenio").show();	
								}
						    });
						});

					
			     $(document).ready(function() {
						$("#tipoDoc").change(function() {
							tipoDoc = $('#tipoDoc').val();
							documento = $('#documento').val();
		 					$.post("<?= base_url()?>/Integration/reloadInformationUserStokePrice", {
		 						tipoDoc : tipoDoc,
		 						documento : documento
		 					}, function(data) {
			 						$("#nombres").val('');
			 						$("#apellidos").val('');
			 						$("#correo").val('');
			 						$("#telefono").val('');
		 							var tempo = data.split('|');
			 						if (tempo==''){
			 							$(document).ready(function() {
				 	                        swal({
				 	                          title: "No existe usuario con la informaci<?= LETRA_MIN_O?>n ingresada",
				 	                          text: "El tipo de documento y documento que ha ingresado no tienen relacionadoa con un usuario dentro de los sistemas de informaci<?= LETRA_MIN_O?>n. Debe completar los datos del usuario.",
				 	                          type: "info",
				 	                          confirmButtonText: "Continuar",
				 	                          closeOnConfirm: true
				 	                        }
				 	                        );
				 	                    });
			 							
				 					}else{
				 						$("#nombres").val(tempo[0]);
				 						$("#apellidos").val(tempo[1]);
				 						$("#telefono").val(tempo[2]);
				 						$("#correo").val(tempo[3]);
					 				}
			 						
		 					});
						});
					});

			     /**Valida los campos de acuerdo al documento*/
			     $(document).ready(function() {
						$("#documento").change(function() {
							tipoDoc = $('#tipoDoc').val();
							documento = $('#documento').val();
		 					$.post("<?= base_url()?>/Integration/reloadInformationUserStokePrice", {
		 						tipoDoc : tipoDoc,
		 						documento : documento
		 					}, function(data) {
		 						$("#nombres").val('');
		 						$("#apellidos").val('');
		 						$("#correo").val('');
		 						$("#telefono").val('');
	 							var tempo = data.split('|');
		 						if (tempo==''){
		 							$(document).ready(function() {
			 	                        swal({
			 	                          title: "No existe usuario con la informaci<?= LETRA_MIN_O?>n ingresada",
			 	                          text: "El tipo de documento y documento que ha ingresado no tienen relacionadoa con un usuario dentro de los sistemas de informaci<?= LETRA_MIN_O?>n. Debe completar los datos del usuario.",
			 	                          type: "info",
			 	                          confirmButtonText: "Continuar",
			 	                          closeOnConfirm: true
			 	                        }
			 	                        );
			 	                    });
		 							
			 					}else{
			 						$("#nombres").val(tempo[0]);
			 						$("#apellidos").val(tempo[1]);
			 						$("#telefono").val(tempo[2]);
			 						$("#correo").val(tempo[3]);
			 						$("#direccion").val(tempo[4]);
			 						$("#fijo").val(tempo[5]);
				 				}
			 						
		 					});
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
<!-- ============================================================== -->
<!-- END PAGE JQUERY ROUTINES -->
<!-- ============================================================== -->


<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<form class=" form-horizontal" role="form"
	action="<?= base_url()?>StokePriceAppStokePrice/saveRequest"
	id="form_sample_3" method="post" autocomplete="off" enctype="multipart/form-data">

	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">
						<i class="fa fa-id-badge  fa-2x"></i> Crear solicitud de
						cotizaci&oacute;n <small> Datos generales</small>
					</h5>
					<div class="form-group">
						<label class="col-md-12" for="tipoDoc">Tipo de documento * </label>
						<div class="col-md-12">
							<select class="form-control" id="tipoDoc" name="tipoDoc">
								<option value="">--- Seleccione una opci&oacute;n ---</option>
								<?php
        if ($listaTipoDocumento != null) {
            foreach ($listaTipoDocumento as $value) {
                
	                ?>
	                                <option value="<?= $value->ID;?>"><?= $value->NOMBRE;?></option>
                                <?php
            }
        }
        ?>
                         	</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="documento">Documento * </label>
						<div class="col-md-12">
							<input class="form-control " type="text" name="documento"
								id="documento" placeholder="88888888" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="nombres">Nombres * </label>
						<div class="col-md-12">
							<input class="form-control " type="text" name="nombres"
								id="nombres" placeholder="Ej. Ana" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="apellidos">Apellidos * </label>
						<div class="col-md-12">
							<input class="form-control " type="text" name="apellidos"
								id="apellidos" placeholder="Ej. Beltr&aacute;n" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="correo">Correo electr&oacute;nico </label>
						<div class="col-md-12">
							<input class="form-control " type="email" name="correo"
								id="correo" placeholder="correo@correo.com.co" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="telefono">Tel&eacute;fono
							m&oacute;vil</label>
						<div class="col-md-12">
							<input class="form-control " type="text" name="telefono"
								id="telefono" placeholder="Ej. 4565656" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="fijo">Segund Tel&eacute;fono fijo </label>
						<div class="col-md-12">
							<input class="form-control " type="text" name="fijo" id="fijo"
								placeholder="Ej. 4565656" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="direccion">Direcci&oacute;n</label>
						<div class="col-md-12">
							<input class="form-control " type="text" name="direccion"
								id="direccion" placeholder="Ej. Cra 104 A 25 25" />
						</div>
					</div>
					<div class="form-group ">
						<label class="col-md-12" for="departamento">Departamento * </label>
						<div class="col-md-12">
							<select class="form-control" id="departamento"
								name="departamento">
								<option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            <?php
                                                            
                                                            foreach ($listaDepartamento->result() as $value) {
                                                                $selected='';
                                                               /* if ($value->ID == $departamento) {
                                                                    $selected = "selected='selected'";
                                                                } else {
                                                                    $selected = "";
                                                                }*/
                                                                ?>
                                                            <option
									value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
							<div class="form-control-feedback"></div>
						</div>
					</div>

					<div class="form-group ">
						<label class="col-md-12" for="ciudad">Ciudad (Municipio) * </label>
						<div class="col-md-12">
							<select class="form-control" id="ciudad" name="ciudad">
								<option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            <?php
                                                            if($listaCiudad!=null){
                                                            foreach ($listaCiudad->result() as $value) {
                                                                $selected='';
                                                               /* if ($value->ID == $ciudad) {
                                                                    $selected = "selected='selected'";
                                                                } else {
                                                                    $selected = "";
                                                                }*/
                                                                ?>
                                                            <option
									value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option>
                                                            <?php
                                                            }
                                                            }
                                                            ?>
                                                        </select>
							<div class="form-control-feedback"></div>
						</div>
					</div>


					<div class="form-group">
						<label class="col-md-12" for="empresa">Entidad (EPS) * </label>
						<div class="col-md-12">
							<select class="form-control" id="empresa" name="empresa">
								<option value="">--- Seleccione una opci&oacute;n ---</option>
								<?php
        if ($listaEmpresa != null) {
            foreach ($listaEmpresa as $value) {
                $empresa = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_APB", "NOM_APB", "ID_APB", $value->ID_EMPRESA);
                ?>
                                <option value="<?= $value->ID;?>"><?= $empresa." - ".$value->TARIFA;?></option>
								<?php
            }
        }
        ?>
                          	</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="proceso">Proceso * </label>
						<div class="col-md-12">
							<select class="form-control" id="proceso" name="proceso">
								<option value="">--- Seleccione una opci&oacute;n ---</option>
								<?php
        if ($listaProcesos != null) {
            foreach ($listaProcesos as $value) {
                
                ?>
                                <option value="<?= $value->ID;?>"><?= $value->NOMBRE;?></option>
								<?php
            }
        }
        ?>
                          	</select>
						</div>
					</div>
					
					<div class="form-group convenio" style="display: none;">
						<label class="col-md-12" for="convenio">Convenio (Empresa aliada)
							* </label>
						<div class="col-md-12">
							<select class="form-control" id="convenio" name="convenio"
								disabled="disabled">
								<option value="">--- Seleccione una opci&oacute;n ---</option>
								
								<?php
        if ($listaAliada != null) {
            foreach ($listaAliada as $value) {
                $empresa = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_APB", "NOM_APB", "ID_APB", $value->EMPRESA);
                ?>
                                <option value="<?= $value->ID;?>"><?= $empresa; ?></option>
								<?php
            }
        }
        ?>
                          	</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-12" for="ejecutivo">Especialista de producto * </label>
						<div class="col-md-12">
							<select class="form-control" id="ejecutivo" name="ejecutivo">
								<option value="">--- Seleccione una opci&oacute;n ---</option>
								<?php
								if ($listaUsuarios != null) {
								    foreach ($listaUsuarios as $value) {
								    	
                
                ?>
                                <option value="<?= $value->ID;?>"  ><?= $value->NOMBRES;?> <?= $value->APELLIDOS;?> (<?= $value->ID;?>)</option>
								<?php
            }
        }
        ?>
                          	</select>
						</div>
					</div>
					<div class="form-group ">
						<label class="col-md-12" for="adjunto2">Fecha y hora de solictud asegurador</label>
						<div class="col-md-12">
							<input type="datetime-local" onclick="" class="form-control " id="adjunto2"
								name="fechaCotizacion" required>
							<div class="form-control-feedback"></div>
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
					<h5 class="card-title">
						<i class="fa fa-hospital-o   fa-2x"></i> Informaci&oacute;n
						cl&iacute;nica<small> Datos espec&iacute;ficos</small>
					</h5>

					<div class="form-group ">
						<label class="col-md-12" for="adjunto2">Orden m&eacute;dica * </label>
						<div class="col-md-12">
							<input type="file" class="form-control " id="adjunto2"
								name="adjunto2" >
							<div class="form-control-feedback"></div>
						</div>
					</div>
					<div class="form-group " >
						<label class="col-md-12" for="adjunto1">Resumen de historia
							cl&iacute;nica </label>
						<div class="col-md-12">
							<input type="file" class="form-control " id="adjunto1"
								name="adjunto1" >
							<div class="form-control-feedback"></div>
						</div>
					</div>
					
					
					
				</div>
			</div>
		</div>
	</div>

	<!-- Bot�n de envio de formulario -->
	<div class="row">
		<div class="col-sm-12">
			<a href="<?= base_url()?>StokePriceAppStokePrice/board"
				class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10">
				<i class="fa fa-arrow-left"></i> <span class="hidden-xs"> Retornar</span>
			</a>
			<button type="submit"
				class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
			<input type="hidden" name="registros" id="registros"
				value="<?= $registros;?>">
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
<!--<?php echo $_POST['fechaCotizacion']; ?>-->


