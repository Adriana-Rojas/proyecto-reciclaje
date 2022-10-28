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
defined('BASEPATH') or exit('No direct script access allowed');

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

			<hr>
			<div class="row">
				<div class="col-md-12">
					<div class="pull-left">
						<address>
							<h3>
								&nbsp;
								<b class="text-danger">
								<?php
                                    $id = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "ID_PCTE", "TP_ID_PCTE", traslateIdToEsalud($idTipo), "NUM_ID_PCTE", $documento);
                                    $paciente= $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "PRI_NOM_PCTE", "ID_PCTE", $id) . " " . $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "SEG_NOM_PCTE", "ID_PCTE", $id) . " " . $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "PRI_APELL_PCTE", "ID_PCTE", $id) . " " . $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "SEG_APELL_PCTE", "ID_PCTE", $id);
                                    echo $paciente;
                                ?>
            					</b>
							</h3>
							<p class="text-muted m-l-5">
								<strong>Documento de identidad </strong>  <?= traslateIdToEsalud($idTipo)." ".$documento; ?>
								<br />
								<b>Cotizaci&oacute;n asociada: </b>  <?= $cotizacion;?><br /> 
							</p>
						</address>
					</div>
					<div class="pull-right text-right">
						<address>
							<h3><b  class="text-danger">Patrocinio n&uacute;mero:</b>  <?= $patrocinio;?> 
																	<?php if($estado!= ACTIVO_ESTADO){?>
																	<span class="<?= validaEstadosGeneralesPatrocinios($estado,'CLASE')?>">
                                                                    <?= validaEstadosGeneralesPatrocinios($estado,'NOMBRE') ?>
													</span>
																	<?php }?>
													<br>
							</h3>
							<h4 class="font-bold"><?= traslateIdToSponsorShipKind($tipo);?></h4>
							<i class="fa fa-calendar"></i> Fecha:  <?=  $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "FECHA", "ID", $fecha);?>
							
						</address>
					</div>
				</div>
			</div>
			
			<?php if($tipo!='1'){?>
			<div class="row">
				<div class="col-md-12">
					<h5>
						<b class="font-bold"></b> Descripci&oacute;n del patrocinio
					</h5>
					<em> <h6><?= $descripcion;?></h6></em>
				</div>
			</div>
			<?php }?>
			
			
			<?php if($estado== INACTIVO_ESTADO){?>
			<div class="row">
				<div class="col-md-12">
					<h5>
						<b class="font-bold"></b>Observaci&oacute;n frente al patrocinio
					</h5>
					<em> <h6><?= $observacion;?></h6></em>
				</div>
			</div>
			<?php }?>
			<div class="row">
				<div class="col-md-12">
					
					<div class="table-responsive m-t-40" style="clear: both;">
					<h3>
						&nbsp;<b class="text-danger"></b> Detalle de fondos
					</h3>
						<table class="table table-hover" >
							<thead>
								<tr>
									<th>Fondo</th>
									<th class="text-right" >Valor</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$patrocinado=0;
								if(count($listaFondos)>0){
								    foreach ( $listaFondos as $value){
								        $patrocinado=$patrocinado+$value->PORCENTAJE;
								
								?>
								<tr>
									<td><?= $value->NOMBRE;?></td>
									<td class="text-right"><?= numberFormatEvolution($value->PORCENTAJE);?></td>
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
					<div class="pull-right m-t-30 text-right">
						<p>Total cotizado: $ <?= numberFormatEvolution($valor);?></p>
						<p>Total patrocinado : $ <?= numberFormatEvolution($patrocinado);?></p>
						<hr>
						<h3>
							<b>Total a pagar:</b> $ <?= numberFormatEvolution($valor- $patrocinado);?>
						</h3>
					</div>
					<div class="clearfix"></div>


				</div>
			</div>
			<div class="row">
				
				<div class="col-md-12">
					<div class="pull-right m-t-30 text-right">
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<hr>
						<h4><?= $nombreUsuario;?> <?= $apellidoUsuario;?></h4>
						<h6><?= $especialidad;?></h6>
					</div>
					<div class="clearfix"></div>

				</div>

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
	<a href="<?= base_url()?>SponsorshipsAppSponsorships/board"
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