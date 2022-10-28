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
								Estad&iacute;sticas por fondos
            					</b>
							</h3>
							
						</address>
					</div>
					<div class="pull-right text-right">
						<address>
							<h3><b>Periodo:</b>  <?= $mes;?>  <?= $ano;?>
							
							</h3>
							
							Fecha del informe: <i class="fa fa-calendar"></i> <?= cambiaHoraServer(2);?>
							
						</address>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					
					<div class="table-responsive m-t-40" style="clear: both;">
					<table class="table table-hover" >
							<thead>
								<tr>
									<th>Fondo</th>
									<th class="text-right" >Saldo inicial</th>
									<th class="text-right" >Valor Autorizado</th>
									<th class="text-right" >Saldo Actual</th>
								</tr>
							</thead>
							<tbody>
									<?php 
									if($listaFondos!=null){
									    $inicial=0;
									    $autorizado=0;
									    $actual=0;
									    foreach ($listaFondos as $value){
									
									?>
								<tr>
									<td><?= $value->NOMBRE;?></td>
									<td class="text-right" ><?php 
									
									$condicion= "and PAT_FONSAL.ID_FONDOS='".$value->ID_FONDOS."'";
									$a=monthYearBefore($mes, $ano);
									$array= $this->SponsorshipModel->selectBalanceFromFund($a[0],$a[1],$condicion);
									if($array!=null){
    									foreach ($array as $val){
    									    $temporal= $val->VALOR;
    									}
									}else{
									    $temporal=0;
									    $inicial=$inicial+$temporal;
									    
									}$inicial=$inicial+$temporal;
									echo numberFormatEvolution($temporal);
									?></td>
									
									<td class="text-right" >
									<?php 
									$array= $this->SponsorshipModel->selectSponsorShipInformationFunds($value->ID_FONDOS,$mes,$ano);
									if($array!=null){
    									foreach ($array as $val){
    									    $temporal= $val->PORCENTAJE;
    									}
    									$autorizado=$autorizado+$temporal;
    									
									}else{
									    $temporal=0;
									    $autorizado=$autorizado+$temporal;
									    
									}
									echo numberFormatEvolution($temporal);?>
									</td>
									
									
									<td class="text-right" >
									<?php
									$actual=$actual+$value->VALOR;
									echo numberFormatEvolution($value->VALOR);?>
									</td>
								</tr>	
									
									<?php 
									    }
									}
									?>
								
							</tbody>
							<tfoot>
								<tr style="background-color: silver;">
									<th>Totales</th>
									<th class="text-right" ><?= numberFormatEvolution($inicial);?></th>
									<th class="text-right" ><?= numberFormatEvolution($autorizado);?></th>
									<th class="text-right" ><?= numberFormatEvolution($actual);?></th>
								</tr>
							</tfoot>
						</table>
					</div>
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
	<a href="<?= base_url()?>SponsorshipsReportStatistics/board"
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