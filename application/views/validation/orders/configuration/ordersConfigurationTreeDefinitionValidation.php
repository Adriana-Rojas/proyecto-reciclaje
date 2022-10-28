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
                    	tipo:{
                            required: true
                        },
                        miembros:{
                            required: true
                        },
                        "nivel[]":{
                            required: true
                        }
                        
                    },
                    messages: {
                    	tipo:"Seleccione el tipo de orden que desea configurar dentro del <?= LETRA_MIN_A?>rbol de <?= LETRA_MIN_O?>rdenes",
                    	miembros:"Seleccione la ubicaci<?= LETRA_MIN_O?>n del cuerpo que desea configurar para le tipo de orden dentro del <?= LETRA_MIN_A?>rbol de <?= LETRA_MIN_O?>rdenes",
                    	"nivel[]":"Seleccione los niveles del cuerpo de acuerdo a la ubicaci<?= LETRA_MIN_O?>n seleccionada, para as<?= LETRA_MIN_I?> definir el <?= LETRA_MIN_A?>rbol de <?= LETRA_MIN_O?>rdenes "
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

		
        
        
        
        
        

