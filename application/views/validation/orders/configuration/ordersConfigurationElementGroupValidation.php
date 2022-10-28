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
                        nombre:{
                            required: true
                        },
                        padre:{
                            required: true
                        },
                        madre:{
                            required: true
                        },
                        unidad:{
                            required: true
                        },
                        iva:{
                            required: true
                        }
                    },
                    messages: {
                        nombre:"Digite el nombre del grupo de elementos que desea crear o modificar",
                        padre:"Seleccione la parte del cuerpo a la cual corresponde el registro que est<?= LETRA_MIN_A; ?> creando o actualizando",
                        madre:"Seleccione el tipo de elemento el registro que est<?= LETRA_MIN_A; ?> creando o actualizando",
                        unidad:"Seleccione la unidad de medida definida para el grupo de elementos",
                        iva:"Seleccione el valor del IVA para el elemento. Recuerde que si este est<?= LETRA_MIN_A; ?> excento debe colocar el n<?= LETRA_MIN_U; ?>mero cero (0)."
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

		
        
        
        
        
        

