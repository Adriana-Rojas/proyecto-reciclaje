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
                        
                        codigo:{
                            required: true,
                            max:9999999
                        },
                        nombre:{
                            required: true
                        },
                        grupo:{
                            required: true
                        },
                        elemento:{
                            required: true
                        },
                        cantidad:{
                            required: true
                        },
                        clona:{
                            required: true
                        },
                        despiece:{
                            required: true
                        }
                        
                    },
                    messages: {
                    	codigo:{
                            required: "Digite el c&oacute;digo del producto o servicio que desea crear o modificar",
                            max:"El c&oacute;digo del elemento no debe ser mayor a 9999999"
                        }
                        ,
                        nombre:"Digite el nombre del producto o servicio que desea crear o modificar",
                        grupo:"Seleccione el grupo en el cual se encuentra el elemento que desea adicionar",
                        elemento:"Seleccione El elemento a adicionar",
                        cantidad:"Digite la cantidad apropiada para el elemento",
                        clona:"Seleccione si desea clonar el despiece a partir de otro previamente definido",
                        despiece:"Seleccione el despiece con el cual realizar<?= LETRA_MIN_A?> la clonaci<?= LETRA_MIN_O?>n"
                            
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

		
        
        
        
        
        

