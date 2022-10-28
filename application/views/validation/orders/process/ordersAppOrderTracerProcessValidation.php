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
                    	estado:{
                        	required: true
                        },
                        tipo:{
                        	required: true
                        },
                        reproceso:{
                        	required: true
                        },
                        observacion:{
                        	required: true
                        },
                        despiece:{
                        	required: true
                        },
                        adjunto:{
                        	accept: "pdf",
        					filesize:<?= FILE_MAX; ?>
                        },
                        fecha:{
                        	required: true
                        }
                    },
                    messages: {
                    	estado:"Seleccione el estado al cual desea realizar seguimiento dentro del proceso de la orden",
                    	tipo:"Seleccione el tipo de observaci<?= LETRA_MIN_O; ?>n, con la cual desea realizar el seguimiento",
                    	despiece:"Seleccione si desea o no hacer modificaciones al despiece",
                    	fecha:"Seleccione la fecha estimada de cierre",
                    	reproceso:"Seleccione el estado al cual retornar<?= LETRA_MIN_A; ?> la orden, de acuerdo al tipo de observaci<?= LETRA_MIN_O; ?>n que seleccion<?= LETRA_MIN_O; ?>",
                    	observacion:"Digite la observaci<?= LETRA_MIN_O; ?>n con la cual hace el seguimiento",
                    	adjunto: {
        					accept: "Solo puede adjuntar archivos de tipo PDF",
        					filesize: "El archivo no puede superar el tama<?= LETRA_MIN_N; ?>o de <?=  formatBytes(FILE_MAX); ?>"
        				},
        				campo1:"Digite un valor para el campo respectivo",
        				listaCampo1:"Seleccione un valor para el campo respectivo",
        				fecha1:"Seleccione un valor para el campo respectivo",
        				numero1:"Digite un valor para el campo respectivo",
        				campo2:"Digite un valor para el campo respectivo",
        				listaCampo2:"Seleccione un valor para el campo respectivo",
        				fecha2:"Seleccione un valor para el campo respectivo",
        				numero2:"Digite un valor para el campo respectivo",
        				campo3:"Digite un valor para el campo respectivo",
        				listaCampo3:"Seleccione un valor para el campo respectivo",
        				fecha3:"Seleccione un valor para el campo respectivo",
        				numero3:"Digite un valor para el campo respectivo",
        				campo4:"Digite un valor para el campo respectivo",
        				listaCampo4:"Seleccione un valor para el campo respectivo",
        				fecha4:"Seleccione un valor para el campo respectivo",
        				numero4:"Digite un valor para el campo respectivo",
        				campo5:"Digite un valor para el campo respectivo",
        				listaCampo5:"Seleccione un valor para el campo respectivo",
        				fecha5:"Seleccione un valor para el campo respectivo",
            			numero5:"Digite un valor para el campo respectivo"
            				
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

		
        
        
        
        
        

