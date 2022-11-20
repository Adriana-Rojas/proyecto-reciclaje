<?php
error_reporting(0);

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
?>


<!-- This page CSS -->



<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- Inicio totales generales -->
<!-- ============================================================== -->

<!-- Librerias para gr�ficos -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<h1>
	<i class=""></i>MI QR
</h1><!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--Puedes descargar el script e incluirlo de manera local si así prefieres-->
	<script src="https://unpkg.com/qrious@4.0.2/dist/qrious.js"></script>
	<title>Generar códigos QR - By Parzibyte</title>
</head>

<body>
	<img alt="Código QR" id="codigo">
	<script>
		new QRious({
			element: document.querySelector("#codigo"),
			value: "Hola me llamo adriana", // La URL o el texto
			size: 450,
			backgroundAlpha: 0, // 0 para fondo transparente
			foreground: "#0391d1", // Color del QR
			level: "H", // Puede ser L,M,Q y H (L es el de menor nivel, H el mayor)
		});
	</script>
</body>

</html>
