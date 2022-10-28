<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electrónico:          	jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:						Página Web.
 *************************************************************************
 *************************************************************************
 ******************** BOGOTÁ COLOMBIA 2018 *******************************
 */
defined('BASEPATH') OR exit('No direct script access allowed');
//Calculo el porcentaje
if ($shelterList!=null){
    $porcentaje=round(($cantidadOcupacion/count($shelterList))*100,2);
    $porcentajeReservas=round(($cantidadReservas/count($shelterList))*100,2);
}else{
    $porcentaje=0;
    $porcentajeReservas=0;
    
}



?>

        		 <!-- ============================================================== -->
                <!-- JavaScript para pintar campos adicionales -->
                <!-- ============================================================== -->
                
    			<!-- ============================================================== -->
                <!-- End JavaScript para pintar campos adicionales -->
                <!-- ============================================================== -->
        
        
               <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5 ">
                    	<center>
                        <?php
                            if ($botonesBoard!=null){
    		                	foreach ($botonesBoard as $value) {
    		                ?>
    		                <a href="<?= base_url().$value->PAGINA; ?>" class="btn btn-dark btn-rounded "> 
    		                <i  class="<?= $value->ICONO ?>"></i>
    		                <span class="hidden-xs"> <?= $value->NOMBRE ?></span>
    		                </a>
    		                <?php 
    		                	}
                            } 
                            ?>
                            <br>
                            <br>
                            </center>
                        <div class="card ">
                            <div class="card-body bg-primary">
                                <h4 class="card-title text-white">Ocupaci&oacute;n Actual</h4>
                                <div class="text-right text-white"> <span class="text-white">Hu&eacute;spedes</span>
                                    <h1 class="font-light"><sup></sup> <?= $cantidadOcupacion;?> </h1>
                                </div>
                                <span class="text-dark"><?= $porcentaje;?> %</span>
                                <div class="progress">
                                    <div class="progress-bar bg-dark" role="progressbar" style="width: <?= ceil($porcentaje);?>%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body bg-info">
                                <h4 class="card-title text-white">Reservas para el d&iacute;a</h4>
                                <div class="text-right"> <span class="text-white">Hu&eacute;spedes</span>
                                    <h1 class="font-light text-white"><sup></sup> <?= $cantidadReservas;?></h1>
                                </div>
                                <span class="text-dark"><?= $porcentajeReservas;?> %</span>
                                <div class="progress">
                                    <div class="progress-bar bg-dark" role="progressbar" style="width: <?= ceil($porcentajeReservas);?>%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body bg-dark">
                                <h4 class="card-title text-white"><i class="fa fa-bed" ></i> Reglas del Hogar de paso</h4>
                                <div class="text-left text-white">
                                    <ol>
                                    <li> En el momento de realizar una reserva u ocupar una habitaci&oacute;n en el hogar de paso debe tener en cuenta que deben estar dos personas del mismo sexo, excepto si la habitaci&oacute;n la ocupa familiares.</li>
                                    <li> Un menor de edad debe estar ubicado en la misma habitaci&oacute;n de su acompa&ntilde;ante.</li>
                                    <li> En el momento de realizar un traslado de un Usuario a una Nueva Cama debe verificar primero la disponibilidad de la cama a asignar.</li>
                                    <li> En el momento de realizar una pr&oacute;rroga de ocupaci&oacute;n del Hogar de Paso de un Usuario debe verificar primero la disponibilidad de la cama a asignar. Y si esta se encuentra reservada debe indagar la reserva con la Trabajadora Social responsable del paciente que tiene reservada dicha cama.</li>
                                    <li> Se debe realizar una confirmaci&oacute;n telef&oacute;nica de la Ocupaci&oacute;n de la reserva previamente creada con el fin de cancelar dicha reserva en el caso de que no se vaya a Ejecutar la ocupaci&oacute;n.</li>
                                    </ol>
                                </div>
                                
                            </div>
                        </div>
                        
                        
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                    	
                    	<div class="card">
	                    	<div class="row">
			                    <div class="col-12 m-t-30">
			                        <h1 class="m-b-0"><i class="fa fa-list-ol" aria-hidden="true"></i> Ocupaci&oacute;n actual</h1>
			                    </div>
			                    <?php
			                    $i=0;
			                    if($shelterList!= null){
			                    foreach ($shelterList as $value){
			                    	if($i%2==0){
			                    		
			                    ?>
			                    	<div class="col-md-2">
			                    	</div>
			                    	<div class="col-md-4">
			                    		<div class="card text-white bg-<?= validaColorEstado( $value->ID_ESTADO)?>">
			                    			<div class="card-header">
			                    				<h4 class="m-b-0 text-white"><?= $value->HABITACION." - ".$value->CAMA;?></h4>
			                    			</div>
			                    			<div class="card-body">
			                    					<h3 class="card-title"><i class="<?= $value->ICONO;?> fa-2x"></i> <?= $value->ESTADO;?></h3>
			                    					<div class="btn-group pull-right">
                                                    	<button type="button" class="btn-dark pull-right btn-rounded dropdown-toggle" data-toggle="dropdown" 
                                                        		aria-haspopup="true" aria-expanded="false">
								                                       <i class="fa fa-bars"></i> 
                                                    	</button>
                                                        	<div class="dropdown-menu animated lightSpeedIn">
                                                            	<?php
                                                            	if($listaBoard!=null){
                                                                    	foreach ($listaBoard as $valueBoard) {
                                                                    		//Verifico los enlaces para que se visualicen de acuerdo a los estados
                                                                    		if($value->ID_ESTADO==SHELTER_FREE && $valueBoard->PAGINA=='ShelterAppShelter/maintenance/' ){
                                                                    			
                                                                                
																?>
                                                                <a class="dropdown-item" 
                                                                	href="<?= base_url().$valueBoard->PAGINA.$this->encryption->encrypt($value->ID); ?>" >
                                                                    <i class="<?= $valueBoard->ICONO ?>"></i> 
                                                                    <?= $valueBoard->NOMBRE ?> 
                                                                </a>
                                                                <?php 		}else if($value->ID_ESTADO==SHELTER_MANT && $valueBoard->PAGINA=='ShelterAppShelter/endMaintenance/' ){?>
                                                                <a class="dropdown-item" 
                                                                	href="<?= base_url().$valueBoard->PAGINA.$this->encryption->encrypt($value->ID); ?>" >
                                                                    <i class="<?= $valueBoard->ICONO ?>"></i> 
                                                                    <?= $valueBoard->NOMBRE ?> 
                                                                </a>
                                                                <?php 		}else if($value->ID_ESTADO==SHELTER_RESERVE && (
                                                                							$valueBoard->PAGINA=='ShelterAppShelter/checkIn/' ||
                                                                                            $valueBoard->PAGINA=='ShelterAppShelter/closeRegister/'||
                                                                                            $valueBoard->PAGINA=='ShelterAppShelter/modifyInformation/'
                                                                							) ){?>
                                                                <a class="dropdown-item" 
                                                                	href="<?= base_url().$valueBoard->PAGINA.$this->encryption->encrypt($value->ID); ?>" >
                                                                    <i class="<?= $valueBoard->ICONO ?>"></i> 
                                                                    <?= $valueBoard->NOMBRE ?> 
                                                                </a>
                                                                <?php 		}else if($value->ID_ESTADO==SHELTER_FULL && (
                                                                							$valueBoard->PAGINA=='ShelterAppShelter/checkOut/' ||
                                                                							$valueBoard->PAGINA=='ShelterAppShelter/moreTime/' ||
                                                                							$valueBoard->PAGINA=='ShelterAppShelter/traslateRoom/' ||
                                                                                            $valueBoard->PAGINA=='ShelterAppShelter/modifyInformation/'
                                                                							) ){?>
                                                                <a class="dropdown-item" 
                                                                	href="<?= base_url().$valueBoard->PAGINA.$this->encryption->encrypt($value->ID); ?>" >
                                                                    <i class="<?= $valueBoard->ICONO ?>"></i> 
                                                                    <?= $valueBoard->NOMBRE ?> 
                                                                </a>
                                                                <?php 		}else if(($value->ID_ESTADO==SHELTER_FULL || $value->ID_ESTADO==SHELTER_RESERVE) && (
                                                                    $valueBoard->PAGINA=='ShelterAppShelter/details/' ) ){?>
                                                                <a class="dropdown-item" href="#" id="detalle_<?= $value->ID_ESTADO."_".$value->ID?>">
                                                                    <i class="<?= $valueBoard->ICONO ?> "></i> 
                                                                    <?= $valueBoard->NOMBRE ?> 
                                                                </a>
                                                                <script>
			    	
																       $(document).ready(function() {
																        	$("#detalle_<?= $value->ID_ESTADO."_".$value->ID;?>").on('click',function() {
																            	$.post("<?= base_url()?>Integration/reloadInformationUserShelterFromLocation", {
																                	id : '<?= $value->ID; ?>'
																                    }, 
																                    function(data) { 
																	                    //Pinto información respectiva
																	                    $("#arbol").html(data);
																	                    }
																                    );
																            	$('#myModal').modal({
																		        	backdrop: 'static',
																		            keyboard: false
																	            })
																       		});
																	   });
																</script>
                                                                
                                                                <?php 
																			}
                                                                    	}
                                                                	} ?>
                                                           </div>
                                                    </div>
			                    					
			                    		 	</div>
			                    		</div>
			                    	</div>	
			                    <?php 	
			                    	}else{
			                    		?>
			                    	
			                    	<div class="col-md-4">
			                    		<div class="card text-white bg-<?= validaColorEstado( $value->ID_ESTADO)?>">
			                    			<div class="card-header">
			                    				<h4 class="m-b-0 text-white"><?= $value->HABITACION." - ".$value->CAMA;?></h4>
			                    			</div>
			                    			<div class="card-body">
			                    					<h3 class="card-title"><i class="<?= $value->ICONO;?> fa-2x"></i> <?= $value->ESTADO;?></h3>
			                    					<div class="btn-group pull-right">
                                                    	<button type="button" class="btn-dark pull-right btn-rounded dropdown-toggle" data-toggle="dropdown" 
                                                        		aria-haspopup="true" aria-expanded="false">
								                                       <i class="fa fa-bars"></i> 
                                                    	</button>
                                                        	<div class="dropdown-menu animated lightSpeedIn">
                                                            	<?php
                                                                	if($listaBoard!=null){
                                                                    	foreach ($listaBoard as $valueBoard) {
                                                                    		//Verifico los enlaces para que se visualicen de acuerdo a los estados
                                                                    		if($value->ID_ESTADO==SHELTER_FREE && $valueBoard->PAGINA=='ShelterAppShelter/maintenance/' ){
                                                                    			
                                                                                
																?>
                                                                <a class="dropdown-item" 
                                                                	href="<?= base_url().$valueBoard->PAGINA.$this->encryption->encrypt($value->ID); ?>" >
                                                                    <i class="<?= $valueBoard->ICONO ?>"></i> 
                                                                    <?= $valueBoard->NOMBRE ?> 
                                                                </a>
                                                                <?php 		}else if($value->ID_ESTADO==SHELTER_MANT && $valueBoard->PAGINA=='ShelterAppShelter/endMaintenance/' ){?>
                                                                <a class="dropdown-item" 
                                                                	href="<?= base_url().$valueBoard->PAGINA.$this->encryption->encrypt($value->ID); ?>" >
                                                                    <i class="<?= $valueBoard->ICONO ?>"></i> 
                                                                    <?= $valueBoard->NOMBRE ?> 
                                                                </a>
                                                                <?php 		}else if($value->ID_ESTADO==SHELTER_RESERVE && (
                                                                							$valueBoard->PAGINA=='ShelterAppShelter/checkIn/' ||
                                                                                            $valueBoard->PAGINA=='ShelterAppShelter/closeRegister/'||
                                                                                            $valueBoard->PAGINA=='ShelterAppShelter/modifyInformation/'
                                                                							) ){?>
                                                                <a class="dropdown-item" 
                                                                	href="<?= base_url().$valueBoard->PAGINA.$this->encryption->encrypt($value->ID); ?>" >
                                                                    <i class="<?= $valueBoard->ICONO ?>"></i> 
                                                                    <?= $valueBoard->NOMBRE ?> 
                                                                </a>
                                                                <?php 		}else if($value->ID_ESTADO==SHELTER_FULL && (
                                                                							$valueBoard->PAGINA=='ShelterAppShelter/checkOut/' ||
                                                                							$valueBoard->PAGINA=='ShelterAppShelter/moreTime/' ||
                                                                                            $valueBoard->PAGINA=='ShelterAppShelter/traslateRoom/'||
                                                                                            $valueBoard->PAGINA=='ShelterAppShelter/modifyInformation/'
                                                                							) ){?>
                                                                <a class="dropdown-item" 
                                                                	href="<?= base_url().$valueBoard->PAGINA.$this->encryption->encrypt($value->ID); ?>" >
                                                                    <i class="<?= $valueBoard->ICONO ?>"></i> 
                                                                    <?= $valueBoard->NOMBRE ?> 
                                                                </a>
                                                                <?php 		}else if(($value->ID_ESTADO==SHELTER_FULL || $value->ID_ESTADO==SHELTER_RESERVE) && (
                                                                							$valueBoard->PAGINA=='ShelterAppShelter/details/'
                                                                							) ){?>
                                                                <a class="dropdown-item" href="#" id="detalle_<?= $value->ID_ESTADO."_".$value->ID?>">
                                                                    <i class="<?= $valueBoard->ICONO ?> "></i> 
                                                                    <?= $valueBoard->NOMBRE ?> 
                                                                </a>
                                                                <script>
			    	
		                                                                $(document).ready(function() {
																        	$("#detalle_<?= $value->ID_ESTADO."_".$value->ID;?>").on('click',function() {
																            	$.post("<?= base_url()?>Integration/reloadInformationUserShelterFromLocation", {
																                	id : '<?= $value->ID; ?>'
																                    }, 
																                    function(data) { 
																	                    //Pinto información respectiva
																	                    $("#arbol").html(data);
																	                    }
																                    );
																            	$('#myModal').modal({
																		        	backdrop: 'static',
																		            keyboard: false
																	            })
																       		});
																	   });
																</script>
                                                                <?php 
																			}
                                                                    	}
                                                                	} ?>
                                                           </div>
                                                    </div>
			                    		 	</div>
			                    		</div>
			                    	</div>
			                    	<div class="col-md-2">
			                    	</div>				                    	
			                   <?php 
			                    	}
			                    	$i++;
			                    }
			                    }
			                    ?>
			                    
			                   
			                    
	                		</div>
	                	</div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- .modal -->
                <div class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" id="myModal">
	                    <div class="modal-dialog ">
	                    	<div class="modal-content">
	                    		<div class="modal-header">
                                	<h4 class="modal-title" id="myLargeModalLabel"><i class="fa fa-address-book-o "></i> Detalle de informaci&oacute;n del hu&eacute;sped</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times "></i></button>
                                </div>
                                <div class="modal-body" style="align:'center'" id="arbol">
                                	<div class="col-lg-12 col-md-12 col-sm-312 col-xs-12">
		                                <div class="ribbon-wrapper card">
		                                    <div class="ribbon ribbon-bookmark  ribbon-default">Cargando informaci&oacute;n del hu&eacute;sped</div>
		                                    <p class="ribbon-content">El sistema de informaci&oacute;n est&aacute; cargando los datos del hu&eacute;sped.</p>
		                                </div>
		                            </div>
                                </div>
                                <div class="modal-footer" style="color: white;">
                                	<button type="button" class="btn  btn-rounded waves-effect text-left" data-dismiss="modal">Cerrar</button>
			                		
                                </div>
                            </div>
                            <!-- /.modal-content -->
                       </div>
                       <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                
            
