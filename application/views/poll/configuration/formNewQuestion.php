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
        $arrayValor[$i] = $value->ID;
        $arrayNombre[$i] = $value->NOMBRE;
        $arrayId[$i] = $value->ID;
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
	action="<?= base_url()?>PollConfigurationDefineQuestions/saveRegister"
	id="form_sample_3" method="post" autocomplete="off">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Definici&oacute;n de preguntas</h4>


				</div>
				
				<div class="form-group">
					<label class="col-md-12" for="nombre">Nombre  corto de la pregunta* <small>Identificador corto de la pregunta</small></label>
					<div class="col-md-12">
						<input class="form-control" id="nombre" name="nombre" value="<?= $nombre;?>"
							placeholder="Ejemplo. Satisfacci&oacute;n...">
						<div class="form-control-feedback"></div>
					</div>

				</div>
				
				<div class="form-group">
					<label class="col-md-12" for="descripcion">Descripci&oacute;n  de la pregunta*</label>
					<div class="col-md-12">
						<textarea class="textarea_editor form-control" rows="5"
							id="descripcion" name="descripcion"
							placeholder="Ejemplo. El servicio prestado dentro de la Entidad..."><?= $descripcion;?></textarea>
						<div class="form-control-feedback"></div>
					</div>

				</div>
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
						<center>
							<table id="dynamic-table" class="table m-t-30 table-hover "
								style="width: 50%;">
								<thead>
									<tr>
										<th width="50%">Valor</th>
										<th width="50%">Nombre</th>
									</tr>
								</thead>
								<tbody>
                                                        <?php
                                                        
                                                        for ($i = 1; $i < MAX_LIST; $i ++) {
                                                            $k = $i - 1;
                                                            if ($k < $contadorArray) {
                                                                $tempoValor = $arrayValor[$k];
                                                                $tempoNombre = $arrayNombre[$k];
                                                                $tempoId = $arrayId[$k];
                                                            } else {
                                                                $tempoValor = '';
                                                                $tempoNombre = '';
                                                                $tempoId = '';
                                                            }
                                                            ?>

                                                        <tr
										id="fila<?= $i ?>"
										<?php
                                                            if ($i > $registros) {
                                                                $disabled = "disabled='disabled'";
                                                                echo "style=\"display:none;\"";
                                                            } else {
                                                                $disabled = "";
                                                                echo "";
                                                            }
                                                            ?>>
										<td><input type="hidden" name="id<?= $i ?>" id="id<?= $i ?>"
											value="<?= $tempoId;?>">
                                                                Respuesta <?= $i ?>
                                                            </td>
										<td><input type="text" id="valor<?= $i ?>"
											name="valor<?= $i ?>" value="<?= $tempoNombre ?>"
											class="col-md-12 " <?= $disabled ?> /></td>


									</tr>
                                                            <?php }?>
                                                    </tbody>
							</table>
						</center>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- Botón de envio de formulario -->
	<div class="row">
		<div class="col-sm-12">
			<a
				href="<?= base_url()?>PollConfigurationDefineQuestions/board"
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


