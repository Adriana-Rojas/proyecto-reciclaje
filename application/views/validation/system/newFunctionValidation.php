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
                        ubicacion:{required: true},
                        clase:{required: true},
                        modulo:{required: true},
                        color:{required: true},
                        pagina:{required: true}
                    },
                    messages: {
                        nombre:"Digite el nombre de la funci<?= LETRA_MIN_O ?>n que desea crear o modificar",
                        tipo:"Seleccione el tipo men<?= LETRA_MIN_U ?> que tendr<?= LETRA_MIN_A ?> la funci<?= LETRA_MIN_O ?>n ",
                        ubicacion:"Seleccione el tipo de men<?= LETRA_MIN_U ?> que desea estar<?= LETRA_MIN_A ?> asociado",
                        pagina:"Digite el nombre de la p<?= LETRA_MIN_A ?>gina de la funci<?= LETRA_MIN_O ?>n",
                        modulo:"Seleccione el m<?= LETRA_MIN_O ?>dulo secundario relacionado ",
                        color:"Seleccione el color que tendr<?= LETRA_MIN_A ?> el bot<?= LETRA_MIN_O ?>n asociado",
                        clase:"Digite el nombre del <?= LETRA_MIN_I ?>cono de la  funci<?= LETRA_MIN_O ?>n "
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

		
        
        
        
        
        

