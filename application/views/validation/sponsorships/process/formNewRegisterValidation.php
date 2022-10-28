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
                    	tipo:{required: true},
                    	tipoDoc:{required: true},
                    	documento:{required: true},
                    	cotizacion:{required: true},
                    	descripcion:{required: true},
                    	observacion:{required: true},
                    	valor:{required: true},
                    	patrocinado:{min: 1}
                    	
                    	
                    },
                    messages: {
                    	tipo:"Seleccione el tipo de patrocinio que desea generar",
                    	tipoDoc:"Seleccione el tipo de documento para el usuario al cual se le har<?= LETRA_MIN_A;?> el patrocinio",
                    	documento:"Digite el documento para el usuario al cual se le har<?= LETRA_MIN_A;?> el patrocinio",
                    	cotizacion:"Selecione la cotizaci<?= LETRA_MIN_O;?>n que desea relacionar al patrocinio",
                    	descripcion:"Relacione la descripci<?= LETRA_MIN_O;?>n de lo  que se est<?= LETRA_MIN_A;?> patrocinando",
                    	observacion:"Relacione la observaci<?= LETRA_MIN_O;?>n que soporta la generaci<?= LETRA_MIN_O;?>n del patrocinio",
                        valor:"Relacione el valor del patrocinio que est<?= LETRA_MIN_A;?> generando",
                        patrocinado:{
                            min: "No se ha definido el valor a patrocinar, este debe ser mayor que cero (0)"
                        }
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

		
        
        
        
        
        

