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


<form class=" form-horizontal" role="form"
	action="<?= base_url()?>OrdersConfigurationStatistics/saveRegister"
	id="form_sample_3" method="post" autocomplete="off">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">
						Selecci&oacute;n de tipo de &oacute;rdenes <small >Se debe seleccionar 2 m&iacute;nimos</small>
					</h5>
					<div class="form-group">
						<label class="col-md-12" for="tipo1">Tipo de orden 1 * </label>
						<div class="col-md-12">
							<select class="form-control" id="tipo1" name="tipo1">
								<option value="">--- Seleccione una opci&oacute;n ---</option>
                                <?php                       
                                foreach ($listaTipo->result() as $value) {
                                        if ($value->ID == $tipo1) {
                                            $selected = "selected='selected'";
                                        } else {
                                            $selected = "";
                                        }
                                ?>
                                <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option>
								<?php
                                    }
                                ?>
                            </select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="tipo2">Tipo de orden 2 * </label>
						<div class="col-md-12">
							<select class="form-control" id="tipo2" name="tipo2">
								<option value="">--- Seleccione una opci&oacute;n ---</option>
                                <?php                       
                                foreach ($listaTipo->result() as $value) {
                                        if ($value->ID == $tipo2) {
                                            $selected = "selected='selected'";
                                        } else {
                                            $selected = "";
                                        }
                                ?>
                                <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option>
								<?php
                                    }
                                ?>
                            </select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="tipo3">Tipo de orden 3  </label>
						<div class="col-md-12">
							<select class="form-control" id="tipo3" name="tipo3">
								<option value="">--- Seleccione una opci&oacute;n ---</option>
                                <?php                       
                                foreach ($listaTipo->result() as $value) {
                                        if ($value->ID == $tipo3) {
                                            $selected = "selected='selected'";
                                        } else {
                                            $selected = "";
                                        }
                                ?>
                                <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option>
								<?php
                                    }
                                ?>
                            </select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="tipo4">Tipo de orden 4  </label>
						<div class="col-md-12">
							<select class="form-control" id="tipo4" name="tipo4">
								<option value="">--- Seleccione una opci&oacute;n ---</option>
                                <?php                       
                                foreach ($listaTipo->result() as $value) {
                                        if ($value->ID == $tipo4) {
                                            $selected = "selected='selected'";
                                        } else {
                                            $selected = "";
                                        }
                                ?>
                                <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option>
								<?php
                                    }
                                ?>
                            </select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="tipo5">Tipo de orden 5  </label>
						<div class="col-md-12">
							<select class="form-control" id="tipo5" name="tipo5">
								<option value="">--- Seleccione una opci&oacute;n ---</option>
                                <?php                       
                                foreach ($listaTipo->result() as $value) {
                                        if ($value->ID == $tipo5) {
                                            $selected = "selected='selected'";
                                        } else {
                                            $selected = "";
                                        }
                                ?>
                                <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option>
								<?php
                                    }
                                ?>
                            </select>
						</div>
					</div>
					
					


					<!--  <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>  -->

				</div>
			</div>
		</div>
	</div>

	<!-- Botón de envio de formulario -->
	<div class="row">
		<div class="col-sm-12">
			<button type="submit"
				class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
		</div>
		<div class="col-sm-12">
			<br />
		</div>
	</div>
	<!-- FIN Botón de envio de formulario -->
</form>
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->


