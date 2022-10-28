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
	action="<?= base_url()?>PollConfigurationDefinePolls/saveRegisterPoll"
	id="form_sample_3" method="post" autocomplete="off">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Selecci&oacute;n de encuesta</h4>
				</div>
				
				<div class="form-group">
					<label class="col-md-12" for="datos">Encuesta a aplicar*</label>
					<div class="col-md-12">
						<select class="form-control" id="datos" name="datos">
						<option></option>
						<?php 
						if($listaEncuesta!=null){
						  foreach ($listaEncuesta as $value) { 
                            if($value->ID==$datos){
                                $selected="selected='selected'";
                            }else{
                                $selected="";
                            }
						?>
                        <option value="<?= $value->ID;?>"  <?=$selected ?>><?= $value->NOMBRE;?></option>
                        <?php
						  }
						}?>
						</select>
						<div class="form-control-feedback"></div>
					</div>

				</div>
				
				
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


