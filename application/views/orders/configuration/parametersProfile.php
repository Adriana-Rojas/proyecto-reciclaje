<?php

/**
 *************************************************************************
 *************************************************************************
 Creado por:                 Juan Carlos Escobar Baquero
 Correo electr�nico:           jcescobarba@gmail.com
 Creaci�n:                     27/02/2018
 Modificaci�n:                 2019/11/06
 Prop�sito: P�gina Web.
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2018 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- BEGIN PAGE JQUERY ROUTINES -->
<script type="text/javascript">
	$(document).ready(function() {
		$('#pais').change(function() {
			if ($("#pais").val() != <?= CTE_PAIS_DEFECTO ?>) {
				$(".pais").hide();
				$("#departamento").prop('disabled', true);
				$("#ciudad").prop('disabled', true);
			} else {
				$(".pais").show();
				$("#departamento").prop('disabled', false);
				$("#ciudad").prop('disabled', false);
			}
		});
	});
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js" />
</script>
<!-- BEGIN PAGE JQUERY ROUTINES -->


<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->



<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Perfil de seguimiento</h4>
				<h6 class="card-subtitle"></h6>
				<div class="table-responsive">
					<form class=" form-horizontal" role="form" action="" id="form_sample_3" method="post" autocomplete="off">
						<div class="row">
							<div class="col-sm-12">
								<div class="card">
									<div class="card-body">
										<h5 class="card-title">
											<div class="form-group ">
												<label class="col-md-12" for="perfil"></label>
												<div class="col-md-12">

													<table id="demo-foo-addrow" class="table m-t-30 table-hover " data-page-size="20">
														<thead>
															<tr>
																<th>ID</th>
																<th width="50%">Nombre</th>
																<th>Estado</th>
																<th>Acci&oacute;n</th>
															</tr>
														</thead>
														<?php
														$usuario = 'sa';
														$pass = 'cirec2020..';
														$servidor = 'LAPTOPCIREC1055\SQLEXPRESS';
														$basedatos = 'produccion';
														$info = array('Database' => $basedatos, 'UID' => $usuario, 'PWD' => $pass);
														$conn = sqlsrv_connect($servidor, $info);

														if ($conn) {
															echo "Conectado<br>";
														} else {
															echo 'No se Conecto';
															die(print_r(sqlsrv_errors(), true));
														}

														$sql = "SELECT ID, NOMBRE FROM  ADM_PERFIL";
														$stmt = sqlsrv_query($conn, $sql);
														echo ("<script>console.log($stmt);</script>");
														while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
															$ID_ROL = $row['ID'];

															$sql1 = "SELECT ESTADO, CONS  FROM  ORD_PERFILSEGUIMIENTO WHERE ID_PERFIL = '$ID_ROL'";
															$stmt1 = sqlsrv_query($conn, $sql1);
															$row2 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC);
															$ESTADO = $row2['ESTADO'];
															$CONS = $row2['CONS'];


														?>


															<tbody>

																<tr>
																	<td style="font-family: Poppins, sans-serif; 
                                                font-size: 14px; color: #212529; font-weight: lighter;"><?php echo $CONS; ?></td>
																	<td style="font-family: Poppins, sans-serif; 
                                                font-size: 14px; color: #212529; font-weight: lighter">
																		<?php echo utf8_encode(($row['NOMBRE'])); ?>
																	</td>
																	<td>


																		<?php

																		if ($ESTADO == 'S') {
																		?>
																			<span class="label label-sm label-success">Activo </span>
																		<?php
																		} else {
																		?>

																			<span class="label label-sm label-danger">Inactivo </span>
																		<?php
																		}

																		?>
																	</td>

																	<td><a role="button" href="<?= base_url() ?>OrdersConfigurationProfile/board?accion=activar&id_rol=<?php echo $ID_ROL ?>" class="btn btn-info" name="Eliminar">Activar /Inactivar</i></a></td>

																</tr>
															</tbody>
															<tfoot>

															</tfoot>
														<?php
														}
														?>
													</table>


													<div class="form-control-feedback"> </div>
												</div>
											</div>

									</div>
								</div>
							</div>
						</div>

						<!-- Bot�n de envio de formulario -->
						<div class="row">
							<div class="col-sm-12">
								<button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
							</div>
							<div class="col-sm-12">
								<br>
							</div>
						</div>
						<!-- FIN Bot�n de envio de formulario -->
					</form>


					<?php
					error_reporting(0);
					if ($_GET['accion'] == "activar") {
						$id_rol = $_GET['id_rol'];

						$sql1 = "SELECT ESTADO  FROM  ORD_PERFILSEGUIMIENTO WHERE ID_PERFIL = '$id_rol'";
						$stmt1 = sqlsrv_query($conn, $sql1);
						$row2 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC);
						$ESTADO = $row2['ESTADO'];

						if ($ESTADO == 'S') {

							$sql1 = "UPDATE ORD_PERFILSEGUIMIENTO SET ESTADO = 'N' WHERE ID_PERFIL = '$id_rol'";
							$stmt1 = sqlsrv_query($conn, $sql1);
						} else {
							$sql1 = "UPDATE ORD_PERFILSEGUIMIENTO SET ESTADO = 'S' WHERE ID_PERFIL = '$id_rol'";
							$stmt1 = sqlsrv_query($conn, $sql1);
						}


						//$query4 = mysqli_query($con, "DELETE FROM reserva where id_reserva = '$reserva' ");

					?>

						<script language="JavaScript" type="text/javascript">
							swal({
									title: "Cambio de Estado",

									text: "Se ha cambiado correctamente el estado",

									type: "success",

									confirmButtonText: "Continuar"
								},

								function() {



									window.location.href = '<?php echo base_url(); ?>OrdersConfigurationProfile/board';

								});
						</script>


					<?php
					}

					?>
				</div>
			</div>
		</div>

	</div>
</div>
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->

__
