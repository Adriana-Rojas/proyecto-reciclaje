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
                <!-- JavaScript para pintar campos adicionales -->
                <!-- ============================================================== -->
                <script>
			    	
			       $(document).ready(function() {
			        	$("#disparaFiltro").on('click',function() {
			            	$.post("<?= base_url()?>/Integration/reloadTree", {
			                	variable : 'StokePriceReportFromTree/board/'
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
                                <h6 class="card-subtitle"> Para un mejor desempe&ntilde;o de la aplicaci&oacute;n, debe filtrar el &aacute;rbol de productos y servicios para acceder a ellos </h6>
                                
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
	                            
                                <div class="row">
                                    <button type="button" id="disparaFiltro" class="btn btn-info btn-rounded" data-whatever="@mdo"><i  class="fa fa-filter"></i> Filtrar</button>

                                </div>
<br>

                                <div class="table-responsive">
                                	<!-- Pinto opción para busqueda -->
                                	
			                        
                                    <table id="myTable" class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Despiece</th>
                                                <th>C&oacute;digo</th>
                                                <th>Nombre</th>
                                                <!-- <th>Descripci&oacute;n</th> -->
                                                <th > <i class="fa fa-money"></i> Materiales</th>
                                                <th ><i class="fa fa-money"></i> Mano de obra</th>
                                                <th ><i class="fa fa-money"></i> Adicionales</th>
                                                
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
                                                <td align="center">
                                                    <button type="button" id="zoom<?= $value->CODIGO;?>" class="btn btn-info btn-rounded" data-whatever="@mdo"><i  class="fa fa-search "></i> </button>
                                                 </td>
                                                 <script>
                    
                                                   $(document).ready(function() {
                                                        $("#zoom<?= $value->CODIGO;?>").on('click',function() {
                                                            codigo = <?= $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ARBOLCODIGO", "ID", "CODIGO", $value->CODIGO);?>;
                                                            $.post("<?= base_url()?>Integration/reloadCodeInformation", {
                                                                codigo : codigo
                                                                }, function(data) { 
                                                                    tempo=  data.split('|');
                                                                    $("#nombre").html(tempo[0]);
                                                                    $("#descripcion").html(tempo[1]);
                                                                    $("#despiece").html(tempo[2]);
                                                                });
                                                            $('#myModalDespiece').modal({
                                                                backdrop: 'static',
                                                                keyboard: false
                                                            })

                                                        });
                                                   });
                                                  
                                                 </script>

                                                <td><?= $value->CODIGO;?></td>
                                                <td><?= $value->NOMBRE;?></td>
                                                <!--<td><?= $this->FunctionsGeneral->getFieldFromTableNotId("COT_DESCRIPCION", "DESCRIPCION", "AUXILIAR", $value->CODIGO)?></td> -->
                                                <td><?= $this->FunctionsGeneral->getFieldFromTableNotId("COT_DESCRIPCION", "MATERIALES", "AUXILIAR", $value->CODIGO)?></td>
                                                <td><?= $this->FunctionsGeneral->getFieldFromTableNotId("COT_DESCRIPCION", "MANOOBRA", "AUXILIAR", $value->CODIGO)?></td>
                                                <td><?= $this->FunctionsGeneral->getFieldFromTableNotId("COT_DESCRIPCION", "ASOCIADOS", "AUXILIAR", $value->CODIGO)?></td>
                                                <?php
                                                $estadoCoti=$this->FunctionsGeneral->getFieldFromTableNotId("COT_DESCRIPCION", "ESTADO", "AUXILIAR", $value->CODIGO); 
                                                ?>
                                                <td><span class="<?= validaEstadosGenerales($estadoCoti,'CLASE')?>">
                                                                    <?= validaEstadosGenerales($estadoCoti  ,'NOMBRE') ?>
                                                             </span> </td>
                                                
                                            </tr>
                                            <?php 
                                                            $i++;
                                                             
                                                            }//end foreach
                                                    }//end if
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            
                                                
                                                <td colspan="4">
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


                <!-- .modal -->
                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" id="myModalDespiece">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myLargeModalLabel">Detalle de la informaci&oacute;n del producto o servicio seleccionado</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times "></i></button>
                                </div>
                                <div class="modal-body" style="align:'center'" >
                                    <div class="col-lg-12 col-md-12 col-sm-312 col-xs-12">
                                        <div class="ribbon-wrapper card">
                                            <h3 >Nombre del producto</h3>
                                            <p class="ribbon-content" id="nombre">.</p>
                                            
                                            <h3 >Descripci&oacute;n del producto</h3>
                                            <p class="ribbon-content" id="descripcion">El sistema de informaci&oacute;n est&aacute; cargando la informaci&oacute;n del producto, Por favor espere.</p>
                                            <div class="table-responsive m-t-40" id="despiece">
                                            </div>
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
                
            
