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
                        descripcion:{
                            required: true
                        },
                        venta:{
                            required: true
                        },
                        tiempo:{
                            required: true
                        },
                        paquete:{
                            required: true
                        },
                        cantidad:{
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
                        descripcion:"Seleccione el proveedor asociado al elemento",
                        venta:"Seleccione si el elemento o el servicio puede ser vendido directamente",
                        tiempo:"Seleccione el tiempo asociado a la elaboraci&oacute;n del producto o prestaci&oacute;n del servicio",
                        paquete:"Seleccione si est&aacute; dentro del paquete de interconsultas",
                        cantidad:"Digite la cantidad m&iacute;nima del servicio dentro del paquete"
                            
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

		
        
        
        
        
        

