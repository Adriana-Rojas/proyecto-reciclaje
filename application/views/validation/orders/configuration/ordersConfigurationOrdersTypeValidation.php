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
                        nombre:{required: true},
                        prioridad:{required: true},
                        clase:{required: true},
                        impresion:{required: true},
                        validado:{required: true},
                        clasificacion:{required: true},
                        niveles:{required: true},
                        maximo:{required: true},
                        prefijo:{required: true},
                        iva:{required: true}
                        
                    },
                    messages: {
                        nombre:"Digite el nombre del tipo de orden",
                        prioridad:"Seleccione el nivel de prioridad",
                        clase:"Seleccione la clase de tipo de orden",
                        impresion:"Seleccione el formato de impresi<?= LETRA_MIN_O?>n que se tendr<?= LETRA_MIN_A?> asociado al tipo de orden",
                        validado:"Seleccione en que grupo de tablas se har<?= LETRA_MIN_A?> la validaci<?= LETRA_MIN_O?>n de registro",
                        clasificacion:"Seleccione si es un elemento / servicio POS o NO POS",
                        niveles:"Digite la cantidad de niveles que tendr<?= LETRA_MIN_A?>  el <?= LETRA_MIN_A?>rbol del productos o servicios",
                        maximo:"Digite la cantidad m<?= LETRA_MIN_A?>xima que se podr<?= LETRA_MIN_A?> ordenar en cada orden del productos o servicios",
                        prefijo:"Digite el prefijo que se le asociar<?= LETRA_MIN_A?> 	 al tipo de orden",
                        iva:"Seleccione el valor del IVA para el tipo de orden. Recuerde que si este est<?= LETRA_MIN_A; ?> excento debe colocar el n<?= LETRA_MIN_U; ?>mero cero (0)."
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

		
        
        
        
        
        

