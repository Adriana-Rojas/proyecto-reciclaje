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
                <script type="text/javascript">
		               
	                $(document).ready(function() {
						$('#estado').change( function(){
							if($("#estado").val()==<?= STATE_CANCEL ?> || $("#estado").val()==<?= STATE_CORRECT ?> || $("#estado").val()==<?= STATE_SUSPEND ?>){
								$(".comodin").prop('disabled', true);
								$(".comodin").hide();
							}else{
								$(".comodin").prop('disabled', false);
								$(".comodin").show();
							}
					    });
					});
		                
			            
			 	</script>
                               
                
                <!-- ============================================================== -->
                <!-- FIn JavaScript para pintar campos adicionales -->
                <!-- ============================================================== -->
        	
        
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
	                                <h4 class="card-title">Definici&oacute;n de Tipos de orden Vs Estados</h4>
	                            </div>
	                            
	                            
                                
	                            <?php if ($tempo!='edit'){?>
	                            
	                            <div class="row">
                               
                               		<!-- Column -->
                                    
                                    <div class="col-md-3 col-lg-3 col-xlg-3">
                                        
                                    </div>
                                    <!-- Column -->
                                     <div class="col-md-3 col-lg-3 col-xlg-3">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?>  text-center">
                                                <h3 class="font-light text-white">Proceso</h3>
                                                <h6 class="text-white"><?= $procesoNombre;?></h6>
                                                <input type="hidden" name="proceso" id="proceso" value="<?= $proceso;?>">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                     <div class="col-md-3 col-lg-3 col-xlg-3">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Tipo de orden</h3>
                                                <h6 class="text-white"><?= $tipoNombre;?></h6>
                                                <input type="hidden" name="tipo" id="tipo" value="<?= $tipo;?>">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Column -->
                                    
                                    <div class="col-md-3 col-lg-3 col-xlg-3">
                                        
                                    </div>
                                    <!-- Column -->
                                   
                                </div>
                                
	                            <div class="form-group">
                               		<label class="col-md-12" for="estado">Estado *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="estado" name="estado">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaEstado->result() as $value) { 
                                            		//Verifico si el estado ya est� relacionado con el $proceso el $tipoOrden
                                            		if($this->FunctionsGeneral->getQuantityFieldFromTable(
                                            				"ORD_TORDPROEST",
                                            				"ID_TORDPRO",
                                            				$tipoOrden, 
                                            				"ID_ESTADO",
                                            				$value->ID)==0){
                                                  	if($value->ID==$estado){
                                                    	$selected="selected='selected'";
                                                    }else{
                                                    	$selected="";
                                                    }
                                            ?>
                                            <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option> 
                                            <?php
                                            }
                                            }?>
                                        </select>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <?php }else{?>
                               
                               <div class="row">
                               
                               		<!-- Column -->
                                    
                                    <div class="col-md-3 col-lg-3 col-xlg-3">
                                        
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?>  text-center">
                                                <h3 class="font-light text-white">Proceso</h3>
                                                <h6 class="text-white"><?= $proceso;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Tipo de orden</h3>
                                                <h6 class="text-white"><?= $tipo;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Estado</h3>
                                                <h6 class="text-white"><?= $estado;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    
                                    <div class="col-md-3 col-lg-3 col-xlg-3">
                                        
                                    </div>
                                    <!-- Column -->
                                   
                                </div>
                               
                               
                               
                               
                               <?php }?>
	                            <div class="form-group comodin">
                               		<label class="col-md-12" for="bajoMin">Tiempo m&iacute;nimo en complejidad baja *</label>
                                    <div class="col-md-12">
                                    	<input class="form-control comodin" id="bajoMin" name="bajoMin" placeholder="Ej. 1" value="<?= $bajoMin ?>">
                                    	
                                    </div>
                               </div>
                               <div class="form-group comodin">
                               		<label class="col-md-12" for="bajoMax">Tiempo m&aacute;ximo en complejidad baja *</label>
                                    <div class="col-md-12">
                                    	<input class="form-control comodin" id="bajoMax" name="bajoMax" placeholder="Ej. 2" value="<?= $bajoMax ?>">
                                    	
                                    </div>
                               </div>
                               <div class="form-group comodin">
                               		<label class="col-md-12" for="bColor">Color en complejidad baja *</label>
                                    <div class="col-md-12">
                                    	<input type="color" class="form-control comodin" id="bColor" name="bColor"  value="<?= $bColor ?>">
                                    </div>
                               </div>
                               <div class="form-group comodin">
                               		<label class="col-md-12" for="medioMin">Tiempo m&iacute;nimo en complejidad media *</label>
                                    <div class="col-md-12">
                                    	<input class="form-control comodin" id="medioMin" name="medioMin" placeholder="Ej. 2" value="<?= $medioMin ?>">
                                    	
                                    </div>
                               </div>
                               <div class="form-group comodin">
                               		<label class="col-md-12" for="medioMax">Tiempo m&aacute;ximo en complejidad media *</label>
                                    <div class="col-md-12">
                                    	<input class="form-control comodin" id="medioMax" name="medioMax" placeholder="Ej. 3" value="<?= $medioMax ?>">
                                    
                                    </div>
                               </div>
                               <div class="form-group comodin">
                               		<label class="col-md-12" for="mColor">Color en complejidad media *</label>
                                    <div class="col-md-12">
                                    	<input type="color" class="form-control comodin" id="mColor" name="mColor"  value="<?= $mColor ?>">
                                    </div>
                               </div>
                               <div class="form-group comodin">
                               		<label class="col-md-12" for="altoMin">Tiempo m&iacute;nimo en complejidad alta *</label>
                                    <div class="col-md-12">
                                    	<input class="form-control comodin" id="altoMin" name="altoMin" placeholder="Ej. 3" value="<?= $altoMin ?>">
                                    	
                                    </div>
                               </div>
                               <div class="form-group comodin">
                               		<label class="col-md-12" for="altoMax">Tiempo m&aacute;ximo en complejidad alta *</label>
                                    <div class="col-md-12">
                                    	<input class="form-control comodin" id="altoMax" name="altoMax" placeholder="Ej. 4" value="<?= $altoMax ?>">
                                    	
                                    </div>
                               </div>
                               <div class="form-group comodin">
                               		<label class="col-md-12" for="aColor">Color en complejidad alta *</label>
                                    <div class="col-md-12">
                                    	<input type="color" class="form-control comodin" id="aColor" name="aColor"  value="<?= $aColor ?>">
                                    </div>
                               </div>
                               
	                        </div>
	                    </div>
	                </div>
	                <!-- Bot�n de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                		<a href="<?= base_url()?>OrdersConfigurationStatesOrdersType/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
                                                <i class="fa fa-arrow-left"></i>
                                                <span class="hidden-xs"> Retornar</span>
                                            </a>
                            <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
	                		<input type="hidden" name="id" id="id" value="<?= $id;?>">
                            <input type="hidden" name="valida" id="valida" value="<?= $valida;?>">
	                	</div>   
	                	<div class="col-sm-12">
	                	<br>
	                	</div> 
	                </div>
	                <!-- FIN Bot�n de envio de formulario -->
	            </form>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                
            
