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
                        nombre:{required: true},
                        despiece:{required: true},
                        tabla:{required: true},
                        codigo:{required: true},
                        nombreCampo:{required: true}
                        
                    },
                    messages: {
                        nombre:"Digite el nombre con el cual identificar<?= LETRA_MIN_A?> la validaci<?= LETRA_MIN_O?>n dentro de la aplicaci<?= LETRA_MIN_O?>n",
                        despiece:"Seleccione si aplica o no el despiece",
                        tabla:"Digite el nombre de la tabla con la cual se realizar<?= LETRA_MIN_A?> la validaci<?= LETRA_MIN_O?>n",
                        codigo:"Digite el nombre del campo c<?= LETRA_MIN_O?>digo de la tabla con la cual se realizar<?= LETRA_MIN_A?> la validaci<?= LETRA_MIN_O?>n",
                        nombreCampo:"Digite el nombre del campo nombre de la tabla con la cual se realizar<?= LETRA_MIN_A?> la validaci<?= LETRA_MIN_O?>n"
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

		
        
        
        
        
        

