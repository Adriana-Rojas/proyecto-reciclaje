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
                <script type="text/javascript">
	                function validar(check,opcion) { 
				    	//Compruebo si la casilla está marcada 
				    	if (check.checked==true){ 
			                //está marcada, entonces aumento en uno el contador del grupo 
			                opcion.value++; 
			            }else { 
			                //si la casilla no estaba marcada, resto uno al contador de grupo
			                opcion.value--; 
			            } 
				    }
                </script>
                
                <!-- ============================================================== -->
                <!-- FIn JavaScript para pintar campos adicionales -->
                <!-- ============================================================== -->
        	
        
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <form class=" form-horizontal" role="form" 
                action="<?= base_url()?>OrdersConfigurationTreeDefinition/<?= $enlace?>" 
                id="form_sample_3" 
                method="post"       
                autocomplete="off">
	                <div class="row">
	                    <div class="col-12">
	                        <div class="card">
	                           <div class="card-body">
	                                <h4 class="card-title">Definici&oacute;n de segundo nivel para &aacute;rbol de &oacute;rdenes </h4>
	                                <h6 class="card-subtitle">Se tendr&aacute; por configurar <?= $cantidadNiveles;?> sub niveles. </h6>
	                                
	                            </div>
	                            
	                            <div class="row">
                               		<!-- Column -->
                                    
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        
                                    </div>
                                    
                                    <!-- Column -->
                                   <div class="col-md-3 col-lg-3 col-xlg-3">
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
                                    <div class="col-md-3 col-lg-3 col-xlg-3">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Subnivel</h3>
                                                <h6 class="text-white"><?= $subnivel;?></h7>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        
                                    </div>
                                    <!-- Column -->
                                   
                                </div>
                                
                                
	                            <center> 
	                            <div class="table-responsive">
                                    <table id="demo-foo-addrow" class="table"  style="width: 50%">
                                        <thead>
                                            <tr align="center">
                                                <th align="center">Primer nivel</th>
                                                <?php 
                                                	if($listaDatosNivVal != null){
                                                		foreach ($listaDatosNivVal as $v) {
                                                ?>
                                                <th align="center"><?= $v->NOMBRE;?></th>
                                                <?php 
                                                        }//end foreach
                                                    }//end if
                                            	?>
                                            	 <th align="center">Validador</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php 
                                                        if($listaNivel != null){
                                                            foreach ($listaNivel as $value) {
                                                    ?>
                                            <tr align="center">
                                                <td><?= $value->NOMBRE;?></td>
                                                <?php 
                                                	$i=0;
                                                	if($listaDatosNivVal != null){
                                                		foreach ($listaDatosNivVal as $v) {
                                                			$i++;
                                                ?>
                                                <td align="center">
                                                	<!-- <input type="checkbox" class="check" onclick="alert('arriba')"
                                                	data-checkbox="icheckbox_flat-blue" 
                                                	name="check_<?= $value->ID;?>_<?= $v->ID;?>" 
                                                	id="check_<?= $value->ID;?>_<?= $v->ID;?>"
                                                	value="<?= $v->ID;?>"
                                                	checked="checked" >
                                                	 -->
                                                	<input type="checkbox"  onclick="validar(check_<?= $value->ID;?>_<?= $v->ID;?>,text_<?= $value->ID;?>)" checked="checked" name="check_<?= $value->ID;?>_<?= $v->ID;?>" 
                                                	id="check_<?= $value->ID;?>_<?= $v->ID;?>" >
                                                </td>
                                                <?php 
                                                        }//end foreach
                                                    }//end if
                                            	?>
                                            	<td> 
                                            		<div class="form-group">
                                            			<input type="text" class="form-control" readonly="readonly"  
                                            			   id="text_<?= $value->ID;?>"
                                            			   name="text_<?= $value->ID;?>"
                                            				value="<?= $i;?>">
                                            			<div class="form-control-feedback" > </div>
                                            		</div>
                                            	</td>
                                            </tr>
                                            <?php 
                                                            }//end foreach
                                                    }//end if
                                            ?>
                                        </tbody>
                                        
                                    </table>
                                </div>
	                            </center>
	                            
	                           
	                           
                               
                            </div>
	                    </div>
	                </div>
	                <!-- Botón de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                		
                            <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
	                		<input type="hidden" name="id" id="id" value="<?= $id;?>">
	                		<input type="hidden" name="tipo" id="tipo" value="<?= $valorTipo;?>">
	                		<input type="hidden" name="miembros" id="miembros" value="<?= $valorMiembros;?>">
                            <input type="hidden" name="secuencia" id="secuencia" value="<?= $secuencia;?>">
                            <input type="hidden" name="idSubNivel" id="idSubNivel" value="<?= $idSubNivel;?>">
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
                
            
