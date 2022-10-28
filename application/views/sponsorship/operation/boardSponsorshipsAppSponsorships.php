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
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><i class="fa fa-newspaper-o fa-2x"></i> Listado de Patrocinios generados dentro del per&iacute;odo <?= date('m');?> - <?= date('Y');?></h4>
                                <h6 class="card-subtitle"></h6>
                                <div class="table-responsive">
                                    <table id="demo-foo-addrow" class="table m-t-30 table-hover " data-page-size="10">
                                        <thead>
                                            <tr>
                                            	<th>Acci&oacute;n</th>
                                                <th>Patrocinio</th>
                                                <th >Tipo</th>
                                                <th >Documento</th>
                                                <th >Nombres y apellidos</th>
                                                <th >Fecha</th>
                                                 <th >Usuario</th>
                                                <th >Estado</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php 
                                                        if($listaLista!=null){
                                                            $i=1;
                                                            foreach ($listaLista as $value) {
                                                    ?>
                                            <tr>
                                            	<td>
                                                    <!--  
                                                    <button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button>
                                                    -->
                                                    <div class="btn-group">
                                                    	<button type="button" class="btn btn-info btn-rounded dropdown-toggle" data-toggle="dropdown" 
                                                        		aria-haspopup="true" aria-expanded="false">
								                                       <i class="fa fa-bars"></i> 
                                                    	</button>
                                                        	<div class="dropdown-menu animated lightSpeedIn">
                                                            	<?php
                                                                	if($listaBoard!=null){
                                                                    	foreach ($listaBoard as $valueBoard) {
                                                                    	    if($valueBoard->ID=='214' && $value->ESTADO=='P'){
																?>
                                                                <a class="dropdown-item" 
                                                                	href="<?= base_url().$valueBoard->PAGINA.$this->encryption->encrypt($value->ID); ?>" >
                                                                    <i class="<?= $valueBoard->ICONO ?>"></i> 
                                                                    <?= $valueBoard->NOMBRE ?> 
                                                                </a>
                                                                <?php 
                                                                    	
                                                                    	    }else  if($valueBoard->ID=='215' && ($value->ESTADO=='P' || $value->ESTADO=='S' )){
                                                                ?>
                                                                 <a class="dropdown-item" 
                                                                	href="<?= base_url().$valueBoard->PAGINA.$this->encryption->encrypt($value->ID); ?>" >
                                                                    <i class="<?= $valueBoard->ICONO ?>"></i> 
                                                                    <?= $valueBoard->NOMBRE ?> 
                                                                </a> 
                                                                <?php 
                                                                    	
                                                                    	    }else  if($valueBoard->ID=='213'){
                                                                ?>
                                                                 <a class="dropdown-item" 
                                                                	href="<?= base_url().$valueBoard->PAGINA.$this->encryption->encrypt($value->ID); ?>" >
                                                                    <i class="<?= $valueBoard->ICONO ?>"></i> 
                                                                    <?= $valueBoard->NOMBRE ?> 
                                                                </a>   	        
                                                                <?php    	        
                                                                    	    }
                                                                    	}
                                                                	} ?>
                                                                
                                                           </div>
                                                    </div>
                                                </td>
                                                <td><?= $value->ID;?></td>
                                                 <td><?= traslateIdToSponsorShipKind($value->ID_TIPO);?></td>
                                                <td><?= traslateIdToEsalud($value->TIPO_DOC)." ".$value->DOCUMENTO; ?></td>
                                                <td><?php
                                                        //Obtengo el id de la adminisión
                                                        $id = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud ( 
                                                                            "T_PACIENTES", 
                                                                            "ID_PCTE", 
                                                                            "TP_ID_PCTE", 
                                                                            traslateIdToEsalud ( $value->TIPO_DOC ), 
                                                                            "NUM_ID_PCTE", 
                                                                            $value->DOCUMENTO );
                                                
                                                         echo $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud ( "T_PACIENTES", "PRI_NOM_PCTE", "ID_PCTE", $id ) . " " . 
                                                             $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud ( "T_PACIENTES", "SEG_NOM_PCTE", "ID_PCTE", $id ) . " " .
                                                             $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud ( "T_PACIENTES", "PRI_APELL_PCTE", "ID_PCTE", $id ) . " " . 
                                                             $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud ( "T_PACIENTES", "SEG_APELL_PCTE", "ID_PCTE", $id );?></td>
                                                <td><?= $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "FECHA", "ID", $value->FECHA); ?></td>
                                               
                                                <td><?= $value->USUIDE;?></td>
                                                <td>
                                                	<span class="<?= validaEstadosGeneralesPatrocinios($value->ESTADO,'CLASE')?>">
                                                                    <?= validaEstadosGeneralesPatrocinios($value->ESTADO,'NOMBRE') ?>
													</span>
												</td>
                                                
                                            </tr>
                                            <?php 
                                                            $i++;
                                                             
                                                            }//end foreach
                                                    }//end if
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="6">
                                                    <?php
                                                if ($botonesBoard!=null){
		                                                foreach ($botonesBoard as $value) {
		                                            ?>
		                                            <a href="<?= base_url().$value->PAGINA; ?>" class="btn btn-info btn-rounded"> 
		                                                <i  class="<?= $value->ICONO ?>"></i>
		                                                <span class="hidden-xs"> <?= $value->NOMBRE ?></span>
		                                            </a>
		                                            <?php 
		                                                }
                                                } ?>
                                            
                                                   
                                                </td>
                                                
                                                <td colspan="2">
                                                    <div class="text-right">
                                                        <ul class="pagination"> </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                
            
