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
$rules='';
$messages='';
for ($i=1;$i<=MAX_LIST;$i++){
    //Defino lo obligatorio para los art�culos
    $rules.="codigo$i: {
				required: true
			},
            cantidad$i: {
				required: true
			},
			
	";
    $messages.="codigo$i: \"Obligatorio\",
                cantidad$i: \"Obligatorio\",
	";
    
}

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
                    	<?= $rules; ?>
                    	tipo:{required: true},
                    	tipoDoc:{required: true},
                    	documento:{required: true},
                    	nombres:{required: true},
                    	apellidos:{required: true},
                    	correo:{email: true},
                    	empresa:{required: true},
                        proceso: {required: true},
                    	pago:{required: true},
                    	vigencia:{required: true},
                        justificacion:{required: true},
                        ejecutivo:{required: true},
                        costoAdc:{required: true}
                    	
                    	
                    },
                    messages: {
                    	<?= $messages; ?>
                    	tipoDoc:"Seleccione el tipo de documento para el usuario al cual se le har<?= LETRA_MIN_A;?> la cotizaci<?= LETRA_MIN_O;?>n",
                    	documento:"Digite el documento para el usuario al cual se le har<?= LETRA_MIN_A;?> la cotizaci<?= LETRA_MIN_O;?>n",
                    	nombres:"Digite el nombre del usuario al cual se le har<?= LETRA_MIN_A;?> la cotizaci<?= LETRA_MIN_O;?>n",
                    	apellidos:"Digite el apellido del usuario al cual se le har<?= LETRA_MIN_A;?> la cotizaci<?= LETRA_MIN_O;?>n",
                    	correo:"Digite una direcci<?= LETRA_MIN_O;?>n de correo valida para el usuario",
                        empresa:{
                        	required: "Seleccione la empresa asociada a la cotizaci<?= LETRA_MIN_O;?>n "
                        },
                        proceso: "Seleccione el proceso asociado con la cotización",
                        ejecutivo:"Seleccione el ejecutivo asignado a la cotizaci<?= LETRA_MIN_O;?>n ",
                        costoAdc:"Ingrese los costos adicionales relacionados a la cotizaci<?= LETRA_MIN_O;?>n del usuario sin puntos ni comas",
                        pago:{
                        	required: "Seleccione la forma de pago"
                        },
                        vigencia:{
                        	required: "Seleccione la vigencia de la cotizaci<?= LETRA_MIN_O;?>n  "
                        },
                        justificacion:{
                            required: "Detalle la justificaci<?= LETRA_MIN_O;?>n de las modificaciones que ha realizado a la cotizaci<?= LETRA_MIN_O;?>n  "
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
            })
        </script>
       
		<!-- BEGIN PAGE JQUERY ROUTINES -->

		
        
        
        
        
        

