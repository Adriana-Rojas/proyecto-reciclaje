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
for ($i=1;$i<=count($caracteristicas);$i++){
	//Defino lo obligatorio para los artículos
	$rules.="caracteristica$i: {
	required: true
	},

	";
	$messages.="caracteristica$i: \"Seleccione un valor para  la caracter".LETRA_MIN_I."stica dentro del elemento\",
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
                        proveedor:{
                            required: true
                        },
                        elemento:{
                            required: true
                        },
                        cantidad:{
                            required: true
                        }
                        
                    },
                    messages: {
                    	<?= $messages ?>
                    	proveedor:"Seleccione el proveedor asociado al elemento",
                    	elemento:"Seleccione el elemento que asocirar<?= LETRA_MIN_A?> a la orden",
                    	cantidad:"Digite la cantidad del elemento para asociar a la orden"
                            
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

		
        
        
        
        
        

