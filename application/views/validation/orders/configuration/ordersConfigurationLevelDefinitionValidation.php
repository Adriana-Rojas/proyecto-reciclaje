<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electrónico:          	jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:						Validación del formulario para la página newCustomer
 *************************************************************************
 *************************************************************************
 ******************** BOGOTÁ COLOMBIA 2017 *******************************
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$rules='';
$messages='';
for ($i=1;$i<=MAX_LIST;$i++){
	//Defino lo obligatorio para los artículos
	$rules.="valor$i: {
				required: true
			},
	
	";
	$messages.="valor$i: \"Digite el valor de que tendr".LETRA_MIN_A." la caracter".LETRA_MIN_I."stica dentro del n".LETRA_MIN_I."vel que se est".LETRA_MIN_A." definiendo\",
	";

}

?>

	<!-- BEGIN PAGE JQUERY ROUTINES -->
    
    
    
        <script type="text/javascript">
            jQuery(function($) {
                //documentation : http://docs.jquery.com/Plugins/Validation/validate
                $('#form_sample_3').validate({
                    errorElement: 'div',
                    errorClass: 'form-control-feedback form-control-feedback-error',
                    focusInvalid: true,
                    ignore: "",
                    rules: {
                    	<?= $rules ?>
                    	nombre:{
                            required: true
                        },
                        miembros:{
                            required: true
                        },
                        valorValida:{
                            required: true
                        },
                        subnivel:{
                            required: true
                        }
                        
                    },
                    messages: {
                    	<?= $messages ?>
                    	nombre:"Digite el nombre con el cual identificar<?= LETRA_MIN_A?> el nivel dentro del <?= LETRA_MIN_A?>rbol de <?= LETRA_MIN_O?>rdenes",
                    	miembros:"Seleccione la ubicaci<?= LETRA_MIN_O?>n en la cual aplica el nivel dentro del <?= LETRA_MIN_A?>rbol de <?= LETRA_MIN_O?>rdenes",
                    	valorValida:"Seleccione en donde valida la informaci<?= LETRA_MIN_O?>n  dentro del <?= LETRA_MIN_A?>rbol de <?= LETRA_MIN_O?>rdenes",
                    	subnivel:"Seleccione en que subnivel se ubicar<?= LETRA_MIN_A?> dentro del <?= LETRA_MIN_A?>rbol de <?= LETRA_MIN_O?>rdenes "
                    },
                    highlight: function (e) {
                        $(e).closest('.form-group').removeClass('has-info').addClass('has-danger');
                    },
                    success: function (e) {
                        $(e).closest('.form-group').removeClass('has-danger');//.addClass('has-info');
                        $(e).remove();
                    },
                    submitHandler: function (form) {
                        form.submit();  
                        
                    },
                    invalidHandler: function (form) {
                    }
                });
            })
        </script>
       
		<!-- BEGIN PAGE JQUERY ROUTINES -->

		
        
        
        
        
        

