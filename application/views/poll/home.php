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
defined('BASEPATH') or exit('No direct script access allowed');

$rules='';
$messages='';
if($preguntas!=null){
    $i=0;
    foreach ($preguntas as $pregunta){
        //Defino lo obligatorio para los artículos
        $i=$pregunta->ID;
        $rules.="pregunta$i: {
				required: true
			},
			
	";
        $messages.="pregunta$i: \"Seleccione la respuesta a la pregunta actual\",
	";
        
    }
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
<link rel="icon" type="image/png" sizes="16x16"
	href="<?= base_url()?>assets/images/favicon.png">
<title><?= showTittleAplication();?></title>

<!-- BEGIN PAGE VALIDATE PLUGINS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js">
		</script>
<script
	src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
<script
	src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.min.js"></script>
<!-- END PAGE VALIDATE PLUGINS-->
<!-- page css -->
<link
	href="<?= base_url()?>assets/dist/css/pages/login-register-lock.css"
	rel="stylesheet">
<!-- Custom CSS -->
<link href="<?= base_url()?>assets/dist/css/style.min.css" rel="stylesheet">
<link href="<?= base_url()?>assets/node_modules/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">


<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<?php
if ($validador) {
    
    ?>
    	<!-- BEGIN PAGE SWEET ALERT PLUGINS-->
<!--alerts CSS -->
<link
	href="<?= base_url()?>assets/node_modules/sweetalert/sweetalert.css"
	rel="stylesheet" type="text/css">
<!-- Sweet-Alert  -->
<script
	src="<?= base_url()?>assets/node_modules/sweetalert/sweetalert.min.js"></script>
<script
	src="<?= base_url()?>assets/node_modules/sweetalert/jquery.sweet-alert.custom.js"></script>
<script type="text/javascript">
                   $(document).ready(function() {
                        swal({
                          title: "Gracias por su participaci<?= LETRA_MIN_O?>n",
                          text: "Su participaci<?= LETRA_MIN_O?>n es muy importante para nosotros. Gracias por ayudarnos a mejorar.",
                          type: "success",
                          confirmButtonClass: "btn-primary",
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
                        <?=$rules?>
                        nombres: {
                            required: true
                        },
                        apellidos: {
                            required: true
                        },
                        correo: {
                            email: true
                        },
                        fecha: {
                        	required: true
                        },
                        hora: {
                        	required: true
                        }
                    },

                    messages: {
                    	<?=$messages?>
                    	nombres: {
                            required: "Digite sus nombres completos."
                        },
                        apellidos: {
                            required: "Digite sus apellidos"
                        },
                        telefono: {
                            required: "Digite sus apellidos"
                        },
                        correo: {
                        	email: "Digite una direcci<?= LETRA_MIN_O;?>n de correo electr<?= LETRA_MIN_O;?>nico valida"
                        },
                        fecha: {
                        	required: "Seleccione la fecha de atenci<?= LETRA_MIN_O;?>n"
                        },
                        hora: {
                        	required: "Seleccione la hora de atenci<?= LETRA_MIN_O;?>n"
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
	<section id="wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<a href="<?= base_url()?>PollAppPoll/" >
					<img alt="Bootstrap Image Preview"
						src="<?= base_url()?>assets/images/logoCirec.png" />
						</a>
				</div>
				<div class="col-md-6">
					<h1 class=" text-right" style="color: #008CBA;">
						<i class="fa fa-check fa-2x"></i>Califique nuestra atenci&oacute;n
					</h1>
				</div>
			</div>
			<BR>
			<div class="row">
				<div class="col-md-12">
					<form class="form-horizontal " id="loginform"
						action="<?= base_url()?>PollAppPoll/SaveRegister" method="post" autocomplete="off">
						<h2 style="color: #008CBA;">Hola! <br> <small>Para nosotros es importante conocer su opini&oacute;n</small></h2>
						<p><?= $descripcion;?></p>
						
						<h3 style="color: #008CBA;"> <i class="fa fa-clock-o" ></i> Fecha y hora de atenci&oacute;n</h3>
						<div class="form-group m-t-40">
							<div class="col-xs-12">
								<input class="form-control" type="text" name="fecha" id="fecha" placeholder="Fecha de atenci&oacute;n">
								<div class="form-control-feedback"></div>
							</div>
						</div>
						<div class="form-group m-t-40">
							<div class="col-xs-12">
								<input class="form-control clockpicker" type="text" name="hora" id="hora" placeholder="Hora de atenci&oacute;n">
								<div class="form-control-feedback"></div>
							</div>
						</div>
						<h3 style="color: #008CBA;"> <i class="fa fa-check" ></i> Calif&iacute;quenos</h3>
						
							<?php 
							if ($preguntas!=null){
							    foreach ($preguntas as $value){
							        ?>
						<div class="form-group m-t-40">
							<div class="col-xs-12">
								<label><?= $value->DESCRIPCION;?></label>
							    <select class="form-control" id="pregunta<?= $value->ID;?>" name="pregunta<?= $value->ID;?>">
                                	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                    <?php 
                                    $listadoRespuestas=$this->PollsModel->getListValueQuestionsOption($value->ID);
                                    foreach ($listadoRespuestas as $value) { 
                                    ?>
                                    <option value="<?= $value->ID;?>" ><?= $value->NOMBRE;?></option>
                                    <?php
                                    }?>
                                </select>
                            	<div class="form-control-feedback"></div>
                        	</div>
						</div>	
							        <?php 
							    }
							}
							?>
							

						
						<?php 
						if($datos==CTE_VALOR_SI){
						?>
						<h3 style="color: #008CBA;"> <i class="fa fa-address-card" ></i> Informaci&oacute;n personal</h3>
						<div class="form-group m-t-40">
							<div class="col-xs-12">
								<input class="form-control" type="text" name="nombres"
									id="nombres" placeholder="Nombres completos">
								<div class="form-control-feedback"></div>
							</div>
						</div>
						<div class="form-group m-t-40">
							<div class="col-xs-12">
								<input class="form-control" type="text" name="apellidos"
									id="apellidos" placeholder="Apellidos completos">
								<div class="form-control-feedback"></div>
							</div>
						</div>
						<div class="form-group m-t-40">
							<div class="col-xs-12">
								<input class="form-control" type="number" name="telefono"
									id="telefono" placeholder="N&uacute;mero de tel&eacute;fono">
								<div class="form-control-feedback"></div>
							</div>
						</div>
						<div class="form-group m-t-40">
							<div class="col-xs-12">
								<input class="form-control" type="email" name="correo"
									id="correo" placeholder="Correo electr&oacute;nico">
								<div class="form-control-feedback"></div>
							</div>
						</div>
						<?php 
						}
						if($observacion==CTE_VALOR_SI){
						?>
						<h3 style="color: #008CBA;"> <i class="fa fa-bullhorn" ></i> Observaciones adicionales</h3>
						<div class="form-group m-t-40">
							<div class="col-xs-12">
								<input class="form-control" type="text" name="observacion"
									id="observacion" placeholder="Observaci&oacute;n">
								<div class="form-control-feedback"></div>
							</div>
						</div>
						<?php 
						}
						?>
						<div class="form-group text-center m-t-20">
							<div class="col-xs-12">
								<input type="hidden" name="cantidad" id="cantidad" value="<?php if ($preguntas!=null){echo count($preguntas);}else{ echo 0;};?>">
								
								<input type="hidden" name="id" id="id" value="<?= $id;?>">
								<button
									class="btn btn-info btn-lg btn-block text-uppercase btn-rounded"
									type="submit">Enviar</button>
							</div>
						</div>

					</form>



				</div>
			</div>
			<div class="clearfix">
				<br>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-4">
					<p class="rtecenter">
						<a href="https://www.facebook.com/fundacion.cirec" target="_blank">
							<i class="fa fa-facebook-square fa-2x" aria-hidden="true"
							style="color: #2372a3;"></i>
						</a> <a
							href="https://www.youtube.com/channel/UCjGKjyiGvWAYH_GZMmZrUIw"
							target="_blank"> <i class="fa fa-youtube-square fa-2x"
							aria-hidden="true" style="color: #cc181e;"></i>
						</a> <a href="https://twitter.com/ongcirec" target="_blank"> <i
							class="fa fa-twitter-square fa-2x" aria-hidden="true"
							style="color: #0084b4;"></i>
						</a>
					</p>
				</div>
				<div class="col-md-4">

					<address>
						<strong>Centro Integral de Rehabilitaci&oacute;n de Colombia.</strong>
						<br />Carrera 54 # 65 - 25 (Bogot&aacute; - Colombia) <br /> PBX
						Bogot&aacute;: 795 3600 <br /> <abbr title="Phone">L&iacute;nea
							Nacional: </abbr> 01 8000 423 633
					</address>
				</div>
				<div class="col-md-4">

					<address>
						<strong>Programaci&oacute;n de citas m&eacute;dicas.</strong> <br />
						<h3>(+571) 795 3600</h3>
						E-mail: citas@cirec.org<br />
					</address>
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
	<script
		src="<?= base_url()?>assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
	<!-- Bootstrap tether Core JavaScript -->
	<script src="<?= base_url()?>assets/node_modules/popper/popper.min.js"></script>
	<script
		src="<?= base_url()?>assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
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
	 <!-- Plugin JavaScript -->
			    <script src="<?= base_url()?>assets/node_modules/moment/moment.js"></script>
			    <!-- Date Picker Plugin JavaScript -->
			    <script src="<?= base_url()?>assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
			    
				<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.es.min.js"></script>
			    <!-- Date range Plugin JavaScript -->
			    <script src="<?= base_url()?>assets/node_modules/timepicker/bootstrap-timepicker.min.js"></script>
			    <script src="<?= base_url()?>assets/node_modules/bootstrap-daterangepicker/daterangepicker.js"></script>
			    
			    <script src="<?= base_url()?>assets/node_modules/clockpicker/dist/jquery-clockpicker.min.js"></script>
        		<script>
        		 
        		 // Date Picker
        		   jQuery('#fecha').datepicker({
        			    startDate: '<?= $fecha;?>',
        		        autoclose: true,
        		        todayHighlight: true,
        		        format: 'yyyy/mm/dd',
        		        endDate: '0d',
        		        language: 'es'
        		    });
        		   $('.clockpicker').clockpicker({
        		        donetext: 'Aplicar',
        		        autoclose: true,
        		        'default': 'now'
        		    }).find('input').change(function() {
        		        console.log(this.value);
        		    });
				    </script>
</body>

</html>