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
                    	tipoNombre:{required: true},
                    	proveedor:{required: true},
                    	origen:{required: true},
                    	descripcion:{required: true},
                    	materiales:{required: true},
                    	mano:{required: true},
                    	adicionales:{required: true},
                    	tiempo:{required: true},
                    	garantia:{required: true}
                    	
                        
                    },
                    messages: {
                    	codigo:"Ingrese el c<?= LETRA_MIN_O?>digo del producto o servicio que desea configurar",
                    	nombre:"Ingrese el nombre del producto o servicio que desea configurar",
                    	tipoNombre:"Ingrese el c<?= LETRA_MIN_O?>digo del producto o servicio que desea configurar, con esto la aplicaci<?= LETRA_MIN_O?>n podr<?= LETRA_MIN_A?> determinar el tipo de elemento o servicios o producto",
                    	proveedor:"Seleccione el proveedor del producto o servicio",
                    	origen:"Seleccione el pa<?= LETRA_MIN_I?>s de origen del producto o elemento",
                    	descripcion:"Ingrese la descripci<?= LETRA_MIN_O?>n del producto, elemento o servicio que desea configurar",
                    	materiales:"Digite el costo de los materiales para el producto o elemento",
                    	mano:"Digite el costo de los mano de obra para el producto o elemento",
                    	adicionales:"Digite el costo adicional asociado para el producto o elemento",
                    	tiempo:"Seleccione el tiempo de entrega definido para el producto o elemento",
                    	garantia:"Seleccione la cantidad asociada al elemento o producto"
                    	
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
                $.validator.addMethod('filesize', function(value, element, param) {
    			    // param = size (in bytes) 
    			    // element = element to validate (<input>)
    			    // value = value of the element (file name)
        			return this.optional(element) || (element.files[0].size <= param) 
    			});	
            })
        </script>
       
		<!-- BEGIN PAGE JQUERY ROUTINES -->

		
        
        
        
        
        

