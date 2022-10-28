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
	$messages.="valor$i: \"Seleccione la pregunta que desea asociar a la encuesta\",
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
                        },descripcion:{
                            required: true
                        },datos:{
                            required: true
                        },observacion:{
                            required: true
                        }
                        
                    },
                    messages: {
                    	<?= $messages ?>
                    	nombre:"Defina el nombre de la encuesta que desea realizar",
                    	descripcion:"Realice la descripci<?= LETRA_MIN_O?>n de la encuesta que desea realizar",
                    	datos:"Seleccione si se pedir<?= LETRA_MIN_A?>n datos personales dentro de la encuesta",
                    	observacion:"Seleccione si se tendr<?= LETRA_MIN_A?> la opci<?= LETRA_MIN_O?>n de pregunta abierta para observaciones"
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

		
        
        
        
        
        

