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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-body printableArea">
                        	<img src="<?= base_url()?>/assets/images/logoCirec.png"  width="292 px" height="96 px">
                            <small style="text-align:right; "> <?= $this->FunctionsGeneral->getFieldFromTableNotId("ADM_PARAMETROS", "COD_ORDENES", "ID", 1);?></small>
                            <hr>
                            <div class="row">
                            	<div class="col-md-12">
                                    <div class="pull-right text-right">
                                        <address>
                                           <p class="m-t-30"><b>Generaci&oacute;n de las &oacute;rdenes :</b> <i class="fa fa-calendar"></i> <?= $fechaOrden;?></p>
                                           
                                        </address>
                                    </div>
                                    
                                </div>
                            </div>
                            <?php 
                                 	foreach ($paciente as $value){
                                        $datos=selectPatienInformationFromOrder($this->session->userdata('encOrden'),$this);

                                        $responsable=$datos[0];
                               		 	
                                ?>
                                
                                <div class="row">
                                	<div class="col-md-12">
	                                	<div class="pull-left">
	                                        <address>
	                                            <h3> &nbsp;<b class="text-danger"><?= $value->PRI_NOM_PCTE," ",$value->SEG_NOM_PCTE," ",$value->PRI_APELL_PCTE," ",$value->SEG_APELL_PCTE;?></b></h3>
	                                            <p class="text-muted m-l-5"><strong>Documento de identidad </strong>  <?= $value->TP_ID_PCTE," ",$value->NUM_ID_PCTE;?>
	                                                <br/> <strong>Registro </strong> <?= $value->ID_PCTE;?>
	                                                <!--<br/> <strong> Edad </strong>//intervaloTiempo($value->FECH_NCTO_PCTE,cambiaHoraServer(2),31104000);?> A&ntilde;os-->
	                                                <br/> <strong> Edad </strong>28 A&ntilde;os
	                                                <br/> <strong>Responsable </strong>NUEVA EMPRESA PROMOTORA DE SALUD S A<?= $responsable;?>
	                                                
	                                        </address>
	                                    </div>
                                    </div>
                                </div>
                                <?php 
                                }?>
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="table-responsive m-t-40" style="clear: both;">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>C&oacute;digo</th>
                                                    <th>Descripci&oacute;n</th>
                                                    <th>Observaci&oacute;n</th>
                                                    <th class="text-right">Cantidad</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                           		 <?php 
                                            	if($listaLista != null){
                                                	foreach ($listaLista as $value) {
                                                    	
                                                    ?>
                                                <tr>
                                                    <td class="text-center"><?= $value->PREFIJO," - ",$value->CONS;?></td>
                                                    <td><?= $value->CODIGO;?></td>
                                                    <td><?= $value->NOMBRE;?></td>
                                                    <td><?=  $this->encryption->decrypt ($value->OBSERVACION);?></td>
                                                    <td class="text-right"><?= $value->CANTIDAD;?> </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center"></td>
                                                    <td>1600719</td>
                                                    <td>KIT ADICIONAL-PROTESIS MIEMBRO INFERIOR</td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
	                                                <?php 
	                                                }//end foreach
	                                            }//end if
	                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="pull-right m-t-30 text-right">
                                        <p>&nbsp;</p>
                                        <p>&nbsp; </p>
                                        <hr>
                                        <h4>Jorge Morales</h4>
                                        <h6><?= $especialidad;?></h6>
                                    </div>
                                    <div class="clearfix"></div>
                                    
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center">
                                <div class="col-md-12">
                            		 <?= $empresa;?>
                            	</div>
                            	
                            </div>
                            <div class="row text-center">
                                <div class="col-md-4">
                            		<small><i class='fa fa-map-marker '></i> <?= $direccion;?></small>
                            	</div>
                            	<div class="col-md-4">
                            		<small><i class='fa fa-phone-square '></i> <?= $telefono;?></small>
                            	</div>
                            	<div class="col-md-4">
                            		<small><i class='fa fa-envelope '></i> <?= $correo;?></small>
                            	</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                	<a href="<?= base_url().$returnPage ?>" class="btn btn-info btn-rounded"> 
		                        	<i  class="fa fa-user"></i>
		                            <span class="hidden-xs"> Nuevo paciente</span>
		                        </a>
		            
                	<button id="print" class="btn btn-default btn-rounded" type="button"> <span><i class="fa fa-print"></i> Imprimir</span> </button>
                </div>
                <br>
                <script src="<?= base_url()?>/assets/dist/js/pages/jquery.PrintArea.js" type="text/JavaScript"></script>
			    <script>
			    $(document).ready(function() {
			        $("#print").click(function() {
			            var mode = 'iframe'; //popup
			            var close = mode == "popup";
			            var options = {
			                mode: mode,
			                popClose: close
			            };
			            $("div.printableArea").printArea(options);
			        });
			    });
			    </script>
                
           
	            <!-- ============================================================== -->
	            <!-- End PAge Content -->
	            <!-- ============================================================== -->