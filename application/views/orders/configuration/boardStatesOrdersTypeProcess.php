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
                <form class=" form-horizontal" role="form" action="<?= base_url()?><?= $pagina ?>" 
                id="form_sample_3" 
                method="post"       
                autocomplete="off">
	                <div class="row">
	                    <div class="col-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h4 class="card-title"><?= $board;?></h4>
	                                <h6 class="card-subtitle"></h6>
	                                
	                                <div class="form-group">
                               		<label class="col-md-12" for="proceso">Proceso *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="proceso" name="proceso">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaProceso->result() as $value) { 
                                                  	if($value->ID==$proceso){
                                                    	$selected="selected='selected'";
                                                    }else{
                                                    	$selected="";
                                                    }
                                            ?>
                                            <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option> 
                                            <?php
                                            }?>
                                        </select>
	                                    <div class="form-control-feedback" > </div>
	                                    </div>
	                               </div>
	                               <div class="form-group">
	                               		<label class="col-md-12" for="tipo">Tipo de Orden *</label>
	                                    <div class="col-md-12">
		                                    <select class="form-control" id="tipo" name="tipo">
	                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
	                                            <?php foreach ($listaTipo->result() as $value) { 
	                                                  	if($value->ID==$tipo){
	                                                    	$selected="selected='selected'";
	                                                    }else{
	                                                    	$selected="";
	                                                    }
	                                            ?>
	                                            <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option> 
	                                            <?php
	                                            }?>
	                                        </select>
		                                    <div class="form-control-feedback" > </div>
	                                    </div>
	                               </div>
	                               <div class="col-sm-12">
				                		<button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
				                		
				                	</div>   
				                	<div class="col-sm-12">
				                	<br>
				                	</div> 
	                                
	                                
	                                
	                                
	                                <div class="table-responsive">
	                                    <table id="demo-foo-addrow" class="table m-t-30 table-hover " data-page-size="20">
	                                        <thead>
	                                            <tr>
													<th>Acci&oacute;n</th>
	                                                <th>Proceso</th>
	                                                <th >Tipo de orden</th>
	                                                <th >Nombre de Estado</th>
	                                                <th>Estado</th>
	                                            </tr>
	                                        </thead>
	                                        <tbody>
	                                        	<?php 
	                                                        
	                                                            $i=1;
	                                                            if($listaLista != null){
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
	                                                            		$pagina="OrdersConfigurationStatesOrdersType/edit/";
	                                                                	if($listaBoard!=null){
	                                                                    	foreach ($listaBoard as $valueBoard) {
	                                                                    		if(($value->ID_ESTADO>0) && $valueBoard->PAGINA==$pagina ){
	                                                                                
																	?>
	                                                                <a class="dropdown-item" 
	                                                                	href="<?= base_url().$valueBoard->PAGINA.$this->encryption->encrypt($value->ID); ?>" >
	                                                                    <i class="<?= $valueBoard->ICONO ?>"></i> 
	                                                                    <?= $valueBoard->NOMBRE ?> 
	                                                                </a>
	                                                                <?php 
	                                                                    		}else if($valueBoard->PAGINA!=$pagina ){
	                                                                    			?>
	                                                                 <a class="dropdown-item" href="<?= base_url().$valueBoard->PAGINA.$this->encryption->encrypt($value->ID); ?>" >
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
	                                                <td><?= $value->PROCESO;?></td>
	                                                <td>
	                                                    <?= $value->TIPOORDEN;?>
	                                                </td>
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
	                                        <tfoot>
	                                            <tr>
	                                                <td colspan="3">
	                                                    <?php
	                                                if ($botonesBoard!=null){
			                                                foreach ($botonesBoard as $value) {
			                                            ?>
			                                            <a href="<?= base_url().$value->PAGINA; ?><?= $procesoId?>/<?= $tipoId?>" class="btn btn-info btn-rounded"> 
			                                                <i  class="<?= $value->ICONO ?>"></i>
			                                                <span class="hidden-xs"> <?= $value->NOMBRE ?></span>
			                                            </a>
			                                            <?php 
			                                                }
	                                                 ?>
	                                            
	                                                   
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
	                                <?php }//end if?>
	                            </div>
	                        </div>
	                        
	                    </div>
	                </div>
	            </form>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                
            
