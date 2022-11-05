<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						Validaci�n del formulario para la p�gina newCustomer
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
                    errorClass: 'form-control-feedback form-control-feedback-error',
                    focusInvalid: true,
                    ignore: "",
                    rules: {
                        valor:{
                            required: true,
                            max:<?=  $valor;?>
                        },
                        accion:{
                            required: true
                        },
                        destino:{
                            required: true
                        }
                    },
                    messages: {
                    	valor:{
                    		required:"Digite el valor por el cual desea afectar el fondo",
                    		max:"El valor por el cual desea afectar el fondo no debe superar <?= numberFormatReciclaje( $valor);?>"
                        },	
                    	accion:"Seleccion el acci<?=  LETRA_MIN_O;?>n que desea aplicar",
                    	destino:"Seleccion el fondo destino que desea afectar"
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

		
        
        
        
        
        

