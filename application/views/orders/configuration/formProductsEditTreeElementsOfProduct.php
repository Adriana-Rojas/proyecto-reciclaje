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
                
    			<script src="<?= base_url()?>assets/dist/js/pages/mask.js"></script>
    			<!--alerts CSS -->
		    	<link href="<?= base_url()?>assets/node_modules/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
			    <!-- Sweet-Alert  -->
			    <script src="<?= base_url()?>assets/node_modules/sweetalert/sweetalert.min.js"></script>
			    <script src="<?= base_url()?>assets/node_modules/sweetalert/jquery.sweet-alert.custom.js"></script>
                <script type="text/javascript">
		                
		                $(document).ready(function() {
							$("#grupo").change(function() {
								$("#grupo option:selected").each(function() {
									grupo = $('#grupo').val();
									id = $('#id').val();
			 					$.post("<?= base_url()?>/Integration/reloadElements", {
			 						grupo : grupo,
			 						id : id
			 					}, function(data) {
			 							$("#elemento").html(data);
			 							});
								});
							})
						});

		                $(document).ready(function() {
							$('#clona').change( function(){
								if($("#clona").val()!=<?= CTE_VALOR_SI ?> ){
									$(".despiece").hide();
							        $(".despiece").prop('disabled', true);
							        $(".noDespiece").show();
							        $(".noDespiece").prop('disabled', false);
								}else{
									$(document).ready(function() {
			 	                        swal({
			 	                          title: "Clonaci<?= LETRA_MIN_O?>n de despiece ",
			 	                          text: "Tenga en cuenta que al escoger esta opci<?= LETRA_MIN_O?>n  debe seleccionar un producto con despiece previamente configurado y al dar clic en enviar se eliminar<?= LETRA_MIN_A?> el despiece que tenga actualmente  relacionado al presente producto y se crear<?= LETRA_MIN_A?> uno a partir del seleccionado.",
			 	                          type: "info",
			 	                          confirmButtonText: "Continuar",
			 	                          closeOnConfirm: true
			 	                        }
			 	                        );
			 	                    });
									$(".noDespiece").hide();
							        $(".noDespiece").prop('disabled', true);
							        $(".despiece").show();
							        $(".despiece").prop('disabled', false);
								}
						    });
						});
			            
			 	</script>
			 	
			 	
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <form class=" form-horizontal" role="form" 
                action="<?= base_url()?>OrdersConfigurationProductsDefinition/saveElementsOfProducts" 
                id="form_sample_3" 
                method="post"       
                autocomplete="off">
	                <div class="row">
	                    <div class="col-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h4 class="card-title">Configuraci&oacute;n de despiece de productos</h4>
	                                <h6 class="card-subtitle">Administre los diferentes despieces de los productos  disponibles dentro del sistema de informaci&oacute;n</h6>
	                                
	                                </div>
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
	                           
	                           <div class="form-group " >
                               		<label class="col-md-12" for="codigo">C&oacute;digo *</label>
                                    <div class="col-md-12">
                                    	<input type="text" class="form-control" readonly="readonly" value="<?= $codigo ?>" >
	                                    
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
	                           
	                           <div class="form-group " >
                               		<label class="col-md-12" for="nombre">Nombre *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="nombre" name="nombre" 
	                                    	value="<?= $nombre ?>"
	                                        readonly="readonly" >
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
	                           <div class="form-group">
                               		<label class="col-md-12" for="clona">Clona despiece *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control" id="clona" name="clona">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaSiNo as $value) { 
                                            		if($value->ID==CTE_VALOR_NO){
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
                                <div class="form-group despiece" style="display: none;">
                               		<label class="col-md-12" for="despiece">Despiece configurado *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control despiece" id="despiece" name="despiece" disabled="disabled">
                                        	
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php 
                                            if($listaArbol!=null){
                                                foreach ($listaArbol as $value) { 
                                                    //Verifico si el código tiene despiece creado
                                                    if($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_DESPIECE","ID_ARBOLCODIGO", $value->ID)>0){
                                           ?>
                                            <option value="<?= $value->ID;?>"><?= $value->NOMBRE;?></option> 
                                            <?php
                                                    }
                                                }
                                            }?>
                                            
                                        </select>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group noDespiece">
                               		<label class="col-md-12" for="grupo">Grupo *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control noDespiece" id="grupo" name="grupo">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaGrupo as $value) { 
                                            		if($value->ID==$grupo){
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
                               <div class="form-group noDespiece">
                               		<label class="col-md-12" for="elemento">Elemento *</label>
                                    <div class="col-md-12">
	                                    <select class="form-control noDespiece" id="elemento" name="elemento">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            
                                        </select>
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
	                           <div class="form-group noDespiece" >
                               		<label class="col-md-12" for="cantidad">Cantidad *</label>
                                    <div class="col-md-12">
	                                    <input type="text"  class="form-control noDespiece" id="cantidad" name="cantidad" data-mask="99,99" >
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               
                               <div class="row">
                               		<div class="col-md-3 col-lg-3"></div>
	                           		<div class="col-md-6 col-lg-6">
	                           			
                                                <table id="dynamic-table" class="table m-t-30 table-hover " >
                                                    <thead>
                                                        <tr>
                                                            <th width="20%">C&oacute;digo</th>
                                                            <th width="40%">Elemento</th>
                                                             <th width="10%">Comod&iacute;n</th>
                                                            <th width="10%">Cantidad</th>
                                                            <th width="10%">Unidad</th>
                                                            <th width="20%">Eliminar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        if($listaDespiece!=null){
                                                        	foreach ($listaDespiece as $value){
                                                        	
                                                        ?>

                                                        <tr >
                                                            <td> <?= $value->CODIGO?></td>
                                                            <td> <?= $value->NOMBRE?></td>
                                                            <td > 
                                                            	<span class="<?= validaComodin($value->COMODIN,'CLASE')?>">
                                                                    <?= validaComodin($value->COMODIN,'NOMBRE') ?>
                                                             	</span>
                                                            </td>
                                                            <td> <?= $value->CANTIDAD?></td>
                                                            <td> <?= $value->UNIDAD?></td>
                                                            <td>
                                                            	<a href="<?= base_url()?>OrdersConfigurationProductsDefinition/saveElementsOfProducts/<?= $id;?>/<?= $this->encryption->encrypt($value->ID_DESPIECE);?>" class="btn btn-danger btn-rounded waves-effect waves-light m-r-10"> 
					                                                <i class="fa fa-ban"></i>
					                                            </a>
                                                            	
		                                            </td>
                                                            
                                                        </tr>
                                                            <?php } }?>
                                                    </tbody>
                                                </table>
                                           
                                     </div>
                                     <div class="col-md-3 col-lg-3"></div>
	                           </div>
                               
	                        </div> <!-- End Card -->   
	                    </div> <!-- End Col -->
	                </div> <!-- End Row -->
	                <!-- Botón de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                		<a href="<?= base_url()?><?= $mainPage ?>" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
                                                <i class="fa fa-arrow-left"></i>
                                                <span class="hidden-xs"> Retornar</span>
                                            </a>
                            <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
	                		<input type="hidden" name="idArbol" id="idArbol" value="<?= $idArbol;?>">
	                		<input type="hidden" name="id" id="id" value="<?= $id;?>">
	                		<input type="hidden" name="tipoOrden" id="tipoOrden" value="<?= $tipoOrden;?>">
	                		
	                	</div>   
	                	<div class="col-sm-12">
	                	<br>
	                	</div> 
	                </div>
	                
                   <!-- /.modal -->
	        		<!-- FIN Botón de envio de formulario -->
	            </form>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                
            
