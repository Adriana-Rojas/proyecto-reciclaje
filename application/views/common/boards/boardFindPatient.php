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
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><i class='fa fa-user fa-2x'></i> Registros encontrados</h4>
                                <h6 class="card-subtitle " style="color: red;"> <i class='fa fa-exclamation-triangle'></i> Recuerde que s&oacute;lo se traen pacientes que tengan una admisi&oacute;n activa. <i class='fa fa-exclamation-triangle'></i> </h6>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Acci&oacute;n</th>
                                                <th>Admisi&oacute;n</th>
                                                <th>Historia</th>
                                                <th>Documento</th>
                                                <th >Nombre y apellidos</th>
                                                <!--<th>Responsable</th>-->
                                                <th>Edad</th>
                                                <th>Genero</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php 
                                                        if($listaLista != null){
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
                                                                                
																?>
                                                                <a class="dropdown-item" 
                                                                	href="<?= base_url().$valueBoard->PAGINA.$this->encryption->encrypt($value->ADMISION); ?>" >
                                                                    <i class="<?= $valueBoard->ICONO ?>"></i> 
                                                                    <?= $valueBoard->NOMBRE ?> 
                                                                </a>
                                                                <?php 
                                                                    	}
                                                                	
                                                                	} ?>
                                                           </div>
                                                    </div>
                                                </td>
                                                <td><?= $value->ADMISION;?></td>
                                                <td><?= $value->ID_PCTE;?></td>
                                                <td><?= $value->TP_ID_PCTE," ",$value->NUM_ID_PCTE;?></td>
                                                <td><?= $value->PRI_NOM_PCTE," ",$value->SEG_NOM_PCTE," ",$value->PRI_APELL_PCTE," ",$value->SEG_APELL_PCTE;?></td>
                                                <!--<td><?= $value->RESPONSABLE;?></td>-->
                                                <td><?=intervaloTiempo($value->FECH_NCTO_PCTE,cambiaHoraServer(2),31104000);
                                                	?> A&ntilde;os
                                                </td>
                                                <td>
                                                	<span class="<?= datosGeneroPersona($value->SEXO,'CLASE')?>">
                                                     	<?= datosGeneroPersona($value->SEXO,'NOMBRE') ?>
                                                    </span>
                                                
                                                	
                                                </td>
                                                
                                            </tr>
                                            <?php 
                                                            $i++;
                                                             
                                                            }//end foreach
                                                    }//end if
                                            ?>
                                        </tbody>
                                        
                                    </table>
                                </div>
                                
                            </div>
                            
                        </div>
                        <div class="row">
				        	<div class="col-sm-12">
				            	<a href="<?= base_url().$returnPage?>" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
		                        	<i class="fa fa-arrow-left"></i>
		                            <span class="hidden-xs"> Retornar</span>
				                </a>
				            </div>   
				            <div class="col-sm-12">
				            	<br>
				            </div> 
				       </div>
                    </div>
                    
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                
            
