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
                                <h4 class="card-title"><?= $board;?></h4>
                                <h6 class="card-subtitle"></h6>
                                <div class="table-responsive">
                                	<!-- Pinto opción para busqueda -->
                                	<a href="<?= base_url().$filtro; ?>" class="btn btn-info btn-rounded "> 
			                                                <i  class="fa fa-filter"></i>
			                                                <span class="hidden-xs"> Filtrar</span>
			                        </a>
                                    <table id="demo-foo-addrow" class="table m-t-30 table-hover " data-page-size="20">
                                        <thead>
                                            <tr>
                                                <th>C&oacute;digo</th>
                                                <th>Tipo de orden</th>
                                                <th>Nombre</th>
                                                <th >Ubicaci&oacute;n</th>
                                                <th >Primer subnivel</th>
                                                <th >Segundo subnivel</th>
                                                <th >Tercer subnivel</th>
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
                                                <td><?= $value->CODIGO;?></td>
                                                <td><?= $value->NOMBRE;?></td>
                                                <td>
                                                    <?= $value->TIPOORDEN;?>
                                                </td>
                                                <td>
                                                    <?= $value->PRIMERNIVEL;?>
                                                </td>
                                                <td>
                                                    <?= $value->SUBNIVEL;?>
                                                </td>
                                                <td>
                                                    <?= $value->SUBNIVEL2;?>
                                                </td>
                                                <td>
                                                    <?= $value->SUBNIVEL3;?>
                                                </td>
                                                
                                                
                                                <td><span class="<?= validaEstadosGenerales($value->ESTADO,'CLASE')?>">
                                                                    <?= validaEstadosGenerales($value->ESTADO,'NOMBRE') ?>
                                                             </span> </td>
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
                                        <tfoot>
                                            <tr>
                                                <td colspan="6">
                                                    <?php
                                                if ($botonesBoard!=null){
		                                                foreach ($botonesBoard as $value) {
		                                            ?>
		                                            <button type="button" 
		                                            		id="disparaModal" 
		                                            		class="btn btn-info btn-rounded"
		                                            		data-whatever="@mdo">
			                                            		<i  class="<?= $value->ICONO ?>">
			                                            		</i>
			                                            		<?= $value->NOMBRE ?>
		                                            </button>
		                                            <script >
			                                            $(function () {
			                                                $("#disparaModal").on('click', function() {
			                                          //            $('#myModal').modal('toggle');
			                                                      $('#myModal').modal({
			                                                        backdrop: 'static',
			                                                        keyboard: false
			                                                      })
			                                                });
			                                            });
		                                            </script>
		                                            <?php 
		                                                }
                                                } ?>
                                            
                                                   
                                                </td>
                                                
                                                <td colspan="3">
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
                
                
                <!-- .modal -->
                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" id="myModal">
	                    <div class="modal-dialog modal-lg">
	                    	<div class="modal-content">
	                    		<div class="modal-header">
                                	<h4 class="modal-title" id="myLargeModalLabel">Selecci&oacute;n de la ruta para el producto o servicio</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times "></i></button>
                                </div>
                                <div class="modal-body" style="align:'center'">
                                	<center>
                                		<!-- Inicio de la ruta -->
                                		<?= $arbol ?>
	                                	
		                                <!-- Fin de la ruta -->
	                            	</center>
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
                   
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                
            
