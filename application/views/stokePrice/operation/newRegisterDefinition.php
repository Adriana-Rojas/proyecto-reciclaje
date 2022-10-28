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




if ($evento=='edit'){
	$disabledEdit="disabled='disabled'";
}else{
	$disabledEdit="";
}

//Recorro el listado de elementos cotizados
$i=1;

if ($listaDetalle!=null){
	//print_r($listaDetalle)."hola";
	foreach ($listaDetalle as $value) {

		$codigos[$i]=$value->CODIGO;
		$cantidades[$i]=$value->CANTIDAD;
		$valores[$i]=$value->VALOR;
		$nombresElementos[$i]=$value->NOMBRE;
		$margenes[$i]=$value->MARGEN;
		//Traigo el valor en pesos
		$materialesObraLista[$i]=$value->MATERIALES;
		$manoObraLista[$i]=$value->MANOOBRA;
		$asociadosLista[$i]=$value->ASOCIADOS;
		$tipos[$i]=$value->TIPO;
		$totalesElemento[$i]=$value->VALOR * $value->CANTIDAD;
		$valuesIva[$i]=$value->IVA;
		$i++;
	}
}

//print_r($totales);
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
			    
			     /**Valida los campos de acuerdo al tipo*/
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
				 				}
			 						
		 					});
						});
					});
				 $(document).ready(function(){
		                /**
		                 * Funcion para a�adir una nueva columna en la tabla
		                 */
		                $("#add").click(function(){
		                    // a�adir nueva fila usando la funcion addTableRow
		                    var id =parseInt($('#registros').val())+1;
		                    $('#registros').val(id);
		                    $("#fila"+id).show(); 
		                    $("#codigo"+id).prop('disabled', false);
		                    $("#cantidad"+id).prop('disabled', false);
		                    if (id>1){
		                        $("#del").prop('disabled', false);
		                    }
		                });
		
		                $("#del").click(function(){
		                    var id =parseInt($('#registros').val());
		                    if (id>=2){
		                        $("#fila"+id).hide(); 
		                        $("#codigo"+id).prop('disabled', true);
		                        $("#cantidad"+id).prop('disabled', true);
		                        id =id-1;
		                        $('#registros').val(id);
		                    }else{
		                        $("#del").prop('disabled', true);
		                    }
		                });
		             });
				 $(document).ready(function() {
						$("#descuento").change(function() {
							descuento = $('#descuento').val();
							total= $('#total').val();
							tempoTotal = total;
		 					total= total - (total * parseFloat(descuento/100));
		 					$('#totalFinal').val(total);
		 					tempoTotalFinal = total;

		 					//alert( "Total "+tempo[2]);
		                    //alert( "Total final "+tempo[3]);

		                    $.post("<?= base_url()?>/Integration/reloadCostTextStokePrice", {
			                    total : tempoTotal,
			                    totalFinal : tempoTotalFinal
								}, function(data) {
		                            //alert(data);
		                            var tempo = data.split('|');
		                            $('#totalText').val(tempo[0]);
		                            $('#totalFinalText').val(tempo[1]);
		                                            			 						
		                    });
		 					
						});
					});
			
				</script>
<!-- ============================================================== -->
<!-- END PAGE JQUERY ROUTINES -->
<!-- ============================================================== -->


<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<form class=" form-horizontal" role="form" action="<?= base_url()?>StokePriceAppStokePrice/saveRegister" id="form_sample_3" method="post" autocomplete="off">

	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title"> <i class="fa fa-user  fa-2x"></i>
						Crear cotizaci&oacute;n <small>Datos generales</small>
					</h5>
					<div class="form-group">
						<label class="col-md-12" for="tipoDoc">Tipo de documento * </label>
						<div class="col-md-12">
							<select class="form-control" id="tipoDoc" name="tipoDoc" <?=$disabledEdit; ?>>
								<option value="">--- Seleccione una opci&oacute;n ---</option>
								<?php
                                if ($listaTipoDocumento != null) {
                                    foreach ($listaTipoDocumento as $value) {
                                        if ($value->ID==$tipo){
                                            $selected="selected='selected'";
                                        }else{
                                            $selected='';
                                        }
                                        
                                        ?>
                                <option value="<?= $value->ID;?>" <?= $selected; ?>><?= $value->NOMBRE;?></option>
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
							<input class="form-control " type="text" name="documento" id="documento" placeholder="88888888" value="<?= $documento;?>"  <?=$disabledEdit; ?> />
						</div>

						
					</div>
					<div class="form-group">
						<label class="col-md-12" for="nombres">Nombres * </label>
						<div class="col-md-12">
							<input class="form-control " type="text" name="nombres" id="nombres" placeholder="Ej. Ana"  value="<?= $nombres;?>" <?=$disabledEdit; ?>/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="apellidos">Apellidos * </label>
						<div class="col-md-12">
							<input class="form-control " type="text" name="apellidos" id="apellidos" placeholder="Ej. Beltr&aacute;n" value="<?= $apellidos;?>" <?=$disabledEdit; ?>/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="correo">Correo electr&oacute;nico </label>
						<div class="col-md-12">
							<input class="form-control " type="email" name="correo" id="correo" placeholder="correo@correo.com.co" value="<?= $correo;?>" <?=$disabledEdit; ?> />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="telefono">Tel&eacute;fono </label>
						<div class="col-md-12">
							<input class="form-control " type="text" name="telefono" id="telefono" placeholder="Ej. 4565656" value="<?= $telefono;?>"  <?=$disabledEdit; ?> />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-12" for="empresa">Entidad (EPS) * </label>
						<div class="col-md-12">
							<select class="form-control" id="empresa" name="empresa" <?=$disabledEdit; ?>>
								<option value="">--- Seleccione una opci&oacute;n ---</option>
								<?php
								if ($listaEmpresa != null) {
								    foreach ($listaEmpresa as $value) {
								        if ($value->ID==$empresaId){
								            $selected="selected='selected'";
								        }else{
								            $selected='';
								        }
								        $empresa= $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_APB","NOM_APB","ID_APB",$value->ID_EMPRESA);
                                        ?>
                                <option value="<?= $value->ID;?>" <?= $selected; ?>><?= $empresa." - ".$value->TARIFA;?></option>
								<?php
                                    }
                                }
                                ?>
                          	</select>
                          	<?php
                          	//}
                          	?>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-12" for="proceso">Proceso * </label>
						<div class="col-md-12">
							<select class="form-control" id="proceso" name="proceso" <?=$disabledEdit; ?>>
								<option value="">--- Seleccione una opci&oacute;n ---</option>
								<?php
									if ($listaProcesos != null) {
										foreach ($listaProcesos as $value) {
											
											if ($value->ID==$procesoId){
												$selected="selected='selected'";
											}else{
												$selected='';
											}
											?>
											<option value="<?= $value->ID;?>" <?= $selected?>><?= $value->NOMBRE;?></option>
											<?php
										}
									}
									?>

                          	</select>
				
						</div>
					</div>
					
					<div class="form-group convenio" style="<?= $display?>">
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
										if($value->ID == $aliadaId) {
											$display = "display: block";
											$selected = "selected = 'selected'";
										} else {
											$display = "display: none";
											$selected = "";
										}
										?>
                                <option value="<?= $value->ID;?>" <?= $selected?>><?= $empresa; ?></option>
								<?php
						            }
						        }
						        ?>
                          	</select>
						</div>
					</div>
					
					<div class="form-group" >
						<div class="clearfix" style="text-align:center;">
							<?php
								if ($adjunto1!=''){
							?>
							<a href="<?= base_url().STOKEPRICE_FOLDER.$adjunto1; ?>" target="_blank"
								class="btn  btn-info btn-rounded pull-left waves-effect waves-light m-r-10">
								<i class="fa fa-paperclip "></i> <span class="hidden-xs"> Resumen de historia cl&iacute;nica</span>
							</a>
							<?php
								}
							?>
							<?php
								if ($adjunto2!=''){
							?>
							<a href="<?= base_url().STOKEPRICE_FOLDER.$adjunto2; ?>" target="_blank"
								class="btn  btn-info btn-rounded pull-left waves-effect waves-light m-r-10">
								<i class="fa fa-paperclip "></i> <span class="hidden-xs"> Orden m&eacute;dica</span>
							</a>

							<?php
								}
							?>
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
					<h5 class="card-title"> <i class="fa fa-shopping-cart fa-2x"></i> Detalle de elementos, productos y servicios a cotizar</h5>
					


					<div class="form-group">
						<div class="clearfix" style="text-align:center;">
								
								<button class="btn btn-secondary btn-rounded waves-effect waves-light m-r-10 " type="button" id='add' name='add'>
									<i class="ace-icon fa fa-plus-square  bigger-110"></i>
										Adicionar
								</button>
								<a href="<?= base_url()?>StokePriceReportFromTree/board" target="_blank"
									class="btn  btn-info btn-rounded  waves-effect waves-light m-r-10">
									<i class="fa fa-th-list"></i> <span class="hidden-xs"> &Aacute;rbol de productos</span>
								</a>

								<button class="btn btn-secondary btn-rounded waves-effect waves-light m-r-10 " type="button" id='del' name='del' <?= $disabledDelete;?>>
									<i class="ace-icon fa fa-minus-square  bigger-110"></i>
									Eliminar
								</button>
							
						</div>
					</div>
	                           
	                           <div class="form-group">
	                           		<div class="clearfix" style="text-align:center;">
	                           			<!--  <center> -->
                                                <table id="dynamic-table" 
                                                    class="table m-t-30 table-hover " >
                                                    <thead>
                                                        <tr>
                                                        	<th width="10%">Detalle</th>
                                                            <th width="10%">C&oacute;digo</th>
                                                            <th width="20%">Nombre</th>
                                                            <th width="10%">Tipo</th>
                                                            <th width="10%">Margen</th>
                                                            <th width="10%">Cantidad</th>
															<th width="10%">Valor IVA</th>
                                                            <th width="10%">Valor unitario</th>
                                                            <th width="10%">Valor total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
																$totalCotizacion=0;
                                                        		for($i=1;$i<MAX_LIST;$i++){
                                                                $k=$i-1;
                                                                if ($evento=='edit'){
                                                                	if($i<=$registros){
                                                                		$codigoElemento=$codigos[$i];
                                                                		$nombreElemento=$nombresElementos[$i];
                                                                		$tipoElemento=$tipos[$i];
                                                                		$cantidadElemento=$cantidades[$i];
                                                                		$valorElemento=$valores[$i];
                                                                		$totalElemento=$cantidades[$i] * $valores[$i];
                                                                		$margen=$margenes[$i];
                                                                		$materiales=$materialesObraLista[$i];
                                                                		$manoObra=$manoObraLista[$i];
																		$asociados=$asociadosLista[$i];
																		$valueIva = $valuesIva[$i];
																		

																		
                                                                	}else{	
                                                                		$codigoElemento='';	
                                                                		$nombreElemento='';	
                                                                		$tipoElemento='';	
                                                                		$cantidadElemento='';	
                                                                		$valorElemento=0;	
                                                                		$totalElemento=0;	
                                                                		$margen='';
                                                                		$materiales=0;
                                                                		$manoObra=0;
																		$asociados=0;
																		$valueIva='';
																		
																		
                                                                	}
																	
                                                                }else{
                                                                	$codigoElemento='';
                                                                	$nombreElemento='';	
                                                                	$tipoElemento='';	
                                                                	$cantidadElemento='';	
                                                                	$valorElemento=0;	
                                                                	$totalElemento=0;
                                                                	$margen='';	
                                                                	$materiales=0;
                                                                	$manoObra=0;
																	$asociados=0;
																	$valueIva='';
																	

                                                                }
                                                                $totalCotizacion += $totalElemento;

																
//																
                                                                
                                                        ?>

                                                        <tr id="fila<?= $i ?>"<?php if($i>$registros){ $disabled="disabled='disabled'";  echo "style=\"display:none;\""; }else{ $disabled=""; echo "";}?>>
                                                        	<td align="center">
			                                                    <button type="button" id="zoom<?= $i;?>" class="btn btn-info btn-rounded" data-whatever="@mdo"><i  class="fa fa-search "></i> </button>
			                                                 </td>
			                                                 <script>
			                    

			                                                  
			                                                 </script>

                                                            <td>
                                                            	<input type="text" id="codigo<?= $i ?>" name="codigo<?= $i ?>"  class=" form-control col-md-12 " <?= $disabled;?> value="<?= $codigoElemento?>" />
                                                            </td>
                                                            <td>
                                                            	<input type="text" id="nombre<?= $i ?>" name="nombre<?= $i ?>"  class="form-control col-md-12 " readonly="readonly"  value="<?= $nombreElemento?>"/>
                                                            </td>
                                                            <td>
                                                            	<input type="text" id="tipo<?= $i ?>" name="tipo<?= $i ?>"  class="form-control col-md-12 " readonly="readonly" value="<?= $tipoElemento?>"/>
                                                            </td>
                                                            <td>
                                                            	<select class="form-control col-md-12" id="margen<?= $i ?>" name="margen<?= $i ?>">
																<option value="">--- Seleccione una opci&oacute;n ---</option>
																<?php
																	for($k=0;$k<=100;$k++){
																		if ($k== $margen){
																			$selected="selected='selected'";
																		}else{
																			$selected="";
																		}
																?>
																	<option value=<?=$k; ?> <?= $selected ?>><?=$k; ?></option>
																<?php
																	}
																?>
																</select>
                                                            </td>
                                                            <td>
                                                            	<input type="number" id="cantidad<?= $i ?>" name="cantidad<?= $i ?>"  class="form-control col-md-12 "  <?= $disabled;?> MIN=1 step="1" value="<?= $cantidadElemento?>"/>
															</td>
															<td>
																<select class="form-control" id="valueIva<?= $i ?>" name="valueIva<?= $i ?>">
																	<option value="">--- Seleccione una opci&oacute;n ---</option>
																	<?php foreach ($listaIva as $value) { 
																				if($value->ID==$valueIva){
																					$selected="selected='selected'";
																				}else{
																					$selected="";
																				}
																	?>
																	<option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option>
																	<?php
																	}?>
                                                        		</select>
															
															</td>
                                                            <td>
                                                            	<input type="text" id="unitarioText<?= $i ?>" name="unitarioText<?= $i ?>"  class=" form-control col-md-12 " readonly="readonly" value="<?= numberFormatEvolution($valorElemento)?>"/>
                                                            	
                                                            	<input type="hidden" name="unitario<?= $i ?>" id="unitario<?= $i ?>" value="<?= $valorElemento; ?>">
                                                            	
                                                            	<input type="hidden" name="materiales<?= $i ?>" id="materiales<?= $i ?>" value="<?= $materiales; ?>">
                                                            	
                                                            	<input type="hidden" name="manoobra<?= $i ?>" id="manoobra<?= $i ?>" value="<?= $manoObra; ?>">

                                                            	<input type="hidden" name="adicionales<?= $i ?>" id="adicionales<?= $i ?>" value="<?= $asociados; ?>">
                                                            </td>
                                                            <td>
                                                            	<input type="text" id="totalText<?= $i ?>" name="totalText<?= $i ?>" class="form-control col-md-12 "  readonly="readonly" value="<?= numberFormatEvolution($totalElemento);?>"/>

                                                            	<input type="hidden" name="total<?= $i ?>" id="total<?= $i ?>" value="<?= $totalElemento; ?>">
                                                            </td>
                                                        </tr>
                                                        <script>
			    												$(document).ready(function() {
                                            						$("#codigo<?= $i ?>").change(function() {
                                            							codigo = $('#codigo<?= $i ?>').val();
                                            							empresa = $('#empresa').val();
                                            							margen = $('#margen<?= $i ?>').val();
                                            		 					$.post("<?= base_url()?>/Integration/reloadInformationUserStokePriceElements", {
                                            		 						codigo : codigo,
                                            		 						empresa : empresa,
                                            		 						margen : margen
                                            		 					}, function(data) {
                                            			 						$("#nombre<?= $i ?>").val('');
                                            			 						$("#tipo<?= $i ?>").val('');
                                            			 						$("#unitario<?= $i ?>").val('');
                                            			 						$("#margen<?= $i ?>").val('');
                                            			 						$("#materiales<?= $i ?>").val('');
                                            			 						$("#manoobra<?= $i ?>").val('');
                                            			 						$("#adicionales<?= $i ?>").val('');
																				$("#valueIva<?= $i ?>").val('');
                                            		 							var tempo = data.split('|');
                                            			 						if (tempo==''){
                                            			 							$(document).ready(function() {
                                            				 	                        swal({
                                            				 	                          title: "Error en los datos",
                                            				 	                          text: "No existe elementos, productos o servicios dentro de la base de datos registros con la informaci<?= LETRA_MIN_O?>n ingresada. Por favor intentelo nuevamente..",
                                            				 	                          type: "error",
                                            				 	                          confirmButtonText: "Continuar",
                                            				 	                          closeOnConfirm: true
                                            				 	                        }
                                            				 	                        );
                                            				 	                    });
                                            			 							$("#codigo<?= $i ?>").val('');
                                            				 					}else{
                                            				 						$("#nombre<?= $i ?>").val(tempo[0]);
                                                			 						$("#tipo<?= $i ?>").val(tempo[1]);
                                                			 						$("#unitario<?= $i ?>").val(tempo[2]);
                                                			 						$("#margen<?= $i ?>").val(tempo[3]);
                                                			 						$("#materiales<?= $i ?>").val(tempo[4]);
                                                			 						$("#manoobra<?= $i ?>").val(tempo[5]);
                                                			 						$("#adicionales<?= $i ?>").val(tempo[6]);
                                                			 						$("#unitarioText<?= $i ?>").val(tempo[8]);
																					$("#valueIva<?= $i ?>").val(tempo[10]);
							

                                            					 				}
                                            			 						
                                            		 					});
                                            						});
                                            					});
																

			    												$(document).ready(function() {
                                            						$("#cantidad<?= $i ?>").change(function() {
                                            							cantidad = parseInt($('#cantidad<?= $i ?>').val());
                                            							if (cantidad==''){
                                            								cantidad=1;
                                            							}
                                            							margen = parseInt($('#margen<?= $i ?>').val());
                                            							materiales = parseInt($('#materiales<?= $i ?>').val());
                                            							manoobra = parseInt($('#manoobra<?= $i ?>').val());
                                            							adicionales =parseInt($('#adicionales<?= $i ?>').val());
																		codigo = $('#codigo<?= $i ?>').val();
                                            							empresa = $('#empresa').val();
																		
                                            							$.post("<?= base_url()?>/Integration/reloadCodeCostStokePrice", {
                                            		 						margen : margen,
                                            		 						materiales : materiales,
                                            		 						manoobra : manoobra,
                                            		 						adicionales : adicionales,
                                            		 						cantidad: cantidad,
                                            		 						codigo : codigo,
                                            		 						empresa : empresa

                                            		 					}, function(data) {
                                            		 							var tempo = data.split('|');
                                            		 							$('#total<?= $i ?>').val('');
                                            			 						$("#unitario<?= $i ?>").val(tempo[0]);
                                            			 						$("#unitarioText<?= $i ?>").val(tempo[1]);
                                            			 						
		                                            		 					$('#total<?= $i ?>').val(tempo[2]);
		                                            		 					$('#totalText<?= $i ?>').val(tempo[3]);

		                                            		 		
		                                            		 					total=
		                                            		 					<?php for($p=1;$p<MAX_LIST;$p++){?>
		                                            		 						parseInt($('#total<?= $p ?>').val())+
		                                            		 					<?php }?>
		                                            		 					+parseInt(0);
		                                            		 					totalAntes=total;
		                                            		 					
		                                            		 					$('#total').val(total);
		                                            		 					total= total - (total * parseFloat($('#descuento').val()/100));
		                                            		 					totalFinal=total;
		                                            		 					$('#totalFinal').val(total);

		                                            							$.post("<?= base_url()?>/Integration/reloadCostTextStokePrice", {
		                                            		 						total : totalAntes,
		                                            		 						totalFinal : totalFinal

		                                            		 					}, function(data) {
		                                            		 							var tempo = data.split('|');
		                                            		 							$('#totalText').val(tempo[0]);
		                                            			 						$('#totalFinalText').val(tempo[1]);
		                                            			 						
		                                            		 					});
                                            		 					});


                                            						});
                                            					});

                                            					$(document).ready(function() {
                                            						$("#margen<?= $i ?>").change(function() {
																		
                                            							cantidad = parseInt($('#cantidad<?= $i ?>').val());
																		
                                            							if (cantidad==''){
                                            								cantidad=1;
                                            							}
                                            							margen = parseInt($('#margen<?= $i ?>').val());
																		
                                            							materiales = parseInt($('#materiales<?= $i ?>').val());
                                            							manoobra = parseInt($('#manoobra<?= $i ?>').val());
                                            							adicionales =parseInt($('#adicionales<?= $i ?>').val());
																		codigo = $('#codigo<?= $i ?>').val();
                                            							empresa = $('#empresa').val();
																	
                                            							$.post("<?= base_url()?>/Integration/reloadCodeCostStokePrice", {
                                            		 						margen : margen,
                                            		 						materiales : materiales,
                                            		 						manoobra : manoobra,
                                            		 						adicionales : adicionales,
                                            		 						cantidad: cantidad,
                                            		 						codigo : codigo,
                                            		 						empresa : empresa

                                            		 					}, function(data) {
                                            		 							var tempo = data.split('|');
                                            		 							$('#total<?= $i ?>').val('');
                                            			 						$("#unitario<?= $i ?>").val(tempo[0]);
                                            			 						$("#unitarioText<?= $i ?>").val(tempo[1]);
                                            			 						
		                                            		 					$('#total<?= $i ?>').val(tempo[2]);
		                                            		 					$('#totalText<?= $i ?>').val(tempo[3]);

		                                            	
		                                            		 					total=
		                                            		 					<?php for($p=1;$p<MAX_LIST;$p++){?>
		                                            		 						parseInt($('#total<?= $p ?>').val())+
		                                            		 					<?php }?>
		                                            		 					+parseInt(0);
		                                            		 					totalAntes=total;
		                                            		 					
		                                            		 					$('#total').val(total);
		                                            		 					total= total - (total * parseFloat($('#descuento').val()/100));
		                                            		 					totalFinal=total;
		                                            		 					$('#totalFinal').val(total);

		                                            							$.post("<?= base_url()?>/Integration/reloadCostTextStokePrice", {
		                                            		 						total : totalAntes,
		                                            		 						totalFinal : totalFinal

		                                            		 					}, function(data) {
		                                            		 						
		                                            		 							var tempo = data.split('|');
		                                            		 							$('#totalText').val(tempo[0]);
		                                            			 						$('#totalFinalText').val(tempo[1]);
		                                            			 						
		                                            		 					});
                                            		 					});

																		
                                            						});
                                            					});


                                            					$(document).ready(function() {
			                                                        $("#zoom<?= $i;?>").on('click',function() {
			                                                            codigo = $('#codigo<?= $i ?>').val();
			                                                            opcion ="0";
			                                                            empresa = $('#empresa').val();
			                                                            $.post("<?= base_url()?>Integration/reloadCodeInformation", {
			                                                                codigo : codigo,
			                                                                opcion: opcion,
			                                                                empresa:empresa
			                                                                }, function(data) { 
			                                                                    tempo=  data.split('|');
			                                                                    $("#nombre").html(tempo[0]);
			                                                                    $("#descripcion").html(tempo[1]);
			                                                                    $("#despiece").html(tempo[2]);
			                                                                    $("#materiales").html(tempo[3]);
			                                                                    $("#manoobra").html(tempo[4]);
			                                                                    $("#adicionales").html(tempo[5]);
			                                                                    $("#margen").html(tempo[6]);
			                                                                    
			                                                                });
			                                                            $('#myModalDespiece').modal({
			                                                                backdrop: 'static',
			                                                                keyboard: false
			                                                            })

			                                                        });
			                                                   	}); 
                                            
                                            			     </script>
                                                        <?php }?>



                                                    </tbody>
                                                </table>
                                           <!-- </center> -->
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
					<h5 class="card-title"><i class="fa fa fa-money fa-2x"></i> Detalle final de la cotizaci&oacute;n</h5>
					<div class="form-group">
						<label class="col-md-12" for="total">Total cotizaci&oacute;n antes de descuento* </label>
						<div class="col-md-12">
							<input class="form-control " type="text" name="totalText" data-mask="$ 999,999,999.99"
								id="totalText" readonly="readonly" value="<?= numberFormatEvolution($totalCotizacion); ?>" />

								<input class="form-control " type="hidden" name="total" 
								id="total" readonly="readonly" value="<?= $totalCotizacion; ?>" />
						</div>
					</div>

					

					<div class="form-group">
						<label class="col-md-12" for="descuento">Descuento (%)* </label>
						<div class="col-md-12">
							<select class="form-control" id="descuento" name="descuento">
								<?php
								for ($i=0;$i<=100;$i++){
									if($evento=='edit'){
										if($i==$descuento){
											$selected="selected='selected'";
										}else{
											$selected="";	
										}
										
									}else{
										$selected="0";
									}
                                        
                                ?>
                                <option value="<?= $i;?>" <?= $selected; ?> ><?= $i;?></option>
                                <?php
                                   
                                }

                                //Verifico el total de la cotizaci�n
                                if($evento=='edit'){

                                	$totalFinalCotizacion=$totalCotizacion - ($totalCotizacion*($descuento/100));
                                }else{
                                	$totalFinalCotizacion=0;
                                }
                                ?>
									
                         	</select>
						</div>
					</div>
					<!--
					<div class="form-group">
						<label class="col-md-12" for="totalFinal">Total cotizaci&oacute;n * </label>
						<div class="col-md-12">
							<input class="form-control " type="hidden" name="totalFinal"
								id="totalFinal" readonly="readonly" value="<?= $totalFinalCotizacion; ?>" />

								<input class="form-control " type="text" name="totalFinalText"
								id="totalFinalText" readonly="readonly" value="<?= numberFormatEvolution($totalFinalCotizacion); ?>" />
						</div>
					</div>
					-->
					<div class="form-group">
						<label class="col-md-12" for="costoAdc">Costos adicionales* <small>Tenga en cuenta que esto se relacionar&aacute;n de manera proporcional a los productos, elementos o servicios cotizados y se incluiran al finalizar la cotizaci&oacute;n </small> </label>
						<div class="col-md-12">
							<input class="form-control " type="number" name="costoAdc"  min="0" step="1"
								id="costoAdc"  value="<?= $costoAdc;?>"/>

						</div>
					</div>
					<div class="form-group ">
						<label class="col-md-12" for="observacion">Concepto costos adicionales</label>
						<div class="col-md-12">
							<textarea rows="4" cols="100" class="form-control "
								id="observacion" name="conceptoAdicional"
								placeholder="Detalle la observaci&oacute;n de los costos adicionales"><?php if($evento=='edit'){ echo $conceptoCosAd; } ?></textarea>
							<div class="form-control-feedback"></div>
						</div>
					</div>
					<div class="form-group ">
						<div class="col-md-12">
							<input type="hidden" class="form-control " id="adjunto2"
								name="fechaCotizacion">
							<div class="form-control-feedback"></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-12" for="pago">Forma de pago * </label>
						<div class="col-md-12">
							<select class="form-control" id="pago" name="pago">
								<option value="">--- Seleccione una opci&oacute;n ---</option>
								<?php
                                if ($listaPago != null) {
                                    foreach ($listaPago->result()  as $value) {
                                    	if($evento=='edit'){
                                    		if( $value->ID==$tiempo){
                                    			$selected="selected='selected'";
                                    		}else{
                                    			$selected='';	
                                    		}
                                    	}else{
                                			$selected='';
                                    	}
                                        
                                ?>
                                <option value="<?= $value->ID;?>" <?= $selected;?> ><?= $value->NOMBRE;?></option>
                                <?php
                                    }
                                }
                                ?>
                         	</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="vigencia">Vigencia cotizaci&oacute;n * </label>
						<div class="col-md-12">
							<select class="form-control" id="vigencia" name="vigencia">
								<option value="">--- Seleccione una opci&oacute;n ---</option>
								<?php
                                if ($listaVigencia != null) {
                                    foreach ($listaVigencia->result() as $value) {
                                        if($value->ID==$vigencia){
                                            $selected="selected='selected'";
                                        }else{
                                            $selected="";
                                        }
                                        
                                        ?>
                                <option value="<?= $value->ID;?>" <?= $selected;?>><?= $value->NOMBRE;?></option>
                                <?php
                                    }
                                }
                                ?>
                         	</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-12" for="incluye">Servicios adicionales * </label>
						<div class="col-md-12">
							<select class="form-control" id="incluye" name="incluye">
								<option value="">--- Seleccione una opci&oacute;n ---</option>
								<?php
                                if ($listaVigencia != null) {
                                    foreach ($listaIncluye->result() as $value) {
                                        if($value->ID==$incluye){
                                            $selected="selected='selected'";
                                        }else{
                                            $selected="";
                                        }
                                        
                                        ?>
                                <option value="<?= $value->ID;?>" <?= $selected;?>><?= $value->NOMBRE;?></option>
                                <?php
                                    }
                                }
                                ?>
                         	</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="ejecutivo">Ejecutivo asociado * </label>
						<div class="col-md-12">
							<select class="form-control" id="ejecutivo" name="ejecutivo">
								<option value="">--- Seleccione una opci&oacute;n ---</option>
								<?php
								if ($listaUsuarios != null) {
								    foreach ($listaUsuarios as $value) {
								    	if ($value->ID== $ejecutivo){
					    					$selected="selected ='selected'";
								    	}else{
											$selected="";
								    	}
                
                ?>
                                <option value="<?= $value->ID;?>" <?= $selected ?>><?= $value->NOMBRES." " .$value->APELLIDOS;?> (<?= $value->ID;?>)</option>
								<?php
            }
        }
        ?>
                          	</select>
						</div>
					</div>


					<div class="form-group ">
						<label class="col-md-12" for="observacion">Observaci&oacute;n</label>
						<div class="col-md-12">
							<textarea rows="4" cols="100" class="form-control "
								id="observacion" name="observacion"
								placeholder="Detalle la observaci&oacute;n de la cotizaci&oacute;n "><?php if($evento=='edit'){echo $observacion;}?></textarea>
							<div class="form-control-feedback"></div>
						</div>
					</div>
					<?php if($evento=='edit'){?>
					<div class="form-group ">
						<label class="col-md-12" for="justificacion">Justificaci&oacute;n *</label>
						<div class="col-md-12">
							<textarea rows="4" cols="100" class="form-control "
								id="observacion" name="justificacion"
								placeholder="Detalle la justificaci&oacute;n de las modificaciones de la cotizaci&oacute;n "></textarea>
							<div class="form-control-feedback"></div>
						</div>
					</div>
					<?php }?>
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
			<button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar </button>
			<input type="hidden" name="registros" id="registros" value="<?= $registros;?>">
			<input type="hidden" name="idSolicitud" id="idSolicitud" value="<?= $idSolicitud;?>">
			<input type="hidden" name="id" id="id" value="<?= $id;?>">
			<input type="hidden" name="evento" id="evento" value="<?= $this->encryption->encrypt($evento);?>">
		</div>
		<div class="col-sm-12">
			<br>
		</div>
	</div>
	<!-- FIN Bot�n de envio de formulario -->
</form>


<!-- .modal -->
                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" id="myModalDespiece">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myLargeModalLabel">Detalle de la informaci&oacute;n del producto o servicio seleccionado</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times "></i></button>
                                </div>
                                <div class="modal-body" style="align:'center'" >
                                    <div class="col-lg-12 col-md-12 col-sm-312 col-xs-12">
                                        
                                            <h3 >Nombre del producto</h3>
                                            <p class="ribbon-content" id="nombre">.</p>
                                            
                                            <h3 >Descripci&oacute;n del producto</h3>
                                            <p class="ribbon-content" id="descripcion">El sistema de informaci&oacute;n est&aacute; cargando la informaci&oacute;n del producto, Por favor espere.</p>
                                            <table class="table m-t-30 table-hover " >
                                            	<tr>
                                            		<th>Costos materiales</th>
                                            		<th>Costos mano obra</th>
                                            		<th>Asociados</th>
                                            		<th>Margen de contribuci&oacute;n</th>
                                            	</tr>
                                            	<tr>
                                            		<td id="materiales">Costos materiales</td>
                                            		<td id="manoobra">Costos mano obra</td>
                                            		<td id="adicionales">Asociados</td>
                                            		<td id="margen">Margen</td>
                                            	</tr>
                                            </table>
                                            <div class="table-responsive m-t-40" id="despiece">
                                            </div>
                                        
                                        
                                    </div>
                                </div>
                                <div class="modal-footer" style="color: white;">
                                    <button type="button" class="btn  btn-rounded waves-effect text-left" data-dismiss="modal">Cerrar</button>
                                    
                                </div>
                            </div>
                            <!-- /.modal-content -->
                       </div>
                       <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

<script src="<?= base_url()?>assets/dist/js/custom.min.js"></script>
<script src="<?= base_url()?>assets/dist/js/pages/mask.js"></script>

<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->



