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
                        <?php 
                        foreach ($fases->result() as $fase){
                        ?>
	                        fase_<?= $fase->ID;?>:{required: true},
	                    	convenio_<?= $fase->ID;?>:{required: true},
	                        tsocial_<?= $fase->ID;?>:{required: true},
                        <?php 
						}
                        ?>
                        departamento:{required: true},
                        ciudad:{required: true},
                        monto:{required: true}
                    },
                    messages: {
                    	<?php 
                                foreach ($fases->result() as $fase){
                        ?>
                        fase_<?= $fase->ID;?>:"Seleccione el periodo en el cual se llevar<?= LETRA_MIN_A?> a cabo est<?= LETRA_MIN_A?> fase de la brigada",
                        convenio_<?= $fase->ID;?>:"Seleccione el convenio asignado a  est<?= LETRA_MIN_A?> fase de la brigada",
                        tsocial_<?= $fase->ID;?>:"Seleccione la trabajadora social asignada a  est<?= LETRA_MIN_A?> fase de la brigada",
                        protesista_<?= $fase->ID;?>:"Seleccione el (a) t<?= LETRA_MIN_E?>cnico(a) protesista asignado a  est<?= LETRA_MIN_A?> fase de la brigada",
                        <?php 
						}
                        ?>
                        departamento:"Seleccione el departamento de residencia comercial de la empresa",
                        ciudad:"Seleccione la ciudad de residencia comercial de la empresa",
                        monto:"Digite el monto asociado a la brigada"
                        
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

		
        
        
        
        
        

