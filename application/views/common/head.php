<?php

/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						P�gina Web.
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2018 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');
if ($clase == 'succes') {
	$boton = ' blue';
} else {
	$boton = '-' . $clase;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/images/favicon.png">
	<title><?= showTittleAplication(); ?></title>

	<!-- Custom CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/node_modules/dropify/dist/css/dropify.min.css">
	<link href="<?= base_url() ?>assets/dist/css/style.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/dist/css/pages/ribbon-page.css" rel="stylesheet">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	<!-- BEGIN PAGE VALIDATE PLUGINS -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js">
	</script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.min.js"></script>
	<!-- END PAGE VALIDATE PLUGINS-->

	<!-- Footable CSS -->
	<link href="<?= base_url() ?>assets/node_modules/footable/css/footable.core.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/node_modules/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />

	<!-- page css -->
	<link href="<?= base_url() ?>assets/dist/css/pages/footable-page.css" rel="stylesheet">

	<!-- icheck -->
	<link href="<?= base_url() ?>assets/node_modules/icheck/skins/all.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/dist/css/pages/form-icheck.css" rel="stylesheet">
	<script src="<?= base_url() ?>assets/node_modules/icheck/icheck.min.js"></script>
	<script src="<?= base_url() ?>assets/node_modules/icheck/icheck.init.js"></script>
	<!-- icheck -->

	<!-- Footable -->
	<script src="<?= base_url() ?>assets/node_modules/footable/js/footable.all.min.js"></script>
	<!--FooTable init-->
	<script src="<?= base_url() ?>assets/dist/js/pages/footable-init.js"></script>

	<!--select2 -->
	<link href="<?= base_url() ?>assets/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>assets/dist/css/pages/other-pages.css" rel="stylesheet">

	<?php
	if ($validador == 1) {

	?>
		<!-- BEGIN PAGE SWEET ALERT PLUGINS-->
		<!--alerts CSS -->
		<link href="<?= base_url() ?>assets/node_modules/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
		<!-- Sweet-Alert  -->
		<script src="<?= base_url() ?>assets/node_modules/sweetalert/sweetalert.min.js"></script>
		<script src="<?= base_url() ?>assets/node_modules/sweetalert/jquery.sweet-alert.custom.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				swal({
					title: "<?= $titulo ?>",
					text: "<?= $mensaje ?>",
					type: "<?= $clase ?>",
					confirmButtonClass: "btn<?= $boton ?>",
					confirmButtonText: "Continuar",
					closeOnConfirm: true
				});
			});
		</script>
		<!-- END PAGE SWEET ALERT PLUGINS-->
	<?php
	}
	?>
	<?php
	if ($idTabla != '') {

	?>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/autofill/2.1.2/css/autoFill.bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/colreorder/1.3.2/css/colReorder.bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/3.2.2/css/fixedColumns.bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/keytable/2.1.3/css/keyTable.bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.1.2/css/rowReorder.bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/scroller/1.4.2/css/scroller.bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.0/css/select.bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css" />

		<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.flash.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.print.min.js"></script>

		<script>
			$(document).ready(function() {
				$('#<?= $idTabla; ?>').DataTable({
					"language": {
						"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
					},
					"paging": true,
					"lengthChange": true,
					"searching": true,
					"ordering": true,
					"info": true,
					"autoWidth": true,

					"dom": 'Bfrtip',
					"buttons": [
						'excel', {
							extend: 'pdfHtml5',
							orientation: 'landscape',
							pageSize: 'LEGAL'
						}, 'print'
					]
				});
				$("div.toolbar").html('<b>Custom tool bar! Text/images etc.</b>');


			});
		</script>
	<?php
	}
	?>
	<?php
	if ($dateValue != '') {
	?>

		<!-- Date picker plugins css -->
		<link href="<?= base_url() ?>assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
		<!-- Daterange picker plugins css -->
		<link href="<?= base_url() ?>assets/node_modules/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
		<link href="<?= base_url() ?>assets/node_modules/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">



	<?php
	}
	?>




</head>
