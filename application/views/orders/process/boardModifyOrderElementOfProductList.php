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
                <!-- Start JavaScript para pintar campos adicionales -->
                <!-- ============================================================== -->
                
    			<!-- ============================================================== -->
                <!-- End JavaScript para pintar campos adicionales -->
                <!-- ============================================================== -->
                
			 	
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <form class=" form-horizontal" role="form" action="<?= base_url()?>OrdersAppOrder/saveUpdateElementsOfProduct" 
		                id="form_sample_3" 
		                method="post"       
		                autocomplete="off">
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-3 col-xlg-3 col-md-3">
                        <div class="card">
                        	<?php 
                                foreach ($paciente as $value){
                                	
                                ?>
                            <div class="card-body">
                                <div class="user-btm-box">
                                	<!-- .row -->
                                    <div class="row text-center m-t-10">
                                        <div class="col-md-12">
                                        	<span class="<?= datosGeneroPersona($value->SEXO,'CLASE','fa-4x')?>">
                                                     	<?= datosGeneroPersona($value->SEXO,'NOMBRE','fa-4x') ?>
                                            </span>
                                            <br>
                                            <strong>Nombres completos</strong>
                                            <p><?= $value->PRI_NOM_PCTE," ",$value->SEG_NOM_PCTE," ",$value->PRI_APELL_PCTE," ",$value->SEG_APELL_PCTE;?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- .row -->
                                    <div class="row text-center m-t-10">
                                        <div class="col-md-6 b-r"><strong>Historia cl&iacute;nica</strong>
                                            <p><?= $value->ID_PCTE;?></p>
                                        </div>
                                        <div class="col-md-6"><strong>Documento de identidad</strong>
                                            <p><?= $value->TP_ID_PCTE," ",$value->NUM_ID_PCTE;?></p>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                    <hr>
                                    <!-- .row -->
                                    <div class="row text-center m-t-10">
                                        <div class="col-md-6 b-r"><strong>Edad</strong>
                                            <p><?=intervaloTiempo($value->FECH_NCTO_PCTE,cambiaHoraServer(2),31104000);
                                                	?> A&ntilde;os</p>
                                        </div>
                                        <div class="col-md-6"><strong>Responsable</strong>
                                            <p><?= $value->RESPONSABLE;?></p>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                    <hr>
                                    
                                    
                                    
                                </div>
                            </div>
                            <?php 
                                }?>
                        </div>
	                        <div class="card">
	                            <div class="card-body">
	                                <h5 class="card-title">Ruta del producto</h5>
	                                <?php if ($niveles==3){
		                            ?>   
		                            <div class="row">
	                               		<!-- Column -->
	                                    
	                                    
	                                   <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Tipo de orden: <small class="text-white"><?= $nombreTipo;?></small></h4>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <!-- Column -->
	                                    <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Ubicaci&oacute;n: <small class="text-white"><?= $nombreMiembros;?></small> </h4>
	                                                
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <!-- Column -->
	                                    <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Primer subnivel: <small class="text-white"><?= $nomPrimerSubNiv;?></small></h4>
	                                                
	                                            </div>
	                                        </div>
	                                    </div>
	                                    
	                                    <!-- Column -->
	                                    <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Segundo subnivel: <small class="text-white"><?= $nomSegundoSubNiv;?></small></h4>
	                                                
	                                            </div>
	                                        </div>
	                                    </div>
	                                    
	                                    <!-- Column -->
	                                    <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Tercer subnivel: <small class="text-white"><?= $nomTerceroSubNiv;?></small></h4>
	                                                
	                                            </div>
	                                        </div>
	                                    </div>
	                                    
	                                   
	                                   
	                                </div>
		                            <?php }?>
		                            <?php if ($niveles==2){
		                            ?>   
		                            <div class="row">
	                               		<div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Tipo de orden: <small class="text-white"><?= $nombreTipo;?></small></h4>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <!-- Column -->
	                                    <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Ubicaci&oacute;n: <small class="text-white"><?= $nombreMiembros;?></small> </h4>
	                                                
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <!-- Column -->
	                                    <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Primer subnivel: <small class="text-white"><?= $nomPrimerSubNiv;?></small></h4>
	                                                
	                                            </div>
	                                        </div>
	                                    </div>
	                                    
	                                    <!-- Column -->
	                                    <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Segundo subnivel: <small class="text-white"><?= $nomSegundoSubNiv;?></small></h4>
	                                                
	                                            </div>
	                                        </div>
	                                    </div>
	                                   
	                                </div>
		                            <?php }?> 
		                            <?php if ($niveles==1){
		                            ?>   
		                            <div class="row">
	                               		<div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Tipo de orden: <small class="text-white"><?= $nombreTipo;?></small></h4>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <!-- Column -->
	                                    <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Ubicaci&oacute;n: <small class="text-white"><?= $nombreMiembros;?></small> </h4>
	                                                
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <!-- Column -->
	                                    <div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Primer subnivel: <small class="text-white"><?= $nomPrimerSubNiv;?></small></h4>
	                                                
	                                            </div>
	                                        </div>
	                                    </div>
	                                    
	                                  
	                                   
	                                </div>
		                            <?php }?> 
		                            <div class="row">
	                               		<div class="col-lg-12 col-xlg-12 col-md-12">
	                                        <div class="card">
	                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
	                                                <h4 class="font-light text-white">Producto: <small class="text-white"><?= $codigo." - ".$nombre;?></small></h4>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-lg-9 col-xlg-9 col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Configuraci&oacute;n de despiece de elementos</h5>
								<h6 class="card-subtitle">Defina los elementos que har&aacute;n parte del despiece del producto</h6>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                            	<th>Acci&oacute;n</th>
                                               <!--  <th>Comod&iacute;n</th> -->
                                                <th>C&oacute;digo</th>
                                                <th >Nombre</th>
                                                <th>Unidad</th>
                                                <th>Cantidad</th>
                                                <th>Traslado</th>
                                                <th>Salida</th>
                                                <th>Serial</th>
                                                <th>Lote</th>
                                                
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
                                                                    		if ($valueBoard->ID==118 || $valueBoard->ID==146 || $valueBoard->ID==155 || $valueBoard->ID==163){
                                                                    			if($value->COMODIN==CTE_VALOR_SI){
                                                                    				
                                                                    			
                                                                ?>
                                                                <a class="dropdown-item" href="<?= base_url().$valueBoard->PAGINA.$id."/".$idOrden."/".$this->encryption->encrypt($value->ID); ?>" >
                                                                    	<i class="<?= $valueBoard->ICONO ?>"></i> 
                                                                    	<?= $valueBoard->NOMBRE ?> 
                                                                </a>
                                                                <?php
                                                                    			}
                                                                    		}else if ($valueBoard->ID==119 || $valueBoard->ID==147 || $valueBoard->ID==156 || $valueBoard->ID==164){
                                                                    			if($value->COMODIN==CTE_VALOR_NO){
                                                                ?>
                                                                <a class="dropdown-item" href="<?= base_url().$valueBoard->PAGINA.$id."/".$idOrden."/".$this->encryption->encrypt($value->ID)."/".$this->encryption->encrypt ( 'trace' ); ?>" >
	                                                                 <i class="<?= $valueBoard->ICONO ?>"></i> 
	                                                                 <?= $valueBoard->NOMBRE ?> 
                                                                </a>
                                                                <?php
                                                                    	 		}
                                                                    		}
                                                                         }
				                                                   } 
				                                                ?>
                                                           </div>
                                                    </div>
                                                </td>
                                            	<!-- <td align="center">
                                                	<span class="<?= validaComodin($value->COMODIN,'CLASE')?>">
                                                                    <?= validaComodin($value->COMODIN,'NOMBRE') ?>
                                                    </span>    
                                                </td> -->
                                                <td>
                                                    <?= $value->CODIGO;?>
                                                </td>
                                                <td>
                                                	<?= $value->NOMBRE;?>
                                                </td>
                                                <td>
                                                	<?= $value->VALOR	;?>
                                                </td>
                                                <td>
                                                	<?= $value->CANTIDAD	;?>
                                                </td>
                                                <td>
                                                	<input type="text" class="form-control" id="traslado<?= $value->ID;?>" name="traslado<?= $value->ID;?>"  placeholder="Ej. 1425" width="25%" value="<?= $this->encryption->decrypt ($value->TRASLADO	);?>" >
                                                </td>
                                                <td>
                                                	<input type="text" class="form-control" id="salida<?= $value->ID;?>" name="salida<?= $value->ID;?>"  placeholder="Ej. 1213" width="25%"  value="<?= $this->encryption->decrypt ($value->SALIDA)	;?>">
                                                </td>
                                                <td>
                                                	<input type="text" class="form-control" id="serial<?= $value->ID;?>" name="serial<?= $value->ID;?>"  placeholder="Ej. 23123seqw" width="25%" value="<?= $this->encryption->decrypt ($value->SERIAL)	;?>">
                                                </td>
                                                <td>
                                                	<input type="text" class="form-control" id="lote<?= $value->ID;?>" name="lote<?= $value->ID;?>"  placeholder="Ej. 12312-2" width="25%" value="<?= $this->encryption->decrypt ($value->LOTE)	;?>">
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
                                <?php 
                                    $pagina="OrdersAppOrder/orderList/".$id;
                                ?>
                                <a href="<?= base_url().$pagina?>" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
			                                                <i class="fa fa-arrow-left"></i>
			                                                <span class="hidden-xs"> Retornar</span>
			                                            </a> 
			                    <a href="<?= base_url()?>OrdersAppOrder/moreElementsOfProduct/<?= $id;?>/<?= $idOrden;?>/<?= $this->encryption->encrypt ( 'trace' );?>" class="btn  btn-info btn-rounded pull-left waves-effect waves-light m-r-10"> 
			                     <i class="fa fa-plus-square"></i>
			                     <span class="hidden-xs"> Adicionar elemento</span>
			                    </a> 
                                
                                <button type="submit" class="btn btn-dark btn-rounded waves-effect waves-light m-r-10 pull-right"> <i class='fa fa-floppy-o'></i> Guardar modificaciones</button>
	                			
	                			<input type="hidden" name="id" id="id" value="<?= $id;?>">
	                			<input type="hidden" name="idOrden" id="idOrden" value="<?= $idOrden;?>">
                                
                            </div>
                        </div>
                    </div>
                    
                    <!-- Column -->
                </div>
	            </form>    
	            <!-- ============================================================== -->
	            <!-- End PAge Content -->
	            <!-- ============================================================== -->
                
            
