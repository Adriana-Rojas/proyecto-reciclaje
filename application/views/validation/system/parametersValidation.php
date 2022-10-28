<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electrónico:          	jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:						Validación del formulario para la página parameters
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
                    errorClass: 'form-control-feedback',
                    focusInvalid: true,
                    ignore: "",
                    rules: {
                        nombre:{required: true},
                        tipoDocumento:{required: true},
                        documento:{required: true},
                        direccion:{required: true},
                        pais:{required: true},
                        departamento:{required: true},
                        ciudad:{required: true},
                        telefono:{required: true},
                        correo:{required: true},
                        longitud:{required: true},
                        duracion:{required: true},
                        historico:{required: true},
                        mayusculas:{required: true},
                        numeros:{required: true},
                        especiales:{required: true},
                        remite:{required: true},
                        agrupa:{required: true},
                        mailtext:{required: true},
                        cotizaciones:{required: true},
                        ordenes:{required: true}
                    },
                    messages: {
                        nombre:"Digite el nombre de la empresa",
                        tipoDocumento:"Seleccione el tipo de documento de la empresa",
                        documento:"Digite el documento de la empresa",
                        direccion:"Digite la direcci<?= LETRA_MIN_O ?>n de residencia comercial de la empresa",
                        pais:"Seleccione el pa<?= LETRA_MIN_I?>s de residencia comercial de la empresa",
                        departamento:"Seleccione el departamento de residencia comercial de la empresa",
                        ciudad:"Seleccione la ciudad de residencia comercial de la empresa",
                        telefono:"Digite el tel<?= LETRA_MIN_E ?>fono de contacto de la empresa",
                        correo:"Digite el correo electr<?= LETRA_MIN_O ?>nico de contacto de la empresa",
                        longitud:"Digite la longitud m<?= LETRA_MIN_I ?>nima que debe tener una contrase<?= LETRA_MIN_N ?>a para un usuario",
                        duracion:"Digite la duraci<?= LETRA_MIN_O ?>n m<?= LETRA_MIN_A ?>xima que debe tener una contrase<?= LETRA_MIN_N ?>a para un usuario",
                        historico:"Digite el hist<?= LETRA_MIN_O ?>rico  m<?= LETRA_MIN_A ?>xima que debe tener una contrase<?= LETRA_MIN_N ?>a para un usuario",
                        numeros:"Seleccione si aplica o no este par<?= LETRA_MIN_A ?>metro para la contrase<?= LETRA_MIN_N ?>a para un usuario",
                        mayusculas:"Seleccione si aplica o no este par<?= LETRA_MIN_A ?>metro para la contrase<?= LETRA_MIN_N ?>a para un usuario",
                        especiales:"Seleccione si aplica o no este par<?= LETRA_MIN_A ?>metro para la contrase<?= LETRA_MIN_N ?>a para un usuario",
                        remite:"Digite la cantidad de remisioens m<?= LETRA_MIN_A ?>ximas permitidas dentro de la aplicaci<?= LETRA_MIN_O ?>n",
                        agrupa:"Seleccione la forma como se agrupan las remisiones dentro de la aplicaci<?= LETRA_MIN_O ?>n",
                        mailtext:"Seleccione el mensaje de correo electr<?= LETRA_MIN_O ?>nico que usar<?= LETRA_MIN_A ?> la aplicaci<?= LETRA_MIN_O ?>n para contactos nuevos",
                        cotizaciones:"Digite el c<?= LETRA_MIN_O ?>digo del formato de cotizaciones definido dentro del Sistema de Gesti<?= LETRA_MIN_O ?>n de Calidad",
                        ordenes:"Digite el c<?= LETRA_MIN_O ?>digo del formato de <?= LETRA_MIN_O ?>rdenes definido dentro del Sistema de Gesti<?= LETRA_MIN_O ?>n de Calidad"
                    },
                    highlight: function (e) {
                        $(e).closest('.form-group').removeClass('form-control-feedback').addClass('has-danger');
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

		
        
        
        
        
        

