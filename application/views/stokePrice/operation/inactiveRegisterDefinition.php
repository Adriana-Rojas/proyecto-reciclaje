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
<!-- BEGIN PAGE JQUERY ROUTINES -->
<!-- ============================================================== -->


<!-- ============================================================== -->
<!-- END PAGE JQUERY ROUTINES -->
<!-- ============================================================== -->


<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<form class=" form-horizontal" role="form"
	action="<?= base_url()?>StokePriceAppStokePrice/saveInactive"
	id="form_sample_3" method="post" autocomplete="off">
	<!-- Row -->
	<div class="row">
		<!-- Column -->
		<div class="col-md-12 col-xs-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-1 col-xs-6 b-r"></div>
						<div class="col-md-2 col-xs-6 b-r">
							<strong>Cotizaci&oacute;n n&uacute;mero</strong> <br>
							<p class="text-muted"><?= $consecutivo;?></p>
						</div>
						<div class="col-md-2 col-xs-6 b-r">
							<strong>Documento de identidad</strong> <br>
							<p class="text-muted"><?= $tipoDocumento," ",$documento;?></p>
						</div>

						<div class="col-md-2 col-xs-6 b-r">
							<strong>Nombre Completo</strong> <br>
							<p class="text-muted">
								<?= $paciente;?></p>
						</div>
						<div class="col-md-2 col-xs-6 b-r">
							<strong>Responsable</strong> <br>
							<p class="text-muted"><?= $empresaCoti;?></p>
						</div>
						<div class="col-md-2 col-xs-6 b-r">
							<strong>Fecha de cotizaci&oacute;n</strong> <br>
							<p class="text-muted"><?= $fecha;?></p>
						</div>
						<div class="col-md-1 col-xs-6 b-r"></div>
					</div>
				</div>
			</div>
		</div>

		<!-- Column -->
	</div>


	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">
						<i class="fa fa-ban fa-2x"></i> Inactivar cotizaci&oacute;n
					</h5>

					<div class="form-group">
						<label class="col-md-12" for="tipificacion">Tipificaci&oacute;n *
						</label>
						<div class="col-md-12">
							<select class="form-control" id="tipificacion"
								name="tipificacion">
								<option value="">--- Seleccione una opci&oacute;n ---</option>
								<?php
                                if ($listaTipificacion != null) {
                                    foreach ($listaTipificacion->result() as $value) {
                                        ?>
                                <option value="<?= $value->ID;?>"><?= $value->NOMBRE;?></option>
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
								placeholder="Detalle la observaci&oacute;n  para inactivar la cotizaci&oacute;n "></textarea>
							<div class="form-control-feedback"></div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>


	<!-- Botón de envio de formulario -->
	<div class="row">
		<div class="col-sm-12">
			<a href="<?= base_url()?>StokePriceAppStokePrice/board"
				class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10">
				<i class="fa fa-arrow-left"></i> <span class="hidden-xs"> Retornar</span>
			</a>
			<button type="submit"
				class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
			<input type="hidden" name="id" id="id" value="<?= $id;?>">
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



