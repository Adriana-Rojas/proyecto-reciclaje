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
                <script>
			    	
			       $(document).ready(function() {
			        	$("#disparaModal").on('click',function() {
			            	$.post("<?= base_url()?>/Integration/reloadTree", {
			                	variable : 'OrdersConfigurationProductsDefinition/newRegister/'
			                    }, function(data) { $("#arbol").html(data);});
			            	$('#myModal').modal({
					        	backdrop: 'static',
					            keyboard: false
				            })
			       		});
				   });
				   
			       $(document).ready(function() {
			        	$("#disparaFiltro").on('click',function() {
			            	$.post("<?= base_url()?>/Integration/reloadTree", {
			                	variable : 'OrdersConfigurationProductsDefinition/board/'
			                    }, function(data) { $("#arbol").html(data);});
			            	$('#myModal').modal({
					        	backdrop: 'static',
					            keyboard: false
				            })
			       		});
				   });
			      
		         </script>
               
        
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Productos parametrizados</h4>
                                <h6 class="card-subtitle"> Para un mejor desempe&ntilde;o de la aplicaci&oacute;n, debe filtrar el &aacute;rbol de productoss y servicios para acceder a ellos </h6>
                                
                                <?php if ($niveles==3){
	                            ?>   
	                            <div class="row">
                               		<!-- Column -->
                                    
                                    <div class="col-md-1 col-lg-1 col-xlg-1">
                                        
                                    </div>
                                    
                                    <!-- Column -->
                                   <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Tipo de orden</h3>
                                                <h6 class="text-white"><?= $nombreTipo;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Ubicaci&oacute;n </h3>
                                                <h6 class="text-white"><?= $nombreMiembros;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Primer subnivel</h3>
                                                <h6 class="text-white"><?= $nomPrimerSubNiv;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Segundo subnivel</h3>
                                                <h6 class="text-white"><?= $nomSegundoSubNiv;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Tercer subnivel</h3>
                                                <h6 class="text-white"><?= $nomTerceroSubNiv;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-1 col-lg-1 col-xlg-1">
                                        
                                    </div>
                                    <!-- Column -->
                                   
                                </div>
	                            <?php }?>
	                            <?php if ($niveles==2){
	                            ?>   
	                            <div class="row">
                               		<!-- Column -->
                                    
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        
                                    </div>
                                    
                                    <!-- Column -->
                                   <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Tipo de orden</h3>
                                                <h6 class="text-white"><?= $nombreTipo;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Ubicaci&oacute;n </h3>
                                                <h6 class="text-white"><?= $nombreMiembros;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Primer subnivel</h3>
                                                <h6 class="text-white"><?= $nomPrimerSubNiv;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Segundo subnivel</h3>
                                                <h6 class="text-white"><?= $nomSegundoSubNiv;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        
                                    </div>
                                    <!-- Column -->
                                   
                                </div>
	                            <?php }?> 
	                            <?php if ($niveles==1){
	                            ?>   
	                            <div class="row">
                               		<!-- Column -->
                                    
                                    <div class="col-md-3 col-lg-3 col-xlg-3">
                                        
                                    </div>
                                    
                                    <!-- Column -->
                                   <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Tipo de orden</h3>
                                                <h6 class="text-white"><?= $nombreTipo;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white"><?php if ($idValida==1){?>Ubicaci&oacute;n<?php }else{?>Tipo<?php }?>   </h3>
                                                <h6 class="text-white"><?= $nombreMiembros;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Primer subnivel</h3>
                                                <h6 class="text-white"><?= $nomPrimerSubNiv;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-md-3 col-lg-3 col-xlg-3">
                                        
                                    </div>
                                    <!-- Column -->
                                   
                                </div>
	                            <?php }?> 
	                            
                                <div class="table-responsive">
                                	<!-- Pinto opci�n para busqueda -->
                                	
			                        <button type="button" id="disparaFiltro" class="btn btn-info btn-rounded" data-whatever="@mdo"><i  class="fa fa-filter"></i> Filtrar</button>
                                    <table id="demo-foo-addrow" class="table m-t-30 table-hover " data-page-size="20">
                                        <thead>
                                            <tr>
                                                <th>Acci&oacute;n</th>
                                                <th>C&oacute;digo</th>
                                                <th>Tipo de orden</th>
                                                <th>Nombre</th>
                                                <th >Ubicaci&oacute;n</th>
                                                <th >Primer subnivel</th>
                                                <th >Segundo subnivel</th>
                                                <th >Tercer subnivel</th>
                                                <th>Estado</th>
                                                
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
	                                                                    	//Debo validar si el registro es interconsultas
	                                                                    	$valores=retornaTipoOrdenFromArbolCodigo($value->ID);
	                                                                    	$idValida=$this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN","ID_VALIDA",$valores[0]);
	                                                                    	$bandera=true;
	                                                                    	if ($valueBoard->ID==ID_TREE_FUNCTION && $idValida==2){
	                                                                    		$bandera=false;
	                                                                    	}
	                                                                    	if ($bandera){
                                                                                
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
                                                <td><?= $value->CODIGO;?></td>
                                                <td>
                                                    <?= $value->TIPOORDEN;?>
                                                </td>
                                                <td><?= $value->NOMBRE;?></td>
                                                
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
                                <div class="modal-body" style="align:'center'" id="arbol">
                                	<div class="col-lg-12 col-md-12 col-sm-312 col-xs-12">
		                                <div class="ribbon-wrapper card">
		                                    <div class="ribbon ribbon-bookmark  ribbon-default">Cargando &aacute;rbol</div>
		                                    <p class="ribbon-content">El sistema de informaci&oacute;n est&aacute; cargando la estructura del &aacute;rbol de productos y servicios, Por favor espere.</p>
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
                   
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                
            
