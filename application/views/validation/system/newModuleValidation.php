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
                        tipo:{required: true},
                        tipoModulo:{required: true},
                        clase:{required: true},
                        modulo:{required: true},
                        pagina:{required: true}
                    },
                    messages: {
                        nombre:"Digite el nombre del m<?= LETRA_MIN_O ?>dulo que desea crear o modificar",
                        tipo:"Seleccione el tipo relacionado al m<?= LETRA_MIN_O ?>dulo que desea crear o modificar",
                        tipoModulo:"Seleccione el tipo de men<?= LETRA_MIN_U ?>que desea estar<?= LETRA_MIN_A ?> asociado",
                        pagina:"Digite el nombre de la p<?= LETRA_MIN_O ?>gina del m<?= LETRA_MIN_O ?>dulo que desea crear o modificar",
                        modulo:"Seleccione el m<?= LETRA_MIN_O ?>dulo principal relacionado ",
                        clase:"Digite el nombre del <?= LETRA_MIN_I ?>cono del m<?= LETRA_MIN_O ?>dulo que desea crear o modificar"
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

		
        
        
        
        
        

