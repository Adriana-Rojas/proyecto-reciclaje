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
                        motivo:{
                            required: true
                        },
                        despiece:{
                            required: true
                        },
                        cierra:{
                            required: true
                        },
                        estado:{
                            required: true
                        }
                    },
                    messages: {
                        nombre:"Digite la observaci<?= LETRA_MIN_O;?>n que desea crear o modificar relacionada a un estado dentro del sistema de informaci<?= LETRA_MIN_O;?>n",
                        tipo:"Seleccione el tipo de observaci<?= LETRA_MIN_O;?>n con el cual se encuentra asociada la observaci<?= LETRA_MIN_O;?>n",
                        estado:"Seleccione el  de estado con el cual se encuentra asociada la observaci<?= LETRA_MIN_O;?>n",
                        motivo:"Seleccione el motivo con el cual se encuentra asociada la observaci<?= LETRA_MIN_O;?>n ",
                        despiece:"Seleccione si aplica modificaci<?= LETRA_MIN_O;?>n de despiece de elementos",
                        cierra:"Seleccione si desde esta observaci<?= LETRA_MIN_O;?>n se permite cerrar el estado"
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

		
        
        
        
        
        

