<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						Cabecer� de la p�gina de logueo del sistema de informaci�n SaludColombia.
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2017 *******************************
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