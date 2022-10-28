<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electrónico:          	jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:						Cabecerá de la página de logueo del sistema de información SaludColombia.
 *************************************************************************
 *************************************************************************
 ******************** BOGOTÁ COLOMBIA 2017 *******************************
 */
defined('BASEPATH') OR exit('No direct script access allowed');
if($clase=='success'){
	$boton=' blue';
}else{
	$boton='-'.$clase;
}




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

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url()?>assets/images/favicon.png">
    <title><?= showTittleAplication();?></title>
    
     <!-- BEGIN PAGE VALIDATE PLUGINS -->
    	<script   src="https://code.jquery.com/jquery-3.3.1.min.js"
  								integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  								crossorigin="anonymous">
		</script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.min.js"></script>
    <!-- END PAGE VALIDATE PLUGINS--> 
    <!-- page css -->
    <link href="<?= base_url()?>assets/dist/css/pages/login-register-lock.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url()?>assets/dist/css/style.min.css" rel="stylesheet">
    
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<?php 
    	if ($validador==1){
    	
    ?>
    	<!-- BEGIN PAGE SWEET ALERT PLUGINS-->
    	<!--alerts CSS -->
    	<link href="<?= base_url()?>assets/node_modules/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
	    <!-- Sweet-Alert  -->
	    <script src="<?= base_url()?>assets/node_modules/sweetalert/sweetalert.min.js"></script>
	    <script src="<?= base_url()?>assets/node_modules/sweetalert/jquery.sweet-alert.custom.js"></script>
        <script type="text/javascript">
                   $(document).ready(function() {
                        swal({
                          title: "<?= $titulo ?>",
                          text: "<?= $mensaje ?>",
                          type: "<?= $clase ?>",
                          confirmButtonClass: "btn<?= $boton ?>",
                          confirmButtonText: "Continuar",
                          closeOnConfirm: true
                        }
                        );
                    });
                </script>
        <!-- END PAGE SWEET ALERT PLUGINS-->   
      <?php 
    	}
    ?>   
</head>

<body>

<script type="text/javascript">
            jQuery(function($) {
                //documentation : http://docs.jquery.com/Plugins/Validation/validate
                $('#changePassword-form').validate({
                    errorElement: 'div', //default input error message container
                    errorClass: 'form-control-feedback form-control-feedback-error', // default input error message class
                    focusInvalid: false, // do not focus the last invalid input
                    rules: {
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
                        nueva: {
                            required: "la clave nueva es requerida.",
                            minlength: "La clave debe tener como m<?= LETRA_MIN_I?>nimo <?= $longitud ?> caracteres"
                            
                        },
                        confirmacion: {
                            required: "La confirmaci\u00f3n de la clave es requerida.",
                            equalTo: "La confirmaci\u00f3n no coincide con la nueva clave."
                            
                        }
                    },
                    highlight: function (e) {
                        $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
                    },
                    success: function (e) {
                        $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
                        $(e).remove();
                    },

                    submitHandler: function(form) {
                        form.submit(); // form validation success, call ajax form submit
                    }
                });
                <?= $metodoNumeros ?>
                <?=  $metodoMayuscula ?>
                <?= $metodoEspeciales ?>
            })
        </script>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label"><?= showPreloadMessage();?></p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="login-register login-sidebar" style="background-image:url(<?= base_url()?>assets/images/background/login-register.png);">
        <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal " id="changePassword-form" action="<?= base_url()?>Login/changePassword" method="post" autocomplete="off">
                    <a href="javascript:void(0)" class="text-center db">
                    	<img src="<?= base_url()?>assets/images/logoCirec.png" alt="Home" />
                    </a>
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <h4 style="color: #03a9f3;">Reestablecer contrase&ntilde;a</h4>
                        </div>
                    </div>
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input class="form-control" type="text"  name="username" id="username" placeholder="Nombre de usuario" value="<?= $id; ?>" readonly="readonly" > 
                            <div class="form-control-feedback" > </div>
                        </div>
                    </div>
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input class="form-control" type="password"  name="password" id="password" placeholder="Contrase&ntilde;a" readonly="readonly" value="<?= $clave; ?>">
                            <div class="form-control-feedback" > </div>
                        </div>
                    </div>
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input class="form-control" type="password"  name="nueva" id="nueva" placeholder="Contrase&ntilde;a nueva " >
                            <div class="form-control-feedback" > </div>
                        </div>
                    </div>
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input class="form-control" type="password"  name="confirmacion" id="confirmacion" placeholder="Confirmaci&oacute;n Contrase&ntilde;a nueva " >
                            <div class="form-control-feedback" > </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox">
                                <a href="<?= base_url()?>"  class="text-dark pull-left"><i class="fa fa-home m-r-5"></i> Retornar</a> 
                            </div>     
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase btn-rounded" type="submit">Reestablecer</button>
                        </div>
                    </div>
                    
                </form>
                
            </div>
        	<div class="card-body">
        		
                <div class="col-xs-12 text-dark pull-right">
                           <i class="fa fa-window-restore"></i>
                           <?= showFooter('AUTHOR');?> 
                </div>
                <div class="col-xs-12 text-dark pull-right">
                           <?= showFooter('TEMPLATE');?> 
                </div>
                 <div class="col-xs-12 text-dark pull-right">
                          <small> <i class="fa fa-code-fork"></i> <?= showFooter('VERSION');?>  <i class="fa fa-code-fork"></i></small>
                </div>
        	</div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?= base_url()?>assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url()?>assets/node_modules/popper/popper.min.js"></script>
    <script src="<?= base_url()?>assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!--Custom JavaScript -->
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
    </script>
    
</body>

</html>