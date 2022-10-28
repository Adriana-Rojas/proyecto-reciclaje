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

$contadorArray = count($detLista);
if ($contadorArray > 0) {
    $i = 0;
    foreach ($detLista as $value) {
        
        $arrayId[$i] = $value->ID_PREGUNTA;
        $i ++;
    }
    $registros = $contadorArray;
} else {
    $registros = 2;
}

?>

<!-- ============================================================== -->
<!-- JavaScript para pintar campos adicionales -->
<!-- ============================================================== -->

<script type="text/javascript">
		               
			            $(document).ready(function(){
			                /**
			                 * Funcion para añadir una nueva columna en la tabla
			                 */
			                $("#add").click(function(){
			                    // añadir nueva fila usando la funcion addTableRow
			                    var id =parseInt($('#registros').val())+1;
			                    $('#registros').val(id);
			                    $("#fila"+id).show(); 
			                    $("#valor"+id).prop('disabled', false);
			                    $("#nombre"+id).prop('disabled', false);
			                    if (id>1){
			                        $("#del").prop('disabled', false);
			                    }
			                });
			
			                $("#del").click(function(){
			                    var id =parseInt($('#registros').val());
			                    if (id>=2){
			                        $("#fila"+id).hide(); 
			                        $("#valor"+id).prop('disabled', false);
			                        $("#nombre"+id).prop('disabled', false);
			                        id =id-1;
			                        $('#registros').val(id);
			                    }else{
			                        $("#del").prop('disabled', true);
			                    }
			                });
			             });
			 	</script>
<link rel="stylesheet"
	href="<?= base_url()?>/assets/node_modules/html5-editor/bootstrap-wysihtml5.css" />
<!-- wysuhtml5 Plugin JavaScript -->
<script
	src="<?= base_url()?>/assets/node_modules/html5-editor/wysihtml5-0.3.0.js"></script>
<script
	src="<?= base_url()?>/assets/node_modules/html5-editor/bootstrap-wysihtml5.js"></script>
<script>
                    $(document).ready(function() {
                		$('.textarea_editor').wysihtml5();
                	});
                    </script>
<!-- ============================================================== -->
<!-- FIn JavaScript para pintar campos adicionales -->
<!-- ============================================================== -->


<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<form class=" form-horizontal" role="form"
	action="<?= base_url()?>PollConfigurationDefinePolls/saveRegister"
	id="form_sample_3" method="post" autocomplete="off">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Definici&oacute;n de encuestas</h4>


				</div>
				<div class="form-group">
					<label class="col-md-12" for="nombre">Nombre  de la encuesta*</label>
					<div class="col-md-12">
						<input class="form-control" id="nombre" name="nombre" value="<?= $nombre;?>"
							placeholder="Ejemplo. Encuesta para medir satisfacci&oacute;n del usuario...">
						<div class="form-control-feedback"></div>
					</div>

				</div>
				<div class="form-group">
					<label class="col-md-12" for="descripcion">Descripci&oacute;n  de la encuesta*</label>
					<div class="col-md-12">
						<textarea class="textarea_editor form-control" rows="5"
							id="descripcion" name="descripcion"
							placeholder="Ejemplo. El servicio prestado dentro de la Entidad..."><?= $descripcion;?></textarea>
						<div class="form-control-feedback"></div>
					</div>

				</div>
				<div class="form-group">
					<label class="col-md-12" for="datos">Se solicitan datos personales*</label>
					<div class="col-md-12">
						<select class="form-control" id="datos" name="datos">
						<option></option>
						<?php foreach ($listaSiNo as $value) { 
                                                                        if($value->ID==$datos){
                                                                            $selected="selected='selected'";
                                                                        }else{
                                                                            $selected="";
                                                                        }
                                                            ?>
                                                            <option value="<?= $value->ID;?>"  <?=$selected ?>><?= $value->NOMBRE;?></option>
                                                            <?php
                                                            }?>
						</select>
						<div class="form-control-feedback"></div>
					</div>

				</div>
				<div class="form-group">
					<label class="col-md-12" for="observacion">Se solicita observaciones*</label>
					<div class="col-md-12">
						<select class="form-control" id="observacion" name="observacion">
						<option></option>
						<?php foreach ($listaSiNo as $value) { 
                                                                        if($value->ID==$observacion){
                                                                            $selected="selected='selected'";
                                                                        }else{
                                                                            $selected="";
                                                                        }
                                                            ?>
                                                            <option value="<?= $value->ID;?>"  <?=$selected ?>><?= $value->NOMBRE;?></option>
                                                            <?php
                                                            }?>
						</select>
						<div class="form-control-feedback"></div>
					</div>

				</div>
				<?php 
				if($cantidad==0){
				?>
				<div class="form-group">
					<div class="clearfix" style="text-align: center;">

						<button
							class="btn btn-secondary btn-rounded waves-effect waves-light m-r-10 "
							type="button" id='add' name='add'>
							<i class="ace-icon fa fa-plus-square  bigger-110"></i> Adicionar
						</button>
						<button
							class="btn btn-secondary btn-rounded waves-effect waves-light m-r-10 "
							type="button" id='del' name='del' <?= $disabledDelete;?>>
							<i class="ace-icon fa fa-minus-square  bigger-110"></i> Eliminar
						</button>

					</div>
				</div>
				<div class="form-group">
					<div class="clearfix" style="text-align: center;">
						
							<table id="dynamic-table" class="table m-t-30 table-hover "
								>
								<thead>
									<tr>
										<th width="30%">Valor</th>
										<th width="70%">Pregunta</th>
									</tr>
								</thead>
								<tbody>
                                <?php
                                for ($i = 1; $i < MAX_LIST; $i ++) {
                                    $k = $i - 1;
                                    if ($k < $contadorArray) {
                                       
                                        $tempoId = $arrayId[$k];
                                    } else {
                                       
                                        $tempoId = '';
                                    }
                                ?>
									<tr id="fila<?= $i ?>" <?php if ($i > $registros) { $disabled = "disabled='disabled'"; echo "style=\"display:none;\"";} else {$disabled = "";echo "";} ?>>
										<td>Pregunta <?= $i ?></td>
										<td>
											<select class="form-control"  id="valor<?= $i ?>" name="valor<?= $i ?>" <?= $disabled ?>>
												<option></option>
												<?php 
												    foreach ($listaPreguntas as $value) { 
												        if($value->ID==$tempoId){
                                                            $selected="selected='selected'";
                                                        }else{
                                                            $selected="";
                                                        }
                                                        ?>
                                                <option value="<?= $value->ID;?>"  <?=$selected ?>><?= $value->NOMBRE;?></option>
                                                            <?php
                                                            }?>
											</select>
										</td>


									</tr>
                                                            <?php }?>
                                                    </tbody>
							</table>
						
					</div>
				</div>
				<?php 
				}else{
				?>
				<div class="form-group">
					<label class="col-md-12 text-danger" ><i CLASS="fa fa-exclamation-triangle"></i>Preguntas asociadas a la encuesta no pueden ser modificadas, ya que la encuesta ya ha sido usada. </label>
					

				</div>
				<?php 
				}
				?>
			</div>
		</div>
	</div>
	<!-- Botón de envio de formulario -->
	<div class="row">
		<div class="col-sm-12">
			<a
				href="<?= base_url()?>PollConfigurationDefinePolls/board"
				class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10">
				<i class="fa fa-arrow-left"></i> <span class="hidden-xs"> Retornar</span>
			</a>
			<button type="submit"
				class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
			<input type="hidden" name="id" id="id" value="<?= $id;?>"> <input
				type="hidden" name="valida" id="valida" value="<?= $valida;?>"> <input
				type="hidden" name="registros" id="registros"
				value="<?= $registros;?>">
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


