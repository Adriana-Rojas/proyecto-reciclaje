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
for ($i=1;$i<=$maxCaracteristicas;$i++){
	//Defino lo obligatorio para los art�culos
	$rules.="caracteristica$i: {
	required: true
	},

	";
	$messages.="caracteristica$i: \"Seleccione un valor para  la caracter".LETRA_MIN_I."stica dentro del elemento\",
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
                    	<?= $rules ?>
                        comodin:{
                            required: true
                        },
                        id:{
                            required: true,
                            max:9999999
                        },
                        nombre:{
                            required: true
                        },
                        proveedor:{
                            required: true
                        },
                        venta:{
                            required: true
                        },
                        grupo:{
                            required: true
                        },
                        aplica:{
                            required: true
                        },
                        costo:{
                            required: true
                        }
                        
                    },
                    messages: {
                    	<?= $messages ?>
                    	comodin:"Seleccione si el elemento es o no un comod&iacute;n dentro del sistema de informaci&oacute;n",
                    	id:{
                            required: "Digite el c&oacute;digo del elemento que desea crear o modificar",
                            max:"El c&oacute;digo del elemento no debe ser mayor a 9999999"
                        }
                        ,
                        nombre:"Digite el nombre del elemento que desea crear o modificar",
                        proveedor:"Seleccione el proveedor asociado al elemento",
                        venta:"Seleccione si el elemento puede ser vendido directamente",
                        grupo:"Seleccione el grupo al cual est&aacute; asociado el elemento",
                        aplica:"Seleccione si el costo est&aacute; dado en moneda extranjera",
                        costo:"Digite el valor del costo"
                            
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

		
        
        
        
        
        

