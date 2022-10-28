<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						P�gina Web.
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2018 *******************************
 */
defined('BASEPATH') OR exit('No direct script access allowed');

?>
        <!-- ============================================================== -->
                <!-- JavaScript para pintar campos adicionales -->
                <!-- ============================================================== -->
                
    			<!-- ============================================================== -->
                <!-- End JavaScript para pintar campos adicionales -->
                <!-- ============================================================== -->
<!-- ============================================================================================================================ -->			 	
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- .row -->
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="card">
                            <div class="card-body">
                            	<?php 
                                 	foreach ($paciente as $value){
                                        $datos=selectPatienInformationFromOrder($this->session->userdata('encOrden'),$this);

                                        $responsable=$datos[0];
                               		 	
                                ?>
                                
                                <div class="row">
                                	<div class="col-md-2 col-xs-6 b-r"> <strong>Tipo de proceso</strong>
                                        <br>
                                        <p class="text-muted"><?= $tipoProceso;?></p>
                                    </div>
                                    <div class="col-md-2 col-xs-6 b-r"> <strong>Documento de identidad</strong>
                                        <br>
                                        <p class="text-muted"><?= $value->TP_ID_PCTE," ",$value->NUM_ID_PCTE;?></p>
                                    </div>
                                    
                                    <div class="col-md-2 col-xs-6 b-r"> <strong>Nombre Completo</strong>
                                        <br>
                                        <p class="text-muted">
                                        <span class="<?= datosGeneroPersona($value->SEXO,'CLASE','fa-1x')?>">
                                                     	<?= datosGeneroPersona($value->SEXO,'NOMBRE','fa-1x') ?>
                                         </span>
                                        <?= $value->PRI_NOM_PCTE," ",$value->SEG_NOM_PCTE," ",$value->PRI_APELL_PCTE," ",$value->SEG_APELL_PCTE;?></p>
                                    </div>
                                    <div class="col-md-2 col-xs-6 b-r"> <strong>Historia</strong>
                                        <br>
                                        <p class="text-muted"><?= $value->ID_PCTE;?></p>
                                    </div>
                                    <div class="col-md-2 col-xs-6 b-r"> <strong>Responsable</strong>
                                        <br>
                                        <p class="text-muted"><?= $responsable;?></p>
                                    </div>
                                    <div class="col-md-2 col-xs-6"> <strong>Edad</strong>
                                        <br>
                                        <p class="text-muted">
                                        	<?=intervaloTiempo($value->FECH_NCTO_PCTE,cambiaHoraServer(2),31104000);
                                                	?> A&ntilde;os
                                         </p>
                                    </div>
                                </div>
                                <?php 
                                }?>
                                
                                <hr>
                                <div class="row">
									<h5 class="card-title">Seleccionar ubicaci&oacute;n para validar elementos o servicios <small>Navegue por el &aacute;rbol de productos y servicios</small></h5>
                                	
                                	<div class="col-md-12 col-xs-12"> 
                                        <?= $arbol;?>
                                    </div>
                                	
                                </div>
                                
                            </div>
                        </div>
                    	
                    </div>
                </div>
                <!-- /.row -->
                
           
	            <!-- ============================================================== -->
	            <!-- End PAge Content -->
	            <!-- ============================================================== -->
