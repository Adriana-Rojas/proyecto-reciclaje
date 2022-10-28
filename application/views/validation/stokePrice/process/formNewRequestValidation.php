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
                    	tipo:{required: true},
                    	tipoDoc:{required: true},
                    	documento:{required: true},
                    	nombres:{required: true},
                    	apellidos:{required: true},
                    	correo:{email: true},
                    	empresa:{required: true},
                    	proceso:{required: true},
                    	convenio:{required: true},
                    	brigada:{required: true},
                    	departamento:{required: true},
                    	ciudad:{required: true},
                    	adjunto1:{
                        	accept: "pdf",
        					filesize:<?= FILE_MAX; ?>
                        },
                    	adjunto2:{
                        	accept: "pdf",
                            required: true,
        					filesize:<?= FILE_MAX; ?>
                        },ejecutivo:{required: true}
                    	
                    	
                    },
                    messages: {
                    	tipoDoc:"Seleccione el tipo de documento para el usuario al cual se le har<?= LETRA_MIN_A;?> la cotizaci<?= LETRA_MIN_O;?>n",
                    	documento:"Digite el documento para el usuario al cual se le har<?= LETRA_MIN_A;?> la cotizaci<?= LETRA_MIN_O;?>n",
                    	nombres:"Digite el nombre del usuario al cual se le har<?= LETRA_MIN_A;?> la cotizaci<?= LETRA_MIN_O;?>n",
                    	apellidos:"Digite el apellido del usuario al cual se le har<?= LETRA_MIN_A;?> la cotizaci<?= LETRA_MIN_O;?>n",
                    	correo:"Digite una direcci<?= LETRA_MIN_O;?>n de correo valida para el usuario",
                         empresa:"Seleccione la empresa asociada a la cotizaci<?= LETRA_MIN_O;?>n ",
                         proceso:"Seleccione el proceso por el cual se realizar<?= LETRA_MIN_A;?> los productos o servicios a ser cotizados ",
                         convenio:"Seleccione la empresa aliada que acompa<?= LETRA_MIN_N;?>ar<?= LETRA_MIN_A;?> el proceso del producto o servicio ",
                         brigada:"Seleccione la brigada en la cual se tendr<?= LETRA_MIN_A;?> el producto o servicio ",
                         departamento:"Seleccione el departamento domicilio del usuario ",
                         ciudad:"Seleccione la ciudad domicilio del usuario ",
                          ejecutivo:"Seleccione el ejecutivo asignado a la solicitud de cotizaci<?= LETRA_MIN_O;?>n ",
                    	adjunto1: {
        					accept: "Solo puede adjuntar archivos de tipo PDF",
        					filesize: "El archivo no puede superar el tama<?= LETRA_MIN_N; ?>o de <?=  formatBytes(FILE_MAX); ?>"
        				},
                    	adjunto2: {
        					accept: "Solo puede adjuntar archivos de tipo PDF",
                            required: "Ingrese la orden m<?= LETRA_MIN_E; ?>dica del paciente ",
        					filesize: "El archivo no puede superar el tama<?= LETRA_MIN_N; ?>o de <?=  formatBytes(FILE_MAX); ?>"
        				}
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

		
        
        
        
        
        

