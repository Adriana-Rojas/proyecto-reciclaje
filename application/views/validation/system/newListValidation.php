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
    $rules.="valor$i: {
                 required: true
             },
             nombre$i: {
                 required: true
             },
             ";
    $messages.="valor$i: \"Digite el valor de que tendr".LETRA_MIN_A." el elemento dentro de la lista\",
            nombre$i: \"Digite el nombre de que tendr".LETRA_MIN_A." el elemento dentro de la lista\",
            
            ";
    
}
?>

	<!-- BEGIN PAGE JQUERY ROUTINES -->
    
    
    
        <script type="text/javascript">
            jQuery(function($) {
                //documentation : http://docs.jquery.com/Plugins/Validation/validate
                $('#form_sample_3').validate({
                    errorElement: 'span',
                    errorClass: 'form-control-feedback form-control-feedback-error',
                    focusInvalid: true,
                    ignore: "",
                    rules: {
                        <?= $rules ?>
                        nombre:{required: true}
                    },
                    messages: {
                        <?= $messages ?>
                        nombre:"Digite el nombre de la lista que desea crear o modificar"
                    },
                    highlight: function (e) {
                        $(e).closest('.form-group').removeClass('has-info').addClass('has-danger');
                    },
                    success: function (e) {
                        $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
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

		
        
        
        
        
        

