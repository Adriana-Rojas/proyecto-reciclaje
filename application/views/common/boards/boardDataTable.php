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
                                <h4 class="card-title"><?= $board;?></h4>
                                <h6 class="card-subtitle"></h6>
                                <div class="table-responsive">
                                    <table id="myTable" class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                            <th>Acci&oacute;n</th>
                                                <th>ID</th>
                                                <th width="50%">Nombre</th>
                                                <th>Estado</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php 
                                                        if($listaLista != null){
                                                            $i=1;
                                                            foreach ($listaLista->result() as $value) {
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
                                                                	href="<?= base_url().$valueBoard->PAGINA.$this->encryption->encrypt($value->ID); ?>" >
                                                                    <i class="<?= $valueBoard->ICONO ?>"></i> 
                                                                    <?= $valueBoard->NOMBRE ?> 
                                                                </a>
                                                                <?php 
                                                                    	}
                                                                	} ?>
                                                           </div>
                                                    </div>
                                                </td>
                                                <td><?= $value->ID;?></td>
                                                <td>
                                                    <?= $value->NOMBRE;?>
                                                </td>
                                                <td><span class="<?= validaEstadosGenerales($value->ESTADO,'CLASE')?>">
                                                                    <?= validaEstadosGenerales($value->ESTADO,'NOMBRE') ?>
                                                             </span> </td>
                                                
                                            </tr>
                                            <?php 
                                                            $i++;
                                                             
                                                            }//end foreach
                                                    }//end if
                                            ?>
                                        </tbody>
                                        
                                    </table>
                                </div>
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
                            </div>
                        </div>
                        
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                
            
