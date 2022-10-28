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
defined('BASEPATH') or exit('No direct script access allowed');
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
                        nombre:{
                            required: true
                        },
                        tipo:{
                            required: true
                        },
                        grupo:{
                            required: true
                        },
                        nivel:{
                            required: true
                        },
                        reproceso:{
                            required: true
                        },
                        adjunto:{
                            required: true
                        },
                        bloque:{
                            required: true
                        },
                        icono:{
                            required: true
                        },
                        campoAdc1:{
                            required: true
                        },
                        campoAdc2:{
                            required: true
                        },
                        campoAdc3:{
                            required: true
                        },
                        campoAdc4:{
                            required: true
                        },
                        campoAdc5:{
                            required: true
                        },
                        nombreAdc1:{
                            required: true
                        },
                        nombreAdc2:{
                            required: true
                        },
                        nombreAdc3:{
                            required: true
                        },
                        nombreAdc4:{
                            required: true
                        },
                        nombreAdc5:{
                            required: true
                        },
                        listaAdc1:{
                            required: true
                        },
                        listaAdc2:{
                            required: true
                        },
                        listaAdc3:{
                            required: true
                        },
                        listaAdc4:{
                            required: true
                        },
                        listaAdc5:{
                            required: true
                        }
                    },
                    messages: {
                        nombre:"Digite el nombre del estado que desea crear o modificar",
                        icono:"Digite el icono que representa el estado",
                        tipo:"Seleccione el tipo de estado con el cual se encuentra asociado",
                        grupo:"Seleccione el grupo de estado con el cual se encuentra asociado",
                        nivel:"Seleccione el nivel de estado con el cual se encuentra asociado",
                        reproceso:"Seleccione si desde este estado se permite reprocesos (Aplica para estados intermedios)",
                        adjunto:"Seleccione si desde este estado se permite el adjunto de documentos",
                        bloque:"Seleccione si este estado permite seguimientos en bloque (Aplica para estados intermedios)",
                        campoAdc1:"Seleccione si requiere el campo adicional para la definici<?= LETRA_MIN_O?>n del  estado",
                        campoAdc2:"Seleccione si requiere el campo adicional para la definici<?= LETRA_MIN_O?>n del  estado",
                        campoAdc3:"Seleccione si requiere el campo adicional para la definici<?= LETRA_MIN_O?>n del  estado",
                        campoAdc4:"Seleccione si requiere el campo adicional para la definici<?= LETRA_MIN_O?>n del  estado",
                        campoAdc5:"Seleccione si requiere el campo adicional para la definici<?= LETRA_MIN_O?>n del  estado",
                        nombreAdc1:"Digite el nombre que tendr<?= LETRA_MIN_A?> el campo adicional para la definici<?= LETRA_MIN_O?>n del  estado",
                        nombreAdc2:"Digite el nombre que tendr<?= LETRA_MIN_A?> el campo adicional para la definici<?= LETRA_MIN_O?>n del  estado",
                        nombreAdc3:"Digite el nombre que tendr<?= LETRA_MIN_A?> el campo adicional para la definici<?= LETRA_MIN_O?>n del  estado",
                        nombreAdc4:"Digite el nombre que tendr<?= LETRA_MIN_A?> el campo adicional para la definici<?= LETRA_MIN_O?>n del  estado",
                        nombreAdc5:"Digite el nombre que tendr<?= LETRA_MIN_A?> el campo adicional para la definici<?= LETRA_MIN_O?>n del  estado",
                        listaAdc1:"Seleccione la lista adicional que usuar<?= LETRA_MIN_A?> en la definici<?= LETRA_MIN_O?>n del  estado",
                        listaAdc2:"Seleccione la lista adicional que usuar<?= LETRA_MIN_A?> en la definici<?= LETRA_MIN_O?>n del  estado",
                        listaAdc3:"Seleccione la lista adicional que usuar<?= LETRA_MIN_A?> en la definici<?= LETRA_MIN_O?>n del  estado",
                        listaAdc4:"Seleccione la lista adicional que usuar<?= LETRA_MIN_A?> en la definici<?= LETRA_MIN_O?>n del  estado",
                        listaAdc5:"Seleccione la lista adicional que usuar<?= LETRA_MIN_A?> en la definici<?= LETRA_MIN_O?>n del  estado",
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








