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
$valor=0;

//Obtengo el array para validar la empresa
$validador=companyListValidation($this, $empresaId);
//echo $validador[0]," ".$validador[1]." ".$validador[2];

?>
<!-- ============================================================== -->
<!-- JavaScript para pintar campos adicionales -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- End JavaScript para pintar campos adicionales -->
<!-- ============================================================== -->
<!-- ============================================================================================================================ -->
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<div class="row">
	<div class="col-md-12">
		<div class="card card-body printableArea">
			<img src="<?= base_url()?>/assets/images/logoCirec.png"
				width="292 px" height="96 px">
			<small style="text-align:right; "> <?= $codigoCalidad;?></small>
			<hr>
			<div class="row">
				<div class="col-md-12">
					<div class="pull-left">
						<address>
							<h3><b class="text-danger">
								<!-- &nbsp; -->
								<i class="fa fa-user "></i>  Usuario: <?= $paciente;?></b>
							</h3>
							<p class="text-muted m-l-5">
								<strong>Documento de identidad </strong>  <?= $tipoDocumento." ".$documento; ?><br />
								<b>Correo electr&oacute;nico: </b>  <?= $correoUsu;?><br /> 
								<b>Tel&eacute;fono: </b>  <?= $telefonoUsu;?><br /> 
								<strong><i class="fa fa-hospital-o "></i> Empresa: </strong> <?= $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_APB", "NOM_APB", "ID_APB",$empresaCoti) ;?><br />
								
							</p>
						</address>
					</div>
					<div class="pull-right text-right">
						<address>
							<h3><b class="text-danger">Cotizaci&oacute;n n&uacute;mero:</b>  <?= $consecutivo;?> 
																	<?php if($estado=='N'){?>
																	<span class="<?= validaEstadosGeneralesPatrocinios($estado,'CLASE')?>">
                                                                    <?= validaEstadosGeneralesPatrocinios($estado,'NOMBRE') ?>
													</span>
																	<?php }?>
													<br>
							</h3>
							<i class="fa fa-id-badge"></i> Solicitud:  <?= $solicitud;?><br>
							<i class="fa fa-calendar"></i> Fecha:  <?= date("Y/m/d H:i", strtotime($fecha));?><br>
							<i class="fa fa-clock-o "></i> Vigencia: <?= $vigencia;?><br>
							<i class="fa fa-usd"></i> Forma de pago:  <?= $pago;?><br>
							<!-- <i class="fa fa-money"></i> TRM:  <?= numberFormatEvolution($trm);?><br> -->
							
						</address>
					</div>
				</div>
			</div>
			
			
			
			
			
			<div class="row">
				<div class="col-md-12">
					
					<div class="table-responsive m-t-40" style="clear: both;">
					<h3>&nbsp;<b class="text-danger">Detalle de la cotizaci&oacute;n</b></h3>
						<table class="table table-hover" >
							<thead>
								<tr>
									<th class="text-right">C&oacute;digo</th>
									<th class="text-right" >Nombre</th>
									<th class="text-right" >Tipo</th>
									<th class="text-right" >Cantidad</th>
									<th class="text-right" >Valor unitario</th>
									<th class="text-right" >Valor IVA</th>
									<th class="text-right" >Valor total</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								if($listaDetalle!=null){
									$bandera=0;
									$valor = 0;
						            $totalDescuento=0;
						            $totalIvaFinal=0;
						            $totalNeto=0;
						            $subtotalNeto=0;
						            $subtotalDescuento=0;
									$subtotalIva=0;
									
								    foreach ( $listaDetalle as $value){
										
								    	$valUnitario=defineValorUnitario($value->VALOR,$value->CANTIDAD,$costosAdicionales/$totalProductos);
										$totalNeto +=$valUnitario;
										$subtotalNeto +=$valUnitario*$value->CANTIDAD;

					                    $valDescuento=$valUnitario* $descuento;
					                    $totalDescuento=$totalDescuento+$valDescuento;
					                    $subtotalDescuento +=$valDescuento*$value->CANTIDAD;

					                    $valorBruto=$valUnitario-$valDescuento;
					                    
										//$iva = defineIvaValue($value->ID_TIPO,$value->CODIGO,$this);
										$iva = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_DETLISTA", "VALOR", "ID", $value->IVA) / 100;

										$valorBruto=($valUnitario-$valDescuento);
										$totalIva= ($valorBruto)*$iva;
										$subtotalIva +=$totalIva*$value->CANTIDAD;
										$totalIvaFinal +=$totalIva;
										$unitarioTotal=$valorBruto+$totalIva;
										$valorTotal=($valorBruto+$totalIva)*$value->CANTIDAD;

										$valor = $valor + ($valorTotal);
								
								?>
								<tr>
									<td class="text-right">
										<?php
											$printCode= printCode($this, $validador, $value->ID,$value->CODIGO,$value->NOMBRE,$bandera);
											echo $printCode[0];
											$bandera=$printCode[1];
									 	?>
									 	
									 </td>
									<td class="text-right"><?= $printCode[2];?></td>
									<td class="text-right"><?= $value->TIPO;?></td>
									<td class="text-right"><?= numberFormatEvolution($value->CANTIDAD);?></td>
									<td class="text-right"><?= numberFormatEvolution($valUnitario);?></td>
									<td class="text-right"><?= numberFormatEvolution($totalIva);?></td>
									<td class="text-right"><?= numberFormatEvolution($valorTotal);?></td>
									
								</tr>
								<?php 
								    }
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<?php if ($descuento!= 0 || $descuento == 0){?>
			<div class="row">
				<div class="col-md-12">
					<div class="pull-right m-t-30 text-right">
						<h3>
							<b>Sub total cotizaci&oacute;n :</b> $ <?= numberFormatEvolution($subtotalNeto);?>
						</h3>
						
						<h3>
							<b>(-) Descuento:</b> $ <?= numberFormatEvolution($subtotalDescuento);?>
						</h3>

						<h3>
							<b>(+) IVA:</b> $ <?= numberFormatEvolution($subtotalIva);?>
						</h3>

						<h3>
							<b class="text-danger">Total cotizaci&oacute;n <sup>(1)</sup>: $ <?= numberFormatEvolution($valor);?></b>
						</h3>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<?php }else{ ?>
			<div class="row">
				<div class="col-md-12">
					<div class="pull-right m-t-30 text-right">
						<h3>
							<b class="text-danger">Total cotizaci&oacute;n <sup>(1)</sup>: $ <?= numberFormatEvolution($valor );?></b>
						</h3>
	
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<?php } ?>
			<?php 
			if ($bandera>0){
			?>
			<div class="row">
				<div class="col-md-12">
					<small> <sup>(**)</sup> Elemento(s) cotizado(s) no se encuentran dentro de la lista de precios establecida.</small>
				</div>
			</div>
			<?php 
			}
			?>
			
			<div class="row">
				<div class="col-md-12">
					
					<div class="table-responsive m-t-40" style="clear: both;">
					<h3>&nbsp;<b class="text-danger">Detalle de los productos o servicios</b></h3>
						<table class="table table-hover" >
							<thead>
								<tr>
									<th class="text-right">C&oacute;digo CIREC</th>
									<!-- <th class="text-right" >Nombre</th>-->
									<th class="text-right" >Descripci&oacute;n</th>
									<th class="text-right" >Tiempo de entrega</th>
									<th class="text-right" >Garantia (*)</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								if($listaDetalle!=null){
								    foreach ( $listaDetalle as $value){
								        $valor=$valor + ($value->CANTIDAD* $value->VALOR);
								
								?>
								<tr>
									<!--
									<td class="text-right"><?php
											$printCode= printCode($this, $validador, $value->ID,$value->NOMBRE,$value->CODIGO);
											echo $printCode[0];
											$bandera=$printCode[1];
									 	?></td>
									 -->
									<td class="text-right">
										<?= $value->CODIGO?>
									</td>
									<!-- <td class="text-right"><?= $value->NOMBRE;?></td>-->
									<td class="text-right"><?= $value->DESCRIPCION;?></td>
									<td class="text-right"><?php if($value->ID_TIPO=='41'){ echo "---";}else{ echo  $value->TENTREGA." d&iacute;as";};?> </td>
									<td class="text-right"><?php if($value->ID_TIPO=='41'){ echo "---";}else{ echo  $value->GARANTIA." meses";};?></td>
									
								</tr>
								<?php 
								    }
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
					
			<div class="row">
				<div class="col-md-12">
					<h5><b class="font-bold">Observaciones</b></h5>
					<h6><em> <?= $observacion;?></em></h6>
					<h5><b class="font-bold" style="color: red;">Modelo de Rehabilitaci&oacute;n CIREC de la "A a la Z"    </b> </h5>
					<h6><em> <?= $incluye;?></em></h6>
					<h5><b class="font-bold">Concepto costos adicionales</b></h5>
					<h6><em> <?= $conceptoCosAd;?></em></h6>
				</div>
			</div>
			
			
			<div class="row">
				
				<div class="col-md-12">
					<?php if($vendedor!=null){?>
					<div class="pull-left  text-right">
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<hr>
						<h4><?= $vendedor;?> </h4>
						<h6>Ejecutivo comercial</h6>
					</div>
					
					<?php }?>	
				
					<div class="pull-right text-right">
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<hr>
						<h4><?= $nombreUsuario;?> <?= $apellidoUsuario;?></h4>
						<h6><?= $especialidad;?></h6>
					</div>
					

				</div>

			</div>
			
			<div class="row text-center">
				<div class="col-md-12"><small> <sup>(1)</sup> Cotizaci&oacute;n sujeta a cambios seg&uacute;n valoraci&oacute;n del usuario.</small> </div>
				
			</div>
			<hr>
			<div class="row text-center">
				<div class="col-md-12">
                            		 <?= $empresa;?>
                            	</div>

			</div>
			<div class="row text-center">
				<div class="col-md-4">
					<small><i class='fa fa-map-marker '></i> <?= $direccion;?></small>
				</div>
				<div class="col-md-4">
					<small><i class='fa fa-phone-square '></i> <?= $telefono;?></small>
				</div>
				<div class="col-md-4">
					<small><i class='fa fa-envelope '></i> <?= $correo;?></small>
				</div>
			</div>
			
		</div>
	</div>
</div>
<div class="text-right">
	<a href="<?= base_url()?>StokePriceAppStokePrice/board"
		class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10">
		<i class="fa fa-arrow-left"></i> <span class="hidden-xs"> Retornar</span>
	</a>
	<button id="print" class="btn btn-default btn-rounded" type="button">
		<span><i class="fa fa-print"></i> Imprimir</span>
	</button>
</div>
<br>
<script src="<?= base_url()?>/assets/dist/js/pages/jquery.PrintArea.js"
	type="text/JavaScript"></script>
<script>
			    $(document).ready(function() {
			        $("#print").click(function() {
			            var mode = 'iframe'; //popup
			            var close = mode == "popup";
			            var options = {
			                mode: mode,
			                popClose: close
			            };
			            $("div.printableArea").printArea(options);
			        });
			    });
			    </script>


<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->
