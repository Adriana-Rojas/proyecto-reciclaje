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
                        historia:{
                        	required: function(element) {
								if($("#documento").val() =='' && $("#nombre").val() =='' && $("#apellido").val() ==''){
									return true;
								}else{
									return false;
								}
							}
                        },
                        documento:{
                        	required: function(element) {
								if($("#historia").val() =='' && $("#nombre").val() =='' && $("#apellido").val() ==''){
									return true;
								}else{
									return false;
								}
							}
                        },
                        nombre:{
                        	required: function(element) {
								if($("#documento").val() =='' && $("#historia").val() =='' && $("#apellido").val() ==''){
									return true;
								}else{
									return false;
								}
							}
                        },
                        apellido:{
                        	required: function(element) {
								if($("#documento").val() =='' && $("#nombre").val() =='' && $("#historia").val() ==''){
									return true;
								}else{
									return false;
								}
							}
                        }
                    },
                    messages: {
                    	historia:"Digite un criterio para buscar informaci<?= LETRA_MIN_O; ?>n de pacientes. Ejemplo el n<?= LETRA_MIN_U; ?>mero de historia cl<?= LETRA_MIN_I; ?>nica",
                    	documento:"Digite un criterio para buscar informaci<?= LETRA_MIN_O; ?>n de pacientes. Ejemplo el n<?= LETRA_MIN_U; ?>mero de documento de identidad",
                    	nombre:"Digite un criterio para buscar informaci<?= LETRA_MIN_O; ?>n de pacientes. Ejemplo el nombre del paciente (Usuario)",
                    	apellido:"Digite un criterio para buscar informaci<?= LETRA_MIN_O; ?>n de pacientes. Ejemplo el apellido del paciente (Usuario)"
                    	
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

		
        
        
        
        
        

