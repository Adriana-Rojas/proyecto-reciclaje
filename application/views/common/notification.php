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

//Cargo listado de ordenes
$ordenes= retornaOrdenesActualesParaNotificacion( $this->session->userdata ( 'usuario' ));
$colores= arrayColor();
$band=true;
if($ordenes!=null){
    $band=false;
}
?>

<ul class="navbar-nav my-lg-0">
	<!-- ============================================================== -->
	<!-- Comment -->
	<!-- ============================================================== -->
	<li class="nav-item dropdown"><a
		class="nav-link dropdown-toggle waves-effect waves-dark" href=""
		data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
			class="fa fa-bell-slash " style="color: white;"></i>
			<?php 
			if($band){
			?>
			<div class="notify">
				<span class="heartbit"></span> <span class="point"></span>
			</div>
			<?php 
			}
			?>
	</a>
		<div
			class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
			<ul>
				<li>
					<div class="drop-title">&Oacute;rdenes pendientes <span style="color: red;"> (<?php if($ordenes!=null){ count($ordenes);}?>)</span> </div>
				</li>
				<li>
					<div class="message-center">
						<?php 
						if($band){
						    $i=0;
							if($ordenes!=null){
						    foreach ($ordenes as $value) {
						        if($i<=MAX_NOTIFICACIONES){
						            //Datos del paciente
						            $id = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_ADMISIONES", "ID_PCTE_ADM", "ID_AMSION",$value->HISTORIA);
						            $paciente= $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "PRI_NOM_PCTE", "ID_PCTE", $id) . " " . $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "SEG_NOM_PCTE", "ID_PCTE", $id) . " " . $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "PRI_APELL_PCTE", "ID_PCTE", $id) . " " . $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "SEG_APELL_PCTE", "ID_PCTE", $id);
						            
						        
						    
						?>
						<!-- Message -->
						<a href="<?= base_url()?>OrdersAppOrder/tracerProcess/<?= $this->encryption->encrypt ( $value->HISTORIA );?>/<?= $this->encryption->encrypt ( $value->ID );?>">
							<?php 
							if($i%2==0){
							    $boton="btn-success";
							}else{
							    $boton="btn-info";
							}
							?>
							<div class="btn <?= $boton;?> btn-circle">
								<i class="<?= $value->ICONO;?>"></i>
							</div>
							<div class="mail-contnet">
								<h5><?= $value->PREFIJO;?> - <?= $value->CONS;?> (<?= $value->ESTADO;?>)</h5>
								<span class="mail-desc"><?= $paciente;?></span> 
								<span class="time"><?=  $value->FECHA_ESTADO;?></span>
							</div>
						</a>
						<?php
						      $i++;
						        }
						    }
							}
            			}
            			?>
					</div>
				</li>
				<li><a class="nav-link text-center link"
					href="<?= base_url()?>MainApp/board"> <strong>Ver todas las
							&oacute;rdenes pendientes</strong> <i class="fa fa-angle-right"></i>
				</a></li>
			</ul>
		</div></li>
	<!-- ============================================================== -->
	<!-- End Comment -->
	<!-- ============================================================== -->