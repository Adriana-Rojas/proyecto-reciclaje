<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						Validaci�n del formulario para la p�gina parameters
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2017 *******************************
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>

	<!-- BEGIN PAGE JQUERY ROUTINES -->
    
    
    	
        <script type="text/javascript">
            jQuery(function($) {
                //documentation : http://docs.jquery.com/Plugins/Validation/validate
                $('#form_sample_3').validate({
                    errorElement: 'div',
                    errorClass: 'form-control-feedback',
                    focusInvalid: true,
                    ignore: "",
                    rules: {
                    	valor:{required: true}
                    },
                    messages: {
                    	valor:"Digite el valor para la TRM"
                    },
                    highlight: function (e) {
                        $(e).closest('.form-group').removeClass('form-control-feedback').addClass('has-danger');
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

		
        
        
        
        
        

