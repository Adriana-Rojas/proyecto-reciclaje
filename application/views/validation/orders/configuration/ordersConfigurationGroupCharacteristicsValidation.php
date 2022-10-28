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
	$messages.="valor$i: \"Digite el valor de que tendr".LETRA_MIN_A." la caracter".LETRA_MIN_I."stica dentro del grupo\",
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
                    	grupo:{
                            required: true
                        },
                        caracteristica:{
                            required: true
                        },
                        aplica:{
                            required: true
                        },
                        "proveedor[]":{
                            required: true
                        }
                        
                    },
                    messages: {
                    	<?= $messages ?>
                    	grupo:"Seleccione el grupo que desea parametrizar",
                        caracteristica:"Seleccione la caracter<?= LETRA_MIN_I?>stica que desea parametrizar",
                        aplica:"Seleccione si aplica o no para proveedores espec<?= LETRA_MIN_I?>ficos",
                        "proveedor[]":"Seleccione los proveedores respectivos"
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

		
        
        
        
        
        

