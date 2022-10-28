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
                    	
                    	tipo:{required: true},
                    	numero:{required: true},
                    	observacion:{required: true},
                    	adjunto:{
                        	accept: "pdf",
        					filesize:<?= FILE_MAX; ?>
                        }
                    	
                    	
                    },
                    messages: {
                    	tipo:"Seleccione  la tipificaci<?= LETRA_MIN_O;?>n para el seguimiento de la cotizaci<?= LETRA_MIN_O;?>n",
                    	numero:"Digite el n<?= LETRA_MIN_U;?>mero de autorizaci<?= LETRA_MIN_O;?>n asociado a la cotizaci<?= LETRA_MIN_O;?>n",
                    	observacion:{
                        	required: "Defina la observaci<?= LETRA_MIN_O;?>n para el seguimiento de la cotizaci<?= LETRA_MIN_O;?>n  "
                        },
                    	adjunto: {
        					accept: "Solo puede adjuntar archivos de tipo PDF",
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

		
        
        
        
        
        

