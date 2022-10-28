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


<!-- BEGIN PAGE JQUERY ROUTINES -->


<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<form class=" form-horizontal" role="form" action="<?= base_url() ?>SystemTRMDefine/saveParameters" id="form_sample_3" method="post" autocomplete="off">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title"> Definici&oacute;n de TRM
						<small class="font-gray">Identifique el valor en pesos (COP) que aplica a ka TRM de acuerdo con el cambio actual</small>
					</h5>

					<div class="form-group">
						<label class="col-md-12" for="valor">Valor *</label>
						<div class="col-md-12">
							<input type="number" class="form-control" id="valor" name="valor" value="<?= $valor ?>" placeholder="Ejemplo. 3000" min="2500" max="10000">
							<div class="form-control-feedback"> </div>
						</div>
					</div>
					<h5 style="color: navy;">TRM de hoy <?= date("Y-m-d") ?> es $ <?=  $valor ?></h5>
					<h5 style="color: navy;">TRM anterior es $ <?=  $valoranterior ?></h5>
					
					<!--  <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>  -->

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
