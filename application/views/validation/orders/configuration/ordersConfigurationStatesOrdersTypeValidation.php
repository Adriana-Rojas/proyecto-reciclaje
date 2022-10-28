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
                        proceso:{
                            required: true
                        },
                        tipo:{
                            required: true
                        },
                        estado:{
                            required: true
                        },
                        bajoMin:{
                            required: true,
                            smallerThan: "#bajoMax"
                        },
                        bajoMax:{
                            required: true
                        },
                        medioMin:{
                            required: true,
                            smallerThan: "#medioMax"
                        },
                        medioMax:{
                            required: true
                        },
                        altoMin:{
                            required: true,
                            smallerThan: "#altoMax"
                        },
                        altoMax:{
                            required: true
                        }
                    },
                    messages: {
                        proceso:{
                        	required: "Seleccione el proceso en el cual crear<?= LETRA_MIN_A?> la relaci<?= LETRA_MIN_O?>n de estados Vs tipo de Orden"
                        },
                        tipo:{
                        	required: "Seleccione el tipo de orden ques estar<?= LETRA_MIN_A?>  relacionado con un estado para el proceso dado"
                        },
                        estado:{
                        	required: "Seleccione el estado ques estar<?= LETRA_MIN_A?>  relaci<?= LETRA_MIN_O?>nado con un tipo de orden para el proceso dado"
                        },
                        bajoMin:{
                        	required: "Seleccione el tiempo m<?= LETRA_MIN_I?>nimo en el cual debe ser cerrado el estado en el tipo de orden para el proceso dado, cuando la complejidad es baja",
                        	smallerThan: "El valor debe ser menor que el definido en Tiempo m<?= LETRA_MIN_A?>ximo en complejidad baja"
                        },
                        bajoMax:{
                        	required: "Seleccione el tiempo m<?= LETRA_MIN_I?>ximo en el cual debe ser cerrado el estado en el tipo de orden para el proceso dado, cuando la complejidad es baja"
                        },
                        medioMin:{
                        	required: "Seleccione el tiempo m<?= LETRA_MIN_I?>nimo en el cual debe ser cerrado el estado en el tipo de orden para el proceso dado, cuando la complejidad es media",
                        	smallerThan: "El valor debe ser menor que el definido en Tiempo m<?= LETRA_MIN_A?>ximo en complejidad media"
                        },
                        medioMax:{
                        	required:"Seleccione el tiempo m<?= LETRA_MIN_I?>ximo en el cual debe ser cerrado el estado en el tipo de orden para el proceso dado, cuando la complejidad es media"
                        },
                        altoMin:{
                        	required: "Seleccione el tiempo m<?= LETRA_MIN_I?>nimo en el cual debe ser cerrado el estado en el tipo de orden para el proceso dado, cuando la complejidad es alta",
                        	smallerThan: "El valor debe ser menor que el definido en Tiempo m<?= LETRA_MIN_A?>ximo en complejidad alta"
                        },
                        altoMax:{
                        	required: "Seleccione el tiempo m<?= LETRA_MIN_I?>ximo en el cual debe ser cerrado el estado en el tipo de orden para el proceso dado, cuando la complejidad es alta"
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

		
        
        
        
        
        

