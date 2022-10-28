<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						Cabecer� de la p�gina de logueo del sistema de informaci�n SaludColombia.
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2017 *******************************
 */
defined('BASEPATH') OR exit('No direct script access allowed');
if($clase=='success'){
	$boton=' blue';
}else{
	$boton='-'.$clase;
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
    	<script   src="https://code.jquery.com/jquery-3.3.1.min.js">
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
                $('#loginform').validate({
                    errorElement: 'div', //default input error message container
                    errorClass: 'form-control-feedback form-control-feedback-error', // default input error message class
                    focusInvalid: false, // do not focus the last invalid input
                    rules: {
                        username: {
                            required: true
                        },
                        password: {
                            required: true
                        }
                    },

                    messages: {
                        username: {
                            required: "Digite el nombre de usuario para ingresar a la aplicaci&oacute;n."
                        },
                        password: {
                            required: "la Clave es requerida para ingresar a la aplicaci&oacute;n."
                        }
                    },
                    highlight: function (e) {
                        $(e).closest('.form-group').removeClass('has-info').addClass('has-danger');
                    },
                    success: function (e) {
                        $(e).closest('.form-group').removeClass('has-danger');//.addClass('has-info');
                        $(e).remove();
                    },
                    
                    submitHandler: function(form) {
                        form.submit(); // form validation success, call ajax form submit
                    }
                });
                
            });
            jQuery(function($) {
                //documentation : http://docs.jquery.com/Plugins/Validation/validate
                $('#recoverform').validate({
                    errorElement: 'div', //default input error message container
                    errorClass: 'form-control-feedback form-control-feedback-error', // default input error message class
                    focusInvalid: false, // do not focus the last invalid input
                    rules: {
                        email: {
                            required: true,
                            email: true
                        }
                    },

                    messages: {
                        email: {
                            required: "Ingrese la direcci<?= LETRA_MIN_O?>n de correo electr<?= LETRA_MIN_O?>nico.",
                            email: "Ingrese un  direcci<?= LETRA_MIN_O?>n de correo electr<?= LETRA_MIN_O?>nico valida"
                        }
                    },
                    highlight: function (e) {
                        $(e).closest('.form-group').removeClass('has-info').addClass('has-danger');
                    },
                    success: function (e) {
                        $(e).closest('.form-group').removeClass('has-danger');//.addClass('has-info');
                        $(e).remove();
                    },
                    
                    submitHandler: function(form) {
                        form.submit(); // form validation success, call ajax form submit
                    }
                });
                
            });
            
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
	<section id="wrapper" class="login-register login-sidebar" style="background-image:url(<?= base_url()?>assets/images/background/imgfondo.JPG);">
      
        <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal " id="loginform" action="<?= base_url()?>Login" method="post" autocomplete="off">
                    <a href="javascript:void(0)" class="text-center db">
                    	<img src="<?= base_url()?>assets/images/logo.svg" alt="Home" width="80%"  />
                    	
                    </a>
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input class="form-control" type="text"  name="username" id="username" placeholder="Nombre de usuario">
                            <div class="form-control-feedback" > </div>
                        </div>
                    </div>
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input class="form-control" type="password"  name="password" id="password" placeholder="Contrase&ntilde;a">
                            <div class="form-control-feedback" > </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox">
                                <a href="javascript:void(0)" id="to-recover" class="text-dark pull-left"><i class="fa fa-lock m-r-5"></i> Recordar clave</a> 
                            </div>     
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase btn-rounded" type="submit">Ingresar</button>
                        </div>
                    </div>
                    
                </form>
                <form class="form-horizontal" id="recoverform" action="<?= base_url()?>SystemUserDefine/rememberPassword" method="post" autocomplete="off">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h3>Reestablecer contrase&ntilde;a</h3>
                            <p class="text-muted">Ingrese su correo electr&oacute;nico para reestablecer la clave </p>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="email"  id="email"  name="email"  placeholder="Correo electr&oacute;nico">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reestablecer</button>
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
