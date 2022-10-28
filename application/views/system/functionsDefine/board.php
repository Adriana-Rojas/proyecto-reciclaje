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
                 <form class=" form-horizontal" role="form" action="<?= base_url()?><?= $pagina ?>" 
                id="form_sample_3" 
                method="post"       
                autocomplete="off">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Administraci&oacute;n de listas para la aplicaci&oacute;n</h4>
                                <h6 class="card-subtitle"></h6>
                                <div class="form-group">
                               		<label class="col-md-12" for="modulo">M&oacute;dulo *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="modulo" name="modulo">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaProceso as $value) { 
                                                  	if($value->ID==$modulo){
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
				                <?php 
                                if($listaLista != null){
                                
                                	
                                ?>
                                
                                
                                
                                <div class="table-responsive">
                                    <table id="demo-foo-addrow" class="table m-t-30 table-hover " data-page-size="20">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th width="30%">M&oacute;dulo</th>
                                                <th width="30%">Funci&oacute;n</th>
                                                <th>Estado</th>
                                                <th>Acci&oacute;n</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php 
                                            	$i=1;
                                                foreach ($listaLista as $value) {
                                            ?>
                                            <tr>
                                                <td><?= $i;?></td>
                                                <td>
                                                    <?= $value->MODULO;?>
                                                </td>
                                                <td>
                                                    <?= $value->NOMBRE;?>
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
                                                   
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td >
                                                    <?php
                                                if ($botonesBoard!=null){
		                                                foreach ($botonesBoard as $value) {
		                                            ?>
		                                            <a href="<?= base_url().$value->PAGINA; ?><?= $moduloId;?>" class="btn btn-info btn-rounded"> 
		                                                <i  class="<?= $value->ICONO ?>"></i>
		                                                <span class="hidden-xs"> <?= $value->NOMBRE ?></span>
		                                            </a>
		                                            <?php 
		                                                }
                                                } ?>
                                            
                                                   
                                                </td>
                                                
                                                <td colspan="4">
                                                    <div class="text-right">
                                                        <ul class="pagination"> </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <?php 
								}	
                                ?>
                            </div>
                        </div>
                        
                    </div>
                </div>
                </form>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                
            
