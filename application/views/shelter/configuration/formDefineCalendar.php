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
        		<!-- BEGIN PAGE JQUERY ROUTINES -->
        		<!-- ============================================================== -->
        		
        		
		        
				<!-- ============================================================== -->
				<!-- END PAGE JQUERY ROUTINES -->
        		<!-- ============================================================== -->
        		
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <form class=" form-horizontal" role="form" 
                action="<?= base_url().$pagina?>" 
                id="form_sample_3" 
                method="post"       
                autocomplete="off">
	                <div class="row">
	                    <div class="col-sm-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h5 class="card-title"> Periodo a generar
                            <small class="font-gray">Identifique el periodo que va a generar, tenga en cuenta que el a&ntilde;o siguiente se habilitar&aacute; despu&eacute;s del mes <?= MONTH_OK;?> </small></h5>
	                                	
	                                    <div class="form-group " >
                                        	<label class="col-md-12" for="ano">Periodo a generar* </label>
                                            <div class="col-md-12">
                                            	<select class="form-control" id="ano" name="ano">
                                            				<option value="" ></option>
                                                            <?php
                                                            $ano=date('Y');
                                                            $mes=date('m');
                                                           	if ($mes>MONTH_OK){
                                                           		$tope=$ano+1;
                                                           	}else{
                                                           		$tope=$ano;
                                                           	}
                                                            for($i=$ano;$i<=$tope;$i++){
                                                            ?>
                                                            <option value="<?=$i?>" ><?= $i;?></option>
                                                            <?php 
                                                            }?>
                                                        </select>
                                                <div class="form-control-feedback" > </div>
                                            </div>
                                         </div>
                                         
                                         
                                         
                                                                             

	                                
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                
	                
	                <!-- Botón de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                		<button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
	                	</div>   
	                	<div class="col-sm-12">
	                	<br>
	                	</div> 
	                </div>
	                <!-- FIN Botón de envio de formulario -->
	            </form>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                
            	
        
