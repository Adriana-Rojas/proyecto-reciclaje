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
                        nombre:{
                            required: true
                        },
                        tipo:{
                            required: true
                        },
                        ubicacion:{
                            required: true
                        },
                        pagina:{
                            required: true
                        },
                        icono:{
                            required: true
                        }
                    },
                    messages: {
                    	nombre:{
                        	required: "Digite el nombre de la funci<?= LETRA_MIN_O;?>n que desea crear o modificar"
                        },
                        tipo:{
                        	required: "Seleccione el tipo de ingreso para la funci<?= LETRA_MIN_O;?>n que desea crear o modificar"
                        },
                        ubicacion:{
                        	required: "Digite la ubicaci<?= LETRA_MIN_O;?>n de la funci<?= LETRA_MIN_O;?>n que desea crear o modificar"
                        },
                        pagina:{
                        	required: "Digite el nombre de la p<?= LETRA_MIN_A;?>gina siguiente, para la funci<?= LETRA_MIN_O;?>n que desea crear o modificar"
                        },
                        icono:{
                        	required: "Digite el nombre del <?= LETRA_MIN_I;?>cono que desea asociar al nombre de la funci<?= LETRA_MIN_O;?>n que desea crear o modificar"
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
                $.validator.addMethod("smallerThan",
        			    function(value, element, params) {
        			        var target = $(params).val();
        			        var isValueNumeric = !isNaN(parseFloat(value)) && isFinite(value);
        			        var isTargetNumeric = !isNaN(parseFloat(target)) && isFinite(target);
        			        if (isValueNumeric && isTargetNumeric) {
        			            return Number(value) < Number(target);
        			        }
        	
        			        if (!/Invalid|NaN/.test(new Date(value))) {
        			            return new Date(value) <= new Date(target);
        			        }
        	
        			        return false;
        			    },
        			    'Must be smaller than {0}.');
            })
        </script>
       
		<!-- BEGIN PAGE JQUERY ROUTINES -->

		
        
        
        
        
        

