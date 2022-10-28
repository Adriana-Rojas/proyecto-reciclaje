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
$registros = 1;
error_reporting(0);
?>
<!--alerts CSS -->
<link href="<?= base_url() ?>assets/node_modules/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
<!-- Sweet-Alert  -->
<script src="<?= base_url() ?>assets/node_modules/sweetalert/sweetalert.min.js"></script>
<script src="<?= base_url() ?>assets/node_modules/sweetalert/jquery.sweet-alert.custom.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<!-- ============================================================== -->
<!-- BEGIN PAGE JQUERY ROUTINES -->
<!-- ============================================================== -->



<script>
	/**Valida los campos de acuerdo al tipo*/


	$(document).ready(function() {
		$('#proceso').change(function() {
			if ($("#proceso").val() == <?= NORMAL_PROCESS; ?>) {
				$("#convenio").prop('disabled', true);
				$(".convenio").hide();
			} else if ($("#proceso").val() == <?= BRIGADE_PROCESS; ?>) {
				$("#convenio").prop('disabled', true);
				$(".convenio").hide();
			} else if ($("#proceso").val() == <?= PARTNER_PROCESS; ?>) {
				$("#convenio").prop('disabled', false);
				$(".convenio").show();
			}
		});



	});


	$(document).ready(function() {
		$("#tipoDoc").change(function() {
			tipoDoc = $('#tipoDoc').val();
			documento = $('#documento').val();
			$.post("<?= base_url() ?>/Integration/reloadInformationUserStokePrice", {
				tipoDoc: tipoDoc,
				documento: documento
			}, function(data) {
				$("#nombres").val('');
				$("#apellidos").val('');
				$("#correo").val('');
				$("#telefono").val('');
				var tempo = data.split('|');
				if (tempo == '') {
					$(document).ready(function() {
						swal({
							title: "No existe usuario con la informaci<?= LETRA_MIN_O ?>n ingresada",
							text: "El tipo de documento y documento que ha ingresado no tienen relacionadoa con un usuario dentro de los sistemas de informaci<?= LETRA_MIN_O ?>n. Debe completar los datos del usuario.",
							type: "info",
							confirmButtonText: "Continuar",
							closeOnConfirm: true
						});
					});

				} else {
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
		$("#departamento").change(function() {
			$("#departamento option:selected").each(function() {
				departamento = $('#departamento').val();
				$.post("<?= base_url() ?>/Integration/reloadCity", {
					departamento: departamento
				}, function(data) {
					$("#ciudad").html(data);
				});
			});
		})
	});
</script>
<!-- ============================================================== -->
<!-- END PAGE JQUERY ROUTINES -->
<!-- ============================================================== -->


<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<form class=" form-horizontal" role="form" action="<?= base_url() ?>StokePriceAppStokePrice/editUser" id="form_sample_3" method="post" autocomplete="off" enctype="multipart/form-data">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">
						<i class="fa fa-id-badge  fa-2x"></i> Editar Datos</small>
					</h5>
				</div>
				<div class="form-group">
					<label class="col-md-12" for="documento">Digíte el número de documento</label>
					<div class="col-md-5">
						<input class="form-control" type="text" name="documento" id="documento" placeholder="8888888888" />
					</div>
				</div>
			</div>
		</div>
	</div>
</form>



<?php
if (isset($_POST['documento'])) {
	$documento = $_POST['documento'];
	$usuario = 'sa';
	$pass = 'cirec2020..';
	$servidor = 'LAPTOPCIREC1055\SQLEXPRESS';
	$basedatos = 'produccion';
	$info = array('Database' => $basedatos, 'UID' => $usuario, 'PWD' => $pass);
	$conn = sqlsrv_connect($servidor, $info);
	$sql1 = "SELECT *  FROM  COT_USUARIO WHERE DOCUMENTO = '$documento'";
	$stmt1 = sqlsrv_query($conn, $sql1);

	$row2 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC);
	$NOMBRES =  $this->encryption->decrypt($row2['NOMBRES']);
	$APELLIDOS =  $this->encryption->decrypt($row2['APELLIDOS']);
	$CORREO =  $this->encryption->decrypt($row2['CORREO']);
	$telefonoMovil =  $this->encryption->decrypt($row2['TELEFONO']);
	$telefonoFijo =  $this->encryption->decrypt($row2['FIJO']);
	$documentoUsuario = $row2['DOCUMENTO'];

	if ($documentoUsuario == null) { ?>


		<script language="JavaScript" type="text/javascript">
			swal({
					title: "El documento no existe",
					text: "El número de documento no tienen relación con el sistema de información.",
					type: "error",
					confirmButtonText: "Continuar"
				},
				function() {
					window.location.href = '<?php echo base_url(); ?>StokePriceAppStokePrice/editUser';
				});
		</script>


	<?php
	} else {
		$usuario = 'sa';
		$pass = 'cirec2020..';
		$servidor = 'LAPTOPCIREC1055\SQLEXPRESS';
		$basedatos = 'produccion';
		$infoEsalud = array('Database' => $basedatosEsalud, 'UID' => $usuarioEsalud, 'PWD' => $passEsalud);
		$conn2 = sqlsrv_connect($servidorEsalud, $infoEsalud);

		//echo $docu
	?>
		<form class=" form-horizontal" role="form" action="<?= base_url() ?>StokePriceAppStokePrice/editUser" id="form_sample_3" method="POST" autocomplete="off" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-12">
					<div class="card">
						<div class="card-body">
							<!--<h5 class="card-title">
							<i class="fa fa-id-badge  fa-2x"></i> Editar Datos</small>
						</h5>-->
						</div>
						<!--<div class="form-group">
							<label class="col-md-12" for="documento">Buscar documento</label>
							<div class="col-md-5">
								<input class="form-control" type="text" name="documento"
									id="documento"/>
								<button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-11 pull-right">Buscar</button>
							</div>
							
						</div>-->
						<div class="form-group">
							<label class="col-md-12" for="documento">Nombre</label>
							<div class="col-md-12">
								<input class="form-control " type="text" name="nombre" id="documento" value="<?php echo $NOMBRES; ?>" disabled />
								<input class="form-control " type="hidden" name="documento" id="documento" value="<?php echo $documento; ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12" for="nombres">Apellido</label>
							<div class="col-md-12">
								<input class="form-control " type="text" name="apellido" id="nombres" value="<?php echo $APELLIDOS; ?>" disabled />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12" for="apellidos">Correo electrónico</label>
							<div class="col-md-12">
								<input class="form-control" type="email" name="email" id="email" value="<?php echo $CORREO; ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12" for="apellidos">Teléfono móvil</label>
							<div class="col-md-12">
								<input class="form-control" type="text" name="movil" id="email" value="<?php echo $telefonoMovil; ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12" for="apellidos">Segundo teléfono</label>
							<div class="col-md-12">
								<input class="form-control" type="text" name="fijo" id="email" value="<?php echo $telefonoFijo; ?>" />
							</div>
						</div>
						<!--<div class="form-group">
							<label class="col-md-12" for="apellidos">Dirección</label>
							<div class="col-md-12">
								<input class="form-control" type="text" name="direccion"
									id="direccion" value = "<?php echo $DIRECCION; ?>"/>
							</div>
						</div>-->


						<?php
						$uno = "SELECT ID, ID_MUNICIPIO FROM COT_USUARIO where DOCUMENTO = '$documento'";

						$stmt1 = sqlsrv_query($conn, $uno);
						$row2 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC);

						$id_municipio = $row2['ID_MUNICIPIO'];
						$id_usuario = $row2['ID'];

						$dos = "SELECT ID, NOMBRE, ID_DEPARTAMENTO FROM ADM_MUNICIPIO where ID = '$id_municipio'";

						$stmt2 = sqlsrv_query($conn, $dos);
						$row3 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC);
						$id_departamento = $row3['ID_DEPARTAMENTO'];
						$nombre_municipio = $row3['NOMBRE'];
						$id_municipio = $row3['ID'];


						//Logica para extraer la orden según el usuario
						$ordenes = [];
						$querySolicitud = "SELECT ID FROM COT_SOLICITUD WHERE ID_USUARIO = '$id_usuario'";
						$ejecucionSolicitud = sqlsrv_query($conn, $querySolicitud);
						while ($resultadoSolicitud = sqlsrv_fetch_array($ejecucionSolicitud, SQLSRV_FETCH_ASSOC)) {
							if (!empty($resultadoSolicitud)) {
								$idSolicitud = $resultadoSolicitud['ID'];
								//ahora info de cotización
								$queryCotizacion = "SELECT ID FROM COT_COTIZACION WHERE ID_SOLICITUD = '$idSolicitud'";
								$ejecucionCotizacion = sqlsrv_query($conn, $queryCotizacion);
								while ($resultadoCotizacion = sqlsrv_fetch_array($ejecucionCotizacion, SQLSRV_FETCH_ASSOC)) {
									$idCotizacion = $resultadoCotizacion['ID'];
									//ahora info de orden
									$queryOrden = "SELECT * FROM ORD_ORDEN WHERE ID_COTIZACION = '$idCotizacion'";
									$ejecucionOrden = sqlsrv_query($conn, $queryOrden);

									while ($resultadoOrden = sqlsrv_fetch_array($ejecucionOrden, SQLSRV_FETCH_ASSOC)) {
										$consOrden = $resultadoOrden[''];
										$ordenes[] = $consOrden;
									}
								}
							}
						}


						$tres = "SELECT ID,NOMBRE FROM ADM_DEPARTAMENTO ";

						$stmt3 = sqlsrv_query($conn, $tres);
						$row4 = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC);
						$nombre_departamento = $row4['NOMBRE'];



						$cuarto = "SELECT ID,NOMBRE FROM ADM_DEPARTAMENTO WHERE ID = '$id_departamento'  ";

						$stmt5 = sqlsrv_query($conn, $cuarto);
						$row5 = sqlsrv_fetch_array($stmt5, SQLSRV_FETCH_ASSOC);
						$nombre_departamento_usuario = utf8_encode($row5['NOMBRE']);

						$quinto = "SELECT ID FROM COT_USUARIO WHERE DOCUMENTO = '$documento'";
						$stmt6 = sqlsrv_query($conn, $quinto);
						$row6 = sqlsrv_fetch_array($stmt6, SQLSRV_FETCH_ASSOC);
						$id_usuario = $row6['ID'];
						//echo $id_usuario;

						$sexto = "SELECT ID_EMPRESA FROM COT_SOLICITUD WHERE ID_USUARIO = '$id_usuario' ORDER BY FCREA DESC";
						$stmt7 = sqlsrv_query($conn, $sexto);
						$row7 = sqlsrv_fetch_array($stmt7, SQLSRV_FETCH_ASSOC);
						$id_empresa = utf8_encode($row7['ID_EMPRESA']);

						//echo $id_empresa;

						$septimo = "SELECT ID_EMPRESA FROM COT_TARIFAEMPRESA WHERE ID = '$id_empresa'";
						$stmt8 = sqlsrv_query($conn, $septimo);
						$row8 = sqlsrv_fetch_array($stmt8, SQLSRV_FETCH_ASSOC);
						$empresa = utf8_encode($row8['ID_EMPRESA']);



						$queryEsalud = "SELECT NOM_APB FROM T_APB WHERE ID_APB = '$empresa'";
						$stmt10 = sqlsrv_query($conn2, $queryEsalud);
						$row10 = sqlsrv_fetch_array($stmt10, SQLSRV_FETCH_ASSOC);
						$empresaEsalud = utf8_encode($row10['NOM_APB']);

						$sexto = "SELECT ID_PROCESO, ID_ALIADA FROM COT_SOLICITUD WHERE ID_USUARIO = '$id_usuario'";
						$stmt9 = sqlsrv_query($conn, $sexto);
						$row9 = sqlsrv_fetch_array($stmt9, SQLSRV_FETCH_ASSOC);
						$idUsuarioProceso = $row9['ID_PROCESO'];
						$idUsuarioAliada = $row9['ID_ALIADA'];



						$sexto = "SELECT ID, NOMBRE FROM ORD_PROCESO WHERE ID = '$idUsuarioProceso'";
						$stmt11 = sqlsrv_query($conn, $sexto);
						$row11 = sqlsrv_fetch_array($stmt11, SQLSRV_FETCH_ASSOC);
						$nombreProceso = utf8_encode($row11['NOMBRE']);
						$idProcesoConditional = $row11['ID'];




						$sexto = "SELECT ID_ALIADA, EJECUTIVO FROM COT_SOLICITUD WHERE ID_USUARIO = '$id_usuario'";
						$stmt11 = sqlsrv_query($conn, $sexto);
						$row11 = sqlsrv_fetch_array($stmt11, SQLSRV_FETCH_ASSOC);
						$nombreProcesoid = $row11['ID_ALIADA'];
						$ejecutivo = $row11['EJECUTIVO'];



						//echo $nombreProceso;  6

						$sexto = "SELECT EMPRESA FROM ADM_ALIADA WHERE ID = '$nombreProcesoid'";
						$stmt11 = sqlsrv_query($conn, $sexto);
						$row11 = sqlsrv_fetch_array($stmt11, SQLSRV_FETCH_ASSOC);
						$idnombreProceso = $row11['EMPRESA'];



						$sexto = "SELECT NOM_APB FROM T_APB WHERE ID_APB = '$idnombreProceso'";
						$stmt11 = sqlsrv_query($conn2, $sexto);
						$row11 = sqlsrv_fetch_array($stmt11, SQLSRV_FETCH_ASSOC);
						$nombreAPB = utf8_encode($row11['NOM_APB']);

						$sexto = "SELECT NOMBRES, APELLIDOS FROM ADM_USUARIO WHERE ID = '$ejecutivo'";
						$stmt12 = sqlsrv_query($conn, $sexto);
						$row12 = sqlsrv_fetch_array($stmt12, SQLSRV_FETCH_ASSOC);
						$nombresApellidosEspecialista = utf8_encode($row12['NOMBRES'] . " " . $row12['APELLIDOS']);







						?>


						<div class="form-group">
							<label class="col-md-12" for="apellidos">Departamento Actual</label>
							<div class="col-md-12">
								<input class="form-control" type="text" name="departamento" id="apellidos" value="<?php echo $nombre_departamento_usuario; ?>" disabled />
							</div>
						</div>

						<!-- este-->
						<div class="form-group">
							<label class="col-md-12" for="apellidos">Municipio Actual</label>
							<div class="col-md-12">
								<input class="form-control" type="text" name="" id="apellidos" value="<?= utf8_encode($nombre_municipio) ?>" disabled />

								<input class="form-control" type="hidden" name="municipio" id="apellidos" value="<?= $id_municipio ?>" />


							</div>
						</div>
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">
									<i class="fa fa-check-square" aria-hidden="true"></i>Ordenes actuales</small>
								</h5>
							</div>
							<div class="form-group">
								<div class="row h-100 justify-content-center align-items-center">
									<?php foreach ($ordenes as $value) : ?>
										<label class="custom-control custom-checkbox" for="orden"><?= $value ?>
											<input type="checkbox" name="ordenes[]" value="<?= $value ?>">
										</label>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12" for="departamento">Departamento de atención </label>
							<div class="col-md-12">
								<select class="form-control" id="departamento" name="departamentoNuevo" value="">
									<option value=" "></option>


									<?php
									while ($arr = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
										$id_tabladepartamento = $arr['ID'];
										$encodeNombre = utf8_encode($arr['NOMBRE']);
										echo "<option value='" . $id_tabladepartamento . "' $selected>" . $encodeNombre . "</option>";
									}
									echo "</select>";


									?>
									<div class="form-control-feedback"></div>
							</div>
						</div>
						<div class="form-group ">
							<label class="col-md-12" for="ciudad">Ciudad de atención</label>
							<div class="col-md-12">
								<select class="form-control" id="ciudad" name="ciudadNueva">
									<option value=" "></option>
									<?php
									if ($listaCiudad != null) {
										foreach ($listaCiudad->result() as $value) {


									?>
											<option value="<?= $value->ID; ?>"><?= $value->NOMBRE; ?></option>
									<?php
										}
									}
									?>
								</select>
								<div class="form-control-feedback"></div>
							</div><br>
							<div class="form-group">
								<label class="col-md-12" for="especialista">Especialista de producto</label>
								<div class="col-md-12">
									<input class="form-control" type="text" name="" id="apellidos" value="<?php echo $nombresApellidosEspecialista; ?>" disabled />
								</div>
							</div>
						</div>
					</div>
				</div>




			</div>




			</div>
			</div>
			</div>
			</div>

			<!-- Botón de envio de formulario -->
			<div class="row">
				<div class="col-sm-12">
					<button type="submit" name="Editar" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Editar</button>
				</div>
				<div class="col-sm-12">
					<br>
				</div>
			</div>
			<!-- FIN Botón de envio de formulario -->
		</form>
<?php
	}
}

?>
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->
<?php

if (isset($_POST['Editar'])) {
	//echo "hola";
	$documento = $_POST['documento'];
	$email = $_POST['email'];
	$emaile = $this->encryption->encrypt($email);
	$departamento = $_POST['departamentoNuevo'];
	$ciudad = $_POST['ciudadNueva'];
	//$proceso = $_POST['proceso'];
	//$convenio = $_POST['convenio'];
	//$orden = $POST['orden'];
	$movil = $_POST['movil'];
	$fijo = $_POST['fijo'];
	$movilEncriptado = $this->encryption->encrypt($movil);
	$fijoEncriptado = $this->encryption->encrypt($fijo);
	//$proceso = $_POST['proceso'];

	$usuario = 'sa';
	$pass = 'cirec2020..';
	$servidor = 'LAPTOPCIREC1055\SQLEXPRESS';
	$basedatos = 'produccion';
	$info = array('Database' => $basedatos, 'UID' => $usuario, 'PWD' => $pass);
	$conn = sqlsrv_connect($servidor, $info);

	foreach ($_POST['ordenes'] as $orden) {
		$queryDepartamento = "UPDATE ORD_ORDEN  SET IDDEPARTAMENTO = '$departamento' WHERE CONS = '$orden'";
		$ejecutandoUpdateDepartamento = sqlsrv_query($conn, $queryDepartamento);

		$queryMunicipio = "UPDATE ORD_ORDEN  SET IDMUNICIPIO = '$ciudad' WHERE CONS = '$orden'";
		$ejecutandoUpdateMunicipio = sqlsrv_query($conn, $queryMunicipio);
	}
	$queryEmail = "UPDATE COT_USUARIO SET CORREO = '$emaile', TELEFONO = '$movilEncriptado', FIJO = '$fijoEncriptado'  WHERE DOCUMENTO = '$documento'";
	$ejecutandoUpdateEmail = sqlsrv_query($conn, $queryEmail);


?>

	<script language="JavaScript" type="text/javascript">
		swal({
				title: "Usuario actualizado",
				text: "Se ha actualizado los datos correctamente.",
				type: "success",
				confirmButtonText: "Continuar"
			},

			function() {
				window.location.href = '<?php echo base_url(); ?>StokePriceAppStokePrice/editUser';
			});
	</script>


<?php



}	//echo $documento;
?>
