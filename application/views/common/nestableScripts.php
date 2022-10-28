<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electrónico:          	jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:						Cabecerá de la página de logueo del sistema de información SaludColombia.
 *************************************************************************
 *************************************************************************
 ******************** BOGOTÁ COLOMBIA 2017 *******************************
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>

				<!--nestable CSS -->
    			<link href="<?= base_url()?>/assets/node_modules/nestable/nestable.css" rel="stylesheet" type="text/css" />
			 	<!--Nestable js -->
			    <script src="<?= base_url()?>/assets/node_modules/nestable/jquery.nestable.js"></script>
			    <?php 
			    	if ($variable==1){
			    ?>
			    <script type="text/javascript">
			    $(document).ready(function() {
			        // Nestable
			    	$(document).ready(function(){
			    		   $("#nestable").nestable({
			    		      maxDepth: 10,
			    		      collapsedClass:'dd-collapsed',
			    		   }).nestable('collapseAll');//Add this line
			    		});
			    });
			    </script>
			     <?php 
			    	}
			    ?>