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
                        codigo:{required: true},
                        nombre:{required: true},
                        apellido:{required: true},
                        correo:{
                            required: true,
                            email: true
                        },
                        perfil:{required: true},
                        pagina:{required: true}
                    },
                    messages: {
                    	codigo:"Digite el c<?= LETRA_MIN_O?>digo del usuario que desea crear o modificar",
                        nombre:"Digite los nombres del usuario que desea crear o modificar",
                        apellido:"Digite los apellidos del usuario que desea crear o modificar",
                        correo:{
                            required: "Digite el correo electr<?= LETRA_MIN_O?>nico del usuario que desea crear o modificar",
                            email: "Digite una direcci<?= LETRA_MIN_O?>n de  correo electr<?= LETRA_MIN_O?>nico valida"
                        },
                        perfil:"Digite el perfil que tendr<?= LETRA_MIN_A?> del usuario que desea crear o modificar",
                        pagina:"Digite la p<?= LETRA_MIN_A?>gina incial que se le asociar<?= LETRA_MIN_A?> al usuario"   
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

		
        
        
        
        
        

