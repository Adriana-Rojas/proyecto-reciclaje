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
                                <h4 class="card-title">Listado de productos, elementos y servicios para <?= $empresa; ?></h4>
                                <h6 class="card-subtitle"></h6>
                                <div class="table-responsive">
                                     <table id="myTable" class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th >C&oacute;digo</th>
                                                <?php
                                                if ($codigoEmpresa== CTE_VALOR_SI){
                                                ?>
                                                <th >C&oacute;digo propio</th>
                                                <?php
                                                }
                                                ?>
                                                <th>Nombre</th>
                                                <?php
                                                if ($cerrada== CTE_VALOR_SI){
                                                ?>
                                                <th>Precio</th>
                                                <?php
                                                }
                                                ?>
                                                <th>Estado</th>
                                                <th>Acci&oacute;n</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php 
                                                        if($listaLista != null){
                                                            $i=1;
                                                            foreach ($listaLista as $value) {
                                                    ?>
                                            <tr>
                                                <td><?= $i;?></td>
                                                <td> <?= $value->CODIGO ;  ?> </td>
                                                <?php
                                                if ($codigoEmpresa== CTE_VALOR_SI){
                                                ?>
                                                <td> <?= $value->AUXILIAR;  ?> </td>
                                                <?php
                                                }
                                                ?>
                                                <td> <?= $value->NOMBRE;  ?> </td>
                                                <?php
                                                if ($cerrada== CTE_VALOR_SI){
                                                ?>
                                                
                                                <td> <?= $value->PRECIO;  ?> </td>
                                                <?php
                                                }
                                                ?>
                                                <td>
                                                    <span class="<?= validaEstadosGenerales($value->ESTADO,'CLASE')?>">
                                                                    <?= validaEstadosGenerales($value->ESTADO,'NOMBRE') ?>
                                                    </span> 
                                                </td>
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
                                            </tr>
                                            <?php 
                                                            $i++;
                                                             
                                                            }//end foreach
                                                    }//end if
                                            ?>
                                        </tbody>
                                       
                                    </table>
                                </div>

                                    <a href="<?= base_url()?>StokePriceConfigurationListCompany/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
                                                <i class="fa fa-arrow-left"></i>
                                                <span class="hidden-xs"> Retornar</span>
                                            </a>
                                    <?php
                                                if ($botonesBoard!=null){
		                                                foreach ($botonesBoard as $value) {
		                                            ?>
		                                            <a href="<?= base_url().$value->PAGINA.$this->encryption->encrypt($id); ?>" class="btn btn-info btn-rounded"> 
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
                
            
