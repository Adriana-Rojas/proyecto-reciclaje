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



?>
				
    			<!-- ============================================================== -->
                <!-- Start JavaScript para pintar campos adicionales -->
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
                    <div class="col-md-12 col-xs-12">
                        <div class="card">
                            <div class="card-body">
                            	<div class="row">
                                	<div class="col-md-2 col-xs-6 b-r"> <strong>Tipo</strong>
                                        <br>
                                        <p class="text-muted"><?= traslateIdToSponsorShipKind($tipo);?></p>
                                    </div>
                                    <div class="col-md-2 col-xs-6 b-r"> <strong>Patrocinio </strong>
                                        <br>
                                        <p class="text-muted"><?= $patrocinio;?></p>
                                    </div>
                                    <div class="col-md-2 col-xs-6 b-r"> <strong>Documento de identidad	</strong>
                                        <br>
                                        <p class="text-muted"><?= traslateIdToEsalud($idTipo)." ".$documento; ?></p>
                                    </div>
                                    
                                    <div class="col-md-2 col-xs-6 b-r"> <strong>Nombre Completo</strong>
                                        <br>
                                        <p class="text-muted"><?php 
                                            $id = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud (
                                            "T_PACIENTES",
                                            "ID_PCTE",
                                            "TP_ID_PCTE",
                                                traslateIdToEsalud ( $idTipo),
                                            "NUM_ID_PCTE",
                                                $documento );
                                        
                                             echo $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud ( "T_PACIENTES", "PRI_NOM_PCTE", "ID_PCTE", $id ) . " " .
                                            $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud ( "T_PACIENTES", "SEG_NOM_PCTE", "ID_PCTE", $id ) . " " .
                                            $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud ( "T_PACIENTES", "PRI_APELL_PCTE", "ID_PCTE", $id ) . " " .
                                            $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud ( "T_PACIENTES", "SEG_APELL_PCTE", "ID_PCTE", $id );
                                        
                                        ?>
                                        </p>
                                    </div>
                                    <div class="col-md-2 col-xs-6 b-r"> <strong>Fecha de generaci&oacute;n</strong>
                                        <br>
                                        <p class="text-muted"><?php
                                                        //list($fecha,$hora)= explode(' ',$fecha);
                                                        echo $fecha; ?></p>
                                    </div>
                                    <div class="col-md-2 col-xs-6 b-r"> <strong>Estado </strong>
                                        <br>
                                        <p class="text-muted"><span class="<?= validaEstadosGeneralesPatrocinios($estado,'CLASE')?>">
                                                                    <?= validaEstadosGeneralesPatrocinios($estado,'NOMBRE') ?>
													</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Column -->
                </div>
                <form class=" form-horizontal" role="form" action="<?= base_url()?>SponsorshipsAppSponsorships/saveInactive" id="form_sample_3" method="post" autocomplete="off" enctype="multipart/form-data">
	                                    	 
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Anulaci&oacute;n de patrocinio</h5>
								<div class="form-group">
                               		<label class="col-md-12" for="grupo">Observaci&oacute;n de anulaci&oacute;n *</label>
                                    <div class="col-md-12">
	                                    <textarea rows="4" cols="100" class="form-control "
                    								id="observacion" name="observacion" placeholder="Detalle la observaci&oacute;n  de anulaci&oacute;n del patrocinio"  ></textarea>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                                
                               
                                <a href="<?= base_url()?>SponsorshipsAppSponsorships/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
			                     <i class="fa fa-arrow-left"></i>
			                     <span class="hidden-xs"> Retornar</span>
			                    </a> 
                                <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
	                			
	                			<input type="hidden" name="id" id="id" value="<?= $idPatrocinio;?>">
                                
                            </div>
                        </div>
                    </div>
                    
                    <!-- Column -->
                </div>  
                </form>
	            <!-- ============================================================== -->
	            <!-- End PAge Content -->
	            <!-- ============================================================== -->
               
    			<!-- Timeline CSS -->
    			
    
            
