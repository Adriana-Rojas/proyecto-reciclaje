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
                    	periodo:{required: true},
                    	relacion:{required: true},
                    	tipo:{required: true},
                    	tipoDoc:{required: true},
                    	documento:{required: true},
                    	nombres:{required: true},
                    	apellidos:{required: true},
                    	nacimiento:{
                        	required: true,
                        	min: '01/01/1900'
                        },
                    	departamento:{required: true},
                    	ciudad:{required: true},
                    	entidad:{required: true},
                    	tsocial:{required: true},
                    	acompanante:{required: true}
                    	
                    },
                    messages: {
                    	periodo:"Seleccione el periodo en el cual se har<?= LETRA_MIN_A;?> la reserva.",
                    	relacion:"Seleccione la habitaci<?= LETRA_MIN_O;?>n - cama que desea reservar",
                    	tipo:"Seleccione el tipo de usuario al cual se le har<?= LETRA_MIN_A;?> la reserva",
                    	tipoDoc:"Seleccione el tipo de documento para el usuario al cual se le har<?= LETRA_MIN_A;?> la reserva",
                    	documento:"Digite el documento para el usuario al cual se le har<?= LETRA_MIN_A;?> la reserva",
                    	nombres:"Digite los nombres del usuario al cual se le har<?= LETRA_MIN_A;?> la reserva",
                    	apellidos:"Digite los apellidos del usuario al cual se le har<?= LETRA_MIN_A;?> la reserva",
                    	nacimiento:{
                        	required:"Seleccione la fecha de nacimiento del usuario al cual se le har<?= LETRA_MIN_A;?> la reserva",
                        	min:"Seleccione una fecha valida de nacimiento del usuario al cual se le har<?= LETRA_MIN_A;?> la reserva"
                    	},
                    	departamento:"Seleccione el departamento de procedencia del usuario",
                    	ciudad:"Seleccione el municipio (ciudad) de procedencia del usuario",
                    	entidad:"Seleccione la entidad responsable del usuario",
                    	tsocial:"Seleccione la trabajadora social asignada al usuario",
                    	acompanante:"Seleccione si tiene o no acompa<?= LETRA_MIN_N;?>antes el usuario"
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

		
        
        
        
        
        

