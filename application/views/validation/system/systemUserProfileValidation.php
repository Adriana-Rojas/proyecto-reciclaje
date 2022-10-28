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
	if($numerosId==1){
		$numeros=",
	                    patternNumber: true";
		$metodoNumeros="
	                $.validator.addMethod( 'patternNumber', function( value, element, param ) {
	                            if(this.optional(element)){
	                                //This is not a 'required' element and the input is empty
	                                  return true;
	                            }
	                            var variable=/[0-9]+/;
	                            if(value.match(variable)){
	                                  return true;
	                            }else{
	                                return false;
	                            }
	                        },\" Debe ingresar como m".LETRA_MIN_I."nimo un n".LETRA_MIN_U."mero en la contrase".LETRA_MIN_N."a\");
	
	            ";
	}else{
		$numeros="";
		$metodoNumeros="";
	}
	//Mayusculas
	if($mayusculasId==1){
		$mayuscula=",
	                    patternMayuscula: true";
		$metodoMayuscula="
	                $.validator.addMethod( 'patternMayuscula', function( value, element, param ) {
	                            if(this.optional(element)){
	                                //This is not a 'required' element and the input is empty
	                                  return true;
	                            }
	                            var variable=/[A-Z]+/;
	                            if(value.match(variable)){
	                                  return true;
	                            }else{
	                                return false;
	                            }
	                        },\" Debe ingresar como m".LETRA_MIN_I."nimo una letra en may".LETRA_MIN_U."scula para la definici".LETRA_MIN_O."n de la contrase".LETRA_MIN_N."a\");
	
	            ";
	}else{
		$mayuscula="";
		$metodoMayuscula="";
	}
	//Caracteres especiales
	if($especialesId==1){
		$especiales=",
	                    patternCaracteres: true";
		$metodoEspeciales="
	                $.validator.addMethod( 'patternCaracteres', function( value, element, param ) {
	                            if(this.optional(element)){
	                                //This is not a 'required' element and the input is empty
	                                  return true;
	                            }
	                            var variable=/\W+/;
	                            if(value.match(variable)){
	                                  return true;
	                            }else{
	                                return false;
	                            }
	                        },\" Debe ingresar como m".LETRA_MIN_I."nimo un caracter especial Ej.( #, @, -, _, |, $) para la definici".LETRA_MIN_O."n de la contrase".LETRA_MIN_N."a\");
	
	            ";
	}else{
		$especiales="";
		$metodoEspeciales="";
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
                        nombre: {
                            minlength: <?= CTE_LONGITUD_MINIMA ?>,
                            required: true
                        },
                        apellido: {
                            minlength: <?= CTE_LONGITUD_MINIMA ?>,
                            required: true
                        },
                        correo: {
                            email: true,
                            required: true
                        },
                        codigo: {
                            minlength: <?= CTE_LONGITUD_MINIMA ?>,
                            required: true
                        },
                        valida: {
                            required: true
                        } ,
                        password: {
                            required: true
                        },
                        nueva: {
                            required: true,
                            minlength: <?= $longitud ?>
                            <?= $numeros ?>
                            <?=  $mayuscula ?>
                            <?= $especiales ?>
                        },
                        confirmacion: {
                            required: true,
                            equalTo: "#nueva"
                        }
                    },
                    messages: {
                        nombre: {
                            minlength: "El nombre de la persona a crear o modificar debe ser mayor o igual a <?= CTE_LONGITUD_MINIMA ?> caracteres",
                            required: "Digite un nombre de la persona que desea crear o modificar"
                        },
                        apellido: {
                            minlength: "El primer apellido de la persona a crear o modificar debe ser mayor o igual a <?= CTE_LONGITUD_MINIMA ?> caracteres",
                            required: "Digite el primer apellido de la persona que desea crear o modificar"
                        },
                        correo: {
                            email: "Digite una direcci<?= LETRA_MIN_O ?>n de correo electr<?= LETRA_MIN_O ?>nico valida",
                            required:  "Digite una direcci<?= LETRA_MIN_O ?>n de correo electr<?= LETRA_MIN_O ?>nico valida"
                        },
                        usuario: {
                            minlength: "El c<?= LETRA_MIN_O ?>digo de usuario debe ser mayor a <?= CTE_LONGITUD_MINIMA ?> caracteres",
                            required: "Digite el c<?= LETRA_MIN_O ?>digo de usuario "
                        },
                        valida: {
                            required: "Seleccione si desea reestablecer o no la contra<?= LETRA_MIN_N?>a de usuario"
                        }  ,
                        password: {
                            required: "La clave anterior es requerida para realizar el cambio."
                        },
                        nueva: {
                            required: "La nueva clave es requerida para realizar el cambio.",
                            minlength: "La clave debe tener como m<?= LETRA_MIN_I?>nimo <?= $longitud ?> caracteres"
                            
                        },
                        confirmacion: {
                            required: "La confirmaci\u00f3n de la clave nueva es requerida.",
                            equalTo: "La confirmaci\u00f3n no coincide con la nueva clave."
                            
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
                <?= $metodoNumeros ?>
                <?=  $metodoMayuscula ?>
                <?= $metodoEspeciales ?>
            })
        </script>
       
		<!-- BEGIN PAGE JQUERY ROUTINES -->

		
        
        
        
        
        

