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
                        codigo:{
                            required: true
                        },
                        cantidad:{
                            required: true
                        },
                        cie10:{
                            required: true
                        },
                        diagnostico:{
                            required: true
                        },
                        causa:{
                            required: true
                        },
                        apoyo:{
                            required: true
                        },
                        telefono:{
                            required: true
                        },
                        direccion:{
                            required: true
                        },
                        departamento:{
                            required: true
                        },
                        ciudad:{
                            required: true
                        },
                        empresa:{
                            required: true
                        },
                        proceso:{
                            required: true
                        },
                        convenio:{
                            required: true
                        }
                        
                    },
                    messages: {
                    	codigo:"Seleccione el c<?= LETRA_MIN_O?>digo del elemento o servicio que desea adicionar a la orden de servicio.",
                    	cantidad:"Digite la cantidad del elemento o servicio que desea adicionar a la orden de servicio.",
                    	cie10:"Seleccione el diagn<?= LETRA_MIN_O?>stico CIE10 que soporta la formulaci<?= LETRA_MIN_O?>n.",
                    	diagnostico:"Digite el diagn<?= LETRA_MIN_O?>stico  que soporta la formulaci<?= LETRA_MIN_O?>n.",
                    	causa:"Seleccione la causa de enfermedad que soporta la formulaci<?= LETRA_MIN_O?>n.",
                    	apoyo:"Seleccione el personal de apoyo que acompa<?= LETRA_MIN_N?>a la formulaci<?= LETRA_MIN_O?>n.",
                        campo1:"Diligencie el campo para continuar",
                        campo2:"Diligencie el campo para continuar",
                        campo3:"Diligencie el campo para continuar",
                        campo5:"Diligencie el campo para continuar",
                        campo4:"Diligencie el campo para continuar",
                        telefono:"Diligencie el campo para continuar",
                        direccion:"Diligencie el campo para continuar",
                        departamento:"Diligencie el campo para continuar",
                        empresa:"Diligencie el campo para continuar",
                        proceso:"Diligencie el campo para continuar",
                        convenio:"Diligencie el campo para continuar"
                        
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

		
        
        
        
        
        

